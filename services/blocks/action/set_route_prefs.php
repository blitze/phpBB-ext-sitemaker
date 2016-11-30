<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

class set_route_prefs extends base_action
{
	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\model\mapper\routes */
	protected $route_mapper;

	/**
	 * {@inheritdoc}
	 */
	public function execute($style_id)
	{
		$this->route_mapper = $this->mapper_factory->create('routes');

		$route_data = array(
			'route'	=> $this->request->variable('route', ''),
			'style'	=> $style_id,
		);

		$route_prefs = array(
			'hide_blocks'	=> $this->request->variable('hide_blocks', false),
			'ex_positions'	=> array_filter($this->request->variable('ex_positions', array(0 => ''))),
		);

		// user has made choices that differ from defaults
		if ($this->route_is_customized($route_prefs))
		{
			// create/update route regardless of whether it has blocks or not
			/** @type \blitze\sitemaker\model\entity\route $entity */
			$entity = $this->force_get_route($route_data);
			$this->update_route($entity, $route_prefs);
		}
		// user has made choices that match defaults, and route prefs exist in db
		else if ($entity = $this->route_mapper->load($this->get_condition($route_data)))
		{
			/** @type \blitze\sitemaker\model\entity\route $entity */
			$this->update_or_remove($entity, $route_prefs);
		}

		return array('message' => $this->translator->lang('ROUTE_UPDATED'));
	}

	/**
	 * Updates the route if it has blocks, or removes it if it doesn't
	 *
	 * @param \blitze\sitemaker\model\entity\route $entity
	 * @param array $route_prefs
	 */
	protected function update_or_remove(\blitze\sitemaker\model\entity\route $entity, array $route_prefs)
	{
		// route has blocks, so update it
		if ($this->route_has_blocks($entity))
		{
			$this->update_route($entity, $route_prefs);
		}
		// route has no blocks, so remove it from db
		else
		{
			$this->route_mapper->delete($entity);
		}
	}

	/**
	 * Update the route
	 *
	 * @param \blitze\sitemaker\model\entity\route $entity
	 * @param array $route_prefs
	 */
	protected function update_route(\blitze\sitemaker\model\entity\route $entity, array $route_prefs)
	{
		$entity->set_hide_blocks($route_prefs['hide_blocks']);
		$entity->set_ex_positions($route_prefs['ex_positions']);

		$this->route_mapper->save($entity);
	}

	/**
	 * @param \blitze\sitemaker\model\entity\route $entity
	 * @return bool
	 */
	protected function route_has_blocks(\blitze\sitemaker\model\entity\route $entity)
	{
		return ($entity && sizeof($entity->get_blocks())) ? true : false;
	}
}
