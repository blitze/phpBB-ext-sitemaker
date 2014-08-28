<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\form\field;

class submit extends base
{
	/* @var \phpbb\user */
	protected $user;

	/** @var \primetime\primetime\core\template */
	protected $ptemplate;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user							$user			User object
	 * @param \primetime\primetime\core\template	$ptemplate		Primetime template object
	 */
	public function __construct(\phpbb\user $user, \primetime\primetime\core\template $ptemplate)
	{
		$this->user = $user;
		$this->ptemplate = $ptemplate;
	}

	/**
	 * @inheritdoc
	 */
	public function get_field_value($name, $value)
	{
		return $value;
	}

	/**
	 * @inheritdoc
	 */
	public function get_default_props()
	{
		return array(
			'validate_form'		=> true,
			'requires_item_id'	=> true,
		);
	}

	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'submit';
	}
}
