<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\users;

class userlist
{
	/**
	 * @param array $settings
	 * @param bool $change_user
	 * @return int
	 */
	public static function get_user_id(array &$settings, $change_user)
	{
		$current_user = $settings['current_user'];
		$userlist = self::_get_userlist($settings['userlist']);

		if ($change_user && sizeof($userlist))
		{
			$current_user = self::_get_next_user($settings['current_user'], $userlist);

			$settings['current_user'] = $current_user;
		}

		return (int) $current_user;
	}

	/**
	 * if we're selecting from a list and there is no result, we remove the culprit and update the list
	 *
	 * @param array $settings
	 */
	public static function update(array &$settings)
	{
		$userlist = self::_get_userlist($settings['userlist']);

		if ($settings['qtype'] === 'featured' && sizeof($userlist))
		{
			$curr_key = (int) array_search($settings['current_user'], $userlist);

			// Remove the invalid user from the list
			$new_list = str_replace($settings['current_user'] . ',', '', $settings['userlist'] . ',');
			$new_list = trim($new_list, ',');

			$new_userlist = self::_get_userlist($new_list);
			$current_user =& $new_userlist[$curr_key - 1];
			$settings['current_user'] = (int) $current_user;
			$settings['userlist'] = trim($new_list);
			$settings['last_changed'] = 0;
		}
	}

	/**
	 * @param string $list
	 * @return array
	 */
	private static function _get_userlist($list)
	{
		$userlist = preg_replace('/\s+/', '', $list);
		return array_map('intval', array_filter(explode(',', $userlist)));
	}

	/**
	 * @param $current_user
	 * @param $userlist
	 * @return int
	 */
	private static function _get_next_user($current_user, array $userlist)
	{
		$key = 0;
		if ($current_user && sizeof($userlist) > 1)
		{
			$key = self::_get_next_key($current_user, $userlist);
		}

		return $userlist[$key];
	}

	/**
	 * @param $current_user
	 * @param $userlist
	 * @return int
	 */
	private static function _get_next_key($current_user, array $userlist)
	{
		$end_key = sizeof($userlist) - 1;
		$curr_key = (int) array_search($current_user, $userlist);

		return ($curr_key >= 0 && $curr_key < $end_key) ? ($curr_key + 1) : 0;
	}
}
