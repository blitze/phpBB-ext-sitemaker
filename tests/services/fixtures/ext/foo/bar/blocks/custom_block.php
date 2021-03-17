<?php

/**
 * PHP Anonymous Object
 */

namespace foo\bar\blocks;

class custom_block extends \blitze\sitemaker\services\blocks\driver\block
{
	public function get_config(array $settings)
	{
		return array(
			'legend1' => 'LEGEND',
			'secret' => array('type' => 'hidden', 'default' => 'I like to hide'),
		);
	}

	public function display(array $bdata, $edit_mode = false)
	{
		return array(
			'title' 	=> 'Custom Block',
			'content'	=> 'Custom content id: ' . $bdata['bid'],
		);
	}

	public function edit($id)
	{
		return array(
			'id'		=> $id,
			'content'	=> 'Edited custom content',
		);
	}
}
