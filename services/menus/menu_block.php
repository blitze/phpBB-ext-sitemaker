<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus;

abstract class menu_block extends \blitze\sitemaker\services\blocks\driver\block
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/** @var \blitze\sitemaker\services\menus\display */
	protected $tree;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface		$cache				Cache driver interface
	 * @param \phpbb\config\config						$config				Config object
	 * @param \phpbb\user								$user				User object
	 * @param \blitze\sitemaker\model\mapper_factory	$mapper_factory		Mapper factory object
	 * @param \blitze\sitemaker\services\menus\display	$tree				Menu tree display object
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\user $user, \blitze\sitemaker\model\mapper_factory $mapper_factory, \blitze\sitemaker\services\menus\display $tree)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->user = $user;
		$this->mapper_factory = $mapper_factory;
		$this->tree = $tree;
	}

	/**
	 * @param int $menu_id
	 * @return array
	 */
	protected function _get_menu($menu_id)
	{
		if (($data = $this->cache->get('sitemaker_menus')) === false)
		{
			$data = $this->_get_all_menus();

			$this->cache->put('sitemaker_menus', $data);
		}

		return (isset($data[$menu_id])) ? $data[$menu_id] : array();
	}

	/**
	 * @return array
	 */
	protected function _get_all_menus()
	{
		$item_mapper = $this->mapper_factory->create('menus', 'items');

		$collection = $item_mapper->find();

		$data = array();
		foreach ($collection as $entity)
		{
			$row = $entity->to_array();
			$this->_set_path_info($row);

			$data[$row['menu_id']][$row['item_id']] = $row;
		}

		return $data;
	}

	/**
	 * @param int $menu_id
	 * @param bool $editing
	 * @return string
	 */
	protected function _get_message($menu_id, $editing)
	{
		$msg_key = '';
		if ($editing)
		{
			$msg_key = ($menu_id) ? 'MENU_NO_ITEMS' : 'SELECT_MENU';
		}

		return $this->user->lang($msg_key);
	}

	/**
	 * @param array $data
	 */
	protected function _set_path_info(array &$data)
	{
		$url_info = parse_url($data['item_url']);

		$data['url_path'] = (isset($url_info['path'])) ? $url_info['path'] : '';
		$data['url_query'] = (isset($url_info['query'])) ? explode('&', $url_info['query']) : array();
	}

	/**
	 * @return array
	 */
	protected function get_menu_options()
	{
		$collection = $this->mapper_factory->create('menus', 'menus')->find();

		$options = array();
		foreach ($collection as $entity)
		{
			$options[$entity->get_menu_id()] = $entity->get_menu_name();
		}

		return $options;
	}
}
