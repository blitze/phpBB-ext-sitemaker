<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

class profilefields
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\profilefields\manager */
	protected $manager;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface		$db	 					Database connection
	 * @param \phpbb\profilefields\manager			$manager				Profile fields manager object
	 * @param \phpbb\user							$user					User object
	 * @param string								$phpbb_root_path		Path to the phpbb includes directory.
	 * @param string								$php_ext				php file extension
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\profilefields\manager $manager, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->db = $db;
		$this->manager = $manager;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;

		if (!function_exists('phpbb_show_profile'))
		{
			include($this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext);
		}
	}

	/**
	 * @return array
	 */
	public function get_all_fields()
	{
		$sql = 'SELECT l.lang_name, f.field_ident
			FROM ' . PROFILE_LANG_TABLE . ' l, ' . PROFILE_FIELDS_TABLE . ' f
			WHERE l.lang_id = ' . $this->user->get_iso_lang_id() . '
				AND f.field_active = 1
				AND f.field_no_view = 0
				AND f.field_hide = 0
				AND l.field_id = f.field_id
			ORDER BY f.field_order';
		$result = $this->db->sql_query($sql);

		$cpf_options = false;
		while ($row = $this->db->sql_fetchrow($result))
		{
			$cpf_options[$row['field_ident']] = $row['lang_name'];
		}
		$this->db->sql_freeresult($result);

		return $cpf_options;
	}

	/**
	 * Get profile fields template data for specified user
	 *
	 * @param int $user_id
	 * @param array $custom_fields
	 * @return array
	 */
	public function get_template_data($user_id, array $custom_fields)
	{
		$data = array(
			'row'		=> array(),
			'blockrow'	=> array(),
		);

		if (sizeof($custom_fields))
		{
			$fields_data = $this->manager->grab_profile_fields_data($user_id);

			if (sizeof($fields_data))
			{
				$fields_data = array_intersect_key(array_shift($fields_data), array_flip($custom_fields));
				$data = $this->manager->generate_profile_fields_template_data($fields_data);
			}
		}

		return $data;
	}
}
