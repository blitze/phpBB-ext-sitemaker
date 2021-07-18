<?php

/**
 *
 * @package phpBB Sitemaker [English]
 * @copyright (c) 2012 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ALL_TYPES'									=> '所有类型',
	'ALL_GROUPS'								=> '所有组',
	'ARCHIVES'									=> '档案',
	'AUTO_LOGIN'								=> '是否允许自动登录？',
	'FILE_MANAGER'								=> '文件管理器',
	'TOPIC_POST_IDS'							=> '从主题/费用ID',
	'TOPIC_POST_IDS_EXPLAIN'					=> '要从附件中检索的主题/帖子的ID，用 <strong>逗号</strong>(,)分隔。指定该列表是否针对主题或帖子id。',
	'TOPIC_POST_IDS_TYPE'						=> 'ID类型(下面)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> '附件',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> '生日',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> '自定义块',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> '精选成员',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'RSS/Atom Feed',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> '论坛投票',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> '论坛主题',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> '谷歌地图',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> '热门主题',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> '链接',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> '登录框',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> '成员',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> '会员菜单',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> '菜单',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> '我的书签',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> '最近的主题',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> '统计',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> '样式切换器',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> '有什么新内容？',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> '谁在线',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> '单词图',

	// block views
	'BLOCK_VIEW'								=> '屏蔽视图',
	'BLOCK_VIEW_BASIC'							=> '基本的',
	'BLOCK_VIEW_BOXED'							=> '盒子',
	'BLOCK_VIEW_DEFAULT'						=> '默认设置',
	'BLOCK_VIEW_SIMPLE'							=> '简单的',

	'CACHE_DURATION'							=> '缓存持续时间',
	'CONTEXT'									=> '二. 背景',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> '自定义配置文件字段',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> '显示预览吗？',

	'EDIT_ME'									=> '请编辑我',
	'ENABLE_TOPIC_TRACKING'						=> '启用主题跟踪？',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> '如果启用，将会显示未读主题，但块结果将不会被缓存 <strong>(不推荐)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> '您输入的单词过多，无法排除。最大字符数为255，您已经输入 %s。',
	'EXCLUDE_WORDS'								=> '排除单词',
	'EXCLUDE_WORDS_EXPLAIN'						=> '列出您想要从用逗号 (,)分隔的单词中排除的单词。最多255个字符。',
	'EXPANDED'									=> '扩展',
	'EXTENSION_GROUP'							=> '扩展组',

	'FEATURED_MEMBER_IDS'						=> '用户 ID',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> '使用逗号分隔的用户列表 (仅适用于精选成员显示模式)',
	'FEED_DATA_PREVIEW'							=> '新闻源数据',
	'FEED_ITEM_TEMPLATE'						=> '项目模板',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>TIPS：</strong><br />
		<ul class="sm-list">
			<li>访问Feed数据在 <strong>item</strong> 变量。 目 录 itle</li>
			<li>模板必须在 <a href="https://twig.symfony.com/doc/2.x/" target="_blank">Twig 语法</a></li>
			<li>点击 <strong>样本</strong> 以上的样本模板</li>
			<li>使用 <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>, $tag)</code> 获取我们不提供的新闻源的任何标签。 。<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<li>使用 Twig\'s json_code 过滤器查看数组内容 e。 。 <strong><code>{Sponge get_item_tags(\'\', \'image\')|json_encode() }}</code></strong></li>
		</ul>',
	'FEED_PREVIEW_SOURCE'						=> '来源',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'Feed URL',
	'FIRST_POST_ONLY'							=> '仅第一篇文章',
	'FIRST_POST_TIME'							=> '首次发布时间',
	'FORUMS_GET_TYPE'							=> '获取类型',
	'FORUMS_MAX_TOPICS'							=> '最大主题/帖子',
	'FORUMS_TITLE_MAX_CHARS'					=> '每个标题的最大字符',
	'FREQUENCY'									=> '频率',
	'FULL'										=> '完整的',
	'FULLSCREEN'								=> '全屏',

	'GET_TYPE'									=> '显示主题/帖子？',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>使用此文本输入原始HTML内容。</strong><br />请注意，此处发布的任何内容都将覆盖自定义块内容，视觉块编辑器将不可用。',
	'HOURS_SHORT'								=> '小时',

	'JS_SCRIPTS'								=> 'JS 脚本',

	'LAST_POST_TIME'							=> '最后发布时间',
	'LAST_READ_TIME'							=> '最后阅读时间',
	'LIMIT'										=> '限制',
	'LIMIT_FORUMS'								=> '论坛ID (可选)',
	'LIMIT_FORUMS_EXPLAIN'						=> '输入每个论坛ID以逗号 (,)分隔。如果设置，只显示指定论坛中的主题。',
	'LIMIT_POST_TIME'							=> '按发布时间限制',
	'LIMIT_POST_TIME_EXPLAIN'					=> '如果设置，只能检索在指定时间段内发布的主题',

	'MAX_DEPTH'									=> '最大深度',
	'MAX_ITEMS'									=> '最大项目数',
	'MAX_MEMBERS'								=> '最大成员',
	'MAX_POSTS'									=> '最大帖子数',
	'MAX_TOPICS'								=> '主题的最大数量',
	'MAX_WORDS'									=> '最大单词数',
	'MANAGE_MENUS'								=> '管理菜单',
	'MAP_COORDINATES'							=> '坐标',
	'MAP_COORDINATES_EXPLAIN'					=> '输入经纬度的坐标',
	'MAP_HEIGHT'								=> '高度',
	'MAP_LOCATION'								=> '地点',
	'MAP_TITLE'									=> '标题',
	'MAP_VIEW'									=> '查看',
	'MAP_VIEW_HYBRID'							=> '混合的',
	'MAP_VIEW_MAP'								=> '地图',
	'MAP_VIEW_SATELITE'							=> 'Satellite',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> '缩放级别',
	'MEMBERS_DATE'								=> '日期',
	'MENU_NO_ITEMS'								=> '没有活动项目要显示',
	'MINI'										=> '迷你的',

	'OR'										=> '<strong>或</strong>',
	'ORDER_BY'									=> '排序方式',

	'POLL_FROM_FORUMS'							=> '显示来自论坛的调查 (s)',
	'POLL_FROM_FORUMS_EXPLAIN'					=> '只显示来自所选论坛的投票，只要上面没有指定主题',
	'POLL_FROM_GROUPS'							=> '显示来自群组的调查',
	'POLL_FROM_GROUPS_EXPLAIN'					=> '只显示所选组成员的投票，只要上面没有用户(s)',
	'POLL_FROM_TOPICS'							=> '显示来自主题的调查 (s)',
	'POLL_FROM_TOPICS_EXPLAIN'					=> '要从中检索调查的主题，用 <strong>逗号</strong>(,)分隔。留空以选择任何主题。',
	'POLL_FROM_USERS'							=> '显示来自用户的调查 (s)',
	'POLL_FROM_USERS_EXPLAIN'					=> '您想要显示投票的用户ID(s)，用 <strong>逗号</strong>(,)分隔。留空以从任何用户选择投票。',
	'POSTS_TITLE_LIMIT'							=> '文章标题的最大字符数',
	'PREVIEW_MAX_CHARS'							=> '要预览的字符数',

	'QUERY_TYPE'								=> '显示模式',

	'ROTATE_DAILY'								=> '每天',
	'ROTATE_HOURLY'								=> '每小时',
	'ROTATE_MONTHLY'							=> '每月的',
	'ROTATE_PAGELOAD'							=> '页面负载',
	'ROTATE_WEEKLY'								=> '每周的',

	'SAMPLES'									=> '示例：',
	'SCRIPTS'									=> '脚本',
	'SELECT_FORUMS'								=> '选择论坛',
	'SELECT_FORUMS_EXPLAIN'						=> '选择显示主题/帖子的论坛。留空则从所有论坛中选择',
	'SELECT_MENU'								=> '选择菜单',
	'SELECT_PROFILE_FIELDS'						=> '选择配置文件字段',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> '如果可用，只有选中的配置文件字段将被显示。',
	'SHOW_FIRST_POST'							=> '第一个帖子',
	'SHOW_HIDE_ME'								=> '允许隐藏在线状态？',
	'SHOW_LAST_POST'							=> '上次帖子',
	'SHOW_MEMBER_MENU'							=> '显示用户菜单？',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> '如果用户登录，用用户菜单替换登录框',
	'SHOW_WORD_COUNT'							=> '显示单词计数？',

	'TEMPLATE'									=> '模板',
	'TOPIC_TITLE_LIMIT'							=> '主题标题的最大字符数',
	'TOPIC_TYPE'								=> '主题类型',
	'TOPIC_TYPE_EXPLAIN'						=> '选择您想要显示的主题类型。不选中框以从所有主题类型中选择',
	'TOPICS_LOOK_BACK'							=> '向后查看',
	'TOPICS_ONLY'								=> '只显示主题？',
	'TOPICS_PER_PAGE'							=> '每页',

	'WORD_MAX_SIZE'								=> '最大字体大小',
	'WORD_MIN_SIZE'								=> '最小字体大小',
));
