<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class blocks_admin
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\auto_lang */
	protected $auto_lang;

	/** @var \blitze\sitemaker\services\blocks\action_handler */
	protected $action_handler;

	/** @var boolean */
	protected $return_url;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth									$auth				Auth object
	 * @param \phpbb\request\request_interface					$request			Request object
	 * @param \phpbb\language\language							$translator			Language object
	 * @param \blitze\sitemaker\services\auto_lang				$auto_lang			Auto lang object
	 * @param \blitze\sitemaker\services\blocks\action_handler	$action_handler		Handles block actions
	 * @param bool												$return_url
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\request\request_interface $request, \phpbb\language\language $translator, \blitze\sitemaker\services\auto_lang $auto_lang, \blitze\sitemaker\services\blocks\action_handler $action_handler, $return_url = false)
	{
		$this->auth = $auth;
		$this->request = $request;
		$this->translator = $translator;
		$this->action_handler = $action_handler;
		$this->auto_lang = $auto_lang;
		$this->return_url = $return_url;
	}

	/**
	 * @param string $action
	 * @return \Symfony\Component\HttpFoundation\Response|string
	 */
	public function handle($action)
	{
		$this->translator->add_lang('block_manager', 'blitze/sitemaker');

		$return_data = array(
			'id'		=> '',
			'title'		=> '',
			'content'   => '',
			'message'   => '',
		);

		if (!$this->request->is_ajax())
		{
			return redirect(generate_board_url(), $this->return_url);
		}

		if (!$this->auth->acl_get('a_sm_manage_blocks'))
		{
			$return_data['message'] = $this->translator->lang('NOT_AUTHORISED');
			return new JsonResponse($return_data, 401);
		}

		$this->execute_action($action, $return_data);

		return new JsonResponse($return_data);
	}

	/**
	 * @param string $action
	 * @param array $return_data
	 * @return void
	 */
	protected function execute_action($action, array &$return_data)
	{
		try
		{
			$this->auto_lang->add('blocks_admin');

			$style_id = $this->request->variable('style', 0);
			$command = $this->action_handler->create($action);

			$return_data = array_merge($return_data,
				$command->execute($style_id)
			);

			$this->action_handler->clear_cache();
		}
		catch (\blitze\sitemaker\exception\base $e)
		{
			$return_data['message'] = $e->get_message($this->translator);
		}
	}
}
