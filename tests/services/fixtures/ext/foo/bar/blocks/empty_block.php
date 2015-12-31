<?php
/**
 * PHP Anonymous Object
 */

namespace foo\bar\blocks;

class empty_block extends \blitze\sitemaker\services\blocks\driver\block
{
	public function get_config(array $settings)
	{
		return array();
	}

	public function display(array $bdata, $edit_mode = false)
	{
		return array(
			'title' 	=> 'I am an empty block',
			'content'	=> '',
		);
	}
}
