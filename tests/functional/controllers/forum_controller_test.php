<?php
/**
 *
 * @package primetime
 * @copyright (c) 2015 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\tests\functional\controller;

/**
 * @group functional
 */
class forum_controller_test extends \phpbb_functional_test_case
{
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
	}

    public function test_forum_controller()
    {
        $crawler = self::request('GET', 'app.php/forum');
        $this->assertGreaterThan(0, $crawler->filter('.topiclist')->count());
    }
}
