<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2016 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use blitze\sitemaker\services\blocks\driver\block;

/**
 * Forum Topics Block config
 */
abstract class forum_topics_config extends block
{
	/** @var \blitze\sitemaker\services\forum\options */
	protected $forum_options;

	const FORUMS_ORDER_FIRST_POST = 0;
	const FORUMS_ORDER_LAST_POST = 1;
	const FORUMS_ORDER_LAST_READ = 2;

	/**
	 * Constructor
	 *
	 * @param \blitze\sitemaker\services\forum\options	$forum_options		Forum Data object
	 */
	public function __construct(\blitze\sitemaker\services\forum\options $forum_options)
	{
		$this->forum_options = $forum_options;
	}

	/**
	 * @param array $settings
	 * @return array
	 */
	public function get_config(array $settings)
	{
		$forum_options = $this->forum_options->get_all();
		$topic_type_options = $this->forum_options->get_topic_types();
		$preview_options = $this->get_preview_options();
		$range_options = $this->get_range_options();
		$sort_options = $this->get_sorting_options();
		$template_options = $this->get_view_options();

		return array(
			'legend1'		=> 'SETTINGS',
			'forum_ids'			=> array('lang' => 'SELECT_FORUMS', 'validate' => 'string', 'type' => 'multi_select', 'options' => $forum_options, 'default' => array(), 'explain' => false),
			'topic_type'		=> array('lang' => 'TOPIC_TYPE', 'validate' => 'string', 'type' => 'checkbox', 'options' => $topic_type_options, 'default' => array(), 'explain' => false),
			'max_topics'		=> array('lang' => 'MAX_TOPICS', 'validate' => 'int:0', 'type' => 'number:0', 'maxlength' => 2, 'explain' => false, 'default' => 5),
			'date_range'		=> array('lang' => 'LIMIT_POST_TIME', 'validate' => 'string', 'type' => 'select', 'options' => $range_options, 'default' => '', 'explain' => false),
			'order_by'			=> array('lang' => 'ORDER_BY', 'validate' => 'string', 'type' => 'select', 'options' => $sort_options, 'default' => self::FORUMS_ORDER_LAST_POST, 'explain' => false),

			'legend2'		=> 'DISPLAY',
			'enable_tracking'	=> array('lang' => 'ENABLE_TOPIC_TRACKING', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
			'topic_title_limit'	=> array('lang' => 'TOPIC_TITLE_LIMIT', 'validate' => 'int:0:255', 'type' => 'number:0:255', 'maxlength' => 3, 'explain' => false, 'default' => 25),
			'template'			=> array('lang' => 'TEMPLATE', 'validate' => 'string', 'type' => 'select', 'options' => $template_options, 'default' => 'titles', 'explain' => false),
			'context'			=> array('lang' => 'BASED_ON', 'validate' => 'string', 'type' => 'select', 'options' => $preview_options, 'default' => 'last', 'explain' => false),
			'preview_chars'		=> array('lang' => 'PREVIEW_MAX_CHARS', 'validate' => 'int:0:255', 'type' => 'number:0:255', 'maxlength' => 3, 'explain' => false, 'default' => 0),
		);
	}

	/**
	 * @return array
	 */
	private function get_preview_options()
	{
		return array(
			'last'  => 'SHOW_LAST_POST',
			'first' => 'SHOW_FIRST_POST',
		);
	}

	/**
	 * @return array
	 */
	private function get_range_options()
	{
		return array(
			''      => 'ALL_TIME',
			'today' => 'TODAY',
			'week'  => 'THIS_WEEK',
			'month' => 'THIS_MONTH',
			'year'  => 'THIS_YEAR',
		);
	}

	/**
	 * @return array
	 */
	private function get_sorting_options()
	{
		return array(
			self::FORUMS_ORDER_FIRST_POST => 'FIRST_POST_TIME',
			self::FORUMS_ORDER_LAST_POST  => 'LAST_POST_TIME',
			self::FORUMS_ORDER_LAST_READ  => 'LAST_READ_TIME',
		);
	}

	/**
	 * @return array
	 */
	private function get_view_options()
	{
		return array(
			'titles'    => 'TITLES',
			'mini'      => 'MINI',
			'context'   => 'CONTEXT',
		);
	}
}
