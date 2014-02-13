<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core;

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
        
	/**
	 * Render Template View
	 * 
	 * @param string $ext_name		extension name in form namespace/extension
	 * @param string $tpl_file		html template file
	 * @param string $handle		template handle
	 */
	public function render_view($ext_name, $tpl_file, $handle)
	{
		$this->set_style(array("ext/$ext_name/styles"));

		$this->set_filenames(array(
			$handle	=> $tpl_file)
		);

		$view = $this->assign_display($handle);
		$this->context->clear();

		return $view;
	}
}
