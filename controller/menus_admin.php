<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\controller;

use Symfony\Component\HttpFoundation\Response;

class menus_admin
{
	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\menus\action_handler */
	protected $action_handler;

	/** @var boolean */
	protected $return_url;

	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request_interface					$request			Request object
	 * @param \phpbb\language\language							$translator			Languag object
	 * @param \blitze\sitemaker\services\menus\action_handler	$action_handler		Handles menu actions
	 * @param bool												$return_url
	 */
	public function __construct(\phpbb\request\request_interface $request, \phpbb\language\language $translator, \blitze\sitemaker\services\menus\action_handler $action_handler, $return_url = false)
	{
		$this->request = $request;
		$this->translator = $translator;
		$this->action_handler = $action_handler;
		$this->return_url = $return_url;
	}

	/**
	 * @param string $action
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function handle($action)
	{
		$return_data = array();

		if ($this->request->is_ajax() === false)
		{
			redirect(generate_board_url(), $this->return_url);

			$return_data['message'] = $this->translator->lang('NOT_AUTHORISED');
			return new Response(json_encode($return_data), 401);
		}

		try
		{
			$command = $this->action_handler->create($action);
			$return_data = $command->execute();

			$this->action_handler->clear_cache();
		}
		catch (\blitze\sitemaker\exception\base $e)
		{
			$return_data['message'] = $e->get_message($this->translator);
		}
		catch (\Exception $e)
		{
			$return_data['message'] = $this->translator->lang($e->getMessage());
		}

		return new Response(json_encode($return_data));
	}
}
