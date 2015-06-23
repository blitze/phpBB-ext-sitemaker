<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\controller;

use Symfony\Component\HttpFoundation\Response;

class menu_admin
{
	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \primetime\core\services\menu\builder */
	protected $manager;

	/** @var string */
	private $menus_table;

	/** @var string */
	private $board_url;

	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request_interface			$request 		Request object
	 * @param \phpbb\user                				$user       	User object
	 * @param \phpbb\template							$template		Template object
	 * @param \primetime\core\services\menu\builder		$manager		Tree builder Object
	 * @param string									$menus_table	Menus table
	 */
	public function __construct(\phpbb\request\request_interface $request, \phpbb\user $user, \phpbb\template\template $template, \primetime\core\services\menu\builder $manager, $menus_table)
	{
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->manager = $manager;
		$this->menus_table = $menus_table;
		$this->board_url = generate_board_url();
	}

	public function handle($action, $item_id = 0)
	{
		if ($this->request->is_ajax() === false)
		{
			trigger_error('NOT_AUTHORISED');
		}

		$errors = array();
		$return = array();

		$menu_id = $this->request->variable('menu_id', 0);

		$this->manager->set_sql_condition('menu_id = ' . $menu_id);

		switch ($action)
		{
			case 'add':
			case 'edit':

				$return = array(
					'menu_id'		=> (int) $menu_id,
					'item_title'	=> $this->request->variable('item_title', '', true),
				);

				if ($action == 'edit' && !$item_id)
				{
					$errors[] = $this->user->lang['MISSING_ITEM_ID'];
				}
				else
				{
					$return['item_title'] = ucwords($return['item_title']);

					$this->manager->save_node($item_id, $return);
					$errors += $this->manager->get_errors();
				}

			break;

			case 'add_bulk':

				$parent_id = $this->request->variable('parent_id', 0);
				$bulk_list = $this->request->variable('add_list', '', true);

				$tree = $this->manager->string_to_nestedset($bulk_list, array('item_title' => '', 'item_url' => ''), array('menu_id' => $menu_id));

				foreach ($tree as $key => $row)
				{
					$tree[$key]['item_url'] = $this->sanitize_url($row['item_url']);
				}

				if (sizeof($tree))
				{
					$return['items'] = $this->manager->add_branch($tree, $parent_id);
				}

				$errors += $this->manager->get_errors();

			break;

			case 'update':

				$return = array(
					'item_title'	=> $this->request->variable('item_title', '', true),
					'item_icon'		=> $this->request->variable('item_icon', ''),
					'item_url'		=> $this->request->variable('item_url', ''),
					'item_target'	=> $this->request->variable('item_target', 0),
					'item_status'	=> $this->request->variable('item_status', 1),
				);

				$return['item_url'] = $this->sanitize_url($return['item_url']);
				$return = array_filter($return);

				$this->manager->save_node($item_id, $return);
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

				$return = $this->manager->menu_create();

			break;

			case 'update_menu':

				$data = array(
					'menu_name' => $this->request->variable('title', '', true),
				);

				$return = $this->manager->menu_update($menu_id, $data);
				$return['name'] = $return['menu_name'];

			break;

			case 'delete_menu':

				$return = $this->manager->menu_delete($menu_id);

			break;

			case 'rebuild_tree':

				$this->manager->recalc_nestedset();

				// no break here

			case 'get_all_items':

				$return['items'] = $this->manager->menu_get_items();

			break;
		}

		$return['errors'] = join('<br />', $errors);

		$response = new Response(json_encode($return));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}

	private function sanitize_url($url)
	{
		$url = ltrim(str_replace($this->board_url, '', $url), './');
		$parts = parse_url($url);

		if ($url && empty($parts['host']) && strpos($parts['path'], '.') === false)
		{
			$url = 'app.php/' . $url;
		}

		return $url;
	}
}
