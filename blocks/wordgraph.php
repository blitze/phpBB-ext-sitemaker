<?php
/**
 *
 * @package sitemaker
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace blitze\sitemaker\blocks;

use blitze\sitemaker\services\blocks\driver\block;

class wordgraph extends block
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \blitze\sitemaker\services\forum\data */
	protected $forum;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/** @var int */
	protected $cache_time;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface			$db     			Database connection
	 * @param \blitze\sitemaker\services\forum\data		$forum				Forum Data object
	 * @param string									$phpbb_root_path	phpBB root path
	 * @param string									$php_ext			phpEx
	 * @param integer									$cache_time			Cache results for given time
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \blitze\sitemaker\services\forum\data $forum, $phpbb_root_path, $php_ext, $cache_time)
	{
		$this->db = $db;
		$this->forum = $forum;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->cache_time = $cache_time;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_config(array $settings)
	{
		return array(
			'legend1'			=> 'SETTINGS',
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
		$block = array(
			'title'		=> 'WORDGRAPH',
			'content'	=> '',
		);

		$words_array = $this->get_words($settings);
		if (sizeof($words_array))
		{
			$this->show_graph($words_array, $settings);

			$block['content'] = $this->ptemplate->render_view('blitze/sitemaker', 'blocks/wordgraph.html', 'wordgraph_block');
		}

		return $block;
	}

	/**
	 * @param array $words_array
	 * @param array $settings
	 */
	protected function show_graph(array $words_array, array $settings)
	{
		$params = $this->get_graph_params($words_array, $settings);

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
				'WORD'			=> $this->show_word($word, $words_array[$word], $settings['show_word_count']),
				'WORD_SIZE'		=> $settings['min_word_size'] + (($words_array[$word] - $params['min_count']) * $params['size_step']),
				'WORD_COLOR'	=> $r . $g . $b,
				'WORD_URL'		=> $this->get_url($word),
			));
		}
	}

	/**
	 * @param array $words_array
	 * @param array $settings
	 * @return array
	 */
	protected function get_graph_params(array $words_array, array $settings)
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
	protected function get_words(array $settings)
	{
		$sql_array = $this->forum->query(false, false)
			->fetch_custom($this->get_custom_sql_array($settings), array('SELECT'))
			->build(true, true, false)
			->get_sql_array();
		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query_limit($sql, $settings['max_num_words'], 0, $this->cache_time);

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
	 * @param array $settings
	 * @return array
	 */
	protected function get_custom_sql_array(array $settings)
	{
		return array(
			'SELECT'	=> array('l.word_text', 'l.word_count'),
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
				AND t.topic_id = p.topic_id' . $this->exclude_words_sql($settings['exclude_words']),
			'GROUP_BY'	=> 'l.word_text, l.word_count',
			'ORDER_BY'	=> 'l.word_count DESC'
		);
	}

	/**
	 * @param string $exclude_words Comma separated string of words
	 * @return string
	 */
	protected function exclude_words_sql($exclude_words)
	{
		$sql_where = '';
		if ($exclude_words)
		{
			$exclude_words = array_filter(explode(',', str_replace(' ', '', strtolower($exclude_words))));
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
	protected function show_word($word, $count, $show_count)
	{
		return censor_text(($show_count) ? $word . '(' . $count . ')' : $word);
	}

	/**
	 * @param string $word
	 * @return string
	 */
	protected function get_url($word)
	{
		return append_sid("{$this->phpbb_root_path}search.$this->php_ext", 'keywords=' . urlencode($word));
	}
}
