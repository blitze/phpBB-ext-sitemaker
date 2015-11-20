<?php
/**
 * PHP Anonymous Object
 */

namespace foo\bar\blocks;

class foo_block extends \blitze\sitemaker\services\blocks\driver\block
{
	public function get_config(array $settings)
	{
		return array();
	}

	public function display(array $settings, $edit_mode = false)
	{
		return array(
			'title'		=> 'I am foo block',
			'content'	=> 'foo block content'
		);
	}

	public function get_name()
	{
		return 'my.foo.block';
	}
}
