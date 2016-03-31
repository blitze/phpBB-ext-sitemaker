<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks;

use Symfony\Component\DependencyInjection\ContainerInterface;

class action_handler
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\blocks\blocks */
	protected $blocks;

	/** @var \blitze\sitemaker\services\blocks\factory */
	protected $block_factory;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config							$config					Config object
	 * @param ContainerInterface							$phpbb_container		Service container
	 * @param \phpbb\request\request_interface				$request				Request object
	 * @param \phpbb\language\language						$translator				Language object
	 * @param \blitze\sitemaker\services\blocks\blocks		$blocks					Blocks object
	 * @param \blitze\sitemaker\services\blocks\factory		$block_factory			Blocks factory object
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory			Mapper factory object
	 */
	public function __construct(\phpbb\config\config $config, ContainerInterface $phpbb_container, \phpbb\request\request_interface $request, \phpbb\language\language $translator, \blitze\sitemaker\services\blocks\blocks $blocks, \blitze\sitemaker\services\blocks\factory $block_factory, \blitze\sitemaker\model\mapper_factory $mapper_factory)
	{
		$this->config = $config;
		$this->phpbb_container = $phpbb_container;
		$this->request = $request;
		$this->translator = $translator;
		$this->blocks = $blocks;
		$this->block_factory = $block_factory;
		$this->mapper_factory = $mapper_factory;
	}

	/**
	 * @param string $action
	 * @return \blitze\sitemaker\services\blocks\action\action_interface
	 * @throws \blitze\sitemaker\exception\unexpected_value
	 */
	public function create($action)
	{
		$action_class = 'blitze\\sitemaker\\services\\blocks\\action\\' . $action;

		if (!class_exists($action_class))
		{
			throw new \blitze\sitemaker\exception\unexpected_value(array($action, 'INVALID_ACTION'));
		}

		return new $action_class($this->config, $this->phpbb_container, $this->request, $this->translator, $this->blocks, $this->block_factory, $this->mapper_factory);
	}

	/**
	 * Clear cache after every action
	 */
	public function clear_cache()
	{
		$this->blocks->clear_cache();
	}
}
