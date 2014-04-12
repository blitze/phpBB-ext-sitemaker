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
 * Base class for content fields
 * @package primetime
 */
abstract class base implements base_interface
{
	/**
	 * Template object for primetime blocks
	 * @var \primetime\primetime\core\template
	 */
	protected $ptemplate;

	/**
	 * Block name
	 * @var string
	 */
	protected $name;

	/**
	 * Constructor
	 *
	 * @param \primetime\primetime\core\template	$ptemplate		Primetime template object
	 */
	public function __construct(\primetime\primetime\core\template $ptemplate)
	{
		$this->ptemplate = $ptemplate;
	}

	/**
	 * @inheritdoc
	 */
	public function display_field($value)
	{
		return $value;
	}

	/**
	 * @inheritdoc
	 */
	public function render_view($name, &$data)
	{
		$data += $this->get_default_props();

		$field = $this->get_name();
		$data['field_name'] = $name;
		$data['field_value'] = $this->get_field_value($name, $data['field_value']);
		$data['field_required']	= ($data['field_required']) ? ' required' : '';

		$this->ptemplate->assign_vars(array_change_key_case($data, CASE_UPPER));

		return $this->ptemplate->render_view('primetime/primetime', "fields/$field.html", $field . '_field');
	}

	/**
	 * @inheritdoc
	 */
	public function save_field($field, $value)
	{
		return '[field=' . $field . ']' . $value . '[/field]';
	}

	/**
	 * @inheritdoc
	 */
	public function validate_field($data)
	{
		global $user;

		if (isset($data['field_minlength']))
		{
			$data['validation_options'] += array('min_range' => $data['field_minlength']);
		}

		if (isset($data['field_maxlength']))
		{
			$data['validation_options'] += array('max_range' => $data['field_maxlength']);
		}

		$options = (isset($data['validation_options'])) ? array('options' => $data['validation_options']) : false;

		if (isset($data['validation_filter']) && !filter_var($data['field_value'], $data['validation_filter'], $options))
		{
			$length = utf8_strlen($data['field_value']);
			
			if (isset($data['field_minlength']) && $length < $data['field_minlength'])
			{
				return sprintf($user->lang['FIELD_TOO_SHORT'], $data['field_label'], $data['field_minlength']);
			}
			else if (isset($data['field_maxlength']) && $length < $data['field_maxlength'])
			{
				return sprintf($user->lang['FIELD_TOO_LONG'], $data['field_label'], $data['field_maxlength']);
			}
			else
			{
				return sprintf($user->lang['FIELD_INVALID'], $data['field_label']);
			}
		}
	}
}
