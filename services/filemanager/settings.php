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
	protected $filesystem;

	/** @var string */
	protected $config_path;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string */
	protected $config_template;

	/**
	 * Constructor
	 *
	 * @param \phpbb\filesystem\filesystem	$filesystem			File system
	 * @param string						$config_path		Filemanager config path
	 * @param string						$php_ext			phpEx
	 */
	public function __construct(\phpbb\filesystem\filesystem $filesystem, $config_path, $php_ext)
	{
		$this->filesystem = $filesystem;
		$this->config_path = $config_path;
		$this->php_ext = $php_ext;

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
		if (!$this->filesystem->exists($config_file) || !exec('grep ' . escapeshellarg($searcString) . ' ' . $config_file))
		{
			$this->filesystem->copy($this->config_template, $config_file, true);
		}
	}

	/**
	 * @return array|void
	 */
	public function get_settings()
	{
		if ($this->filesystem->exists($this->config_path))
		{
			$this->init();
	
			$editing = true;
			return include($this->get_config_file());
		}
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

		$this->filesystem->dump_file($config_file, $config_str);
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
