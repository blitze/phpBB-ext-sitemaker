<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus\action;

abstract class base_action implements action_interface
{
	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request_interface				$request				Request object
	 * @param \phpbb\user									$user					User object
	 * @param \blitze\sitemaker\model\mapper_factory		$mapper_factory			Mapper factory object
	 */
	public function __construct(\phpbb\request\request_interface $request, \phpbb\user $user, \blitze\sitemaker\model\mapper_factory $mapper_factory)
	{
		$this->request = $request;
		$this->user = $user;
		$this->mapper_factory = $mapper_factory;
	}

	/**
	 * @param \blitze\sitemaker\model\base_collection $collection
	 * @return array
	 */
	protected function get_items(\blitze\sitemaker\model\base_collection $collection)
	{
		$items = array();
		foreach ($collection as $item)
		{
			$items[] = $item->to_array();
		}

		return array(
			'items' => $items,
		);
	}
}
