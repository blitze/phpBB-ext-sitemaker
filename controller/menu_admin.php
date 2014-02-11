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

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

/**
*
*/
class menu_admin
{
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
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Tree builder object
	 * @var \primetime\menu\core\builder
	 */
	protected $manager;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver					$db				Database object
	 * @param \phpbb\request\request_interface			$request 		Request object
	 * @param \phpbb\user                				$user       	User object
	 * @param \phpbb\template							$template		Template object
	 * @param \primetime\primetime\core\menu\builder	$manager		Tree builder Object
	 * @param string									$menus_table	Menus table
	 */
	public function __construct(\phpbb\db\driver\driver $db, \phpbb\request\request_interface $request, \phpbb\user $user, \phpbb\template\template $template, \primetime\primetime\core\menu\builder $manager, $menus_table)
	{
		$this->db = $db;
		$this->request = $request;
		$this->user = $user;
		$this->template = $template;
		$this->manager = $manager;
		$this->menus_table = $menus_table;
	}

	/**
	 * Default controller method to be called if no other method is given.
	 * In our case, it is accessed when the URL is /example
	 *
	 * @return Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function handle($action, $item_id = 0)
	{
		$this->user->add_lang_ext('primetime/menu', 'admin');

		if ($this->request->is_ajax() === false)
		{
			$this->return_data['errors'] = $this->user->lang['NOT_AUTHORIZED'];
			return new Response(json_encode($this->return_data));
		}

		$errors = array();
		$return = array();

		$menu_id = $this->request->variable('menu_id', 0);

		$this->manager->set_sql_condition('menu_id = ' . $menu_id);

		switch ($action)
		{
			case 'add':
			case 'edit':

				$data = array(
					'item_id'		=> (int) $item_id,
					'menu_id'		=> (int) $menu_id,
					'item_title'	=> $this->request->variable('item_title', $this->user->lang['CHANGE_ME'], true),
				);

				if ($action == 'edit')
				{
					if ($data['item_id'])
					{
						$data += $this->manager->get_row($data['item_id']);
					}
					else
					{
						$errors[] = $this->user->lang['MISSING_ITEM_ID'];
					}
				}

				if (!sizeof($errors))
				{
					$data['item_title'] = ucwords($data['item_title']);

					$this->manager->save_node($data['item_id'], $data);

					$return = $this->manager->get_row($data['item_id']);
					$errors += $this->manager->get_errors();
				}

			break;

			case 'add_bulk':

				$parent_id = $this->request->variable('parent_id', 0);
				$bulk_list = $this->request->variable('add_list', '', true);
	
				$tree = $this->manager->string_to_nestedset($bulk_list, array('item_title' => '', 'item_url' => ''), array('menu_id' => $menu_id));
				if (sizeof($tree)) {
					$return['items'] = $this->manager->add_branch($tree, $parent_id);
				}
				$errors += $this->manager->get_errors();

			break;

			case 'update':

				$data = array(
					'item_id'		=> (int) $item_id,
					'item_title'	=> $this->request->variable('item_title', '', true),
					'item_icon'		=> $this->request->variable('item_icon', ''),
					'item_url'		=> $this->request->variable('item_url', ''),
					'item_target'	=> $this->request->variable('item_target', 0),
					'item_status'	=> $this->request->variable('item_status', 1),
				);

				$this->manager->save_node($item_id, array_filter($data));
				$return = $this->manager->get_row($item_id);
				$errors += $this->manager->get_errors();

			break;

			case 'save_tree':

				$raw_tree = $this->request->variable('tree', array(0 => array('' => 0)));

				$tree = array();
				for ($i = 1, $size = sizeof($raw_tree); $i < $size; $i++)
				{
					$row = $raw_tree[$i];
					$tree[$row['item_id']] = array(
						'item_id'	=> (int) $row['item_id'],
						'parent_id' => (int) $row['parent_id'],
					);
				}

				$this->manager->update_tree($tree);

			break;

			case 'get_item':

				$return = $this->manager->get_row($item_id);

			break;

			case 'add_menu':

				$result = $this->db->sql_query('SELECT COUNT(*) AS total FROM ' . $this->menus_table);
				$total = $this->db->sql_fetchfield('total');
				$this->db->sql_freeresult($result);

				$data = array(
					'menu_name'	=> 'Menu ' . ($total + 1), 
				);

				$return = $this->manager->menu_create($data);

			break;


			case 'rebuild_tree':

				$this->manager->recalc_nestedset();
				
				// no break here

			case 'get_all_items':

				$sql = $this->manager->qet_tree_sql();
				$result = $this->db->sql_query($sql);

				$items = array();
				while ($row = $this->db->sql_fetchrow($result))
				{
					$items[] = $row;
				}
				$this->db->sql_freeresult($result);
				
				$return['items'] = $items;

			break;
		}

		$return['errors'] = join('<br />', $errors);

		$response = new Response(json_encode($return));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}
}
