<?php

/**
 * PHP Anonymous Object
 */

namespace foo\bar\blocks;

class error_block extends \blitze\sitemaker\services\blocks\driver\block
{
	public function display(array $bdata, $edit_mode = false)
	{
		throw new \Exception('Something went wrong');

		return array(
			'title' 	=> 'I am error block',
			'content'	=> 'You should not see this',
		);
	}
}
