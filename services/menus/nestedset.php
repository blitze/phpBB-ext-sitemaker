<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\menus;

use blitze\sitemaker\services\tree\builder;

class nestedset extends builder
{
	/**
	* Construct
	*
	* @param \phpbb\db\driver\driver_interface	$db				Database connection
	* @param \phpbb\lock\db						$lock			Lock class used to lock the table when moving forums around
	* @param string								$table_name		Table name
	*/
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\lock\db $lock, $table_name)
	{
		parent::__construct(
			$db,
			$lock,
			$table_name,
			'MENU_',
			'',
			array()
		);
	}
}
