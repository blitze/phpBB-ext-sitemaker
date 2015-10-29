<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus;

class action_handler
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface			$cache					Cache object
	 * @param \phpbb\request\request_interface				$request				Request object
	 * @param \phpbb\user									$user					User object
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory			Mapper factory object
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\request\request_interface $request, \phpbb\user $user, \blitze\sitemaker\model\mapper_factory $mapper_factory)
	{
		$this->cache = $cache;
		$this->request = $request;
		$this->user = $user;
		$this->mapper_factory = $mapper_factory;
	}

	public function create($action)
	{
		$action_class = 'blitze\\sitemaker\\services\\menus\\action\\' . $action;

		if (!class_exists($action_class))
		{
			throw new \blitze\sitemaker\exception\out_of_bounds(array($action, 'INVALID_REQUEST'));
		}

		return new $action_class($this->request, $this->user, $this->mapper_factory);
	}

	public function clear_cache()
	{
		$this->cache->destroy('sitemaker_menus');
	}
}
