<?php
/**
 * PHP Anonymous Object
 */

namespace foo\bar\blocks;

class baz_block
{
	public function get_config($settings)
	{
		return array();
	}

	public function display($settings, $edit_mode = false)
	{
		return 'I am baz block';
	}

	public function get_name()
	{
		return 'my.baz.block';
	}

	public function set_template($tpl)
	{
		$this->ptemplate = $tpl;
	}
}
