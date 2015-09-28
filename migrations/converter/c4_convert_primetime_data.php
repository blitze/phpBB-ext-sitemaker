<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\converter;

class c4_convert_primetime_data extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v20x\m1_initial_schema',
			'\blitze\sitemaker\migrations\v20x\m2_initial_data',
		);
	}

	/**
	 * Skip this migration if the pt_blocks table does not exist
	 *
	 * @return bool True to skip this migration, false to run it
	 * @access public
	 */
	public function effectively_installed()
	{
		return !$this->db_tools->sql_table_exists($this->table_prefix . 'pt_blocks');
	}

	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'import_block_routes'))),
			array('custom', array(array($this, 'import_blocks'))),
			array('custom', array(array($this, 'import_blocks_config'))),
			array('custom', array(array($this, 'import_menus'))),
			array('custom', array(array($this, 'import_menu_items'))),
			array('custom', array(array($this, 'update_block_names'))),
			array('custom', array(array($this, 'update_forum_names'))),

			array('config.add', array('sitemaker_last_changed', $this->config['primetime_last_changed'])),
			array('config.add', array('sitemaker_default_layout', $this->config['primetime_default_layout'])),
			array('config.add', array('sitemaker_parent_forum_id', $this->config['primetime_parent_forum_id'])),
			array('config.add', array('sitemaker_blocks_cleanup_gc', $this->config['primetime_blocks_cleanup_gc'])),
			array('config.add', array('sitemaker_blocks_cleanup_last_gc', $this->config['primetime_blocks_cleanup_last_gc'], 1)),
			array('config.add', array('sitemaker_startpage_controller', $this->config['primetime_startpage_controller'])),
			array('config.add', array('sitemaker_startpage_method', $this->config['primetime_startpage_method'])),
			array('config.add', array('sitemaker_startpage_params', $this->config['primetime_startpage_params'])),
		);
	}

	public function import_block_routes()
	{
		$this->copy_table('pt_block_routes', 'sm_block_routes');
	}

	public function import_blocks()
	{
		$this->copy_table('pt_blocks', 'sm_blocks');
	}

	public function import_blocks_config()
	{
		$this->copy_table('pt_blocks_config', 'sm_blocks_config');
	}

	public function import_menus()
	{
		$this->copy_table('pt_menus', 'sm_menus');
	}

	public function import_menu_items()
	{
		$this->copy_table('pt_menu_items', 'sm_menu_items');
	}

	public function update_block_names()
	{
		$result = $this->db->sql_query('SELECT bid, name FROM ' . $this->table_prefix . 'sm_blocks');

		while ($row = $this->db->sql_fetchrow($result))
		{
			$name = str_replace('primetime.core', 'blitze.sitemaker', $row['name']);
			$this->db->sql_query('UPDATE ' . $this->table_prefix . "sm_blocks SET name='" . $this->db->sql_escape($name) . "' WHERE bid = " . (int) $row['bid']);
		}
		$this->db->sql_freeresult($result);
	}

	public function update_forum_names()
	{
		if (!class_exists('acp_forums'))
		{
			include($this->phpbb_root_path . 'includes/acp/acp_forums.' . $this->php_ext);
		}

		$acp_forum = new \acp_forums();
		$errors = $acp_forum->delete_forum($this->config['sitemaker_parent_forum_id']);

		if (!sizeof($errors) && !empty($this->config['primetime_parent_forum_id']))
		{
			$this->db->sql_query('UPDATE ' . FORUMS_TABLE . " SET forum_name='phpBB Sitemaker Extensions' WHERE forum_id = " . (int) $this->config['primetime_parent_forum_id']);
		}
	}

	public function copy_table($old_table, $new_table)
	{
		// Load the insert buffer class to perform a buffered multi insert
		$insert_buffer = new \phpbb\db\sql_insert_buffer($this->db, $this->table_prefix . $new_table);

		$result = $this->db->sql_query('SELECT * FROM ' . $this->table_prefix . $old_table);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$insert_buffer->insert($row);
		}
		$this->db->sql_freeresult($result);

		// Flush the buffer
		$insert_buffer->flush();
	}
}
