<?php
/**
 *
 * @package primetime
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\tests\functional;

/**
 * @group functional
 */
class startpage_test extends \phpbb_functional_test_case
{
	protected $phpbb_extension_manager;

	static private $helper;

	static public function setUpBeforeClass()
	{
		global $phpbb_root_path;

		parent::setUpBeforeClass();

		self::$helper = new \phpbb_test_case_helpers(self);

		// First, move any extensions setup on the board to a temp directory
		// self::$helper->copy_dir($phpbb_root_path . 'ext/', $phpbb_root_path . 'store/temp_ext/');

		// Create our fake extension
		self::$helper->copy_dir(dirname(__FILE__) . '/fixtures/ext/', $phpbb_root_path . 'ext/');
	}

	static public function tearDownAfterClass()
	{
		global $phpbb_root_path;

		parent::tearDownAfterClass();

		//self::$helper->restore_original_ext_dir();
	}

	/**
	 * Define the extensions to be tested
	 *
	 * @return array vendor/name of extension(s) to test
	 * @access static
	 */
	static protected function setup_extensions()
	{
		return array('primetime/core');
	}

	public function setUp()
	{
		parent::setUp();

		// Load all of Pages language files
		$this->add_lang_ext('primetime/core', array(
			'common',
		));

		$this->phpbb_extension_manager = $this->get_extension_manager();
		$this->phpbb_extension_manager->enable('foo/bar');

		$this->login();
		$this->purge_cache();
	}

	public function tearDown()
	{
		parent::tearDown();

		$this->phpbb_extension_manager->disable('foo/bar');
		$this->phpbb_extension_manager->purge('foo/bar');
	}

	/**
	 * Check path controller for extension foo/bar.
	 */
	public function test_foo_controller()
	{
		$crawler = self::request('GET', 'app.php/foo/bar', array(), false);
		self::assert_response_status_code();
		$this->assertContains("foo/bar controller handle() method", $crawler->filter('#foo-bar-content')->text());
	}

	/**
	 * Check default forum index.
	 */
	public function test_default_index()
	{
		$crawler = self::request('GET', 'index.php');
		$this->assertGreaterThan(0, $crawler->filter('.topiclist')->count());
	}

	/**
	 * Check set default start page.
	 */
	public function test_set_default_startpage()
	{
		$crawler = self::request('GET', 'app.php/foo/bar?edit_mode=1');

		// Go to extension page and set as start page
		$link = $crawler->selectLink('Set As Start Page')->link();
		self::$client->click($link);
		$this->assert_response_status_code('200');

		// Go to home and make assertions
		$link = $crawler->selectLink('Home')->link();
		self::$client->click($link);
		$this->assertContains("foo/bar controller handle() method", $crawler->filter('#foo-bar-content')->text());
	}

	/**
	 * Check remove default start page.
	 * @depends test_set_default_startpage
	 */
	public function test_remove_default_startpage()
	{
		$crawler = self::request('GET', 'app.php/foo/bar?edit_mode=1');

		// Remove as startpage
		$link = $crawler->selectLink('Remove As Start Page')->link();
		self::$client->click($link);
		$this->assert_response_status_code('200');

		$crawler = self::request('GET', 'index.php');
		$this->assertGreaterThan(0, $crawler->filter('.topiclist')->count());
	}
}
