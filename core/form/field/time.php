<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\form\field;

class time extends duration
{
	/** @var \phpbb\request\request_interface */
	protected $request;

	/* @var \phpbb\user */
	protected $user;

	/** @var \primetime\primetime\core\template */
	protected $ptemplate;

	/** @var \primetime\primetime\core\primetime */
	protected $primetime;

	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request_interface		$request		Request object
	 * @param \phpbb\user							$user			User object
	 * @param \primetime\primetime\core\template	$ptemplate		Primetime template object
	 * @param \primetime\primetime\core\primetime	$primetime		Primetime object
	 */
	public function __construct(\phpbb\request\request_interface $request, \phpbb\user $user, \primetime\primetime\core\template $ptemplate, \primetime\primetime\core\primetime $primetime)
	{
		$this->request = $request;
		$this->user = $user;
		$this->ptemplate = $ptemplate;
		$this->primetime = $primetime;
	}

	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'time';
	}
}
