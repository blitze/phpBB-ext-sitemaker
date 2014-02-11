<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\menu;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Manage nested sets
 * @package phpBB Primetime Categories
 */
class display extends \primetime\primetime\core\tree\display
{
	/**
	 * Construct
	 * 
	 * @param \phpbb\db\driver\driver				$db             Database connection
	 * @param \primetime\primetime\core\primetime	$primetime		Primetime object
	 * @param string								$table_name		Table name
	 * @param string								$pk				Primary key
	 */
	public function __construct(\phpbb\db\driver\driver $db, \primetime\primetime\core\primetime $primetime, $table, $pk)
	{
		parent::__construct($db, $primetime, $table, $pk);
	}
}
