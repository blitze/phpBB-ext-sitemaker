<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\tests\services\blocks\config\fields;

use blitze\sitemaker\services\blocks\config\fields\custom;

class custom_test extends cfg_test_base
{
	/**
	 * @return \blitze\sitemaker\services\blocks\config\fields\custom
	 */
	protected function get_service()
	{
		return new custom($this->translator);
	}

	/**
	 */
	public function test_name()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('custom', $cfg_fields->get_name());
	}

	/**
	 */
	public function test_template()
	{
		$cfg_fields = $this->get_service();
		$this->assertEquals('', $cfg_fields->get_template());
	}
}
