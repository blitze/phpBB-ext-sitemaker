<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

/**
 * Custom Block
 */
class custom extends \blitze\sitemaker\services\blocks\driver\block
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/** @var string */
	protected $cblocks_table;

	/**
	 * Constructor
	 *
	 * @param \phpbb\cache\driver\driver_interface	$cache				Cache driver interface
	 * @param \phpbb\db\driver\driver_interface		$db					Database object
	 * @param \phpbb\request\request_interface		$request			Request object
	 * @param string								$cblocks_table		Name of custom blocks database table
	 */
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\db\driver\driver_interface $db, \phpbb\request\request_interface $request, $cblocks_table)
	{
		$this->cache = $cache;
		$this->db = $db;
		$this->request = $request;
		$this->cblocks_table = $cblocks_table;
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$cblock = $this->_get_custom_blocks();

		$content = '';
		if (isset($cblock[$bdata['bid']]))
		{
			$cblock = $cblock[$bdata['bid']];
			$content = $this->_get_content($cblock);
		}
		else
		{
			$cblock = array(
				'block_id'		=> $bdata['bid'],
				'block_content'	=> '',
				'bbcode_uid'	=> '',
			);
		}

		$this->_show_editor($cblock, $content, $edit_mode);

		return array(
			'title'		=> 'BLOCK_TITLE',
			'content'	=> $content,
		);
	}

	/**
	 * @param int $block_id
	 * @return array
	 */
	public function save($block_id)
	{
		$content = $this->request->variable('content', '', true);
		$cblocks = $this->_get_custom_blocks();

		$sql_data =	array(
			'block_id'			=> $block_id,
			'block_content'		=> $content,
			'bbcode_bitfield'	=> '',
			'bbcode_options'	=> 7,
			'bbcode_uid'		=> '',
		);

		generate_text_for_storage($sql_data['block_content'], $sql_data['bbcode_uid'], $sql_data['bbcode_bitfield'], $sql_data['bbcode_options'], true, true, true);

		$sql = (!isset($cblocks[$block_id])) ? 'INSERT INTO ' . $this->cblocks_table . ' ' . $this->db->sql_build_array('INSERT', $sql_data) : 'UPDATE ' . $this->cblocks_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_data) . ' WHERE block_id = ' . (int) $block_id;
		$this->db->sql_query($sql);
		$this->cache->destroy('pt_cblocks');

		return array(
			'id'		=> $block_id,
			'content'	=> $this->_get_content($sql_data),
			'callback'	=> 'previewCustomBlock',
		);
	}

	/**
	 * @param array $data
	 * @return string
	 */
	private function _get_content(array $data)
	{
		$content = generate_text_for_display($data['block_content'], $data['bbcode_uid'], $data['bbcode_bitfield'], $data['bbcode_options']);
		return html_entity_decode($content);
	}

	/**
	 * @param array $cblock
	 * @param string $content
	 * @param bool $edit_mode
	 * @return string
	 */
	private function _show_editor(array $cblock, &$content, $edit_mode)
	{
		if ($edit_mode !== false)
		{
			decode_message($cblock['block_content'], $cblock['bbcode_uid']);
			$content = '<div id="block-editor-' . $cblock['block_id'] . '" class="editable editable-block" data-service="blitze.sitemaker.block.custom" data-method="save" data-raw="' . $cblock['block_content'] . '">' . $content . '</div>';
		}
	}

	/**
	 * @return array
	 */
	private function _get_custom_blocks()
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
}
