<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\config\fields;

/**
 * @package sitemaker
 */
class code_editor implements cfg_field_interface
{
	/** @var \phpbb\language\language */
	protected $translator;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language	$translator		Language object
	 */
	public function __construct(\phpbb\language\language $translator)
	{
		$this->translator = $translator;
	}

	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'code_editor';
	}

	/**
	 * {@inheritdoc}
	 */
	public function prep_field(array &$vars, array &$type, $field, array $db_settings)
	{
		$vars['method'] = 'build_code_editor';
		$vars['params'] = array_reverse((array) $vars['params']);
		$vars['params'][] = $vars['lang_explain'];
		$vars['params'][] = $db_settings[$field];
		$vars['params'][] = $field;
		$vars['params'] = array_reverse($vars['params']);

		$type[0] = 'custom';
	}

	/**
	 * Used to add a code editor to blocks config
	 *
	 * @param string $key
	 * @param string $value
	 * @param string $explain
	 * @param array $data_props
	 * @param string $label
	 * @return string
	 */
	public function build_code_editor($key, $value, $explain, array $data_props = array(), $label = '')
	{
		$html = '';
		$id = $key . '-editor';
		$class = $id . '-button';
		$attributes = $this->get_code_editor_attributes($data_props);

		$html .= ($label) ? '<label for="' . $key . '"><strong>' . $this->translator->lang($label) . '</strong></label>' : '';
		$html .= ($explain) ? '<span>' . $explain . '</span>' : '';
		$html .= '<textarea id="' . $id . '" class="code-editor" name="config[' . $key . ']"' . $attributes . '>' . $value . '</textarea>';
		$html .= '<div class="align-right">';
		$html .= '<button class="' . $class . ' CodeMirror-button" data-action="undo" title="' . $this->translator->lang('UNDO') . '"><i class="fa fa-undo" aria-hidden="true"></i></button>';
		$html .= '<button class="' . $class . ' CodeMirror-button" data-action="redo" title="' . $this->translator->lang('REDO') . '"><i class="fa fa-repeat" aria-hidden="true"></i></button>';
		$html .= '<button class="' . $class . ' CodeMirror-button" data-action="clear" title="' . $this->translator->lang('CLEAR') . '"><i class="fa fa-ban" aria-hidden="true"></i></button>';
		$html .= $this->fullscreen_allowed($data_props) ? '<button class="' . $class . ' CodeMirror-button" data-action="fullscreen" title="' . $this->translator->lang('FULLSCREEN') . '"><i class="fa fa-window-restore" aria-hidden="true"></i></button>' : '';
		$html .= '</div>';

		return $html;
	}

	/**
	 * @param array $data_props
	 * @return bool
	 */
	protected function fullscreen_allowed(array $data_props = array())
	{
		return (!isset($data_props['allow-full-screen']) || $data_props['allow-full-screen']);
	}

	/**
	 * @param array $data_props
	 * @return string
	 */
	protected function get_code_editor_attributes(array $data_props = array())
	{
		$attributes = '';
		foreach ($data_props as $prop => $value)
		{
			$value = (gettype($value) === 'boolean') ? (int) $value : $value;
			$attributes .= " data-{$prop}=\"{$value}\"";
		}
		return $attributes;
	}
}
