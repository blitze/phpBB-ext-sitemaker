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
		self::$helper->copy_dir($phpbb_root_path . 'ext/', $phpbb_root_path . 'store/temp_ext/');

		// Create our fake extension
		self::$helper->copy_dir(dirname(__FILE__) . '/fixtures/ext/', $phpbb_root_path . 'ext/');
	}

	static public function tearDownAfterClass()
	{
		global $phpbb_root_path;

		parent::tearDownAfterClass();

		self::$helper->restore_original_ext_dir();
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

		$this->purge_cache();
	}

	/**
	 * Check set default start page.
	 */
	public function test_set_default_startpage()
	{
		$this->phpbb_extension_manager->enable('foo/bar');
		$this->login();

		// Confirm forum index is initial start page
		$crawler = self::request('GET', 'index.php');
		$this->assertGreaterThan(0, $crawler->filter('.topiclist')->count());

		// Confirm foo/bar path exists and displays content
		$crawler = self::request('GET', 'app.php/foo/bar', array(), false);
		self::assert_response_status_code();
		$this->assertContains("foo/bar controller handle() method", $crawler->filter('#foo-bar-content')->text());

		$crawler = self::request('GET', 'app.php/foo/bar?edit_mode=1');

		// Go to extension page and set as start page
		$link = $crawler->selectLink('Set As Start Page')->link();
		self::$client->click($link);
		$this->assert_response_status_code('200');

		// Go to index.php
		$link = $crawler->selectLink('Home')->link();
		self::$client->click($link);

		// Confirm it now displays the contents of foo/bar controller
		$this->assertContains("foo/bar controller handle() method", $crawler->filter('#foo-bar-content')->text());

		// Remove as startpage
		$link = $crawler->selectLink('Remove As Start Page')->link();
		self::$client->click($link);
		$this->assert_response_status_code('200');

		$crawler = self::request('GET', 'index.php');
		$this->assertGreaterThan(0, $crawler->filter('.topiclist')->count());

		$this->phpbb_extension_manager->purge('foo/bar');
	}
}
