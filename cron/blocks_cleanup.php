<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\core\cron;

class blocks_cleanup extends \phpbb\cron\task\base
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \primetime\core\services\blocks\manager */
	protected $manager;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config						$config					Config object
	 * @param \phpbb\db\driver\driver_interface			$db						Database object
	 * @param \primetime\core\services\blocks\manager	$manager				Blocks manager object
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \primetime\core\services\blocks\manager $manager)
	{
		$this->config = $config;
		$this->db = $db;
		$this->manger = $manager;
	}

	/**
	 * Runs this cron task.
	 *
	 * @return null
	 */
	public function run()
	{
		$routes = $this->manager->get_all_routes();

		foreach ($routes as $style_id => $style_routes)
		{
			if (!isset($style_ids[$style_id]))
			{
				continue;
			}

		}
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
		return $this->config['primetime_blocks_cleanup_last_gc'] < time() - $this->config['primetime_blocks_cleanup_gc'];
	}
}
