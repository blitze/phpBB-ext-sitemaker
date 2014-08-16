<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core;

class primetime
{
	/**
	 * Auth object instance
	 * @var \phpbb\auth\auth
	 */
	protected $auth;

	/**
	 * Config object
	 * @var \phpbb\config\db
	 */
	protected $config;

	/**
	 * Database
	 * @var \phpbb\db\driver\factory
	 */
	protected $db;

	/**
	 * Template object
	 * @var \phpbb\template\template
	 */
	protected $template;

	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Primetime template object
	 * @var \primetime\primetime\core\template
	 */
	protected $ptemplate;

	protected $scripts;

	public $asset_path;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth						$auth			Auth object
	 * @param \phpbb\db\driver\factory				$db     		Database connection
	 * @param \phpbb\config\db						$config			Config object
	 * @param \phpbb\path_helper					$path_helper	Path helper object
	 * @param \phpbb\template\template				$template		Template object
	 * @param \phpbb\user							$user			User object
	 * @param \primetime\primetime\core\template	$ptemplate		Primetime template object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\db\driver\factory $db, \phpbb\config\db $config, \phpbb\path_helper $path_helper, \phpbb\template\template $template, \phpbb\user $user, \primetime\primetime\core\template $ptemplate)
	{
		$this->auth = $auth;
		$this->db = $db;
		$this->config = $config;
		$this->user = $user;
		$this->template = $template;
		$this->ptemplate = $ptemplate;
		$this->asset_path = $path_helper->get_web_root_path();
		$this->scripts = array(
			'js'	=> array(),
			'css'   => array(),
		);
	}

	/**
	 * include css/javascript
	 * receives an array of form: array('js' => array('test.js', 'test2.js'), 'css' => array())
	*/
	public function add_assets($scripts)
	{
		foreach ($scripts as $type => $paths)
		{
			$count = (isset($this->scripts[$type])) ? count($this->scripts[$type]) : 0;
			foreach ($paths as $key => $script)
			{
				if (isset($this->scripts[$type][$key]))
				{
					$this->scripts[$type][$count++] = $script;
				}
				else
				{
					$this->scripts[$type][$key] = $script;
				}
			}
		}
	}

	/**
	 * Pass assets to template
	 */
	public function set_assets()
	{
		ksort($this->scripts['js']);
		ksort($this->scripts['css']);

		// lets clean it up
		$this->scripts['js'] = (isset($this->scripts['js'])) ? array_filter(array_unique($this->scripts['js'])) : array();
		$this->scripts['css'] = (isset($this->scripts['css'])) ? array_filter(array_unique($this->scripts['css'])) : array();

		$this->scripts = array_filter($this->scripts);

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
	public function ext_add_form_key($form_name)
	{
		global $phpbb_container;

		$tpl_context = $phpbb_container->get('template_context');

		add_form_key($form_name);

		$rootref = $tpl_context->get_root_ref();
		$s_form_token = $rootref['S_FORM_TOKEN'];
		$this->ptemplate->assign_var('S_FORM_TOKEN', $s_form_token);

		return $s_form_token;
	}

	/**
	 * Build breadcrumbs
	 */
	function set_breadcrumbs($data)
	{
		foreach ($data as $row)
		{
			$this->template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $row['display'],
				'U_VIEW_FORUM'	=> $row['url'])
			);
		}
	}

	/**
	 * Merge dbal query arrays
	 */
	public function merge_dbal_arrays($sql_ary1, $sql_ary2)
	{
		if (sizeof($sql_ary2))
		{
			$sql_ary1['SELECT'] .= (!empty($sql_ary2['SELECT'])) ? ', ' . $sql_ary2['SELECT'] : '';
			$sql_ary1['FROM'] += (!empty($sql_ary2['FROM'])) ? $sql_ary2['FROM'] : array();
			$sql_ary1['WHERE'] .= (!empty($sql_ary2['WHERE'])) ? ' AND ' . $sql_ary2['WHERE'] : '';

			if (!empty($sql_ary2['LEFT_JOIN']))
			{
				$sql_ary1['LEFT_JOIN'] = (!empty($sql_ary1['LEFT_JOIN'])) ? array_merge($sql_ary1['LEFT_JOIN'], $sql_ary2['LEFT_JOIN']) : $sql_ary2['LEFT_JOIN'];
			}

			if (!empty($sql_ary2['GROUP_BY']))
			{
				$sql_ary1['GROUP_BY'] = $sql_ary2['GROUP_BY'];
			}

			if (!empty($sql_ary2['ORDER_BY']))
			{
				$sql_ary1['ORDER_BY'] = $sql_ary2['ORDER_BY'];
			}
		}

		return $sql_ary1;
	}
}
