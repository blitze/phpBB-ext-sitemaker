<?php

/**
 * PHP Anonymous Object
 */

namespace foo\bar\blocks;

class no_template_block extends \blitze\sitemaker\services\blocks\driver\block
{
	public function display(array $bdata, $edit_mode = false)
	{
		return array(
			'title' => 'I am raz block',
			'data'	=> ['key' => 'fab'],
		);
	}
}
