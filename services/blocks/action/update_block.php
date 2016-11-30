<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

class update_block extends base_action
{
	/**
	 * {@inheritdoc}
	 * @throws \blitze\sitemaker\exception\out_of_bounds
	 */
	public function execute($style_id)
	{
		$block_id = $this->request->variable('id', 0);
		$field = $this->request->variable('field', 'icon');

		$allowed_fields = array(
			'title'	=> $this->request->variable('title', '', true),
			'icon'	=> $this->request->variable('icon', ''),
		);

		$block_mapper = $this->mapper_factory->create('blocks');

		if (($entity = $block_mapper->load(array('bid', '=', $block_id))) === null)
		{
			throw new \blitze\sitemaker\exception\out_of_bounds('bid');
		}

		if (isset($allowed_fields[$field]))
		{
			$mutator = 'set_' . $field;
			$entity->$mutator($allowed_fields[$field]);
			$entity = $block_mapper->save($entity);
		}

		return $this->render_block($entity);
	}
}
