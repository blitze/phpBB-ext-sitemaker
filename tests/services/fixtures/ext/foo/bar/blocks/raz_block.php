<?php

/**
 * PHP Anonymous Object
 */

namespace foo\bar\blocks;

class raz_block extends \blitze\sitemaker\services\blocks\driver\block
{
	public function get_config($settings)
	{
		return array(
			'legend1' => 'LEGEND',
			'show'	=> array('lang' => 'SHOW', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => true),
		);
	}

	public function display(array $bdata, $edit_mode = false)
	{
		return array(
			'title' => 'I am raz block',
			'data'	=> array_filter(array('loop' => $bdata['settings']['show'] ? ['row1', 'row2'] : '')),
		);
	}

	public function get_template()
	{
		return 'raz.html';
	}
}
