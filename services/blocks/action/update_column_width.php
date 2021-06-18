<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services\blocks\action;

class update_column_width extends base_action
{
	/**
	 * {@inheritdoc}
	 */
	public function execute($style_id)
	{
		$position = $this->request->variable('position', '');
		$width = $this->request->variable('width', '');

		$column_widths = (array) json_decode($this->config['sitemaker_column_widths'], true);
		$column_widths[$style_id][$position] = $width;

		// clean up
		$column_widths[$style_id] = array_filter($column_widths[$style_id]);

		$this->config->set('sitemaker_column_widths', json_encode(array_filter($column_widths)));

		return array();
	}
}
