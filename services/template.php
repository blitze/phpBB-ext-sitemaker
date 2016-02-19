<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class template extends \phpbb\template\twig\twig
{
	public function __construct(\phpbb\path_helper $path_helper, $config, \phpbb\filesystem\filesystem $filesystem, \Symfony\Component\DependencyInjection\ContainerInterface $container, $cache_path, \phpbb\user $user = null, $extensions = array(), \Twig_LoaderInterface $loader = null, \phpbb\extension\manager $extension_manager = null, $options = array())
	{
		$context = new \phpbb\template\context;
		$twig_environment = new \phpbb\template\twig\environment(
			$config,
			$filesystem,
			$path_helper,
			$container,
			$cache_path,
			$extension_manager,
			new \phpbb\template\twig\loader($filesystem),
			$options);

		parent::__construct($path_helper, $config, $context, $twig_environment, $cache_path, $user, $extensions, $extension_manager);
	}

	public function clear()
	{
		$this->context->clear();
	}

	/**
	 * Render Template View
	 *
	 * @param string $ext_name		extension name in form namespace/extension
	 * @param string $tpl_file		html template file
	 * @param string $handle		template handle
	 */
	public function render_view($ext_name, $tpl_file, $handle)
	{
		$this->set_style(array("ext/$ext_name/styles", 'styles'));

		$this->set_filenames(array(
			$handle	=> $tpl_file)
		);

		$view = $this->assign_display($handle);
		$this->context->clear();

		return $view;
	}
}
