<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\forum;

class tracker
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config		$config			Config object
	 * @param \phpbb\user				$user			User object
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\user $user)
	{
		$this->config = $config;
		$this->user = $user;
	}

	/**
	 * @param array $forums
	 * @param array $topics
	 * @return array
	 */
	public function get_tracking_info(array $forums, array &$topics)
	{
		$info = array();
		if ($this->can_track_by_lastread())
		{
			$info = $this->build_tracking_info('get_topic_tracking', $forums, $topics);
		}
		else if ($this->can_track_anonymous())
		{
			$info = $this->build_tracking_info('get_complete_topic_tracking', $forums, $topics);
		}

		return $info;
	}

	/**
	 * @param string $function
	 * @param array $forums
	 * @param array $topics
	 * @return array
	 */
	protected function build_tracking_info($function, array $forums, array &$topics)
	{
		$tracking_info = array();
		foreach ($forums as $fid => $forum)
		{
			$tracking_info[$fid] = call_user_func_array($function, array($fid, $forum['topic_list'], &$topics, array($fid => $forum['mark_time'])));
		}

		return $tracking_info;
	}

	/**
	 * @return bool
	 */
	protected function can_track_by_lastread()
	{
		return ($this->config['load_db_lastread'] && $this->user->data['is_registered']) ? true : false;
	}

	/**
	 * @return bool
	 */
	protected function can_track_anonymous()
	{
		return ($this->config['load_anon_lastread'] || $this->user->data['is_registered']) ? true : false;
	}
}
