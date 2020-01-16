<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker;

class ext extends \phpbb\extension\base
{
	/** array */
	protected $errors = [];

	/**
	 * Check whether or not the extension can be enabled.
	 *
	 * @return bool
	 */
	public function is_enableable()
	{
		$user = $this->container->get('user');
		$user->add_lang_ext('blitze/sitemaker', 'ext');

		$metadata = $this->get_metadata('blitze/sitemaker');

		$req_phpbb_version = $metadata['extra']['soft-require']['phpbb/phpbb'];
		$phpbb_version = $this->container->get('config')['version'];
		$version_ok = $this->version_is_ok($phpbb_version, $req_phpbb_version);
		$img_dir_ok = $this->image_directory_is_ready();

		if (!$version_ok || !$img_dir_ok)
		{
			$errors = array_merge(['EXTENSION_NOT_ENABLEABLE'], $this->errors);
			return array_map([$user, 'lang'], array_filter($errors), ['', $req_phpbb_version]);
		}

		return true;
	}

	/**
	 * return bool
	*/
	protected function image_directory_is_ready()
	{
		$root_path = $this->container->getParameter('core.root_path');
		$filesystem = $this->container->get('filesystem');
		$images_folder = $root_path . 'images';
		$uploads_folder = $images_folder . '/sitemaker_uploads';

		if (!$filesystem->exists($uploads_folder) && !$filesystem->is_writable($images_folder))
		{
			$this->errors[] = 'IMAGE_DIRECTORY_NOT_WRITABLE';
			return false;
		}
		return true;
	}

	/**
	 * @param string $current_version
	 * @param string $required_version
	 * @return bool
	 */
	protected function version_is_ok($current_version, &$required_version)
	{
		$required_version = html_entity_decode($required_version);
		list($min_req_version, $max_req_version) = array_pad(explode(',', $required_version), 2, '');

		$constraint = $this->get_version_constraint($min_req_version);
		if (!phpbb_version_compare($current_version, $constraint['version'], $constraint['operator']))
		{
			$this->errors[] = 'PHPBB_VERSION_UNMET';
			return false;
		}

		$constraint = $this->get_version_constraint($max_req_version);
		if ($constraint['version'] && !phpbb_version_compare($current_version, $constraint['version'], $constraint['operator']))
		{
			$this->errors[] = 'PHPBB_VERSION_UNMET';
			return false;
		}

		return true;
	}

	/**
	 * @param string $version
	 * @return array
	 */
	protected function get_version_constraint($version)
	{
		$operator = '';
		if (preg_match('/^(\D+)(.+)/i', trim($version), $matches))
		{
			list(, $operator, $version) = $matches;
		}

		return [
			'version' => str_replace('@', '', $version),
			'operator' => $operator ?: '>=',
		];
	}

	/**
	 * Get composer metadata information
	 *
	 * @param string $name
	 * @return array
	 */
	protected function get_metadata($name)
	{
		$ext_manager = $this->container->get('ext.manager');
		$metadata_manager = $ext_manager->create_extension_metadata_manager($name);
		return $metadata_manager->get_metadata('all');
	}
}
