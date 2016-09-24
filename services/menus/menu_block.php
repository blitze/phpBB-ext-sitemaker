<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus;

use blitze\sitemaker\services\blocks\driver\block;

abstract class menu_block extends block
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\language\language */
	protected $translator;

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
	 * @param \phpbb\config\config						$config				Config object
	 * @param \phpbb\language\language					$translator			Language object
	 * @param \blitze\sitemaker\model\mapper_factory	$mapper_factory		Mapper factory object
	 * @param \blitze\sitemaker\services\menus\display	$tree				Menu tree display object
	 * @param string									$php_ext			php file extension
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\language\language $translator, \blitze\sitemaker\model\mapper_factory $mapper_factory, \blitze\sitemaker\services\menus\display $tree, $php_ext)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->translator = $translator;
		$this->mapper_factory = $mapper_factory;
		$this->tree = $tree;
		$this->php_ext = $php_ext;
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
		$item_mapper = $this->mapper_factory->create('menus', 'items');

		$collection = $item_mapper->find();

		$data = array();
		foreach ($collection as $entity)
		{
			$row = $entity->to_array();
			$this->set_path_info($row);
			$this->pre_parse($row);

			$data[$row['menu_id']][$row['item_id']] = $row;
		}

		return $data;
	}

	/**
	 * @param int $menu_id
	 * @param bool $editing
	 * @return string
	 */
	protected function get_message($menu_id, $editing)
	{
		$msg_key = '';
		if ($editing)
		{
			$msg_key = ($menu_id) ? 'MENU_NO_ITEMS' : 'SELECT_MENU';
		}

		return $this->translator->lang($msg_key);
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
	}

	/**
	 * @param array $row
	 * @return bool
	 */
	protected function is_navigable(array $row)
	{
		return ($row['host'] || substr($row['item_url'], 0, 1) === '#' || $this->is_not_php_file($row['url_path'])) ? false : true;
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
