<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\form\field;

class password extends base
{
	/** @var \phpbb\request\request_interface */
	protected $request;

	/* @var \phpbb\user */
	protected $user;

	/** @var \primetime\primetime\core\template */
	protected $ptemplate;

	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request_interface		$request		Request object
	 * @param \phpbb\user							$user			User object
	 * @param \primetime\primetime\core\template	$ptemplate		Primetime template object
	 */
	public function __construct(\phpbb\request\request_interface $request, \phpbb\user $user, \primetime\primetime\core\template $ptemplate)
	{
		$this->request = $request;
		$this->user = $user;
		$this->ptemplate = $ptemplate;
	}

	/**
	 * @inheritdoc
	 */
	public function get_field_value($name, $value)
	{
		return $this->request->variable($name, (string) $value, true);
	}

	/**
	 * @inheritdoc
	 */
	public function get_default_props()
	{
		return array(
			'field_size'		=> 30,
			'field_minlen'		=> 0,
			'field_maxlen'		=> 200,
			'requires_item_id'	=> false,
		);
	}

	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'password';
	}
}
