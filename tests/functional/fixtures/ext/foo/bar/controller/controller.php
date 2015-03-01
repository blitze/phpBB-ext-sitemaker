<?php

namespace foo\bar\controller;

class controller
{
	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/**
	 * Constructor
	 *
	 * @param \phpbb\controller\helper		$helper			Controller Helper object
	 * @param \phpbb\template\template		$template		Template object
	 */
	public function __construct(\phpbb\controller\helper $helper, \phpbb\template\template $template)
	{
		$this->helper = $helper;
		$this->template = $template;
	}
	public function handle()
	{
		return $this->helper->render('test_body.html', 'Foo/bar test Controller');
	}
}
