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
		return array('blitze/sitemaker');
	}

    public function test_forum_controller()
    {
		$this->add_lang_ext('blitze/sitemaker', 'common');

        $crawler = self::request('GET', 'app.php/forum');
        $this->assertGreaterThan(0, $crawler->filter('.topiclist')->count());
    }
}
