<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menu\action;

class update_item extends base_action
{
	public function execute()
	{
		$item_id = $this->request->variable('item_id', 0);
		$field = $this->request->variable('field', 'item_icon');

		$allowed_fields = array(
			'item_icon'		=> $this->request->variable('item_icon', ''),
			'item_status'	=> $this->request->variable('item_status', 0),
			'item_title'	=> $this->request->variable('item_title', '', true),
		);

		if (!$item_id)
		{
			return array('errors' => $this->user->lang('MENU_ITEM_NOT_FOUND'));
		}

		$item_mapper = $this->mapper_factory->create('menu', 'items');

		if (($entity = $item_mapper->load(array('item_id' => $item_id))) === null)
		{
			return array('errors' => $this->user->lang('MENU_ITEM_NOT_FOUND'));
		}

		if (isset($allowed_fields[$field]))
		{
			$mutator = 'set_' . $field;
			$entity->$mutator($allowed_fields[$field]);
			$item_mapper->save($entity);
		}

		return $entity->to_array();
	}
}
