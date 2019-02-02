<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\functional;

/**
 * @group functional
 */
class startpage_test extends \phpbb_functional_test_case
{
	static private $helper;

	static public function setUpBeforeClass()
	{
		global $phpbb_root_path;

		parent::setUpBeforeClass();

		self::$helper = new \phpbb_test_case_helpers(__CLASS__);

		self::$helper->copy_dir($phpbb_root_path . '../tests/functional/fixtures/ext/foo/bar', $phpbb_root_path . 'ext/foo/bar');
	}

	static public function tearDownAfterClass()
	{
		global $phpbb_root_path;

		parent::tearDownAfterClass();

		self::$helper->empty_dir($phpbb_root_path . 'ext/foo');
		rmdir($phpbb_root_path . 'ext/foo');
	}

	/**
	 * Define the extensions to be tested
	 *
	 * @return array vendor/name of extension(s) to test
	 * @access static
	 */
	static protected function setup_extensions()
	{
		return array('blitze/sitemaker');
	}

	/**
	 * Check set default start page.
	 */
	public function test_set_default_startpage()
	{
		$this->add_lang_ext('blitze/sitemaker', array('common', 'blocks_manager'));

		$phpbb_extension_manager = $this->get_extension_manager();
		$phpbb_extension_manager->enable('foo/bar');

		$this->login();

		// Confirm forum index is initial start page
		$crawler = self::request('GET', 'index.php');
		$this->assertGreaterThan(0, $crawler->filter('.topiclist')->count());

		// Confirm foo/bar path exists and displays content
		$crawler = self::request('GET', 'app.php/foo/template');
		$this->assertContains("I am a variable", $crawler->filter('#content')->text());

		// switch to edit mode and confirm we have option to set start page
		$crawler = self::request('GET', 'app.php/foo/template?edit_mode=1');
		$this->assertContains('Set As Start Page', $crawler->filter('#startpage-toggler')->text());

		$this->make_ajax_request([
			'controller'	=> 'foo_bar.controller',
			'method'		=> 'template',
		]);

		// Go to index.php and Confirm it now displays the contents of foo/bar controller
		$crawler = self::request('GET', 'index.php?edit_mode=1');
		$this->assertContains("I am a variable", $crawler->filter('#content')->text());

		// Confirm Remove Start Page is now available to us
		$this->assertContains('Remove Start Page', $crawler->filter('#startpage-toggler')->text());

		// Remove as startpage
		$this->make_ajax_request([
			'controller'	=> '',
			'method'		=> '',
		]);

		$crawler = self::request('GET', 'index.php');
		$this->assertGreaterThan(0, $crawler->filter('.topiclist')->count());

		$phpbb_extension_manager->purge('foo/bar');
	}

	/**
	 * @param array $data
	 * @return void
	 */
	private function make_ajax_request(array $data)
	{
		self::$client->setHeader('X-Requested-With', 'XMLHttpRequest');
		self::request('POST', 'app.php/sitemaker/blocks/set_startpage?style=1', $data, false);
		self::$client->removeHeader('X-Requested-With');
		$this->assert_response_status_code('200');
	}
}