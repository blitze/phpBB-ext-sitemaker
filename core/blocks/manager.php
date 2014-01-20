<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\blocks;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
*
*/
class manager
{
	/**
	* Cache
	* @var \phpbb\cache\service
	*/
	protected $cache;

	/**
	 * Database object
	 * @var \phpbb\db\driver
	 */
	protected $db;

	/**
	 * Request object
	 * @var \phpbb\request\request_interface
	 */
	protected $request;

	/**
	* Template object
	* @var \phpbb\template\template
	*/
	protected $template;

	/**
	* User object
	* @var \phpbb\user
	*/
	protected $user;

	/**
	 * Primetime object
	 * @var \primetime\primetime\core\primetime
	 */
	protected $primetime;

	/**
	* Icons
	* @var \primetime\primetime\core\icon_picker
	*/
	protected $icons;

	/**
	* Name of the blocks database table
	* @var string
	*/
	private $blocks_table;

	/**
	 * Block positions
	 * @var array
	 */
	private $positions = array();

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\service					$cache			Cache object
	 * @param \phpbb\db\driver\driver				$db				Database object
	 * @param \phpbb\request\request_interface		$request		Request object
	 * @param \phpbb\template\template				$template		Template object
	 * @param \phpbb\user							$user			User object
	 * @param \primetime\primetime\core\primetime	$primetime		Template object
	 * @param \primetime\primetime\core\icon_picker	$icons			Primetime icon picker object
	 * @param string								$blocks_table	Name of the blocks database table
	 */
	public function __construct(\phpbb\cache\driver\driver_interface  $cache, \phpbb\db\driver\driver $db, \phpbb\request\request_interface $request, \phpbb\template\template $template, \phpbb\user $user, \primetime\primetime\core\primetime $primetime, \primetime\primetime\core\icon_picker $icons, $blocks_table)
	{
		$this->db = $db;
		$this->user = $user;
		$this->cache = $cache;
		$this->icons = $icons;
		$this->request = $request;
		$this->template = $template;
		$this->primetime = $primetime;
		$this->blocks_table = $blocks_table;
	}

	public function handle($route)
	{
		global $phpEx;

		$edit_mode = $this->request->variable('edit_mode', false);

		$page_url = str_replace('../', '', build_url(array('edit_mode')));
		$asset_path = $this->primetime->asset_path;

		$this->primetime->add_assets(array(
			'js'		=> array(
				'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
				100 =>  $asset_path . 'ext/primetime/primetime/assets/blocks/manager.js',
			),
			'css'   => array(
				'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css',
				$asset_path . 'ext/primetime/primetime/assets/blocks/manager.css',
			)
		));

		$this->template->assign_vars(array(
			'S_ADMIN_BLOCKS'	=> true,
			'S_EDIT_MODE'		=> $edit_mode,
			'U_EDIT_MODE'		=> append_sid($page_url, 'edit_mode=1'),
			'U_DISP_MODE'		=> build_url('edit_mode'),
			'UA_ROUTE'			=> $route,
			'UA_AJAX_URL'		=> $this->user->page['root_script_path'] . 'app.' . $phpEx)
		);

		if ($edit_mode === false)
		{
			return false;
		}

		$this->user->add_lang_ext('primetime/primetime', 'manager');

		$this->get_available_blocks();

		$this->template->assign_vars(array(
			'ICON_PICKER'	=> $this->icons->picker(),
			'S_ROUTE_OPS'	=> $this->get_page_routes($route))
		);

		return true;
	}

	public function get_available_blocks()
	{
		if (($blocks = $this->cache->get('_primetime_blocks')) === false)
		{
			global $phpbb_container;

			$factory = $phpbb_container->get('primetime.blocks.factory');
			
			$blocks = $factory->get_all_blocks();
			$this->cache->put('_primetime_blocks', $blocks);
		}

		foreach ($blocks as $service => $name)
		{
			$lname = strtoupper($name);
			$this->template->assign_block_vars('block', array(
				'NAME'		=> (isset($this->user->lang[$lname])) ? $this->user->lang[$lname] : $name,
				'SERVICE'	=> $service)
			);
		}
	}

	public function get_page_routes($route)
	{
		$sql_array = array(
			'SELECT'	=> 'b.route',
			'FROM'		=> array($this->blocks_table => 'b'),
			'WHERE'		=> "b.route <> '" . $this->db->sql_escape($route) . "'"
		);
		$sql = $this->db->sql_build_query('SELECT_DISTINCT', $sql_array);
		$result = $this->db->sql_query($sql);

		$options = '<option value="">' . $this->user->lang['SELECT'] . '</option>';
		while ($row = $this->db->sql_fetchrow($result))
		{
			$options .= '<option value="' . $row['route'] . '">' . $row['route'] . '</option>';
		}
		$this->db->sql_freeresult($result);

		return $options;
	}
}
