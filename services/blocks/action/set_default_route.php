<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

class set_default_route extends base_action
{
	/**
	 * {@inheritdoc}
	 */
	public function execute($style_id)
	{
		$route = $this->request->variable('route', '');
		$this->config->set('sitemaker_default_layout', join(':', [$route, $style_id]));

		return array();
	}
}
