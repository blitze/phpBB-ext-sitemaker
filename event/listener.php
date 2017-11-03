<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\event;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param ContainerInterface			$phpbb_container		Service container
	 * @param \phpbb\language\language		$translator				Language object
	 * @param string						$php_ext				php file extension
	 */
	public function __construct(ContainerInterface $phpbb_container, \phpbb\language\language $translator, $php_ext)
	{
		$this->phpbb_container = $phpbb_container;
		$this->translator = $translator;
		$this->php_ext = $php_ext;
	}

	/**
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return array(
			'core.user_setup'			=> 'load_common_language',
			'core.permissions'			=> 'load_permission_language',
			'core.viewonline_overwrite_location'	=> 'add_viewonline_location',
		);
	}

	/**
	 * @param \phpbb\event\data $event
	 */
	public function load_common_language(\phpbb\event\data $event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'blitze/sitemaker',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * @param \phpbb\event\data $event
	 */
	public function load_permission_language(\phpbb\event\data $event)
	{
		$permissions = $event['permissions'];
		$permissions['a_sm_settings']		= array('lang' => 'ACL_A_SM_SETTINGS', 'cat' => 'misc');
		$permissions['a_sm_manage_blocks']	= array('lang' => 'ACL_A_SM_MANAGE_BLOCKS', 'cat' => 'misc');
		$permissions['a_sm_manage_menus']	= array('lang' => 'ACL_A_SM_MANAGE_MENUS', 'cat' => 'misc');
		$permissions['a_sm_filemanager']	= array('lang' => 'ACL_A_SM_FILEMANAGER', 'cat' => 'misc');
		$permissions['u_sm_filemanager']	= array('lang' => 'ACL_U_SM_FILEMANAGER', 'cat' => 'misc');
		$event['permissions'] = $permissions;
	}

	/**
	 * @param \phpbb\event\data $event
	 */
	public function add_viewonline_location(\phpbb\event\data $event)
	{
		if ($event['on_page'][1] == 'app' && strrpos($event['row']['session_page'], 'app.' . $this->php_ext . '/forum') === 0)
		{
			$event['location'] = $this->translator->lang('FORUM_INDEX');
			$event['location_url'] = $this->phpbb_container->get('controller.helper')->route('blitze_sitemaker_forum');
		}
	}
}
