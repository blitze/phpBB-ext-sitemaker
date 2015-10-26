<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

class handle_custom_action extends base_action
{
	public function execute($style_id)
	{
		$block_id = $this->request->variable('id', 0);
		$service = $this->request->variable('service', '');
		$method = $this->request->variable('method', '');

		if ($this->phpbb_container->has($service))
		{
			return $this->phpbb_container->get($service)->$method($block_id);
		}

		throw new \blitze\sitemaker\exception\out_of_bounds(array($service, 'SERVICE_NOT_FOUND'));
	}
}
