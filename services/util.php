<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

class util
{
	/** @var \phpbb\path_helper */
	protected $path_helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\template\context */
	protected $template_context;

	/** @var \phpbb\user */
	protected $user;

	/** string */
	protected $web_path;

	/** array */
	protected $scripts;

	/**
	 * Constructor
	 *
	 * @param \phpbb\path_helper					$path_helper		Path helper object
	 * @param \phpbb\template\template				$template			Template object
	 * @param \phpbb\template\context				$template_context	Template context object
	 * @param \phpbb\user							$user				User object
	 */
	public function __construct(\phpbb\path_helper $path_helper, \phpbb\template\template $template, \phpbb\template\context $template_context, \phpbb\user $user)
	{
		$this->path_helper = $path_helper;
		$this->template = $template;
		$this->template_context = $template_context;
		$this->user = $user;

		$this->set_corrected_paths();
		$this->scripts = array(
			'js'	=> array(),
			'css'   => array(),
		);
	}

	/**
	 * include css/javascript
	 * receives an array of form: array('js' => array('test.js', 'test2.js'), 'css' => array())
	 * @param array $scripts
	 */
	public function add_assets(array $scripts)
	{
		foreach ($scripts as $type => $paths)
		{
			$count = (isset($this->scripts[$type])) ? sizeof($this->scripts[$type]) : 0;
			foreach ($paths as $key => $script)
			{
				$this->scripts[$type][$count++] = $script;
			}
		}
	}

	/**
	 * Pass assets to template
	 */
	public function set_assets()
	{
		$this->_prep_scripts();
		foreach ($this->scripts as $type => $scripts)
		{
			foreach ($scripts as $file)
			{
				$this->template->assign_block_vars($type, array('UA_FILE' => trim($file)));
			}
		}

		$this->scripts = array();
	}

	/**
	 * Add a secret token to the form (requires the S_FORM_TOKEN template variable)
	 * @param string  $form_name The name of the form; has to match the name used in check_form_key, otherwise no restrictions apply
	 */
	public function get_form_key($form_name)
	{
		add_form_key($form_name);

		$rootref = $this->template_context->get_root_ref();
		$s_form_token = $rootref['S_FORM_TOKEN'];

		return $s_form_token;
	}

	/**
	 * Returns a corrected theme path depending on whether or not we are accessing a controller
	 * @return string
	 */
	public function get_theme_path()
	{
		return "{$this->web_path}styles/" . rawurlencode($this->user->style['style_path']) . '/theme';
	}

	/**
	 * Returns a corrected root path depending on whether or not we are accessing a controller
	 * @return string
	 */
	public function get_web_path()
	{
		return $this->web_path;
	}

	protected function _prep_scripts()
	{
		if (isset($this->scripts['js']))
		{
			ksort($this->scripts['js']);
			$this->scripts['js'] = array_filter(array_unique($this->scripts['js']));
		}

		if (isset($this->scripts['css']))
		{
			ksort($this->scripts['css']);
			$this->scripts['css'] = array_filter(array_unique($this->scripts['css']));
		}

		$this->scripts = array_filter($this->scripts);
	}

	/**
	 * Sets the correct paths to use when we are on a controller or not
	 */
	protected function set_corrected_paths()
	{
		// Determine board url - we may need it later
		$board_url = generate_board_url() . '/';

		$corrected_path = $this->path_helper->get_web_root_path();
		$this->web_path = (defined('PHPBB_USE_BOARD_URL_PATH') && PHPBB_USE_BOARD_URL_PATH) ? $board_url : $corrected_path;
	}
}
