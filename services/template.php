<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

use phpbb\template\twig\twig;

class template extends twig
{
	/**
	 * Clear template data
	 */
	public function clear()
	{
		$this->context->clear();
	}

	/**
	 * Render Template View
	 *
	 * @param string $ext_name extension name in form namespace/extension
	 * @param string $tpl_file html template file
	 * @param string $handle template handle
	 * @return string
	 */
	public function render_view($ext_name, $tpl_file, $handle)
	{
		$this->set_style(array("ext/$ext_name/styles", 'styles'));

		$this->set_filenames(array(
			$handle	=> $tpl_file)
		);

		$view = $this->assign_display($handle);
		$this->context->clear();

		return $view;
	}
}
