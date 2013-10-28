<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\migrations\v10x;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Initial schema changes needed for Extension installation
 */

class v100 extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public function effectively_installed()
	{
		return isset($this->config['primetime_version']) && version_compare($this->config['primetime_version'], '1.0.0', '>=');
	}

	/**
	 * @inheritdoc
	 */
	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'block_positions'	=> array(
					'COLUMNS'		=> array(
						'pid'			=> array('USINT', NULL, 'auto_increment'),
						'pname'			=> array('VCHAR:25', ''),
						'style'			=> array('USINT', 0),
						'status'		=> array('BOOL', 1),
					),

					'PRIMARY_KEY'	=> 'pid',

					'KEYS'			=> array(
						'style'			=> array('INDEX', 'style'),
					),
				),

				$this->table_prefix . 'blocks'			=> array(
					'COLUMNS'		=> array(
						'bid'			=> array('UINT', NULL, 'auto_increment'),
						'icon'			=> array('VCHAR:55', ''),
						'name'			=> array('VCHAR:55', ''),
						'title'			=> array('XSTEXT_UNI', ''),
						'route'			=> array('XSTEXT_UNI', ''),
						'position'		=> array('USINT', 0),
						'weight'		=> array('USINT', 0),
						'style'			=> array('USINT', 0),
						'permission'	=> array('VCHAR:125', ''),
						'class'			=> array('VCHAR:125', ''),
						'status'		=> array('BOOL', 1),
						'no_wrap'		=> array('BOOL', 0),
						'hide_title'	=> array('BOOL', 0),
					),

					'PRIMARY_KEY'	=> 'bid',

					'KEYS'			=> array(
						'style'			=> array('INDEX', 'style'),
					),
				),

				$this->table_prefix . 'blocks_config'	=> array(
					'COLUMNS'		=> array(
						'bid'			=> array('UINT', 0),
						'bvar'			=> array('VCHAR', ''),
						'bval'			=> array('VCHAR_UNI', ''),
					),

					'KEYS'			=> array(
						'bid'			=> array('INDEX', 'bid'),
					),
				),
			),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'block_positions',
				$this->table_prefix . 'blocks',
				$this->table_prefix . 'blocks_config',
			),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return array(
			array('config.add', array('primetime_version', '1.0.0')),

		 	array('permission.add', array('a_manage_blocks')),
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_manage_blocks')),
			
			// Add the Primetime tab in acp
		 	array('module.add', array('acp', 0, 'Primetime')),

			// Add Primetime Category
		 	array('module.add', array('acp', 'Primetime', 'ACP_CAT_CMS')),

		 	array('module.add', array('acp', 'Primetime', 'ACP_PRIMETIME_EXTENSIONS')),

			// Add the dashboard mode
			array('module.add', array('acp', 'ACP_CAT_CMS', array(
					'module_basename'	=> '\primetime\primetime\acp\dashboard_module',
				),
			)),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function revert_data()
	{
		return array(
			array('config.remove', array('primetime_version')),
		 	array('permission.remove', array('a_manage_blocks')),
		);
	}
}