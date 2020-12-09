<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2020 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\controller;

use Symfony\Component\HttpFoundation\Response;

class navbar
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\request\request_interface */
	protected $request;

	/* @var symfony_request */
	protected $symfony_request;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \phpbb\user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth							$auth					Auth object
	 * @param \phpbb\config\config						$config					Config object
	 * @param \phpbb\config\db_text						$config_text			Config text object
	 * @param \phpbb\request\request_interface			$request				Request object
	 * @param \phpbb\symfony_request					$symfony_request		Symfony Request object
	 * @param \phpbb\language\language					$translator				Language object
	 * @param \phpbb\user								$user					User object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\config\db_text $config_text, \phpbb\request\request_interface $request, \phpbb\symfony_request $symfony_request, \phpbb\language\language $translator, \phpbb\user $user)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->config_text = $config_text;
		$this->request = $request;
		$this->symfony_request = $symfony_request;
		$this->translator = $translator;
		$this->user = $user;
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function css($style)
	{
		$css = html_entity_decode($this->config_text->get('sitemaker_navbar_' . $style));

		$response = new Response($css);
		$response->headers->set('Content-Type', 'text/css');

		$response->setPublic();
		$response->setSharedMaxAge(3600);
		$response->setETag(md5($response->getContent()));
		$response->setLastModified(new \DateTime($this->config['sitemaker_nav_last_modified']));

		if ($response->isNotModified($this->symfony_request))
		{
			return $response;
		};

		return $response;
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function save($style)
	{
		$data = array('message' => '');

		if (!$this->request->is_ajax() || !$this->auth->acl_get('a_sm_manage_blocks'))
		{
			$data['message'] = $this->translator->lang('NOT_AUTHORISED');
			$status = 401;
		}
		else
		{
			$css = $this->request->variable('css', '');
			$location = $this->request->variable('location', '');

			$locations = (array) json_decode($this->config['sitemaker_nav_locations'], true);

			$this->config_text->set('sitemaker_navbar_' . $style, $css);

			$this->config->set('sitemaker_nav_last_modified', new \phpbb\datetime($this->user));
			$this->config->set('sitemaker_nav_locations', json_encode(array_filter(array_merge($locations, [$style => $location]))));

			$data['message'] = '';
			$data['location'] = $locations[$style] ?? '';
			$status = 200;
		}

		$response = new Response(json_encode($data), $status);
		$response->headers->set('Content-Type', 'application/json');

        return $response;
	}
}
