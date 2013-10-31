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
class template extends \phpbb\template\twig\twig
{
	public function __construct(\phpbb\path_helper $path_helper, $config, $user, \phpbb\template\context $context, \phpbb\extension\manager $extension_manager = null)
	{
		parent::__construct($path_helper, $config, $user, $context, $extension_manager);
	}

	public function clear()
	{
		$this->context->clear();
	}
}
