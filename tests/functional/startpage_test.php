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
	protected $phpbb_extension_manager;

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

	public function setUp()
	{
		parent::setUp();

		// Load all of Pages language files
		$this->add_lang_ext('blitze/sitemaker', array(
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
        $client = new \GuzzleHttp\Client(self::$root_url, array(
            'request.options' => array(
                'exceptions' => false,
            )
        ));

		$this->phpbb_extension_manager->enable('foo/bar');
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

		$data = array(
			'style'			=> 1,
			'controller'	=> 'foo_bar.controller',
			'method'		=> 'template',
			'params'		=> '',
		);

		$request = $client->post('app.php/blocks/set_startpage', null, json_encode($data));
        $response = $request->send();
		$this->assert_response_status_code('200');

		// Go to index.php and Confirm it now displays the contents of foo/bar controller
		$crawler = self::request('GET', 'index.php?edit_mode=1');
		$this->assertContains("I am a variable", $crawler->filter('#content')->text());

		// Confirm Remove Start Page is now available to us
		$this->assertContains('Remove Start Page', $crawler->filter('#startpage-toggler')->text());

		// Remove as startpage
		$data = array(
			'style'			=> 1,
			'controller'	=> '',
			'method'		=> '',
			'params'		=> '',
		);

		$request = $client->post('app.php/blocks/set_startpage', null, json_encode($data));
        $response = $request->send();
		$this->assert_response_status_code('200');

		$crawler = self::request('GET', 'index.php');
		$this->assertGreaterThan(0, $crawler->filter('.topiclist')->count());

		$this->phpbb_extension_manager->purge('foo/bar');
	}
}