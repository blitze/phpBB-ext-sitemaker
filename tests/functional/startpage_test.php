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
class forum_controller_test extends \phpbb_functional_test_case
{
	protected $phpbb_extension_manager;

	static private $helper;

	static protected $fixtures = array(
		'foo/foo/config/',
		'foo/foo/controller/',
	);

	static public function setUpBeforeClass()
	{
		parent::setUpBeforeClass();

		self::$helper = new phpbb_test_case_helpers(self);
		self::$helper->copy_ext_fixtures(dirname(__FILE__) . '/fixtures/ext/', self::$fixtures);
	}

	static public function tearDownAfterClass()
	{
		parent::tearDownAfterClass();

		self::$helper->restore_original_ext_dir();
	}

	public function setUp()
	{
		parent::setUp();

		$this->phpbb_extension_manager = $this->get_extension_manager();
		$this->phpbb_extension_manager->enable('foo/foo');

		$this->login();
		$this->purge_cache();
	}

	/**
	 * Check path controller for extension foo/bar.
	 */
	public function test_foo_controller()
	{
		$crawler = self::request('GET', 'app.php/foo/foo', array(), false);
		self::assert_response_status_code();
		$this->assertContains("foo/foo controller handle() method", $crawler->filter('body')->text());
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
	 * Check set default startpage.
	 */
	public function test_set_default_startpage()
	{
		$crawler = self::request('GET', 'app.php/foo/foo?edit_mode=1');

		// Go to extension page and set as startpage
		$link = $crawler->selectLink('Set As Start Page')->link();
		self::$client->click($link);

		// Go to home and make assertions
		$crawler = self::request('GET', 'index.php');
		self::$client->click($link);

		$this->assertContains("foo/foo controller handle() method", $crawler->filter('body')->text());
	}

	/**
	 * Check remove default startpage.
	 * @depends test_set_default_startpage
	 */
	public function test_remove_default_startpage()
	{
		$crawler = self::request('GET', 'app.php/foo/foo?edit_mode=1');

		// Remove as startpage
		$link = $crawler->selectLink('Remove As Start Page')->link();
		self::$client->click($link);

		$crawler = self::request('GET', 'index.php');
        $this->assertGreaterThan(0, $crawler->filter('.topiclist')->count());
	}
}
