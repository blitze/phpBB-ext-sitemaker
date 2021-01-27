<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2020 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\services;

class navbar
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config					$config			Config object
	 * @param \phpbb\config\db_text					$config_text	Config text object
	 * @param \phpbb\db\driver\driver_interface		$db	 			Database connection
	 * @param \phpbb\request\request_interface		$request		Request object
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\config\db_text $config_text, \phpbb\db\driver\driver_interface $db, \phpbb\request\request_interface $request)
	{
		$this->config = $config;
		$this->config_text = $config_text;
		$this->db = $db;
		$this->request = $request;
	}

	/**
	 * @param string $style
	 * @return array
	 */
	public function get_settings($style)
	{
		return [
			'location'	=> &$this->get_locations()[$style],
			'modified'	=> $this->get_last_modified(),
		];
	}

	/**
	 * @return int
	 */
	public function get_last_modified()
	{
		return (int) $this->config['sm_navbar_last_modified'];
	}

	/**
	 * @param string $style
	 * @return string
	 */
	public function get_css($style)
	{
		$board_url = generate_board_url();

		$css = "@import url('{$board_url}/ext/blitze/sitemaker/styles/all/theme/assets/navbar.min.css');";
		$css .= html_entity_decode($this->config_text->get('sm_navbar_' . $style));

		return $css;
	}

	/**
	 * @param string $style
	 * @param string $time
	 * @return void
	 */
	public function save($style, $time = 'now')
	{
		$location = $this->request->variable('location', '');
		$css = $this->request->variable('css', '');

		$this->save_css($style, $css);
		$this->save_locations([$style => $location]);

		$this->config->set('sm_navbar_last_modified', strtotime($time));
	}

	/**
	 * @param string $style
	 * @param string $css
	 * @return void
	 */
	protected function save_css($style, $css)
	{
		if ($css)
		{
			$this->config_text->set('sm_navbar_' . $style, $css);
		}
		else
		{
			$this->config_text->delete('sm_navbar_' . $style);
		}
	}

	/**
	 * @param string $style
	 * @return string
	 */
	protected function save_locations(array $locations)
	{
		$locations =  array_merge($this->get_locations(), $locations);

		$this->config->set('sm_navbar_locations', json_encode(array_filter($locations)));
	}

	/**
	 * @param bool $all
	 * @return void
	 */
	public function cleanup($all = false)
	{
		$ids = $this->request->variable('ids', [0]);

		if ($all || sizeof($ids))
		{
			$sql = 'SELECT style_name FROM ' . STYLES_TABLE . (sizeof($ids) ? ' WHERE ' . $this->db->sql_in_set('style_id', $ids) : '');
			$result = $this->db->sql_query($sql);

			$locations = [];
			while ($row = $this->db->sql_fetchrow($result))
			{
				$style = strtolower($row['style_name']);
				$this->config_text->delete('sm_navbar_' . $style);
				$locations[$style] = '';
			}
			$this->db->sql_freeresult($result);

			$this->save_locations($locations);
		}
	}

	/**
	 * @return array
	 */
	protected function get_locations()
	{
		return (array) json_decode($this->config['sm_navbar_locations'], true);
	}
}
