<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2017 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\v30x;

/**
 * This fixes this issue: https://www.phpbb.com/customise/db/extension/phpbb_sitemaker_2/support/topic/181676
 * For some reason, by depending on m1_initial_schema, m1_initial_schema is reverted (removing sm_blocks)
 * before m16_add_block_view_field is reverted when uninstalling the extension
 */
class m302_fix_m16_add_block_view_field extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v30x\m16_add_block_view_field',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'fix_migration_deps'))),
		);
	}

	/**
	 * @return void
	 */
	public function fix_migration_deps()
	{
		$migration_name = '\\blitze\\sitemaker\\migrations\\v30x\\m16_add_block_view_field';
		$migration_deps = array(
			'\\blitze\\sitemaker\\migrations\\v20x\\m1_initial_schema',
			'\\blitze\\sitemaker\\migrations\\converter\\c4_convert_primetime_data',
		);

		$sql_data = array(
			'migration_depends_on' => serialize($migration_deps),
		);

		$sql = 'UPDATE ' . $this->table_prefix . 'migrations
				SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . "
				WHERE migration_name = '" . $this->db->sql_escape($migration_name) . "'";
		$this->db->sql_query($sql);
	}
}
