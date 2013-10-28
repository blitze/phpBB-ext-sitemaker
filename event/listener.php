<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\event;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
*
*/
class listener implements EventSubscriberInterface
{
	public function __construct()
	{
		global $phpbb_container;

		$this->primetime = $phpbb_container->get('primetime');
		$this->blocks = $phpbb_container->get('primetime.blocks.display');
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.page_footer'		=> 'init_front',
			'core.adm_page_footer'  => 'init_admin',
		);
	}

	public function init_admin()
	{
		$this->primetime->set_assets();
	}

	public function init_front()
	{
		$this->primetime->init();
		$this->blocks->show();
		$this->primetime->set_assets();
	}
}
