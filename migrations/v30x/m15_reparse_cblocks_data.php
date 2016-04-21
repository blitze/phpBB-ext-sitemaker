<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\migrations\v30x;

/**
 * Initial schema changes needed for Extension installation
 */
class m15_reparse_cblocks_data extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public static function depends_on()
	{
		return array(
			'\blitze\sitemaker\migrations\v20x\m5_add_cblocks_schema',
		);
	}

	/**
	 * @inheritDoc
	 */
	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'reparse'))),
		);
	}

	/**
	 * Run the custom block text reparser (see boardrules extension)
	 *
	 * @param int $current A custom block identifier
	 * @return bool|int A custom block identifier or true if finished
	 */
	public function reparse($current = 0)
	{
		$reparser = new \blitze\sitemaker\migrations\v30x\textreparser\plugins\custom_block_text(
			$this->db,
			$this->table_prefix . 'sm_cblocks'
		);

		if (empty($current))
		{
			$current = $reparser->get_max_id();
		}

		$limit = 50; // lets keep the reparsing conservative
		$start = max(1, $current + 1 - $limit);
		$end   = max(1, $current);

		$reparser->reparse_range($start, $end);

		$current = $start - 1;

		return ($current === 0) ? true : $current;
	}
}
