<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2017 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\filemanager;

/**
* @package sitemaker
*/
class settings
{
	/** @var \phpbb\filesystem\filesystem */
	protected $file_system;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string */
	protected $config_path;

	/** @var string */
	protected $config_template;

	/**
	 * Constructor
	 *
	 * @param \phpbb\filesystem\filesystem	$file_system			File system
	 * @param string						$phpbb_root_path		phpBB root path
	 * @param string						$php_ext				phpEx
	 */
	public function __construct(\phpbb\filesystem\filesystem $file_system, $phpbb_root_path, $php_ext)
	{
		$this->file_system = $file_system;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;

		$this->config_path = $this->phpbb_root_path . 'ext/blitze/sitemaker/vendor/ResponsiveFilemanager/filemanager/config/';
		$this->config_template = __DIR__ . '/default.config';
	}

	/**
	 * @return void
	 */
	public function init()
	{
		$searcString = 'phpbb';
		$config_file = $this->get_config_file();

		// credit: http://jafty.com/blog/quick-way-to-check-if-string-exists-in-a-file-with-php/
		if (!$this->file_system->exists($config_file) || !exec('grep ' . escapeshellarg($searcString) . ' ' . $config_file))
		{
			$this->file_system->copy($this->config_template, $config_file, true);
		}
	}

	/**
	 * @return array
	 */
	public function get_settings()
	{
		$this->init();

		$editing = true;
		return include($this->get_config_file());
	}

	/**
	 * @param string $path
	 * @return void
	 */
	public function set_config_path($path)
	{
		$this->config_path = $path;
	}

	/**
	 * @param string $file
	 * @return void
	 */
	public function set_config_template($file)
	{
		$this->config_template = $file;
	}

	/**
	 * @param array $settings
	 * @return void
	 */
	public function save(array $settings)
	{
		$curr_settings = $this->get_settings();
		$config_file = $this->get_config_file();
		$config_str = file_get_contents($config_file);

		foreach ($settings as $prop => $value)
		{
			$this->type_cast_config_value($curr_settings[$prop], $value);
			$config_str = preg_replace("/\s'$prop'(\s+)=>\s+(.*?),/i", "	'$prop'$1=> $value,", $config_str);
		}

		$this->file_system->dump_file($config_file, $config_str);
	}

	/**
	 * @param mixed $curr_val
	 * @param mixed $value
	 * @return void
	 */
	protected function type_cast_config_value($curr_val, &$value)
	{
		$type = gettype($curr_val);
		switch ($type)
		{
			case 'string':
				$value = "'$value'";
			break;
			case 'integer':
				$value = (int) $value;
			break;
		}
	}

	/**
	 * @return string
	 */
	protected function get_config_file()
	{
		return $this->config_path . 'config.' . $this->php_ext;
	}
}
