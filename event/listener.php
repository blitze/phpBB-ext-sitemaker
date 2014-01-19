<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\event;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
*
*/
class listener implements EventSubscriberInterface
{
	/* @var \phpbb\request\request_interface */
	protected $request;

	/* @var \primetime\primetime\core\primetime */
	protected $primetime;
	
	/* @var \primetime\primetime\core\blocks\display */
	protected $blocks;
	
	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request_interface			$request		Request object
	 * @param \primetime\primetime\core\primetime		$primetim		Primetime helper object
	 * @param \primetime\primetime\core\blocks\display	$blocks			Blocks display object
	*/
	public function __construct(\phpbb\request\request_interface $request, \primetime\primetime\core\primetime $primetime, \primetime\primetime\core\blocks\display $blocks)
	{
		$this->request = $request;
		$this->primetime = $primetime;
		$this->blocks = $blocks;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'		=> 'load_language_on_setup',
			'core.append_sid'		=> 'add_edit_mode',
			'core.page_footer'		=> 'init',
			'core.adm_page_footer'	=> 'set_assets',
		);
	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'primetime/primetime',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function add_edit_mode($event)
	{
		if ($this->request->is_set('edit_mode') && !preg_match('/ucp|mcp|adm/', $event['url']))
		{
			$params = $event['params'];
			$amp = ($event['is_amp']) ? '&amp;' : '&';
			if (!is_array($params))
			{
				$params .= (($params) ? $amp : '') . 'edit_mode=1';
			}
			else
			{
				$params[] = 'edit_mode=1';
			}
			$event['params'] = $params;
		}
	}

	public function init()
	{
		$this->primetime->init();
		$this->blocks->show();
		$this->set_assets();
	}

	public function set_assets()
	{
		$this->primetime->set_assets();
	}
}
