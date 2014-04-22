<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\core;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 *
 */
class primetime
{
	/**
	 * Auth object instance
	 * @var \phpbb\auth\auth
	 */
	protected $auth;

	/**
	 * Database
	 * @var \phpbb\db\driver\driver
	 */
	protected $db;

	/**
	 * Template object
	 * @var \phpbb\template\template
	 */
	protected $template;

	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Primetime template object
	 * @var \primetime\primetime\core\template
	 */
	protected $ptemplate;

	protected $scripts;

	public $asset_path;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth						$auth			Auth object
	 * @param \phpbb\db\driver\driver				$db     		Database connection
	 * @param \phpbb\config\db						$config			Config object
	 * @param \phpbb\path_helper					$path_helper	Path helper object
	 * @param \phpbb\template\template				$template		Template object
	 * @param \phpbb\user							$user			User object
	 * @param \primetime\primetime\core\template	$ptemplate		Primetime template object
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\db\driver\driver $db, \phpbb\config\db $config, \phpbb\path_helper $path_helper, \phpbb\template\template $template, \phpbb\user $user, \primetime\primetime\core\template $ptemplate)
	{
		$this->auth = $auth;
		$this->db = $db;
		$this->config = $config;
		$this->user = $user;
		$this->template = $template;
		$this->ptemplate = $ptemplate;
		$this->asset_path = $path_helper->get_web_root_path();
		$this->scripts = array(
			'js'	=> array(),
			'css'   => array(),
		);
	}

	/**
	 * Initialize phpBB Primetime
	 */
	public function init()
	{
		// we sacrifice one query here to potentially save many
		$sql = 'SELECT post_edit_time
			FROM ' . POSTS_TABLE . '
			WHERE post_visibility = ' . ITEM_APPROVED . '
			ORDER BY post_edit_time DESC';
		$result = $this->db->sql_query_limit($sql, 1);
		$last_edit_time = $this->db->sql_fetchfield('post_edit_time');
		$this->db->sql_freeresult($result);
	
		$last_changed = $last_edit_time . '_' . $this->config['num_posts'];

		if ($last_changed != $this->config['primetime_last_changed'])
		{
			global $cache;

			define('PRIMETIME_FORUM_CHANGED', true);
			$this->config->set('primetime_last_changed', $last_changed, true);
			$cache->destroy('sql', array(FORUMS_TABLE, TOPICS_TABLE, POSTS_TABLE, USERS_TABLE));
		}
		else
		{
			define('PRIMETIME_FORUM_CHANGED', false);
		}

		$this->template->assign_vars(array(
			'S_PRIMETIME_ENABLED'		=> $this->config['primetime_enabled'])
		);
	}

	/**
	 * include css/javascript
	 * receives an array of form: array('js' => array('test.js', 'test2.js'), 'css' => array())
	*/
	public function add_assets($scripts)
	{
		foreach ($scripts as $type => $paths)
		{
			$count = (isset($this->scripts[$type])) ? count($this->scripts[$type]) : 0;
			foreach ($paths as $key => $script)
			{
				if (isset($this->scripts[$type][$key]))
				{
					$this->scripts[$type][$count++] = $script;
				}
				else
				{
					$this->scripts[$type][$key] = $script;
				}
			}
		}
	}

	/**
	 * Pass assets to template
	 */
	public function set_assets()
	{
		ksort($this->scripts['js']);
		ksort($this->scripts['css']);

		// lets clean it up
		$this->scripts['js'] = (isset($this->scripts['js'])) ? array_filter(array_unique($this->scripts['js'])) : array();
		$this->scripts['css'] = (isset($this->scripts['css'])) ? array_filter(array_unique($this->scripts['css'])) : array();

		$this->scripts = array_filter($this->scripts);

		foreach ($this->scripts as $type => $scripts)
		{
			foreach ($scripts as $file)
			{
				$this->template->assign_block_vars($type, array('UA_FILE' => trim($file)));
			}
		}

		$this->scripts = array();
	}

	/**
	 * truncate Html can truncate a string up to a number of characters while preserving whole words and HTML tags
	 * got this script from a blog that got it from a blog that got it from a blog that got it from cakephp
	 *
	 * @param string $text String to truncate.
	 * @param integer $length Length of returned string, including ellipsis.
	 * @param boolean $considerHtml If true, HTML tags would be handled correctly
	 * @param string $ending Ending to be appended to the trimmed string.
	 * @param boolean $exact If false, $text will not be cut mid-word
	 *
	 * @return string Trimmed string.
	 */
	public function truncate_html_string(&$text, $length, $considerHtml = true, $ending = '...', $exact = false)
	{
		$truncated = false;

		if ($considerHtml)
		{
			// if the plain text is shorter than the maximum length, return the whole text
			if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length)
			{
				return $truncated;
			}
			// splits all html-tags to scanable lines
			preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
			$total_length = strlen($ending);
			$open_tags = array();
			$truncate = '';
			foreach ($lines as $line_matchings)
			{
				// if there is any html-tag in this line, handle it and add it (uncounted) to the output
				if (!empty($line_matchings[1]))
				{
					// if it's an "empty element" with or without xhtml-conform closing slash
					if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1]))
					{
						// do nothing
					// if tag is a closing tag
					}
					else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings))
					{
						// delete tag from $open_tags list
						$pos = array_search($tag_matchings[1], $open_tags);
						if ($pos !== false)
						{
							unset($open_tags[$pos]);
						}
					// if tag is an opening tag
					}
					else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings))
					{
						// add tag to the beginning of $open_tags list
						array_unshift($open_tags, strtolower($tag_matchings[1]));
					}
					// add html-tag to $truncate'd text
					$truncate .= $line_matchings[1];
				}
				// calculate the length of the plain text part of the line; handle entities as one character
				$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
				if ($total_length + $content_length > $length)
				{
					// the number of characters which are left
					$left = $length - $total_length;
					$entities_length = 0;
					// search for html entities
					if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE))
					{
						// calculate the real length of all entities in the legal range
						foreach ($entities[0] as $entity)
						{
							if ($entity[1]+1-$entities_length <= $left)
							{
								$left--;
								$entities_length += strlen($entity[0]);
							}
							else
							{
								// no more characters left
								break;
							}
						}
					}
					$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
					// maximum lenght is reached, so get off the loop
					break;
				}
				else
				{
					$truncate .= $line_matchings[2];
					$total_length += $content_length;
				}
				// if the maximum length is reached, get off the loop
				if($total_length>= $length)
				{
					break;
				}
			}
		}
		else
		{
			if (strlen($text) <= $length)
			{
				return $truncated;
			}
			else
			{
				$truncate = substr($text, 0, $length - strlen($ending));
			}
		}
		// if the words shouldn't be cut in the middle...
		if (!$exact)
		{
			// ...search the last occurance of a space...
			$spacepos = strrpos($truncate, ' ');
			if (isset($spacepos))
			{
				// ...and cut the text in this position
				$truncate = substr($truncate, 0, $spacepos);
			}
		}
		// add the defined ending to the text
		$truncate .= $ending;
		if ($considerHtml)
		{
			// close all unclosed html-tags
			foreach ($open_tags as $tag)
			{
				$truncate .= '</' . $tag . '>';
			}
		}
		$text = $truncate;

		return true;
	}

	/**
	 * Add a secret token to the form (requires the S_FORM_TOKEN template variable)
	 * @param string  $form_name The name of the form; has to match the name used in check_form_key, otherwise no restrictions apply
	 */
	public function ext_add_form_key($form_name)
	{
		global $phpbb_container;

		$tpl_context = $phpbb_container->get('template_context');

		add_form_key($form_name);
		
		$rootref = $tpl_context->get_root_ref();
		$s_form_token = $rootref['S_FORM_TOKEN'];
		$this->ptemplate->assign_var('S_FORM_TOKEN', $s_form_token);

		return $s_form_token;
	}

	/**
	 * Build breadcrumbs
	 */
	function set_breadcrumbs($data)
	{
		global $template;

		foreach ($data as $row)
		{
			$template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $row['display'],
				'U_VIEW_FORUM'	=> $row['url'])
			);
		}
	}

	/**
	 * Reset cached queries
	 */
	function reset_sql_cache($tables = array())
	{
		global $cache;

		$reset = false;
		if (PRIMETIME_FORUM_CHANGED)
		{
			$reset = true;
			if (sizeof($tables))
			{
				$cache->destroy('sql', $tables);
			}
		}
		return $reset;
	}

	/**
	 * Merge dbal query arrays
	 */
	public function merge_dbal_arrays($sql_ary1, $sql_ary2)
	{
		if (sizeof($sql_ary2))
		{
			$sql_ary1['SELECT'] .= (!empty($sql_ary2['SELECT'])) ? ', ' . $sql_ary2['SELECT'] : '';
			$sql_ary1['FROM'] += (!empty($sql_ary2['FROM'])) ? $sql_ary2['FROM'] : array();
			$sql_ary1['WHERE'] .= (!empty($sql_ary2['WHERE'])) ? ' AND ' . $sql_ary2['WHERE'] : '';
	
			if (!empty($sql_ary2['LEFT_JOIN']))
			{
				$sql_ary1['LEFT_JOIN'] = (!empty($sql_ary1['LEFT_JOIN'])) ? array_merge($sql_ary1['LEFT_JOIN'], $sql_ary2['LEFT_JOIN']) : $sql_ary2['LEFT_JOIN'];
			}
	
			if (!empty($sql_ary2['GROUP_BY']))
			{
				$sql_ary1['GROUP_BY'] = $sql_ary2['GROUP_BY'];
			}
	
			if (!empty($sql_ary2['ORDER_BY']))
			{
				$sql_ary1['ORDER_BY'] = $sql_ary2['ORDER_BY'];
			}
		}

		return $sql_ary1;
	}
}
