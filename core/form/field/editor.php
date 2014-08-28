<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core\form\field;

use Urodoz\Truncate\TruncateService;

class editor extends base
{
	/** @var \phpbb\request\request_interface */
	protected $request;

	/* @var \phpbb\user */
	protected $user;

	/** @var \primetime\primetime\core\template */
	protected $ptemplate;

	/** @var Urodoz\Truncate\TruncateService */
	protected $truncate;

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
		$this->truncate = new TruncateService();
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
	public function display_field($value, $data = array(), $view = 'detail', $item_id = 0)
	{
		if ($view == 'summary' && $data['max_chars'])
		{
			$value = $this->truncate->truncate($value, $data['max_chars']);
		}

		return $value;
	}

	/**
	 * @inheritdoc
	 */
	public function get_default_props()
	{
		return array(
			'field_minlen'		=> 0,
			'field_maxlen'		=> 20,
			'field_rows'		=> 25,
			'field_columns'		=> 25,
			'full_width'		=> true,
			'wysiwyg_editor'	=> '',
			'requires_item_id'	=> false,
			'max_chars'			=> 0,
		);
	}

	/**
	 * @inheritdoc
	 */
	public function get_name()
	{
		return 'editor';
	}
}
