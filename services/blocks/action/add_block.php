<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

class add_block extends base_action
{
	/**
	 * {@inheritdoc}
	 * @throws \blitze\sitemaker\exception\invalid_argument
	 */
	public function execute($style_id)
	{
		$name	= $this->request->variable('block', '');
		$route	= $this->request->variable('route', '');

		if (($block_instance = $this->block_factory->get_block($name)) === null)
		{
			throw new \blitze\sitemaker\exception\invalid_argument(array($name, 'SERVICE_NOT_FOUND'));
		}

		$route_data = array(
			'route' => $route,
			'style'	=> $style_id,
		);

		/** @var \blitze\sitemaker\model\entity\route $route_entity */
		$route_entity = $this->force_get_route($route_data, true);

		$default_settings = $block_instance->get_config(array());
		$block_settings = $this->blocks->sync_settings($default_settings);

		$block_mapper = $this->mapper_factory->create('blocks');

		$entity = $block_mapper->create_entity(array(
			'name'			=> $name,
			'weight'		=> $this->request->variable('weight', 0),
			'position'		=> $this->request->variable('position', ''),
			'route_id'		=> (int) $route_entity->get_route_id(),
			'style'			=> (int) $style_id,
			'settings'		=> $block_settings,
			'view'			=> $this->get_block_view($style_id),
		));

		$entity = $block_mapper->save($entity);

		return $this->render_block($entity);
	}

	/**
	 * @param int $style_id
	 * @return string
	 */
	protected function get_block_view($style_id)
	{
		$config_text = $this->phpbb_container->get('config_text');
		$style_prefs = json_decode($config_text->get('sm_layout_prefs'), true);

		return (isset($style_prefs[$style_id])) ? basename($style_prefs[$style_id]['view']) : '';
	}
}
