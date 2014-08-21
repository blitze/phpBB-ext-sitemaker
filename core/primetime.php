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
	/** @var \phpbb\template\template */
	protected $template;

	protected $scripts;

	public $asset_path;

	/**
	 * Constructor
	 *
	 * @param \phpbb\path_helper					$path_helper	Path helper object
	 * @param \phpbb\template\template				$template		Template object
	 */
	public function __construct(\phpbb\path_helper $path_helper, \phpbb\template\template $template)
	{
		$this->template = $template;
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
