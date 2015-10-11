<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

/**
* Menu Block
* @package phpBB Sitemaker Menu
*/
class menu extends \blitze\sitemaker\services\blocks\driver\block
{
	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/** @var \blitze\sitemaker\services\menu\display */
	protected $tree;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service						$cache				Cache object
	 * @param \phpbb\config\config						$config				Config object
	 * @param \phpbb\template\template					$user				User object
	 * @param \blitze\sitemaker\model\mapper_factory	$mapper_factory		Mapper factory object
	 * @param \blitze\sitemaker\services\menu\display	$tree				Menu tree display object
	 */
	public function __construct(\phpbb\cache\service $cache, \phpbb\config\config $config, \phpbb\user $user, \blitze\sitemaker\model\mapper_factory $mapper_factory, \blitze\sitemaker\services\menu\display $tree)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->user = $user;
		$this->mapper_factory = $mapper_factory;
		$this->tree = $tree;
	}

	public function get_config($settings)
	{
		$menu_options = $this->get_menu_options();
		$depth_options = $this->get_depth_options();

		$menu_id = (!empty($settings['menu_id'])) ? $settings['menu_id'] : 0;
		$expanded = (!empty($settings['expanded'])) ? $settings['expanded'] : 0;
		$max_depth = (!empty($settings['max_depth'])) ? $settings['max_depth'] : 3;

		return array(
			'legend1'       => $this->user->lang('SETTINGS'),
			'menu_id'		=> array('lang' => 'MENU', 'validate' => 'int', 'type' => 'select', 'params' => array($menu_options, $menu_id), 'default' => $menu_id, 'explain' => false),
			'expanded'		=> array('lang' => 'EXPANDED', 'validate' => 'bool', 'type' => 'checkbox', 'params' => array(array(1 => ''), $expanded), 'default' => 0, 'explain' => false),
			'max_depth'		=> array('lang' => 'MAX_DEPTH', 'validate' => 'int', 'type' => 'select', 'params' => array($depth_options, $max_depth), 'default' => 3, 'explain' => false),
		);
	}

	public function display($db_data, $editing = false)
	{
		$title = $this->user->lang('MENU');
		$menu_id = $db_data['settings']['menu_id'];

		if (!$menu_id)
		{
			return array(
				'title'		=> $title,
				'content'	=> ($editing) ? $this->user->lang('SELECT_MENU') : ''
			);
		}

		$data = $this->get_menu($menu_id);

		$this->tree->set_params($db_data['settings']);
		$this->tree->display_list(array_values($data), $this->ptemplate, 'tree');

		return array(
			'title'     => $title,
			'content'   => $this->ptemplate->render_view('blitze/sitemaker', 'blocks/menu.html', 'menu_block'),
		);
	}

	private function get_menu($menu_id)
	{
		if (($data = $this->cache->get('sitemaker_menus')) === false)
		{
			$item_mapper = $this->mapper_factory->create('menu', 'items');

			$collection = $item_mapper->find(array(
				'item_status' => 1
			));

			$data = array();
			$parents = array();

			foreach ($collection as $entity)
			{
				if (!$entity->get_item_title())
				{
					continue;
				}

				$row = $entity->to_array();
				$url_info = parse_url($row['item_url']);

				$row['url_path']	= (isset($url_info['path'])) ? $url_info['path'] : '';
				$row['url_query']	= (isset($url_info['query'])) ? explode('&', $url_info['query']) : array();

				$data[$row['menu_id']][$row['item_id']] = $row;
			}

			$this->cache->put('sitemaker_menus', $data);
		}

		return (isset($data[$menu_id])) ? $data[$menu_id] : array();
	}

	protected function get_menu_options()
	{
		$collection = $this->mapper_factory->create('menu', 'menus')->find();

		$options = array();
		foreach ($collection as $entity)
		{
			$options[$entity->get_menu_id()] = $entity->get_menu_name();
		}

		return $options;
	}

	protected function get_depth_options()
	{
		$options = array();
		for ($i = 3; $i < 10; $i++)
		{
			$options[$i] = $i;
		}

		return $options;
	}
}
