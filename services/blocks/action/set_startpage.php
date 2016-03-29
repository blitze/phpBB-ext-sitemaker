<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

class set_startpage extends base_action
{
	/**
	 * {@inheritdoc}
	 */
	public function execute($style_id)
	{
		$this->config->set('sitemaker_startpage_controller', $this->request->variable('controller', ''));
		$this->config->set('sitemaker_startpage_method', $this->request->variable('method', ''));
		$this->config->set('sitemaker_startpage_params', $this->request->variable('params', ''));

		return array();
	}
}
