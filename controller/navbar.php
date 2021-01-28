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

	/** @var \phpbb\symfony_request */
	protected $symfony_request;

	/** @var \phpbb\language\language */
	protected $translator;

	/** @var \blitze\sitemaker\services\navbar */
	protected $navbar;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth							$auth					Auth object
	 * @param \phpbb\symfony_request					$symfony_request		Symfony Request object
	 * @param \phpbb\language\language					$translator				Language object
	 * @param \blitze\sitemaker\services\navbar			$navbar					Navbar object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\symfony_request $symfony_request, \phpbb\language\language $translator, \blitze\sitemaker\services\navbar $navbar)
	{
		$this->auth = $auth;
		$this->symfony_request = $symfony_request;
		$this->translator = $translator;
		$this->navbar = $navbar;
	}

	/**
	 * @return Response
	 */
	public function css($style)
	{
		$response = new Response();
		$response->headers->set('Content-Type', 'text/css');

		$response->setPublic();
		$response->setETag($style . '-' . $this->navbar->get_last_modified());
		$response->setLastModified(new \DateTime('@' . $this->navbar->get_last_modified() ?? null));

		if ($response->isNotModified($this->symfony_request))
		{
			return $response;
		}

		$response->setContent($this->navbar->get_css($style));

		return $response;
	}

	/**
	 * @return Response
	 */
	public function save($style)
	{
		$data = array('message' => '');

		if (!$this->symfony_request->isXmlHttpRequest() || !$this->auth->acl_get('a_sm_manage_blocks'))
		{
			$data['message'] = $this->translator->lang('NOT_AUTHORISED');
			$status = 401;
		}
		else
		{
			$this->navbar->save($style);
			$status = 200;
		}

		$response = new Response(json_encode($data), $status);
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}
}
