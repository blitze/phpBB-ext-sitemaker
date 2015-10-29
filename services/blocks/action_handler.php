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

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\blocks */
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
	 * @param \phpbb\user									$user					User object
	 * @param \blitze\sitemaker\services\blocks				$blocks					Blocks object
	 * @param \blitze\sitemaker\services\blocks\factory		$block_factory			Blocks factory object
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory			Mapper factory object
	 */
	public function __construct(\phpbb\config\config $config, ContainerInterface $phpbb_container, \phpbb\request\request_interface $request, \phpbb\user $user, \blitze\sitemaker\services\blocks $blocks, \blitze\sitemaker\services\blocks\factory $block_factory, \blitze\sitemaker\model\mapper_factory $mapper_factory)
	{
		$this->config = $config;
		$this->phpbb_container = $phpbb_container;
		$this->request = $request;
		$this->user = $user;
		$this->blocks = $blocks;
		$this->block_factory = $block_factory;
		$this->mapper_factory = $mapper_factory;
	}

	public function create($action)
	{
		$action_class = 'blitze\\sitemaker\\services\\blocks\\action\\' . $action;

		if (!class_exists($action_class))
		{
			throw new \blitze\sitemaker\exception\out_of_bounds(array($action, 'INVALID_REQUEST'));
		}

		return new $action_class($this->config, $this->phpbb_container, $this->request, $this->user, $this->blocks, $this->block_factory, $this->mapper_factory);
	}

	public function clear_cache()
	{
		$this->blocks->clear_cache();
	}
}
