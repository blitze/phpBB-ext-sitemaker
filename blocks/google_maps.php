<?php

/**
 *
 * @package sitemaker
 * @copyright (c) 2019 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use blitze\sitemaker\services\blocks\driver\block;

/**
 * Google Maps Block
 */
class google_maps extends block
{
	/** @var \phpbb\template\template */
	protected $template;

	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template		$template				Template object
	 */
	public function __construct(\phpbb\template\template $template)
	{
		$this->template = $template;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		return array(
			'legend1'			=> 'SETTINGS',
			'title'		    => array('lang' => 'MAP_TITLE', 'validate' => 'string', 'type' => 'text:0:255', 'default' => ''),
			'location'	    => array('lang' => 'MAP_LOCATION', 'validate' => 'string', 'type' => 'text:0:255', 'default' => ''),
			'coordinates'   => array('lang' => 'MAP_COORDINATES', 'validate' => 'string', 'type' => 'text:0:255', 'default' => '', 'explain' => true),
			'zoom'	        => array('lang' => 'MAP_ZOOM_LEVEL', 'validate' => 'int:0:21', 'type' => 'number:0:21', 'maxlength' => 2, 'default' => 14),
			'view'	        => array('lang' => 'MAP_VIEW', 'validate' => 'string', 'type' => 'select', 'options' => $this->view_options(), 'default' => ''),
			'height'	    => array('lang' => 'MAP_HEIGHT', 'validate' => 'int:0', 'type' => 'number', 'default' => 100),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$settings = $bdata['settings'];

		return array(
			'title'		=> 'GOOGLE_MAP',
			'data'		=> array(
				'location'      => urlencode($settings['location']),
				'coordinates'   => $settings['coordinates'],
				'height'        => $settings['height'],
				'title'         => urlencode($settings['title']),
				'view'          => $settings['view'],
				'zoom'          => $settings['zoom'],
				'lang_code'		=> $this->template->retrieve_var('S_USER_LANG'),
			)
		);
	}

	/**
	 * @return array
	 */
	protected function view_options()
	{
		return [
			''  => 'MAP_VIEW_MAP',
			'k' => 'MAP_VIEW_SATELITE',
			'h' => 'MAP_VIEW_HYBRID',
			'p' => 'MAP_VIEW_TERRAIN',
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_template()
	{
		return '@blitze_sitemaker/blocks/google_maps.html';
	}
}
