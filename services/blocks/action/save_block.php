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
	/** @var \blitze\sitemaker\model\mapper\blocks */
	protected $block_mapper;

	/**
	 * {@inheritdoc}
	 * @throws \blitze\sitemaker\exception\out_of_bounds
	 */
	public function execute($style_id)
	{
		$block_id = $this->request->variable('id', 0);
		$update_similar = $this->request->variable('similar', false);

		$this->block_mapper = $this->mapper_factory->create('blocks');

		/** @var \blitze\sitemaker\model\entity\block $entity */
		if (($entity = $this->block_mapper->load(array('bid', '=', $block_id))) === null)
		{
			throw new \blitze\sitemaker\exception\out_of_bounds('bid');
		}

		$old_hash = $entity->get_hash();
		$updated_blocks = array();

		/** @var \blitze\sitemaker\model\entity\block $entity */
		$entity = $this->get_updated_settings($entity);
		$entity = $this->block_mapper->save($entity);

		$new_hash = $entity->get_hash();
		$updated_blocks[$entity->get_bid()] = $this->render_block($entity);

		if ($update_similar && $new_hash !== $old_hash)
		{
			$updated_blocks += $this->update_similar($old_hash, $new_hash, $entity->get_settings());
		}

		return array(
			'list'	=> $updated_blocks,
		);
	}

	/**
	 * @param \blitze\sitemaker\model\entity\block $entity
	 * @return array
	 */
	private function get_updated_settings(\blitze\sitemaker\model\entity\block $entity)
	{
		$block_instance = $this->block_factory->get_block($entity->get_name());
		$default_config = $block_instance->get_config(array());

		$cfg_handler = $this->phpbb_container->get('blitze.sitemaker.blocks.cfg_handler');
		$submitted_settings = $cfg_handler->get_submitted_settings($default_config);

		$this->set_hidden_fields($submitted_settings, $default_config, $entity->get_settings());

		return $entity->set_permission($this->get_block_permissions())
			->set_class($this->request->variable('class', ''))
			->set_hide_title($this->request->variable('hide_title', 0))
			->set_status($this->request->variable('status', 0))
			->set_type($this->request->variable('type', 0))
			->set_view($this->request->variable('view', ''))
			->set_settings($submitted_settings);
	}

	/**
	 * Get submitted block permissions
	 * @return array
	 */
	private function get_block_permissions()
	{
		$groups = $this->request->variable('perm_groups', array(0));

		$permission = [];
		$groups = array_filter($groups);

		if (!empty($groups))
		{
			$permission =  array(
				'type'		=> $this->request->variable('perm_type', 0),
				'groups'	=> $groups,
			);
		}

		return $permission;
	}

	/**
	 * Hidden/static fields are not generated when editing block, so we add them manually
	 * @param array $submitted_settings
	 * @param array $default_settings
	 * @param array $db_settings
	 * @return void
	 */
	private function set_hidden_fields(array &$submitted_settings, array $default_settings, array $db_settings)
	{
		$hidden_settings = array_diff_key($default_settings, $submitted_settings);

		foreach ($hidden_settings as $field => $props)
		{
			// make sure we have required props
			$props = ((array) $props) + array('type' => '', 'default' => '');

			if ($props['type'] === 'hidden')
			{
				if (!empty($db_settings[$field]))
				{
					$submitted_settings[$field] = $db_settings[$field];
				}
				else if (!empty($props['default']))
				{
					$submitted_settings[$field] = $props['default'];
				}
			}
		}
	}

	/**
	 * @param string $field
	 * @param array $settings
	 * @return bool
	 */
	private function is_hidden_field($field, array $settings)
	{
		return $settings[$field] && $settings[$field]['type'] === 'hidden';
	}

	/**
	 * @param string $old_hash
	 * @param string $new_hash
	 * @param array  $settings
	 * @return array
	 */
	private function update_similar($old_hash, $new_hash, array $settings)
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
