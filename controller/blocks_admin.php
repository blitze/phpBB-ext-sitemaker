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

class blocks_admin
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\auto_lang */
	protected $auto_lang;

	/** @var \blitze\sitemaker\services\blocks\action_handler */
	protected $action_handler;

	/** @var boolean */
	protected $return_url;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth                                 $auth Auth object
	 * @param \phpbb\request\request_interface                 $request Request object
	 * @param \phpbb\user                                      $user User object
	 * @param \blitze\sitemaker\services\auto_lang             $auto_lang Auto lang object
	 * @param \blitze\sitemaker\services\blocks\action_handler $action_handler Handles block actions
	 * @param bool                                             $return_url
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\request\request_interface $request, \phpbb\user $user, \blitze\sitemaker\services\auto_lang $auto_lang, \blitze\sitemaker\services\blocks\action_handler $action_handler, $return_url = false)
	{
		$this->auth = $auth;
		$this->request = $request;
		$this->user = $user;
		$this->action_handler = $action_handler;
		$this->auto_lang = $auto_lang;
		$this->return_url = $return_url;
	}

	/**
	 * @param string $action
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function handle($action)
	{
		$this->user->add_lang_ext('blitze/sitemaker', 'block_manager');

		$return_data = array();
		$json_data = array(
			'id'		=> '',
			'title'		=> '',
			'content'   => '',
			'message'   => '',
		);

		if (!$this->auth->acl_get('a_sm_manage_blocks') || $this->request->is_ajax() === false)
		{
			if ($this->request->is_ajax() === false)
			{
				redirect(generate_board_url(), $this->return_url);
			}

			$json_data['message'] = $this->user->lang('NOT_AUTHORISED');
			return new Response(json_encode($json_data), 401);
		}

		$style_id = $this->request->variable('style', 0);

		try
		{
			$this->auto_lang->add('blocks_admin');

			$command = $this->action_handler->create($action);
			$return_data = $command->execute($style_id);

			$this->action_handler->clear_cache();
		}
		catch (\blitze\sitemaker\exception\base $e)
		{
			$json_data['message'] = $e->get_message($this->user);
		}

		return new Response(json_encode(array_merge($json_data, $return_data)));
	}
}
