<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\cron;

class blocks_cleanup extends \phpbb\cron\task\base
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \blitze\sitemaker\services\blocks\cleaner_inteface */
	protected $cleaner;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config							$config				Config object
	 */
	public function __construct(\phpbb\config\config $config)
	{
		$this->config = $config;
	}

	/**
	 * We do this instead of the constructor injection to avoid circular reference
	 * since phpBB controller.helper service now has a dependency on cron.manager
	 *
	 * @param \blitze\sitemaker\services\blocks\cleaner_interface $cleaner
	 */
	public function set_cleaner(\blitze\sitemaker\services\blocks\cleaner_interface $cleaner)
	{
		$this->cleaner = $cleaner;
	}

	/**
	 * Runs this cron task.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->cleaner->test();

		$this->config->set('sitemaker_blocks_cleanup_last_gc', time());
	}

	/**
	 * Returns whether this cron task can run, given current board configuration.
	 *
	 * @return bool
	 */
	public function is_runnable()
	{
		return true;
	}

	/**
	 * Returns whether this cron task should run now, because enough time
	 * has passed since it was last run.
	 *
	 * @return bool
	 */
	public function should_run()
	{
		return (int) $this->config['sitemaker_blocks_cleanup_last_gc'] < time() - (int) $this->config['sitemaker_blocks_cleanup_gc'];
	}
}
