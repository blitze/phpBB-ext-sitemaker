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
	/* @var \primetime\primetime\core\primetime */
	protected $primetime;
	
	/* @var \primetime\primetime\core\blocks\display */
	protected $blocks;
	
	/**
	 * Constructor
	 *
	 * @param \primetime\primetime\core\primetime		$primetim		Primetime helper object
	 * @param \primetime\primetime\core\blocks\display	$blocks			Blocks display object
	*/
	public function __construct(\primetime\primetime\core\primetime $primetime, \primetime\primetime\core\blocks\display $blocks)
	{
		$this->primetime = $primetime;
		$this->blocks = $blocks;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.page_footer'		=> 'init',
		);
	}

	public function init($event)
	{
		$this->primetime->init();
		$this->blocks->show();
		$this->primetime->set_assets();
	}
}
