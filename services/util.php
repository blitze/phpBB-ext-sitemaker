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

	/** @var \phpbb\user */
	protected $user;

	/** string */
	protected $web_path;

	/** array */
	protected $assets;

	/**
	 * Constructor
	 *
	 * @param \phpbb\path_helper					$path_helper		Path helper object
	 * @param \phpbb\template\template				$template			Template object
	 * @param \phpbb\user							$user				User object
	 */
	public function __construct(\phpbb\path_helper $path_helper, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->path_helper = $path_helper;
		$this->template = $template;
		$this->user = $user;

		$this->reset();
	}

	/**
	 * include css/javascript
	 * @param array $assets array of form array('js' => array('test.js', 'test2.js'), 'css' => array())
	 * @return void
	 */
	public function add_assets(array $assets)
	{
		foreach ($assets as $type => $scripts)
		{
			foreach ($scripts as $order => $script)
			{
				if (!isset($this->assets[$type][$script]) || $this->assets[$type][$script] < $order)
				{
					$this->assets[$type][$script] = $order;
				}
			}
		}
	}

	/**
	 * Pass assets to template
	 */
	public function set_assets()
	{
		uasort($this->assets['js'], array($this, 'sort_assets'));
		uasort($this->assets['css'], array($this, 'sort_assets'));

		$this->template->assign_var('assets', array(
			'css'	=> array_keys($this->assets['css']),
			'js'	=> array_keys($this->assets['js']),
		));

		$this->reset();
	}

	/**
	 * Add a secret token to the form
	 * @param string  $form_name The name of the form; has to match the name used in check_form_key, otherwise no restrictions apply
	 * @param string  $template_variable_suffix A string that is appended to the name of the template variable to which the form elements are assigned
	 * @return string
	 */
	public function get_form_key($form_name, $template_variable_suffix = '_BLITZE_SITEMAKER')
	{
		add_form_key($form_name, $template_variable_suffix);

		return $this->template->retrieve_var('S_FORM_TOKEN' . $template_variable_suffix);
	}

	/**
	 * @return string
	 */
	public function get_default_avatar()
	{
		return '<img src="' . $this->get_theme_path() . '/images/no_avatar.gif" alt="" />';
	}

	/**
	 * Returns a corrected theme path depending on whether or not we are accessing a controller
	 * @return string
	 */
	public function get_theme_path()
	{
		$web_path = $this->get_web_path();
		return "{$web_path}styles/" . rawurlencode($this->user->style['style_path']) . '/theme';
	}

	/**
	 * Returns a corrected root path depending on whether or not we are accessing a controller
	 * @return string
	 */
	public function get_web_path()
	{
		// Determine board url - we may need it later
		$board_url = generate_board_url() . '/';

		$corrected_path = $this->path_helper->get_web_root_path();
		return (defined('PHPBB_USE_BOARD_URL_PATH') && PHPBB_USE_BOARD_URL_PATH) ? $board_url : $corrected_path;
	}

	/**
	 * @param int $a
	 * @param int $b
	 * @return int
	 */
	protected function sort_assets($a, $b)
	{
		if ($a == $b)
		{
			return 0;
		}

		return ($a < $b) ? -1 : 1;
	}

	/**
	 * @return void
	 */
	protected function reset()
	{
		$this->assets = array(
			'js'	=> array(),
			'css'   => array(),
		);
	}
}
