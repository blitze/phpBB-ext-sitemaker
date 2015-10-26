<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

class edit_block extends base_action
{
	public function execute($style_id)
	{
		$block_id = $this->request->variable('id', 0);

		$cfg_fields = $this->phpbb_container->get('blitze.sitemaker.blocks.cfg_fields');

		$block_mapper = $this->mapper_factory->create('blocks', 'blocks');
		if (($entity = $block_mapper->load(array('bid' => $block_id))) === null)
		{
			throw new \blitze\sitemaker\exception\out_of_bounds('BLOCK_NOT_FOUND');
		}

		$block_instance = $this->block_factory->get_block($entity->get_name());
		$default_settings = $block_instance->get_config($entity->get_settings());

		$extension = $this->_get_extension($block_instance);

		$this->user->add_lang_ext($extension, 'blocks_admin');

		return array_merge(array(
				'form' => $cfg_fields->get_edit_form($entity->to_array(), $default_settings),
			),
			$this->render_block($entity)
		);
	}

	protected function _get_extension(\blitze\sitemaker\services\blocks\driver\block_interface $block_instance)
	{
		$class_name = get_class($block_instance);
		list($namespace, $extension) = explode('\\', $class_name);

		return $namespace . '/' . $extension;
	}
}
