<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\form\field;

/**
 * 
 */
class date extends base
{
	/**
	 * Request object
	 * @var \phpbb\request\request_interface
	 */
	protected $request;

	/**
	 * Template object for primetime blocks
	 * @var \primetime\primetime\core\template
	 */
	protected $ptemplate;

	/**
	 * Constructor
	 *
	 * @param \phpbb\request\request_interface		$request		Request object
	 * @param \primetime\primetime\core\template	$ptemplate		Primetime template object
	 */
	public function __construct(\phpbb\request\request_interface $request, \primetime\primetime\core\template $ptemplate)
	{
		$this->request = $request;
		$this->ptemplate = $ptemplate;
	}

	/**
	 * @inheritdoc
	 */
	public function get_field_value($name, $value)
	{
		return $this->request->variable($name, $value);
	}

	/**
	 * @inheritdoc
	 */
	public function get_default_props()
	{
		return array(
			'field_minlen'		=> '',
			'field_maxlen'		=> '',
			'requires_item_id'	=> false,
		);
	}

	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'date';
	}
}
