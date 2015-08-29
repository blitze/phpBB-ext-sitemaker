<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

/**
 * Login Block
 */
class members extends \blitze\sitemaker\services\blocks\driver\block
{
	/** @var \phpbb\user */
	private $user;

	/** @var \blitze\sitemaker\services\members */
	private $members;

	/** @var array */
	private $query_type_options;

	/** @var array */
	private $range_options;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user							$user		User object
	 * @param \blitze\sitemaker\services\members		$members	Members object
	 */
	public function __construct(\phpbb\user $user, \blitze\sitemaker\services\members $members)
	{
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

	public function get_config($settings)
	{
		$query_type = (!empty($settings['query_type'])) ? $settings['query_type'] : 'recent';
		$date_range = (!empty($settings['date_range'])) ? $settings['date_range'] : 'month';

		return array(
			'legend1'		=> $this->user->lang('SETTINGS'),
			'query_type'	=> array('lang' => 'QUERY_TYPE', 'validate' => 'string', 'type' => 'select', 'params' => array($this->query_type_options, $query_type), 'default' => 'recent', 'explain' => false),
			'date_range'	=> array('lang' => 'DATE_RANGE', 'validate' => 'string', 'type' => 'select', 'params' => array($this->range_options, $date_range), 'default' => 'month', 'explain' => false),
			'max_members'	=> array('lang' => 'MAX_MEMBERS', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
		);
	}

	public function display($bdata, $edit_mode = false)
	{
		$bdata['settings']['range'] = ($bdata['settings']['query_type'] != 'tenured') ? $bdata['settings']['date_range'] : '';

		$this->ptemplate->assign_var('RANGE', $this->user->lang($this->range_options[$bdata['settings']['range']]));

		return array(
			'title'		=> $this->query_type_options[$bdata['settings']['query_type']],
			'content'	=> $this->members->get_list($bdata['settings']),
		);
	}
}
