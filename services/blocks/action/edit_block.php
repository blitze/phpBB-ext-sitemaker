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
	/** @var \phpbb\language\language */
	protected $translator;

	/**
	 * {@inheritdoc}
	 * @throws \blitze\sitemaker\exception\out_of_bounds
	 * @throws \blitze\sitemaker\exception\invalid_argument
	 */
	public function execute($style_id)
	{
		$this->translator->add_lang('css_presets', 'blitze/sitemaker');
		$this->translator->add_lang('posting');

		$block_id = $this->request->variable('id', 0);

		$cfg_handler = $this->phpbb_container->get('blitze.sitemaker.blocks.cfg_handler');
		$block_mapper = $this->mapper_factory->create('blocks');

		/** @type \blitze\sitemaker\model\entity\block $entity */
		if (($entity = $block_mapper->load(array('bid', '=', $block_id))) === null)
		{
			throw new \blitze\sitemaker\exception\out_of_bounds('bid');
		}

		if (($block_instance = $this->block_factory->get_block($entity->get_name())) === null)
		{
			throw new \blitze\sitemaker\exception\invalid_argument(array($entity->get_name(), 'SERVICE_NOT_FOUND'));
		}

		$default_settings = $block_instance->get_config($entity->get_settings());

		$extension = $this->get_extension($block_instance);

		$this->translator->add_lang('blocks_admin', $extension);

		return array_merge(array(
				'form' => $cfg_handler->get_edit_form($entity->to_array(), $default_settings),
			),
			$this->render_block($entity)
		);
	}

	/**
	 * @param \blitze\sitemaker\services\blocks\driver\block_interface $block_instance
	 * @return string
	 */
	protected function get_extension(\blitze\sitemaker\services\blocks\driver\block_interface $block_instance)
	{
		$class_name = get_class($block_instance);
		list($namespace, $extension) = explode('\\', $class_name);

		return $namespace . '/' . $extension;
	}
}
