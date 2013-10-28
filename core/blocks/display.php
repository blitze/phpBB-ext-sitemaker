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
class display
{
	/**
	 * Auth object instance
	 * @var \phpbb\auth\auth
	 */
	protected $auth;

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
	* Name of the blocks database table
	* @var string
	*/
	private $blocks_table;

	/**
	* Name of the blocks_config database table
	* @var string
	*/
	private $blocks_config_table;
	
	/**
	* Name of the block_positions database table
	* @var string
	*/
	private $block_positions_table;

	/**
	 * Block positions
	 * @var array
	 */
	private $positions = array();

	/**
	* Constructor
	*
	* @param \phpbb\auth\auth					$auth					Auth object
	* @param \phpbb\cache\service				$cache					Cache object
	* @param \phpbb\db\driver\driver			$db						Database object
	* @param \phpbb\request\request_interface	$request 				Request object
	* @param \phpbb\template\template			$template				Template object
	* @param \phpbb\user                		$user       			User object
	* @param string								$blocks_table			Name of the blocks database table
	* @param string								$blocks_config_table	Name of the blocks_config database table
	* @param string								$block_positions_table	Name of the block_positions database table
	*/
	public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\driver\driver_interface  $cache, \phpbb\db\driver\driver $db, \phpbb\request\request_interface $request, \phpbb\template\template $template, \phpbb\user $user, $blocks_table, $blocks_config_table, $block_positions_table)
	{
		$this->db = $db;
		$this->user = $user;
		$this->auth = $auth;
		$this->cache = $cache;
		$this->request = $request;
		$this->template = $template;
		$this->blocks_table = $blocks_table;
		$this->blocks_config_table = $blocks_config_table;
		$this->block_positions_table = $block_positions_table;
	}

	public function get_blocks($route, $edit_mode)
	{
        if (($blocks = $this->cache->get('_blocks_' . $route)) === false)
        {
			global $phpbb_container;

			$sql_array = array(
				'SELECT'	=> 'b.*, p.pname',

				'FROM'	  => array(
					$this->blocks_table	=> 'b'
				),

				'LEFT_JOIN' => array(
					array(
						'FROM'  => array($this->block_positions_table => 'p'),
						'ON'	=> 'b.position = p.pid',
					)
				),

				'WHERE'	 => "route = '" . $this->db->sql_escape($route) . "'" . ((!$edit_mode) ? ' AND b.status = 1' : ''),

				'ORDER_BY'  => 'b.weight ASC',
			);

			$sql = $this->db->sql_build_query('SELECT', $sql_array);
			$result = $this->db->sql_query($sql);

			$blocks = array();
			while ($row = $this->db->sql_fetchrow($result))
			{
				$blocks[$row['bid']] = $row;
				$blocks[$row['bid']]['settings'] = array();
			}
			$this->db->sql_freeresult($result);

			$db_settings = $this->get_blocks_config(array_keys($blocks));

			$blocks = array_values($blocks);
			for ($i = 0, $size = sizeof($blocks); $i < $size; $i++)
			{
				$bid = $blocks[$i]['bid'];
				$block_service = $blocks[$i]['name'];

				if ($phpbb_container->has($block_service) === false)
				{
					continue;
				}

				$b = $phpbb_container->get($block_service);
				$df_settings = $b->config();

				foreach ($df_settings as $key => $settings)
				{
					if (!is_array($settings))
					{
						continue;
					}
					$default =& $settings['default'];
					$blocks[$i]['settings'][$key] = (isset($db_settings[$bid][$key])) ? $db_settings[$bid][$key] : $default;
				}
			}

            $this->cache->put('_blocks_' . $route, $blocks);
        }

		return $blocks;
	}
	
	public function get_blocks_config($bids)
	{
		if (!sizeof($bids))
		{
			return array();
		}

        $sql = 'SELECT bid, bvar, bval
            FROM ' . $this->blocks_config_table . '
            WHERE ' . $this->db->sql_in_set('bid', $bids);
        $result = $this->db->sql_query($sql);

        $data = array();
        while ($row = $this->db->sql_fetchrow($result))
        {
            $data[$row['bid']][$row['bvar']] = $row['bval'];
        }
        $this->db->sql_freeresult($result);
    
        return $data;
	}

	public function show()
	{
		global $phpbb_container, $phpbb_root_path;

		$offlimits = array('ucp.php', 'mcp.php');
		if ($this->user->page['page_dir'] == 'adm' || in_array($this->user->page['page_name'], $offlimits))
		{
			return;
		}

		$edit_mode = false;
		$route = $this->user->page['page_name'];

		if ($this->auth->acl_get('a_manage_blocks'))
		{
			$manager = $phpbb_container->get('primetime.blocks.manager');
			$edit_mode = $manager->handle($route);
		}

		$blocks = $this->get_blocks($route, $edit_mode);

		$blocks_per_position = array();
		for ($i = 0, $size = sizeof($blocks); $i < $size; $i++)
		{
			$row = $blocks[$i];
			$block_service = $row['name'];
			$pos_count_key = 's_' . $row['pname'] . '_count';

			if ($phpbb_container->has($block_service))
			{
				$b = $phpbb_container->get($block_service);
				$block = $b->display($row, $edit_mode);

				if (!trim($block['content']))
				{
					continue;
				}

				$data = array_merge($row, array(
						'TITLE'		=> ($row['title']) ? $row['title'] : $block['title'],
						'CONTENT'	=> $block['content'],
					)
				);
				$this->template->assign_block_vars($row['pname'], array_change_key_case($data, CASE_UPPER));
				$blocks_per_position[$pos_count_key] = (isset($blocks_per_position[$pos_count_key])) ? $blocks_per_position[$pos_count_key] + 1 : 0;
			}
		}

		$this->template->assign_vars(array_merge(array(
				'S_PRIMETIME'		=> true,
				'S_BLOCKS_ADMIN'	=> true,
			),
			array_change_key_case($blocks_per_position, CASE_UPPER))
		);
	}
}
