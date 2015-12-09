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
			'legend1'			=> $this->user->lang('SETTINGS'),
			'show_word_count'	=> array('lang' => 'SHOW_WORD_COUNT', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => 0),
			'max_num_words'		=> array('lang' => 'MAX_WORDS', 'validate' => 'int:0:255', 'type' => 'number:0:255', 'maxlength' => 2, 'explain' => false, 'default' => 15),
			'max_word_size'		=> array('lang' => 'WORD_MAX_SIZE', 'validate' => 'int:0:55', 'type' => 'number:0:55', 'maxlength' => 2, 'explain' => false, 'default' => 25, 'append' => 'PIXEL'),
			'min_word_size'		=> array('lang' => 'WORD_MIN_SIZE', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 9, 'append' => 'PIXEL'),
			'exclude_words'		=> array('lang' => 'EXCLUDE_WORDS', 'validate' => 'string', 'type' => 'textarea:5:50', 'maxlength' => 255, 'explain' => true, 'default' => ''),
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

		$this->_show_graph($words_array, $settings);

		return array(
			'title'		=> $block_title,
			'content'	=> $this->ptemplate->render_view('blitze/sitemaker', 'blocks/wordgraph.html', 'wordgraph_block')
		);
	}

	/**
	 * @param array $words_array
	 * @param array $settings
	 */
	private function _show_graph(array $words_array, array $settings)
	{
		$params = $this->_get_graph_params($words_array, $settings);

		// Sort words in result
		$words = array_keys($words_array);
		sort($words);

		foreach ($words as $word)
		{
			$color = $params['min_sat'] + (($words_array[$word] - $params['min_count']) * $params['color_step']);
			$r = dechex($color);
			$b = dechex($params['max_sat'] - $color);
			$g = 'c';

			$this->ptemplate->assign_block_vars('wordgraph', array(
				'WORD'			=> $this->_show_word($word, $words_array[$word], $settings['show_word_count']),
				'WORD_SIZE'		=> $settings['min_word_size'] + (($words_array[$word] - $params['min_count']) * $params['size_step']),
				'WORD_COLOR'	=> $r . $g . $b,
				'WORD_URL'		=> append_sid("{$this->phpbb_root_path}search.$this->php_ext", 'keywords=' . urlencode($word)),
			));
		}
	}

	/**
	 * @param array $words_array
	 * @param array $settings
	 */
	private function _get_graph_params(array $words_array, array $settings)
	{
		$max_sat = hexdec('f');
		$min_sat = hexdec(0);

		$max_count = max(array_values($words_array));
		$min_count = min(array_values($words_array));

		$spread = $max_count - $min_count;
		$spread = ($spread) ? $spread : 1;

		return array(
			'min_sat'	=> $min_sat,
			'max_sat'	=> $max_sat,

			'min_count'	=> $min_count,
			'max_count'	=> $max_count,

			'spread'	=> $spread,

			// determine the font-size increment
			'size_step'		=> ($settings['max_word_size'] - $settings['min_word_size']) / $spread,
			'color_step'	=> ($max_sat - $min_sat) / $spread,
		);
	}

	/**
	 * @param array $settings
	 * @return array
	 */
	private function _get_words(array $settings)
	{
		$sql_array = $this->_get_words_sql($settings['exclude_words']);
		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query_limit($sql, $settings['max_num_words'], 0, 10800);

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
	 * @return array
	 */
	private function _get_words_sql($exclude_words)
	{
		$sql_where = $this->_exclude_words_sql($exclude_words);
		return array(
			'SELECT'	=> 'l.word_text, l.word_count',
			'FROM'		=> array(
				SEARCH_WORDLIST_TABLE	=> 'l',
				SEARCH_WORDMATCH_TABLE	=> 'm',
				TOPICS_TABLE			=> 't',
				POSTS_TABLE				=> 'p',
			),
			'WHERE'		=> 'l.word_common <> 1
				AND l.word_count > 0
				AND m.word_id = l.word_id
				AND m.post_id = p.post_id
				AND t.topic_id = p.topic_id
				AND t.topic_time <= ' . time() . '
				AND ' . $this->content_visibility->get_global_visibility_sql('topic', array_keys($this->auth->acl_getf('!f_read', true)), 't.') .
				$sql_where,
			'GROUP_BY'	=> 'l.word_text',
			'ORDER_BY'	=> 'l.word_count DESC'
		);
	}

	/**
	 * @param string $exclude_words
	 */
	private function _exclude_words_sql($exclude_words)
	{
		$sql_where = '';
		if ($exclude_words)
		{
			$exclude_words = array_filter(explode(',', str_replace(' ', '', $exclude_words)));
			$sql_where = (sizeof($exclude_words)) ? ' AND ' . $this->db->sql_in_set('l.word_text', $exclude_words, true) : '';
		}

		return $sql_where;
	}

	/**
	 * @param string $word
	 * @param int $count
	 * @param bool $show_count
	 * @return string
	 */
	private function _show_word($word, $count, $show_count)
	{
		return censor_text(($show_count) ? $word . '(' . $count . ')' : $word);
	}
}
