<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use blitze\sitemaker\services\blocks\driver\block;

/**
 * Custom Block
 */
class custom extends block
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var \phpbb\textformatter\s9e\utils */
	protected $text_formatter_utils;

	/** @var string */
	protected $cblocks_table;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface	$cache					Cache driver interface
	 * @param \phpbb\db\driver\driver_interface		$db						Database object
	 * @param \phpbb\request\request_interface		$request				Request object
	* @param \phpbb\textformatter\s9e\utils      	$text_formatter_utils	Text manipulation utilities
	 * @param string								$cblocks_table			Name of custom blocks database table
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\db\driver\driver_interface $db, \phpbb\request\request_interface $request, \phpbb\textformatter\s9e\utils $text_formatter_utils, $cblocks_table)
	{
		$this->cache = $cache;
		$this->db = $db;
		$this->request = $request;
		$this->text_formatter_utils = $text_formatter_utils;
		$this->cblocks_table = $cblocks_table;
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$cblock = $this->get_block_data($bdata['bid']);
		$content = $this->get_content_for_display($cblock);

		$this->show_editor($cblock, $content, $edit_mode);

		return array(
			'title'		=> 'BLOCK_TITLE',
			'content'	=> $content,
		);
	}

	/**
	 * @param int $block_id
	 * @return array
	 */
	public function edit($block_id)
	{
		$content = $this->request->variable('content', '', true);
		$cblocks = $this->get_custom_blocks();

		$sql_data =	$this->get_default_fields($block_id);
		$sql_data['block_content'] = $content;

		generate_text_for_storage($sql_data['block_content'], $sql_data['bbcode_uid'], $sql_data['bbcode_bitfield'], $sql_data['bbcode_options'], true, true, true);

		$this->save($sql_data, isset($cblocks[$block_id]));

		return array(
			'id'		=> $block_id,
			'content'	=> $this->get_content_for_display($sql_data),
			'callback'	=> 'previewCustomBlock',
		);
	}

	/**
	 * @param int $from_bid
	 * @param int $to_bid
	 * @see \blitze\sitemaker\services\blocks\action\copy_route::copy_custom_block
	 */
	public function copy($from_bid, $to_bid)
	{
		$cblocks = $this->get_custom_blocks();

		if (isset($cblocks[$from_bid]))
		{
			$sql_data = $cblocks[$from_bid];
			$sql_data['block_id'] = $to_bid;

			$this->save($sql_data, isset($cblocks[$to_bid]));
		}
	}

	/**
	 * @param int $bid
	 * @return array
	 */
	private function get_block_data($bid)
	{
		$cblock = $this->get_custom_blocks();

		return (isset($cblock[$bid])) ? $cblock[$bid] : $this->get_default_fields($bid);
	}

	/**
	 * @param array $data
	 * @return string
	 */
	private function get_content_for_display(array $data)
	{
		//$content = generate_text_for_display($data['block_content'], $data['bbcode_uid'], $data['bbcode_bitfield'], $data['bbcode_options']);
		$content = $this->text_formatter_utils->unparse($data['block_content']);
		return htmlspecialchars_decode($content, ENT_COMPAT);
	}

	/**
	 * @param array $sql_data
	 * @param bool $block_exists
	 */
	private function save(array $sql_data, $block_exists)
	{
		if (!$block_exists)
		{
			$sql = 'INSERT INTO ' . $this->cblocks_table . ' ' . $this->db->sql_build_array('INSERT', $sql_data);
		}
		else
		{
			$sql = 'UPDATE ' . $this->cblocks_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . ' WHERE block_id = ' . (int) $sql_data['block_id'];
		}
		$this->db->sql_query($sql);
		$this->cache->destroy('pt_cblocks');
	}

	/**
	 * @param array $cblock
	 * @param string $content
	 * @param bool $edit_mode
	 * @return string
	 */
	private function show_editor(array $cblock, &$content, $edit_mode)
	{
		if ($edit_mode !== false)
		{
			decode_message($cblock['block_content'], $cblock['bbcode_uid']);
			$content = '<div id="block-editor-' . $cblock['block_id'] . '" class="editable editable-block" data-service="blitze.sitemaker.block.custom" data-method="edit" data-raw="' . $cblock['block_content'] . '">' . $content . '</div>';
		}
	}

	/**
	 * @return array
	 */
	private function get_custom_blocks()
	{
		if (($cblocks = $this->cache->get('pt_cblocks')) === false)
		{
			$sql = 'SELECT *
				FROM ' . $this->cblocks_table;
			$result = $this->db->sql_query($sql);

			$cblocks = array();
			while ($row = $this->db->sql_fetchrow($result))
			{
				$cblocks[$row['block_id']] = $row;
			}
			$this->db->sql_freeresult($result);

			$this->cache->put('pt_cblocks', $cblocks);
		}

		return $cblocks;
	}

	/**
	 * @param int $bid
	 * @return array
	 */
	private function get_default_fields($bid)
	{
		return array(
			'block_id'			=> $bid,
			'block_content'		=> '',
			'bbcode_bitfield'	=> '',
			'bbcode_options'	=> 7,
			'bbcode_uid'		=> '',
		);
	}
}
