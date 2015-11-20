<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

class wordgraph extends \blitze\sitemaker\services\blocks\driver\block
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\content_visibility */
	protected $content_visibility;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth					$auth					Auth object
	 * @param \phpbb\content_visibility			$content_visibility		Content visibility
	 * @param \phpbb\db\driver\driver_interface	$db     				Database connection
	 * @param \phpbb\user						$user					User object
	 * @param string							$phpbb_root_path		phpBB root path
	 * @param string							$php_ext				phpEx
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\content_visibility $content_visibility, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->content_visibility = $content_visibility;
		$this->db = $db;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		return array(
			'legend1'				=> $this->user->lang('SETTINGS'),
			'wordgraph_word_count'	=> array('lang' => 'ALLOW_WORD_COUNT', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true, 'default' => 0),
			'wordgraph_word_number'	=> array('lang' => 'WORD_NUMBER', 'validate' => 'int:0:255', 'type' => 'number:0:255', 'maxlength' => 2, 'explain' => true, 'default' => 15, 'append' => 'WORDS'),
			'wordgraph_max_size'	=> array('lang' => 'WORD_MAX_SIZE', 'validate' => 'int:0:55', 'type' => 'number:0:55', 'maxlength' => 2, 'explain' => true, 'default' => 25, 'append' => 'PIXEL'),
			'wordgraph_min_size'	=> array('lang' => 'WORD_MIN_SIZE', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => true, 'default' => 9, 'append' => 'PIXEL'),
			'wordgraph_exclude'		=> array('lang' => 'EXCLUDE_WORDS', 'validate' => 'string', 'type' => 'textarea:5:50', 'maxlength' => 255, 'explain' => true, 'default' => ''),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function display(array $bdata, $edit_mode = false)
	{
		$settings = $bdata['settings'];

		$block_title = 'WORDGRAPH';
		$words_array = $this->_get_words($settings);

		if (!sizeof($words_array))
		{
			return array(
				'title'		=> $block_title,
				'content'	=> '',
			);
		}

		$max_sat = hexdec('f');
		$min_sat = hexdec(0);

		$max_count = max(array_values($words_array));
		$min_count = min(array_values($words_array));

		$spread = $max_count - $min_count;
		$spread = ($spread) ? $spread : 1;

		// determine the font-size increment
		$size_step = ($settings['wordgraph_max_size'] - $settings['wordgraph_min_size']) / $spread;
		$color_step = ($max_sat - $min_sat) / $spread;

		// Sort words in result
		$words = array_keys($words_array);
		sort($words);

		foreach ($words as $word)
		{
			$color = $min_sat + (($words_array[$word] - $min_count) * $color_step);
			$r = dechex($color);
			$b = dechex($max_sat - $color);
			$g = 'c';

			$this->ptemplate->assign_block_vars('wordgraph', array(
				'WORD'		=> $this->_show_word($word, $words_array, $settings['wordgraph_word_count']),
				'WORD_SIZE'	=> $settings['wordgraph_min_size'] + (($words_array[$word] - $min_count) * $size_step),
				'WORD_COLOR'=> $r . $g . $b,
				'WORD_URL'	=> append_sid("{$this->phpbb_root_path}search.$this->php_ext", 'keywords=' . urlencode($word)),
			));
		}

		return array(
			'title'		=> $block_title,
			'content'	=> $this->ptemplate->render_view('blitze/sitemaker', 'blocks/wordgraph.html', 'wordgraph_block')
		);
	}

	/**
	 * @param array $settings
	 * @return array
	 */
	private function _get_words(array $settings)
	{
		$sql_where = $this->_sql_exclude_words($settings['wordgraph_exclude']);
		$sql_array = array(
			'SELECT'	=> 'l.word_text, COUNT(*) AS word_count',
			'FROM'		=> array(
				SEARCH_WORDLIST_TABLE	=> 'l',
				SEARCH_WORDMATCH_TABLE	=> 'm',
				TOPICS_TABLE			=> 't',
				POSTS_TABLE				=> 'p',
			),
			'WHERE'		=> 'm.word_id = l.word_id
				AND m.post_id = p.post_id
				AND t.topic_id = p.topic_id
				AND t.topic_time <= ' . time() . '
				AND ' . $this->content_visibility->get_global_visibility_sql('topic', array_keys($this->auth->acl_getf('!f_read', true)), 't.') .
				$sql_where,
			'GROUP_BY'	=> 'm.word_id',
			'ORDER_BY'	=> 'word_count DESC'
		);

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query_limit($sql, $settings['wordgraph_word_number'], 0, 10800);

		$words_array = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$word = ucwords(strtolower($row['word_text']));
			$words_array[$word] = $row['word_count'];
		}
		$this->db->sql_freeresult($result);

		return $words_array;
	}

	/**
	 * @param string $exclude_words
	 */
	private function _sql_exclude_words($exclude_words)
	{
		$sql_where = '';
		if ($exclude_words)
		{
			$exclude_words = array_filter(explode(',', str_replace(' ', '', $exclude_words)));
			$sql_where = (sizeof($exclude_words)) ? ' AND ' . $this->db->sql_in_set('l.word_text', $exclude_words, true) : '';
		}

		return $sql_where;
	}

	private function _show_word($word, array $words_array, $show_count)
	{
		return ($show_count) ? $word . '(' . $words_array[$word] . ')' : $word;
	}
}
