<?php
/**
*
* Board Rules extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace blitze\sitemaker\migrations\v30x\textreparser\plugins;

class custom_block_text extends \phpbb\textreparser\row_based_plugin
{
	/**
	* {@inheritdoc}
	*/
	public function get_columns()
	{
		return array(
			'id'			=> 'block_id',
			'text'			=> 'block_content',
			'bbcode_uid'	=> 'bbcode_uid',
			'options'		=> 'bbcode_options',
		);
	}
}
