<?php
/**
 * PHP Anonymous Object
 */

namespace foo\bar\blocks;

class baz_block extends \blitze\sitemaker\services\blocks\driver\block
{
	public function get_config(array $data)
	{
		return array(
			'legend1'			=> 'SETTINGS',
			'my_setting'	=> array('lang' => 'MY_SETTING', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 1),
			'other_setting'	=> array('lang' => 'OTHER_SETTING', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true, 'default' => 0),
		);
	}

	public function display(array $bdata, $edit_mode = false)
	{
		$content = array(
			($bdata['settings']['my_setting']) ? ' myself' : '',
			($bdata['settings']['other_setting']) ? ' others' : '',
		);

		return array(
			'title' 	=> 'I am baz block',
			'content'	=> 'I love' . join(' and', array_filter($content)),
		);
	}
}
