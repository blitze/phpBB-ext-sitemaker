<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use blitze\sitemaker\services\blocks\driver\block;
use blitze\sitemaker\services\users\userlist;

/**
 * Featured Member Block
 */
class featured_member extends block
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\users\data */
	protected $user_data;

	/** @var string */
	protected $blocks_table;

	/** @var array */
	private $settings;

	/** @var array */
	private static $rotations = array(
		'hourly'	=> 'hour',
		'daily'		=> 'day',
		'weekly'	=> 'week',
		'monthly'	=> 'month'
	);

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface		$cache					Cache driver interface
	 * @param \phpbb\db\driver\driver_interface			$db	 					Database connection
	 * @param \phpbb\language\language					$translator				Language object
	 * @param \blitze\sitemaker\services\users\data		$user_data				Sitemaker User data object
	 * @param string									$blocks_table			Name of blocks database table
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\db\driver\driver_interface $db, \phpbb\language\language $translator, \blitze\sitemaker\services\users\data $user_data, $blocks_table)
	{
		$this->cache = $cache;
		$this->db = $db;
		$this->translator = $translator;
		$this->user_data = $user_data;
		$this->blocks_table = $blocks_table;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		$rotation_options = $this->get_rotation_frequencies();
		$qtype_options = $this->get_query_types();
		$cpf_options = $this->user_data->get_profile_fields();

		return array(
			'legend1'	=> 'SETTINGS',
			'qtype'			=> array('lang' => 'QUERY_TYPE', 'validate' => 'string', 'type' => 'select', 'options' => $qtype_options, 'default' => 'recent', 'explain' => false),
			'rotation'		=> array('lang' => 'FREQUENCY', 'validate' => 'string', 'type' => 'select', 'options' => $rotation_options, 'default' => 'daily', 'explain' => false),
			'userlist'		=> array('lang' => 'FEATURED_MEMBER_IDS', 'validate' => 'string', 'type' => 'textarea:3:40', 'default' => '', 'explain' => true),

			'legend2'	=> 'CUSTOM_PROFILE_FIELDS',
			'show_cpf'		=> array('lang' => 'SELECT_PROFILE_FIELDS', 'validate' => 'string', 'type' => 'checkbox', 'options' => $cpf_options, 'default' => array(), 'explain' => true),
			'last_changed'	=> array('type' => 'hidden', 'default' => 0),
			'current_user'	=> array('type' => 'hidden', 'default' => 0),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false, $loop_count = 0)
	{
		$this->settings = $this->get_settings($bdata);

		$change_user = $this->change_user();
		$block_title = $this->get_block_title($this->settings['qtype']);

		if (($row = $this->get_user_data($change_user)) === false)
		{
			userlist::update($this->settings);

			$bdata['settings'] = $this->settings;
			$bdata['hash'] = 0;

			// Prevent endless loop looking for valid user
			if ($loop_count < 3)
			{
				return $this->display($bdata, $edit_mode, ++$loop_count);
			}
			$row = array();
		}

		return array(
			'title'		=> $block_title,
			'content'	=> $this->display_user($bdata['bid'], $row, $change_user),
		);
	}

	/**
	 * @param bool $change_user
	 * @return array|false
	 */
	protected function get_user_data($change_user)
	{
		$sql_where = $this->db->sql_in_set('user_type', array(USER_NORMAL, USER_FOUNDER));

		$sort_keys = array(
			'recent'	=> 'user_id DESC',
			'posts'		=> 'user_posts DESC',
		);

		if (isset($sort_keys[$this->settings['qtype']]))
		{
			return $this->user_data->query($sql_where, $sort_keys[$this->settings['qtype']], 1);
		}
		else
		{
			$user_id = (int) userlist::get_user_id($this->settings, $change_user);
			$data = $this->user_data->get_users(array($user_id), $sql_where);

			return (sizeof($data)) ? $data : false;
		}
	}

	/**
	 * @return bool
	 */
	private function change_user()
	{
		$change = false;
		if ($this->settings['rotation'] == 'pageload' || $this->settings['last_changed'] < strtotime('-1 ' . self::$rotations[$this->settings['rotation']]))
		{
			$this->settings['last_changed'] = time();
			$change = true;
		}

		return $change;
	}

	/**
	 * @param array $bdata
	 * @return array
	 */
	private function get_settings(array $bdata)
	{
		$cached_settings = $this->cache->get('pt_block_data_' . $bdata['bid']);
		$settings = ($cached_settings && $cached_settings['hash'] === $bdata['hash']) ? $cached_settings : $bdata['settings'];
		$settings['hash'] = $bdata['hash'];

		return $settings;
	}

	/**
	 * @param int $bid
	 * @param bool $change_user
	 */
	private function save_settings($bid, $change_user)
	{
		if ($change_user && $this->settings['qtype'] === 'featured')
		{
			$settings = $this->settings;
			unset($settings['hash']);
			$sql_data = array(
				'settings'	=> json_encode($settings)
			);
			$this->db->sql_query('UPDATE ' . $this->blocks_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . ' WHERE bid = ' . (int) $bid);
			$this->cache->put('pt_block_data_' . $bid, $this->settings);
		}
	}

	/**
	 * @param int   $block_id
	 * @param array $row
	 * @param bool  $change_user
	 * @return string
	 */
	private function display_user($block_id, array $row, $change_user)
	{
		$this->save_settings($block_id, $change_user);

		$html = '';
		if (sizeof($row))
		{
			$this->explain_view();

			$row = array_shift($row);
			$allowed_fields = array_flip(array_merge(array('pm', 'email', 'jabber'), $this->settings['show_cpf']));

			$this->ptemplate->assign_block_vars_array('contact_field', array_intersect_key($row['contact_fields'], $allowed_fields));
			$this->ptemplate->assign_block_vars_array('profile_field', array_intersect_key($row['profile_fields'], $allowed_fields));
			unset($row['contact_fields'], $row['profile_fields']);

			$this->ptemplate->assign_vars(array_change_key_case($row, CASE_UPPER));

			$html = $this->ptemplate->render_view('blitze/sitemaker', 'blocks/featured_member.html', 'featured_member_block');
		}

		return $html;
	}

	/**
	 * @param string $qtype
	 * @return string
	 */
	private function get_block_title($qtype)
	{
		$qtypes = $this->get_query_types();
		return isset($qtypes[$qtype]) ? $qtypes[$qtype] : 'FEATURED_MEMBER';
	}

	/**
	 */
	private function explain_view()
	{
		$query_type = $this->settings['qtype'];
		$rotation = $this->settings['rotation'];

		$this->ptemplate->assign_vars(array(
			'QTYPE_EXPLAIN'		=> ($query_type == 'posts' || $query_type == 'recent') ? $this->translator->lang('QTYPE_' . strtoupper($query_type)) : '',
			'TITLE_EXPLAIN'		=> ($rotation != 'pageload') ? $this->translator->lang(strtoupper($rotation) . '_MEMBER') : '',
		));
	}

	/**
	 * @return array
	 */
	private function get_rotation_frequencies()
	{
		return array(
			'pageload'	=> 'ROTATE_PAGELOAD',
			'hourly'	=> 'ROTATE_HOURLY',
			'daily'		=> 'ROTATE_DAILY',
			'weekly'	=> 'ROTATE_WEEKLY',
			'monthly'	=> 'ROTATE_MONTHLY',
		);
	}

	/**
	 * @return array
	 */
	private function get_query_types()
	{
		return array(
			'recent'	=> 'RECENT_MEMBER',
			'posts'		=> 'POSTS_MEMBER',
			'featured'	=> 'FEATURED_MEMBER',
		);
	}
}
