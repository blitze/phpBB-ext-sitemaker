<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\controller;

use Symfony\Component\HttpFoundation\Response;

class blocks_admin
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\db */
	protected $config;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	/** @var \primetime\primetime\core\blocks\manager */
	protected $block;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth								$auth		Auth object
	 * @param \phpbb\config\db								$config		Config object
	 * @param \phpbb\request\request_interface				$request	Request object
	 * @param \phpbb\user									$user		User object
	 * @param \primetime\primetime\core\blocks\manager		$blocks		Block manager object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\db $config, \phpbb\request\request_interface $request, \phpbb\user $user, \primetime\primetime\core\blocks\manager $blocks)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->request = $request;
		$this->user = $user;
		$this->blocks = $blocks;

		$this->user->add_lang_ext('primetime/primetime', 'block_manager');
	}

	public function handle($action, $id, $block)
	{
		$return_data = array();
		$json_data = array(
			'id'		=> '',
			'title'		=> '',
			'content'   => '',
			'message'   => '',
			'errors'	=> '',
		);

		if (!$this->auth->acl_get('a_manage_blocks') || $this->request->is_ajax() === false)
		{
			if ($this->request->is_ajax() === false)
			{
				trigger_error('NOT_AUTHORISED');
			}

			$json_data['message'] = $this->user->lang['NOT_AUTHORISED'];
			return new Response(json_encode($json_data));
		}

		$id		= $this->request->variable('id', 0);
		$style	= $this->request->variable('style', 0);
		$block	= $this->request->variable('block', '');
		$route	= $this->request->variable('route', '');

		if (!$style)
		{
			return new Response(json_encode($json_data));
		}

		$this->blocks->set_style($style);

		switch ($action)
		{
			case 'add':
				$return_data = $this->blocks->add($block, $route);
			break;
			case 'config':
				$data = array(
					'bid'	=> (int) $id,
					'bvar'	=> $this->request->variable('bvar', ''),
					'bval'	=> $this->request->variable('bval', ''),
				);
				$this->blocks->config($id, $data);
			break;
			case 'edit':
				$return_data = $this->blocks->edit($id);
			break;
			case 'save':
				$return_data = $this->blocks->save($id, $route);
			break;
			case 'update':
				$field = $this->request->variable('field', 'icon');

				$data = array();
				if ($field == 'title')
				{
					$data['title'] = ucwords(trim($this->request->variable('title', '')));
				}
				else
				{
					$data['icon'] = $this->request->variable('icon', '');
				}
				$return_data = $this->blocks->update($id, $data, $route);
			break;
			case 'delete_blocks':
				$this->blocks->delete_route_blocks($route);
			break;
			case 'save_layout':
				$return_data = $this->blocks->save_layout($route);
			break;
			case 'copy_layout':
				$copy_from = $this->request->variable('copy', '');
				$return_data = $this->blocks->copy_layout($route, $copy_from);
			break;
			case 'layout_settings':
				$data = array(
					'hide_blocks'	=> $this->request->variable('hide_blocks', false),
					'ex_positions'	=> join(',', $this->request->variable('ex_positions', array(0 => ''))),
				);
				$return_data = $this->blocks->set_route_prefs($route, $data);
			break;
			case 'set_default':
				$this->config->set('primetime_default_layout', $route);
			break;
		}

		$return_data += $json_data;

		return new Response(json_encode($return_data));
	}
}
