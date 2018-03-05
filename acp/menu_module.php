<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\acp;

use blitze\sitemaker\services\menus\nestedset;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
* @package acp
*/
class menu_module
{
	/** @var \phpbb\controller\helper */
	protected $controller_helper;

	/** @var \phpbb\event\dispatcher_interface */
	protected $phpbb_dispatcher;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \blitze\sitemaker\services\icon_picker */
	protected $icon;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \blitze\sitemaker\model\mapper_factory */
	protected $mapper_factory;

	/** @var \blitze\sitemaker\services\util */
	protected $util;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string */
	public $tpl_name;

	/** @var string */
	public $page_title;

	/** @var string */
	public $u_action;

	/**
	 * menu_module constructor.
	 */
	public function __construct()
	{
		global $phpbb_container, $phpbb_dispatcher, $request, $template, $user, $phpbb_root_path, $phpEx;

		$this->phpbb_dispatcher = $phpbb_dispatcher;
		$this->request = $request;
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;

		$this->controller_helper = $phpbb_container->get('controller.helper');
		$this->language = $phpbb_container->get('language');
		$this->mapper_factory = $phpbb_container->get('blitze.sitemaker.mapper.factory');
		$this->icon = $phpbb_container->get('blitze.sitemaker.icon_picker');
		$this->util = $phpbb_container->get('blitze.sitemaker.util');
	}

	/**
	 * @return void
	 */
	public function main()
	{
		$menu_id = $this->request->variable('menu_id', 0);

		nestedset::load_scripts($this->util);
		$this->util->add_assets(array(
			'js'	=> array('@blitze_sitemaker/assets/menu/admin.min.js'),
			'css'	=> array('@blitze_sitemaker/assets/menu/admin.min.css')
		));

		$this->list_menus($menu_id);
		$this->build_bulk_options();

		$this->template->assign_vars(array(
			'S_MENU'		=> true,
			'MENU_ID'		=> $menu_id,
			'ICON_PICKER'	=> $this->icon->picker(),
			'T_PATH'		=> $this->phpbb_root_path,
			'UA_AJAX_URL'   => $this->controller_helper->route('blitze_sitemaker_menus_admin', array(), true, '') . '/',
		));

		$this->tpl_name = 'acp_menu';
		$this->page_title = 'ACP_MENU';
	}

	/**
	 * @param int $menu_id
	 * @return void
	 */
	protected function list_menus(&$menu_id)
	{
		$menu_mapper = $this->mapper_factory->create('menus');

		// Get all menus
		$collection = $menu_mapper->find();

		if ($collection->valid())
		{
			/** @var \blitze\sitemaker\model\entity\menu $menu */
			$menu = (isset($collection[$menu_id])) ? $collection[$menu_id] : $collection->current();
			$menu_id = $menu->get_menu_id();

			foreach ($collection as $entity)
			{
				$id = $entity->get_menu_id();
				$this->template->assign_block_vars('menu', array(
					'ID'		=> $id,
					'NAME'		=> $entity->get_menu_name(),
					'S_ACTIVE'	=> ($id == $menu_id) ? true : false,
				));
			}
		}
	}

	/**
	 * @return void
	 */
	protected function build_bulk_options()
	{
		$bulk_options = array();
		$forumslist = (array) make_forum_select(false, false, true, false, false, false, true);

		/**
		 * Event to add bulk menu options
		 *
		 * @event blitze.sitemaker.acp_add_bulk_menu_options
		 * @var	array	bulk_options	Array of bulk menu options
		 * @var	array	forumslist		Array of phpBB forums
		 * @since 3.1.0
		 */
		$vars = array('bulk_options', 'forumslist');
		extract($this->phpbb_dispatcher->trigger_event('blitze.sitemaker.acp_add_bulk_menu_options', compact($vars)));

		$bulk_options['FORUMS']	= $this->get_forums_string($forumslist);

		$this->template->assign_var('bulk_options', $bulk_options);
	}

	/**
	 * @param array $forumslist
	 * @return string
	 */
	protected function get_forums_string(array $forumslist)
	{
		$forum_url = $this->controller_helper->route('blitze_sitemaker_forum', array(), true, '', UrlGeneratorInterface::RELATIVE_PATH);
		$text = $this->language->lang('FORUM') . '|' . $forum_url . "\n";
		foreach ($forumslist as $forum_id => $row)
		{
			$text .= "\t" . str_replace('&nbsp; &nbsp;', "\t", $row['padding']);
			$text .= $row['forum_name'] . '|';
			$text .= "viewforum.{$this->php_ext}?f=$forum_id\n";
		}

		return trim($text);
	}
}
