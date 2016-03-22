<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

class save_block extends base_action
{
	/** @var \blitze\sitemaker\model\blocks\mapper\blocks */
	protected $block_mapper;

	public function execute($style_id)
	{
		$block_id = $this->request->variable('id', 0);
		$update_similar = $this->request->variable('similar', false);

		$this->block_mapper = $this->mapper_factory->create('blocks', 'blocks');

		if (($entity = $this->block_mapper->load(array('bid', '=', $block_id))) === null)
		{
			throw new \blitze\sitemaker\exception\out_of_bounds('BLOCK_NOT_FOUND');
		}

		$old_hash = $entity->get_hash();

		$cfg_handler = $this->phpbb_container->get('blitze.sitemaker.blocks.cfg_handler');
		$block_instance = $this->block_factory->get_block($entity->get_name());
		$default_settings = $block_instance->get_config(array());
		$submitted_settings = $cfg_handler->get_submitted_settings($default_settings);

		$entity->set_permission($this->request->variable('permission', array(0)))
			->set_class($this->request->variable('class', ''))
			->set_hide_title($this->request->variable('hide_title', 0))
			->set_status($this->request->variable('status', 0))
			->set_type($this->request->variable('type', 0))
			->set_no_wrap($this->request->variable('no_wrap', 0))
			->set_settings($submitted_settings);
		$entity = $this->block_mapper->save($entity);

		$new_hash = $entity->get_hash();
		$updated_blocks = array();
		$updated_blocks[$entity->get_bid()] = $this->render_block($entity);

		if ($update_similar && $new_hash !== $old_hash)
		{
			$updated_blocks += $this->_update_similar($old_hash, $new_hash, $submitted_settings);
		}

		return $updated_blocks;
	}

	private function _update_similar($old_hash, $new_hash, $settings)
	{
		// find all similar blocks
		$blocks_collection = $this->block_mapper->find(array('hash', '=', $old_hash));

		$blocks = array();
		foreach ($blocks_collection as $entity)
		{
			$entity->set_hash($new_hash);
			$entity->set_settings($settings);
			$this->block_mapper->save($entity);

			$blocks[$entity->get_bid()] = $this->render_block($entity);
		}

		return $blocks;
	}
}
