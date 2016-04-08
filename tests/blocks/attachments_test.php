<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\blocks;

use blitze\sitemaker\services\date_range;
use blitze\sitemaker\services\forum\data;
use blitze\sitemaker\blocks\attachments;

class attachments_test extends blocks_base
{
	/**
	 * Load required fixtures.
	 *
	 * @return mixed
	 */
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/forum.xml');
	}

	/**
	 * Create the attachments block
	 *
	 * @return \blitze\sitemaker\blocks\attachments
	 */
	protected function get_block()
	{
		global $cache;

		$this->auth->expects($this->any())
			->method('acl_getf')
			->will($this->returnCallback(function($acl, $test) {
				if ($acl == '!f_read' && $test)
				{
					$ids = array(5 => 5);
				}
				else
				{
					$ids = array(
						2 => 2,
						4 => 4,
					);
				}

				return $ids;
			}));

		$cache = $this->getMockBuilder('\phpbb\cache\service')
			->disableOriginalConstructor()
			->getMock();
		$cache->expects($this->any())
			->method('obtain_attach_extensions')
			->willReturn(array(
				'_allowed_'	=> array(
					'png' => 0,
					'zip' => 0,
				),
				'png' => array(
            		'group_name' => 'IMAGES',
				),
				'zip' => array(
            		'group_name' => 'ARCHIVES',
				),
			));

		$content_visibility = new \phpbb\content_visibility($this->auth, $this->config, $this->phpbb_dispatcher, $this->db, $this->user, $this->phpbb_root_path, $this->php_ext, 'phpbb_forums', 'phpbb_posts', 'phbb_topics', 'phpbb_users');

		$date_range = new date_range($this->user, '24 November 2015');

		$forum_data = new data($this->auth, $this->config, $content_visibility, $this->db, $this->user, $this->user_data, 0);

		$forum_options = $this->getMockBuilder('\blitze\sitemaker\services\forum\options')
			->disableOriginalConstructor()
			->getMock();

		$block = new attachments($this->auth, $cache, $date_range, $forum_data, $forum_options, $this->phpbb_root_path, $this->php_ext);
		$block->set_template($this->ptemplate);

		return $block;
	}

	public function test_block_config()
	{
		$block = $this->get_block();
		$config = $block->get_config(array());

		$expected_keys = array(
			'legend1',
			'forum_ids',
			'topic_type',
			'first_only',
			'post_ids',
			'date_range',
			'limit',
			'ext_type',
		);

		$this->assertEquals($expected_keys, array_keys($config));
	}

	/**
	 * Data set for test_block_display
	 *
	 * @return array
	 */
	public function block_test_data()
	{
		return array(
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(),
						'topic_type'		=> array(),
						'first_only'		=> 0,
						'post_ids'			=> '',
						'date_range'		=> '',
						'limit'				=> 5,
						'ext_type'			=> '',
						'slideshow'			=> false,
					),
				),
				array(
					array (
						'DISPLAY_ATTACHMENT' => array(
							'_file' => array(
								array(
									'UPLOAD_ICON' => '<span class="imageset icon_topic_attach"></span>',
									'FILESIZE' => 248.63,
									'SIZE_LANG' => 'KiB',
									'DOWNLOAD_NAME' => 'some_archive.zip',
									'COMMENT' => '',
									'S_FILE' => true,
									'U_DOWNLOAD_LINK' => 'phpBB/download/file.php?id=2',
									'L_DOWNLOAD_COUNT' => 'Downloaded 2 times',
								),
							),
						),
						'EXTENSION_GROUP' => 'ARCHIVES',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?t=2&amp;p=6#p6',
					),
					array(
						'DISPLAY_ATTACHMENT' => array(
							'_file' => array(
								array(
									'UPLOAD_ICON' => '<span class="imageset icon_topic_attach"></span>',
									'FILESIZE' => 31.09,
									'SIZE_LANG' => 'KiB',
									'DOWNLOAD_NAME' => 'Some_image.png',
									'COMMENT' => '',
									'S_FILE' => true,
									'U_DOWNLOAD_LINK' => 'phpBB/download/file.php?id=1',
									'L_DOWNLOAD_COUNT' => 'Downloaded 1 time',
								),
							),
						),
						'EXTENSION_GROUP' => 'IMAGES',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?t=1&amp;p=1#p1',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(),
						'topic_type'		=> array(),
						'first_only'		=> 0,
						'post_ids'			=> '',
						'date_range'		=> '',
						'limit'				=> 5,
						'ext_type'			=> 'ARCHIVES',
						'slideshow'			=> false,
					),
				),
				array(
					array (
						'DISPLAY_ATTACHMENT' => array(
							'_file' => array(
								array(
									'UPLOAD_ICON' => '<span class="imageset icon_topic_attach"></span>',
									'FILESIZE' => 248.63,
									'SIZE_LANG' => 'KiB',
									'DOWNLOAD_NAME' => 'some_archive.zip',
									'COMMENT' => '',
									'S_FILE' => true,
									'U_DOWNLOAD_LINK' => 'phpBB/download/file.php?id=2',
									'L_DOWNLOAD_COUNT' => 'Downloaded 2 times',
								),
							),
						),
						'EXTENSION_GROUP' => 'ARCHIVES',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?t=2&amp;p=6#p6',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(),
						'topic_type'		=> array(),
						'first_only'		=> 0,
						'post_ids'			=> '',
						'date_range'		=> '',
						'limit'				=> 5,
						'ext_type'			=> 'IMAGES',
						'slideshow'			=> false,
					),
				),
				array(
					array(
						'DISPLAY_ATTACHMENT' => array(
							'_file' => array(
								array(
									'UPLOAD_ICON' => '<span class="imageset icon_topic_attach"></span>',
									'FILESIZE' => 31.09,
									'SIZE_LANG' => 'KiB',
									'DOWNLOAD_NAME' => 'Some_image.png',
									'COMMENT' => '',
									'S_FILE' => true,
									'U_DOWNLOAD_LINK' => 'phpBB/download/file.php?id=1',
									'L_DOWNLOAD_COUNT' => 'Downloaded 1 time',
								),
							),
						),
						'EXTENSION_GROUP' => 'IMAGES',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?t=1&amp;p=1#p1',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(),
						'topic_type'		=> array(),
						'first_only'		=> 1,
						'post_ids'			=> '',
						'date_range'		=> '',
						'limit'				=> 5,
						'ext_type'			=> '',
						'slideshow'			=> false,
					),
				),
				array(
					array(
						'DISPLAY_ATTACHMENT' => array(
							'_file' => array(
								array(
									'UPLOAD_ICON' => '<span class="imageset icon_topic_attach"></span>',
									'FILESIZE' => 31.09,
									'SIZE_LANG' => 'KiB',
									'DOWNLOAD_NAME' => 'Some_image.png',
									'COMMENT' => '',
									'S_FILE' => true,
									'U_DOWNLOAD_LINK' => 'phpBB/download/file.php?id=1',
									'L_DOWNLOAD_COUNT' => 'Downloaded 1 time',
								),
							),
						),
						'EXTENSION_GROUP' => 'IMAGES',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?t=1&amp;p=1#p1',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(),
						'topic_type'		=> array(),
						'first_only'		=> 0,
						'post_ids'			=> '6',
						'date_range'		=> '',
						'limit'				=> 5,
						'ext_type'			=> '',
						'slideshow'			=> false,
					),
				),
				array(
					array (
						'DISPLAY_ATTACHMENT' => array(
							'_file' => array(
								array(
									'UPLOAD_ICON' => '<span class="imageset icon_topic_attach"></span>',
									'FILESIZE' => 248.63,
									'SIZE_LANG' => 'KiB',
									'DOWNLOAD_NAME' => 'some_archive.zip',
									'COMMENT' => '',
									'S_FILE' => true,
									'U_DOWNLOAD_LINK' => 'phpBB/download/file.php?id=2',
									'L_DOWNLOAD_COUNT' => 'Downloaded 2 times',
								),
							),
						),
						'EXTENSION_GROUP' => 'ARCHIVES',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?t=2&amp;p=6#p6',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(4),
						'topic_type'		=> array(),
						'first_only'		=> 0,
						'post_ids'			=> '',
						'date_range'		=> '',
						'limit'				=> 5,
						'ext_type'			=> '',
						'slideshow'			=> false,
					),
				),
				array(
					array (
						'DISPLAY_ATTACHMENT' => array(
							'_file' => array(
								array(
									'UPLOAD_ICON' => '<span class="imageset icon_topic_attach"></span>',
									'FILESIZE' => 248.63,
									'SIZE_LANG' => 'KiB',
									'DOWNLOAD_NAME' => 'some_archive.zip',
									'COMMENT' => '',
									'S_FILE' => true,
									'U_DOWNLOAD_LINK' => 'phpBB/download/file.php?id=2',
									'L_DOWNLOAD_COUNT' => 'Downloaded 2 times',
								),
							),
						),
						'EXTENSION_GROUP' => 'ARCHIVES',
						'U_VIEWTOPIC' => 'phpBB/viewtopic.php?t=2&amp;p=6#p6',
					),
				),
			),
			array(
				array(
					'settings' => array(
						'forum_ids'			=> array(),
						'topic_type'		=> array(),
						'first_only'		=> 1,
						'post_ids'			=> '6',
						'date_range'		=> '',
						'limit'				=> 5,
						'ext_type'			=> '',
						'slideshow'			=> false,
					),
				),
				'',
			),
		);
	}

	/**
	 * Test block display
	 *
	 * @dataProvider block_test_data
	 * @param array $bdata
	 * @param mixed $expected
	 */
	public function test_block_display(array $bdata, $expected)
	{
		$block = $this->get_block();
		$result = $block->display($bdata);

		if ($expected)
		{
			$this->assertEquals($expected, $result['content']['postrow.attachment']);
		}
		else
		{
			$this->assertEquals($expected, $result['content']);
		}
	}
}
