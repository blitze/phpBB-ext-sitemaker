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

/**
 * Members Block
 */
class members extends block
{
	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/** @var \blitze\sitemaker\services\members */
	private $members;

	/** @var array */
	private $query_type_options;

	/** @var array */
	private $range_options;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language				$translator		Language Object
	 * @param \phpbb\user							$user			User object
	 * @param \blitze\sitemaker\services\members	$members		Members object
	 */
	public function __construct(\phpbb\language\language $translator, \phpbb\user $user, \blitze\sitemaker\services\members $members)
	{
		$this->translator = $translator;
		$this->user = $user;
		$this->members = $members;

		$this->query_type_options = array(
			'visits'	=> 'LAST_VISITED',
			'bots'		=> 'RECENT_BOTS',
			'recent'	=> 'RECENT_MEMBERS',
			'tenured'	=> 'MOST_TENURED',
			'posts'		=> 'TOP_POSTERS',
		);

		$this->range_options = array(
			''		=> 'ALL_TIME',
			'today'	=> 'TODAY',
			'week'	=> 'THIS_WEEK',
			'month'	=> 'THIS_MONTH',
			'year'	=> 'THIS_YEAR',
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		return array(
			'legend1'		=> 'SETTINGS',
			'query_type'	=> array('lang' => 'QUERY_TYPE', 'validate' => 'string', 'type' => 'select', 'options' => $this->query_type_options, 'default' => 'recent', 'explain' => false),
			'date_range'	=> array('lang' => 'DATE_RANGE', 'validate' => 'string', 'type' => 'select', 'options' => $this->range_options, 'default' => '', 'explain' => false),
			'max_members'	=> array('lang' => 'MAX_MEMBERS', 'validate' => 'int:0', 'type' => 'number:0', 'maxlength' => 2, 'explain' => false, 'default' => 5),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$bdata['settings']['range'] = ($bdata['settings']['query_type'] != 'tenured') ? $bdata['settings']['date_range'] : '';

		$this->ptemplate->assign_var('RANGE', $this->translator->lang($this->range_options[$bdata['settings']['range']]));

		return array(
			'title'		=> $this->query_type_options[$bdata['settings']['query_type']],
			'content'	=> $this->members->get_list($bdata['settings']),
		);
	}
}
