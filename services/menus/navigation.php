<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus;

class navigation
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/** @var \blitze\sitemaker\services\menus\display */
	protected $tree;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface		$cache				Cache driver interface
	 * @param \blitze\sitemaker\model\mapper_factory	$mapper_factory		Mapper factory object
	 * @param \blitze\sitemaker\services\menus\display	$tree				Menu tree display object
	 * @param string									$php_ext			php file extension
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \blitze\sitemaker\model\mapper_factory $mapper_factory, \blitze\sitemaker\services\menus\display $tree, $php_ext)
	{
		$this->cache = $cache;
		$this->mapper_factory = $mapper_factory;
		$this->tree = $tree;
		$this->php_ext = $php_ext;
	}

	/**
	 * @param \phpbb\template\twig\twig $template
	 * @param int $menu_id
	 * @param bool $is_navigation
	 * @param array $settings
	 * @return bool
	 */
	public function build_menu($template, $menu_id, $is_navigation = false, array $settings = array())
	{
		$data = $this->get_menu($menu_id);

		if (!sizeof($data))
		{
			return false;
		}

		if (!$is_navigation)
		{
			$this->tree->display_list($data['items'], $template, 'tree');
		}
		else
		{
			$this->tree->set_params($settings);
			$this->tree->display_navlist($data, $template, 'tree');
		}

		return true;
	}

	/**
	 * @return string[]
	 */
	public function get_menu_options()
	{
		$collection = $this->mapper_factory->create('menus')->find();

		$options = array();
		foreach ($collection as $entity)
		{
			$options[$entity->get_menu_id()] = $entity->get_menu_name();
		}

		return $options;
	}

	/**
	 * @param int $menu_id
	 * @return array
	 */
	protected function get_menu($menu_id)
	{
		if (($data = $this->cache->get('sitemaker_menus')) === false)
		{
			$data = $this->get_all_menus();

			$this->cache->put('sitemaker_menus', $data);
		}

		return (isset($data[$menu_id])) ? $data[$menu_id] : array();
	}

	/**
	 * @return array
	 */
	protected function get_all_menus()
	{
		$item_mapper = $this->mapper_factory->create('items');

		$collection = $item_mapper->find();

		$data = array();
		foreach ($collection as $entity)
		{
			$row = $entity->to_array();
			$this->set_path_info($row);
			$this->pre_parse($row);

			$data[$row['menu_id']]['items'][$row['item_id']] = $row;

			if ($row['is_navigable'])
			{
				$data[$row['menu_id']]['paths'][$row['item_id']] = $this->get_matchable_url($row);
			}
		}

		return $data;
	}

	/**
	 * @param array $row
	 */
	protected function set_path_info(array &$row)
	{
		$url_info = parse_url($row['item_url']);

		$row['host'] = (isset($url_info['host'])) ? $url_info['host'] : '';
		$row['url_path'] = (isset($url_info['path'])) ? $url_info['path'] : '';
		$row['url_query'] = (isset($url_info['query'])) ? explode('&', $url_info['query']) : array();
	}

	/**
	 * @param array $row
	 */
	protected function pre_parse(array &$row)
	{
		$row['is_navigable'] = $this->is_navigable($row);
		$row['is_expandable'] = ($row['is_navigable'] && !$row['item_target']) ? true : false;
		$row['url_path'] = str_replace('/index.' . $this->php_ext, '/', $row['url_path']);
	}

	/**
	 * @param array $row
	 * @return bool
	 */
	protected function is_navigable(array $row)
	{
		return (!$this->is_local($row) || substr($row['item_url'], 0, 1) === '#' || $this->is_not_php_file($row['url_path'])) ? false : true;
	}

	/**
	 * @param array $row
	 * @return bool
	 */
	protected function is_local(array $row)
	{
		return ($row['item_url'] && !$row['host']) ? true : false;
	}

	/**
	 * @param string $url_path
	 * @return bool
	 */
	protected function is_not_php_file($url_path)
	{
		$extension = pathinfo($url_path, PATHINFO_EXTENSION);
		return ($extension && $extension !== $this->php_ext) ? true : false;
	}

	/**
	 * @param array
	 * @return string
	 */
	protected function get_matchable_url(array $row)
	{
		sort($row['url_query']);

		$row['url_path'] = ($row['url_path'] === '/') ? '/index.' . $this->php_ext : $row['url_path'];

		return $row['url_path'] . ((sizeof($row['url_query'])) ? '?' . join('&', $row['url_query']) : '');
	}
}
