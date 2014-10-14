<?php
/**
 *
 * @package primetime
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace primetime\primetime\blocks;

class wordgraph extends \primetime\primetime\core\blocks\driver\block
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\content_visibility */
	protected $content_visibility;

	/** @var \phpbb\db\driver\factory */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth				$auth					Auth object
	 * @param \phpbb\content_visibility		$content_visibility		Content visibility
	 * @param \phpbb\db\driver\factory		$db     				Database connection
	 * @param \phpbb\user					$user					User object
	 * @param string						$root_path				phpBB root path
	 * @param string						$php_ext				phpEx
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\content_visibility $content_visibility, \phpbb\db\driver\factory $db, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->content_visibility = $content_visibility;
		$this->db = $db;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * Block config
	 */
	public function get_config($settings)
	{
		return array(
			'legend1'				=> $this->user->lang['SETTINGS'],
			'wordgraph_word_count'	=> array('lang' => 'ALLOW_WORD_COUNT', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => true, 'default' => 0),
			'wordgraph_word_number'	=> array('lang' => 'WORD_NUMBER', 'validate' => 'int:0:255', 'type' => 'number:0:255', 'maxlength' => 2, 'explain' => true, 'default' => 15, 'append' => 'WORDS'),
			'wordgraph_max_size'	=> array('lang' => 'WORD_MAX_SIZE', 'validate' => 'int:0:55', 'type' => 'number:0:55', 'maxlength' => 2, 'explain' => true, 'default' => 25, 'append' => 'PIXEL'),
			'wordgraph_min_size'	=> array('lang' => 'WORD_MIN_SIZE', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => true, 'default' => 9, 'append' => 'PIXEL'),
			'wordgraph_exclude'		=> array('lang' => 'EXCLUDE_WORDS', 'validate' => 'string', 'type' => 'textarea:5:50', 'maxlength' => 255, 'explain' => true, 'default' => ''),
		);
	}

	public function display($bdata, $edit_mode = false)
	{
		$settings = $bdata['settings'];

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
				AND ' . $this->content_visibility->get_global_visibility_sql('topic', array_keys($this->auth->acl_getf('!f_read', true)), 't.'),
			'GROUP_BY'	=> 'm.word_id',
			'ORDER_BY'	=> 'word_count DESC'
		);

		if ($settings['wordgraph_exclude'])
		{
			$exclude_words = array_filter(explode(',', str_replace(' ', '', $settings['wordgraph_exclude'])));
			$sql_array['WHERE'] .= (sizeof($exclude_words)) ? ' AND ' . $this->db->sql_in_set('l.word_text', $exclude_words, true) : '';
		}

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query_limit($sql, $settings['wordgraph_word_number'], 0, 10800);

		$words_array = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$word = ucwords(strtolower($row['word_text']));
			$words_array[$word] = $row['word_count'];
		}
		$this->db->sql_freeresult($result);

		if (!sizeof($words_array))
		{
			return array(
				'title'		=> '',
				'content'	=> '',
			);
		}

		$max_sat = hexdec(0);
		$min_sat = hexdec('f');

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
				'WORD'		=> ($settings['wordgraph_word_count']) ? $word . '(' . $words_array[$word] . ')' : $word,
				'WORD_SIZE'	=> $settings['wordgraph_min_size'] + (($words_array[$word] - $min_count) * $size_step),
				'WORD_COLOR'=> $r . $g . $b,
				'WORD_URL'	=> append_sid("{$this->phpbb_root_path}search.$this->php_ext", 'keywords=' . urlencode($word)),
			));
		}

		return array(
			'title'		=> $this->user->lang['WORDGRAPH'],
			'content'	=> $this->ptemplate->render_view('primetime/primetime', 'blocks/wordgraph.html', 'wordgraph_block')
		);
	}
}
