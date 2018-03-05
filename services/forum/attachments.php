<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2016 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\forum;

class attachments
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth						$auth		Auth object
	 * @param \phpbb\db\driver\driver_interface		$db     	Database connection
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\db\driver\driver_interface $db)
	{
		$this->auth = $auth;
		$this->db = $db;
	}

	/**
	 * Get attachments...
	 *
	 * @param int $forum_id
	 * @param array $attach_ids
	 * @param array $allowed_extensions
	 * @param int $limit
	 * @param bool $exclude_in_message
	 * @param string $order_by
	 * @return array
	 */
	public function get_attachments($forum_id = 0, array $attach_ids = array(), $allowed_extensions = array(), $limit = 0, $exclude_in_message = true, $order_by = 'filetime DESC')
	{
		$attachments = array();
		if ($this->user_can_download_attachments($forum_id))
		{
			$sql = $this->get_attachment_sql($attach_ids, $allowed_extensions, $exclude_in_message, $order_by);
			$result = $this->db->sql_query_limit($sql, $limit);

			while ($row = $this->db->sql_fetchrow($result))
			{
				$attachments[$row['post_msg_id']][] = $row;
			}
			$this->db->sql_freeresult($result);
		}

		return $attachments;
	}

	/**
	 * @param int $forum_id
	 * @return bool
	 */
	protected function user_can_download_attachments($forum_id)
	{
		return ($this->auth->acl_get('u_download') && (!$forum_id || $this->auth->acl_get('f_download', $forum_id))) ? true : false;
	}

	/**
	 * @param array $attach_ids
	 * @param array $allowed_extensions
	 * @param bool $exclude_in_message
	 * @param string $order_by
	 * @return string
	 */
	protected function get_attachment_sql(array $attach_ids, array $allowed_extensions, $exclude_in_message, $order_by)
	{
		return 'SELECT *
			FROM ' . ATTACHMENTS_TABLE . '
			WHERE ' . $this->db->sql_in_set('post_msg_id', array_map('intval', $attach_ids)) .
				(($exclude_in_message) ? ' AND in_message = 0' : '') .
				(sizeof($allowed_extensions) ? ' AND ' . $this->db->sql_in_set('extension', $allowed_extensions) : '') . '
			ORDER BY ' . $order_by;
	}
}
