<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2021 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use blitze\sitemaker\services\blocks\driver\block;

/**
 * Hot Topics Block
 */
class hot_topics extends forum_topics
{
	/** @var \phpbb\config\config */
	protected $config;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth							$auth				Permission object
	 * @param \phpbb\content_visibility					$content_visibility	Content visibility object
	 * @param \phpbb\language\language					$translator			Language object
	 * @param \phpbb\user								$user				User object
	 * @param \Urodoz\Truncate\TruncateService			$truncator			Truncator service
	 * @param \blitze\sitemaker\services\date_range		$date_range			Date Range Object
	 * @param \blitze\sitemaker\services\forum\data		$forum_data			Forum Data object
	 * @param \blitze\sitemaker\services\forum\options	$forum_options		Forum Data object
	 * @param string									$phpbb_root_path	Path to the phpbb includes directory.
	 * @param string									$php_ext			php file extension
	 * @param \phpbb\config\config						$config				phpBB configuration
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\content_visibility $content_visibility, \phpbb\language\language $translator, \phpbb\user $user, \Urodoz\Truncate\TruncateService $truncator, \blitze\sitemaker\services\date_range $date_range, \blitze\sitemaker\services\forum\data $forum_data, \blitze\sitemaker\services\forum\options $forum_options, $phpbb_root_path, $php_ext, \phpbb\config\config $config)
	{
		parent::__construct($auth, $content_visibility, $translator, $user, $truncator, $date_range, $forum_data, $forum_options, $phpbb_root_path, $php_ext);

		$this->config = $config;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		$config = parent::get_config($settings);
		unset($config['topic_type']);

		return $config;
	}

	/**
	 * @return string
	 */
	protected function get_block_title()
	{
		return 'HOT_TOPICS';
	}

	/**
	 * {@inheritdoc}
	 */
	protected function build_query()
	{
		parent::build_query();

		$this->forum_data->fetch_custom([
			'WHERE'	=> array('t.topic_posts_approved >' . $this->config['hot_threshold'])
		]);
	}
}
