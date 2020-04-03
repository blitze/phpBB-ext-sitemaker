<?php
/**
 * @copyright (c) 2017 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace blitze\sitemaker\services\filemanager;

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

	/** @var string */
	protected $config_version = '3.2.0';

	/** @var string */
	protected $error = '';

	/** @var array */
	protected $filemanager_prop_types = [
		'image_max_width' => 'integer',
		'image_max_height' => 'integer',
		'image_max_mode' => 'string',
		'image_resizing' => 'boolean',
		'image_resizing_width' => 'integer',
		'image_resizing_height' => 'integer',
		'image_resizing_mode' => 'string',
		'image_watermark' => 'string',
		'image_watermark_position' => 'string',
		'image_watermark_padding' => 'integer',
	];

	/**
	 * Constructor.
	 *
	 * @param \phpbb\filesystem\filesystem	$filesystem  File system
	 * @param string						$config_path Filemanager config path
	 * @param string						$php_ext     phpEx
	 */
	public function __construct(\phpbb\filesystem\filesystem $filesystem, $config_path, $php_ext)
	{
		$this->filesystem = $filesystem;
		$this->config_path = $config_path;
		$this->php_ext = $php_ext;

		$this->config_template = __DIR__.'/default.config';
	}

	/**
	 * @param bool $check_file
	 *
	 * @return array
	 */
	public function get_settings($check_file = true)
	{
		if (!$this->config_is_writable())
		{
			return $this->error;
		}

		$config_file = $this->get_config_file();

		if ($check_file)
		{
			$this->ensure_config_is_ready();
		}

		return include $config_file;
	}

	/**
	 * @return string
	 */
	public function get_error()
	{
		return $this->error;
	}

	/**
	 * @param string $file
	 */
	public function set_config_template($file)
	{
		$this->config_template = $file;
	}

	/**
	 * @return void
	 */
	public function ensure_config_is_ready()
	{
		$config_file = $this->get_config_file();
		$test_line = file($config_file)[1];

		if (false === strpos($test_line, 'Sitemaker '.$this->config_version))
		{
			$curr_settings = [];

			// we are already using sitemaker config but it is out of date
			if (strpos($test_line, 'Sitemaker'))
			{
				$curr_settings = $this->get_settings(false);
				$curr_settings = array_intersect_key($curr_settings, $this->filemanager_prop_types);
			}

			// $this->filesystem->remove($config_file);
			$this->save($curr_settings);
		}
	}

	/**
	 * @return bool
	 */
	public function config_is_writable()
	{
		if (!$this->is_installed())
		{
			$this->error = 'FILEMANAGER_NO_EXIST';
			return false;
		}

		if (!$this->filesystem->is_writable($this->get_config_file()))
		{
			$this->error = 'FILEMANAGER_NOT_WRITABLE';
			return false;
		}

		return true;
	}

	public function save(array $settings)
	{
		$config_file = $this->get_config_file();
		$config_str = file_get_contents($config_file);

		foreach ($settings as $prop => $value)
		{
			$this->type_cast_config_value($prop, $value);

			$config_str = preg_replace("/\\s'{$prop}'(\\s+)=>\\s+(.*?),/i", "	'{$prop}'$1=> {$value},", $config_str);
		}

		$this->filesystem->dump_file(realpath($config_file), $config_str);
	}

	/**
	 * @return bool
	 */
	protected function is_installed()
	{
		return $this->filesystem->exists($this->config_path);
	}

	/**
	 * @return string
	 */
	protected function get_config_file()
	{
		$config_file = $this->config_path.'config.'.$this->php_ext;

		if (!$this->filesystem->exists($config_file))
		{
			$this->filesystem->copy($this->config_template, $config_file, true);
		}

		return $config_file;
	}

	/**
	 * @param string $prop
	 * @param mixed  $value
	 */
	protected function type_cast_config_value($prop, &$value)
	{
		$type = $this->filemanager_prop_types[$prop];

		settype($value, $type);

		switch ($type)
		{
			case 'boolean':
				$value = ($value) ? 'true' : 'false';
			break;

			case 'string':
				$value = "'{$value}'";
			break;
		}
	}
}
