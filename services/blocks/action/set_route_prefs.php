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
	/** @var \blitze\sitemaker\model\blocks\mapper\routes */
	protected $route_mapper;

	public function execute($style_id)
	{
		$this->route_mapper = $this->mapper_factory->create('blocks', 'routes');

		$route = array(
			'route'	=> $this->request->variable('route', ''),
			'style'	=> $style_id,
		);

		$route_prefs = array(
			'hide_blocks'	=> $this->request->variable('hide_blocks', false),
			'ex_positions'	=> array_filter($this->request->variable('ex_positions', array(0 => ''))),
		);

		// user has made choices that differ from defaults
		if ($this->_route_is_customized($route_prefs))
		{
			// create/update route regardless of whether it has blocks or not
			$entity = $this->_force_get_route($route);
			$this->_update_route($entity, $route_prefs);
		}
		// user has made choices that match defaults, and route prefs exist in db
		else if ($entity = $this->route_mapper->load($route))
		{
			// route has blocks, so update it
			if ($this->_route_has_blocks($entity))
			{
				$this->_update_route($entity, $route_prefs);
			}
			// route has no blocks, so remove it from db
			else
			{
				$this->route_mapper->delete($entity);
			}
		}

		return array('message' => $this->user->lang('ROUTE_UPDATED'));
	}

	protected function _update_route(\blitze\sitemaker\model\blocks\entity\route $entity, array $route_prefs)
	{
		$entity->set_hide_blocks($route_prefs['hide_blocks']);
		$entity->set_ex_positions($route_prefs['ex_positions']);

		$this->route_mapper->save($entity);
	}

	protected function _route_has_blocks($entity)
	{
		return ($entity && sizeof($entity->get_blocks())) ? true : false;
	}

	protected function _route_is_customized($route_prefs)
	{
		$default_prefs = array(
			'hide_blocks'	=> false,
			'ex_positions'	=> array(),
		);

		return ($default_prefs !== $route_prefs) ? true : false;
	}
}
