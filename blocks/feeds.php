<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use blitze\sitemaker\services\blocks\driver\block;
use blitze\sitemaker\services\feeds\Feed;

/**
 * Feeds Block
 */
class feeds extends block
{
	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\twig\environment */
	protected $twig;

	/** @var string */
	protected $phpbb_root_path;

	/** @var array */
	protected $feed_fields = ['title', 'description', 'category', 'categories', 'author', 'authors', 'contributor', 'contributors', 'copyright', 'image_url', 'image_title', 'image_link', 'image_width', 'image_height', 'permalink', 'link', 'links'];

	/** @var array */
	protected $item_fields = ['id', 'title', 'description', 'content', 'category', 'categories', 'author', 'authors', 'contributor', 'contributors', 'copyright', 'date', 'updated_date', 'gmdate', 'updated_gmdate', 'permalink', 'link', 'links', 'enclosure', 'enclosures', 'latitude', 'longitude', 'source'];

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language				$translator			Language object
	 * @param \phpbb\request\request_interface		$request			Request object
	 * @param \phpbb\template\twig\environment		$twig				Twig environment
	 * @param string 								$phpbb_root_path	Relative path to phpBB root
	 */
	public function __construct(\phpbb\language\language $translator, \phpbb\request\request_interface $request, \phpbb\template\twig\environment $twig, $phpbb_root_path)
	{
		$this->translator = $translator;
		$this->request = $request;
		$this->twig = $twig;
		$this->cache_dir = $phpbb_root_path;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		return array(
			'legend1'			=> 'SETTINGS',
			'feeds'			=> array('type' => 'custom', 'default' => [], 'object' => $this, 'method' => 'get_feeds_ui', 'params' => [$settings['feeds'], $settings['template']]),
			'max'			=> array('lang' => 'MAX_ITEMS', 'validate' => 'int:1', 'type' => 'number:1', 'default' => 5),
			'cache'			=> array('lang' => 'CACHE_DURATION', 'validate' => 'int:1', 'type' => 'number:1', 'default' => 6, 'append' => 'HOURS_SHORT'),
			'template'		=> array('type' => 'hidden', 'default' => '<a target="_blank" href="{{ item.link }}">{{ item.title }}</a>'),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$settings = $bdata['settings'];
		$title = 'FEEDS';
		$content = '';

		if ($settings['feeds'])
		{
			try
			{
				$template = $this->twig->createTemplate($this->get_template($settings['template']));
				
				if ($items = $this->get_feed_items(array_filter((array) $settings['feeds']), $settings['max'], $settings['cache']))
				{
					return array(
						'title'		=> $title,
						'content'	=> $template->render([
							'items'	=> $items,
					]));
				}
				
				$content = $this->translator->lang('FEED_PROBLEMS');
			}
			catch (\Exception $e)
			{
				$content = $e->getMessage();
			}
		}
		else
		{
			$content = $this->translator->lang('FEED_MISSING');
		}

		return array(
			'title'		=> $title,
			'content'	=> ($edit_mode) ? $content : '',
		);
	}

	/**
	 * @param array $feed_urls
	 * @param int $max
	 * @param int $cache
	 * @return array
	 */
	protected function get_feed_items(array $feed_urls, $max, $cache = 0, $items_per_feed = 0)
	{
		$items = [];
		if (sizeof($feed_urls))
		{
			$feed = new Feed;
			$feed->set_feed_url($feed_urls);
			$feed->enable_cache((bool) $cache);
			$feed->set_cache_location($this->cache_dir);
			$feed->set_cache_duration($cache * 3600);

			if ($items_per_feed) {
				$feed->set_item_limit($items_per_feed);
			}

			$feed->init();
			$feed->handle_content_type();

			$items = $feed->get_items(0, $max);
		}

		return $items;
	}

	/**
	 * @param mixed $feeds
	 * @param string $template
	 * @return string
	 */
	public function get_feeds_ui($feeds, $template)
	{
		$this->ptemplate->assign_vars([
			'feeds'		=> array_filter((array) $feeds),
			'template'	=> $template,
		]);

		return $this->ptemplate->render_view('blitze/sitemaker', 'blocks/feeds_settings.html', 'feeds_settings');
	}

	/**
	 * Called when editing feed block to get available rss/atom fields
	 * @return array
	 */
	public function get_fields()
	{
		$feeds = $this->request->variable('feeds', array(0 => ''));

		$this->translator->add_lang('feed_fields', 'blitze/sitemaker');

		$feeds = array_filter(array_map('trim', $feeds));
		$feed_items = $this->get_feed_items($feeds, 0, 0, 1);

		$data['items'] = [];
		$fields['items'] = $this->get_field_defaults('items');

		foreach ($feed_items as $feed)
		{
			$feed_data = $feed_fields = [];
			$fields['items']['children'] += $this->get_feed_fields($feed, $feed_data);

			foreach ($this->item_fields as $field)
			{
				$value = $feed->{$field};
				$feed_data[$field] = $value;
				$feed_fields[$field] = $this->buildTags($field, $value);
			}

			$data['items'][] = array_filter($feed_data);
			$fields['items']['children'] = array_replace_recursive($fields['items']['children'], array_filter($feed_fields));
		}

		return [
			'fields'	=> array_filter($fields),
			'data'		=> array_filter($data),
		];
	}

	/**
	 * @param \blitze\sitemaker\services\feeds\Item $feed
	 * @return array
	 */
	protected function get_feed_fields(\blitze\sitemaker\services\feeds\Item $feed, array &$data)
	{
		$feed_props = [];
		foreach ($this->feed_fields as $field)
		{
			$feed_props[$field] = $this->buildTags($field, $feed->feed->{$field});
			$data['feed'][$field] = $feed->feed->{$field};
		}

		$feed_props = array_filter($feed_props);
		$data['feed'] = array_filter($data['feed']);

		$fields = [];
		if (sizeof($feed_props))
		{
			$fields['feed'] = $this->get_field_defaults('feed');
			$fields['feed']['children'] = $feed_props;
		}

		return $fields;
	}

	/**
	 * @param string $field
	 * @param mixed $value
	 * @return array
	 */
	protected function buildTags($field, $value)
	{
		if (empty($value))
		{
			return '';
		}

		$data = $this->get_field_defaults($field);

		if ($this->is_array_of_objects($value))
		{
			$value = array_slice($value, 0, 1);
			$this->iterate_props($value, $data);
		}
		else if (gettype($value) === 'object')
		{
			$props = array_filter(get_object_vars($value));
			$this->iterate_props($props, $data);
		}

		return $data;
	}

	/**
	 * @param array $props
	 * @param array $data
	 * @return void
	 */
	protected function iterate_props(array $props, array &$data)
	{
		ksort($props);
		foreach ($props as $prop => $value)
		{
			$data['children'][$prop] = $this->buildTags($prop, $value);
		}
	}

	/**
	 * @param mixed $value
	 * @return bool
	 */
	protected function is_array_of_objects($value)
	{
		return (is_array($value) && gettype($value[0]) === 'object');
	}

	/**
	 * @param string $field
	 * @return array
	 */
	protected function get_field_defaults($field)
	{
		$field = (string) $field;
		return [
			'text'			=> $field,
			'displayText'	=> $this->translator->lang(strtoupper($field)),
			'children'		=> [],
		];
	}

	/**
	 * @param string $tpl
	 * @return string
	 */
	protected function get_template($item_tpl)
	{
		$item_tpl = html_entity_decode(trim($item_tpl));
		return "<ul class=\"sm-list\">
			{% for item in items %}
			<li>
				$item_tpl
			</li>
			{% endfor %}
		</ul>";
	}
}
