<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\services\blocks;

use Symfony\Component\DependencyInjection\Container;

abstract class base
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var Container */
	protected $phpbb_container;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpEx */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config						$config					Config object
	 * @param Container									$phpbb_container		Service container
	 * @param \phpbb\user								$user					User object
	 * @param string									$php_ext				phpEx
	 */
	public function __construct(\phpbb\config\config $config, Container $phpbb_container, \phpbb\user $user, $php_ext)
	{
		$this->config = $config;
		$this->phpbb_container = $phpbb_container;
		$this->user = $user;
		$this->php_ext = $php_ext;
	}

	/**
	 * Add blocks_admin language file
	 * 
	 * This is a modified copy of the add_mod_info in functions_module.php
	 */
	protected function add_block_admin_lang()
	{
		$finder = $this->phpbb_container->get('ext.manager')->get_finder();

		// We grab the language files from the default, English and user's language.
		// So we can fall back to the other files like we do when using add_lang()
		$default_lang_files = $english_lang_files = array();

		// Search for board default language if it's not the user language
		if ($this->config['default_lang'] != $this->user->lang_name)
		{
			$default_lang_files = $finder
				->prefix('blocks_admin')
				->suffix(".$this->php_ext")
				->extension_directory('/language/' . basename($this->config['default_lang']))
				->core_path('language/' . basename($this->config['default_lang']) . '/')
				->find();
		}

		// Search for english, if its not the default or user language
		if ($this->config['default_lang'] != 'en' && $this->user->lang_name != 'en')
		{
			$english_lang_files = $finder
				->prefix('blocks_admin')
				->suffix(".$this->php_ext")
				->extension_directory('/language/en')
				->core_path('language/en/')
				->find();
		}

		// Find files in the user's language
		$user_lang_files = $finder
			->prefix('blocks_admin')
			->suffix(".$this->php_ext")
			->extension_directory('/language/' . $this->user->lang_name)
			->core_path('language/' . $this->user->lang_name . '/')
			->find();

		$lang_files = array_unique(array_merge($user_lang_files, $english_lang_files, $default_lang_files));
		foreach ($lang_files as $lang_file => $ext_name)
		{
			$this->user->add_lang_ext($ext_name, $lang_file);
		}
	}
}
