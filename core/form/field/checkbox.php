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
class checkbox extends choice
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
	public function get_field_value($name, $default)
	{
		$default = is_array($default) ? $default : explode("\n", $default);
		$value =  $this->request->variable($name, $default, true);

		if (empty($value) && $this->request->server('REQUEST_METHOD') != 'POST')
		{
			$value = $default;
		}

		return $value;
	}

	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'checkbox';
	}
}
