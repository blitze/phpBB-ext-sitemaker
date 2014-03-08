<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\controller;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

// This is required for all controllers
use Symfony\Component\HttpFoundation\Response;

/**
*
*/
class blocks_admin
{
	/**
	 * Auth object instance
	 * @var \phpbb\auth\auth
	 */
	protected $auth;

	/**
	 * Request object
	 * @var \phpbb\request\request_interface
	 */
	protected $request;

	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Primetime Block manager object
	 * @var \primetime\primetime\core\blocks\manager
	 */
	protected $block;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth								$auth		Auth object
	 * @param \phpbb\request\request_interface				$request	Request object
	 * @param \phpbb\user									$user		User object
	 * @param \primetime\primetime\core\blocks\manager		$blocks		Block manager object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\request\request_interface $request, \phpbb\user $user, \primetime\primetime\core\blocks\manager $blocks)
	{
		$this->auth = $auth;
		$this->request = $request;
		$this->user = $user;
		$this->blocks = $blocks;
	}

	public function handle($action, $id, $block)
	{
		global $config, $phpbb_dispatcher;

		$this->user->add_lang_ext('primetime/primetime', 'block_manager');

		$lang_set_ext = array();

		/**
		 * Event to load block config language files
		 * 
		 * @var	array	lang_set_ext		Array containing entries of format
		 * 					array(
		 * 						'ext_name' => (string) [extension name],
		 * 						'lang_set' => (string|array) [language files],
		 * 					)
		 * 					This is to be used only to add language files that are used when editing block configuartion
		 */
		$vars = array('lang_set_ext');
		extract($phpbb_dispatcher->trigger_event('primetime.blocks.add_lang', compact($vars)));

		foreach ($lang_set_ext as $ext_lang_pair)
		{
			$this->user->add_lang_ext($ext_lang_pair['ext_name'], $ext_lang_pair['lang_set']);
		}
		unset($lang_set_ext);

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
		$block	= $this->request->variable('block', '');
		$route	= $this->request->variable('route', '');

		switch ($action)
		{
			case 'add':
				$return_data = $this->blocks->add($block, $route);
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
			case 'save_layout':
				$return_data = $this->blocks->save_layout($route);
			break;
			case 'copy':
				$copy_from = $this->request->variable('copy', '');
				$return_data = $this->blocks->copy($route, $copy_from);
			break;
			case 'settings':
				$data = array(
					'hide_blocks'	=> $this->request->variable('hide_blocks', false),
					'ex_positions'	=> join(',', $this->request->variable('ex_positions', array(0 => ''))),
				);
				$return_data = $this->blocks->set_route_prefs($route, $data);
			break;
			case 'set_default':
				$config->set('primetime_default_layout', $route);
			break;
		}

		$return_data += $json_data;

		return new Response(json_encode($return_data));
	}
}
