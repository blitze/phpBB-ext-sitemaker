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
	'ALL_TYPES'									=> 'جميع الأنواع',
	'ALL_GROUPS'								=> 'جميع المجموعات',
	'ARCHIVES'									=> 'المحفوظات',
	'AUTO_LOGIN'								=> 'السماح بتسجيل الدخول التلقائي؟',
	'FILE_MANAGER'								=> 'مدير الملفات',
	'TOPIC_POST_IDS'							=> 'من عنوان الموضوع/الموقع',
	'TOPIC_POST_IDS_EXPLAIN'					=> 'معرف (مواضيع) المواضيع / المشاركات لاسترداد المرفقات منها، مفصولة بفواصل <strong></strong>(,). حدد ما إذا كانت هذه القائمة للموضوع أو معلمات النشر أعلاه.',
	'TOPIC_POST_IDS_TYPE'						=> 'نوع المعرفات (أدناه)',

	// Blocks
	'BLITZE_SITEMAKER_BLOCK_ATTACHMENTS'		=> 'المرفقات',
	'BLITZE_SITEMAKER_BLOCK_BIRTHDAY'			=> 'تاريخ الميلاد',
	'BLITZE_SITEMAKER_BLOCK_CUSTOM'				=> 'كتلة مخصصة',
	'BLITZE_SITEMAKER_BLOCK_FEATURED_MEMBER'	=> 'العضو المميز',
	'BLITZE_SITEMAKER_BLOCK_FEEDS'				=> 'ريس/تغذية Atom',
	'BLITZE_SITEMAKER_BLOCK_FORUM_POLL'			=> 'استفتاء المنتدى',
	'BLITZE_SITEMAKER_BLOCK_FORUM_TOPICS'		=> 'مواضيع المنتدى',
	'BLITZE_SITEMAKER_BLOCK_GOOGLE_MAPS'		=> 'خرائط جوجل',
	'BLITZE_SITEMAKER_BLOCK_POPULAR_TOPICS'		=> 'المواضيع الشائعة',
	'BLITZE_SITEMAKER_BLOCK_LINKS'				=> 'الروابط',
	'BLITZE_SITEMAKER_BLOCK_LOGIN'				=> 'صندوق تسجيل الدخول',
	'BLITZE_SITEMAKER_BLOCK_MEMBERS'			=> 'الأعضاء',
	'BLITZE_SITEMAKER_BLOCK_MEMBER_MENU'		=> 'قائمة الأعضاء',
	'BLITZE_SITEMAKER_BLOCK_MENU'				=> 'القائمة',
	'BLITZE_SITEMAKER_BLOCK_MYBOOKMARKS'		=> 'علاماتي',
	'BLITZE_SITEMAKER_BLOCK_RECENT_TOPICS'		=> 'المواضيع الحديثة',
	'BLITZE_SITEMAKER_BLOCK_STATS'				=> 'الإحصائيات',
	'BLITZE_SITEMAKER_BLOCK_STYLE_SWITCHER'		=> 'مبدل النمط',
	'BLITZE_SITEMAKER_BLOCK_WHATS_NEW'			=> 'ما الجديد؟',
	'BLITZE_SITEMAKER_BLOCK_WHOIS'				=> 'من هو متصل',
	'BLITZE_SITEMAKER_BLOCK_WORDGRAPH'			=> 'ورغراف',

	// block views
	'BLOCK_VIEW'								=> 'عرض كتلة',
	'BLOCK_VIEW_BASIC'							=> 'اساسي',
	'BLOCK_VIEW_BOXED'							=> 'مربع',
	'BLOCK_VIEW_DEFAULT'						=> 'الافتراضي',
	'BLOCK_VIEW_SIMPLE'							=> 'بسيط',

	'CACHE_DURATION'							=> 'مدة التخزين المؤقت',
	'CONTEXT'									=> 'السياق',
	'CSS_SCRIPTS'								=> 'CSS Scripts',
	'CUSTOM_PROFILE_FIELDS'						=> 'حقول الملف الشخصي المخصصة',

	'DATE_RANGE'								=> 'Date Range',
	'DISPLAY_PREVIEW'							=> 'عرض المعاينة؟',

	'EDIT_ME'									=> 'من فضلك قم بتعديلي',
	'ENABLE_TOPIC_TRACKING'						=> 'تمكين تتبع الموضوع؟',
	'ENABLE_TOPIC_TRACKING_EXPLAIN'				=> 'في حالة التمكين، سيتم الإشارة إلى المواضيع غير المقروءة ولكن نتائج الكتلة لن يتم تخزينها مؤقتا <strong>(غير مستحسن)</strong>',
	'EXCLUDE_TOO_MANY_WORDS'					=> 'لقد قمت بإدخال العديد من الكلمات للاستبعاد. الحد الأقصى لعدد الأحرف الممكن هو 255، لقد قمت بإدخال %s.',
	'EXCLUDE_WORDS'								=> 'استبعاد الكلمات',
	'EXCLUDE_WORDS_EXPLAIN'						=> 'قائمة الكلمات التي ترغب في استبعادها من الكلمة مفصولة بفاصلة (,). بحد أقصى 255 حرفاً.',
	'EXPANDED'									=> 'موسع',
	'EXTENSION_GROUP'							=> 'فريق التمديد',

	'FEATURED_MEMBER_IDS'						=> 'معرفات المستخدم',
	'FEATURED_MEMBER_IDS_EXPLAIN'				=> 'قائمة مفصولة بفواصل للمستخدمين للميزة (ينطبق فقط على وضع عرض الأعضاء المميزين)',
	'FEED_DATA_PREVIEW'							=> 'بيانات التغذية',
	'FEED_ITEM_TEMPLATE'						=> 'قالب العنصر',
	'FEED_ITEM_TEMPLATE_EXPLAIN'				=> '<strong>تلميح:</strong><br />
		<unk>		<ul class="sm-list">
			<unk>			<li>الوصول إلى بيانات التغذية في <strong>البند</strong> المتغير e. البند عنوان</li>
			<unk>			<li>يجب أن يكون قالب في <a href="https://twig.symfony.com/doc/2.x/" target="_blank">بندا Twig</a></li>
			<unk>			<li>انقر فوق <strong>عينات</strong> أعلاه لنماذج القالب</li>
			<unk> <unk>			<li>استخدم <code>get_item_tags(<a href="http://simplepie.org/wiki/faq/supported_xml_namespaces" target="_blank">$namespace</a>، $tag)</code> للحصول على أي علامة من موجز الويب الذي لا نقدمه. .<br /><strong><code>{{ get_item_tags(\'\', \'image\') }}</code></strong></li>
			<unk>			<li>استخدم عامل تصفية Twig\'s json_encode لمشاهدة محتويات الصفيف e. . <strong><code>{{ get_item_tags(\'\', \'image\')<unk> json_encode() }}</code></strong></li>
		<unk>		</ul>',
	'FEED_PREVIEW_SOURCE'						=> 'المصدر',
	'FEED_URL_PLACEHOLDER'						=> 'http://example.com/rss',
	'FEED_URLS'									=> 'رابط تغذية',
	'FIRST_POST_ONLY'							=> 'أول مشاركة فقط',
	'FIRST_POST_TIME'							=> 'وقت الرد الأول',
	'FORUMS_GET_TYPE'							=> 'الحصول على النوع',
	'FORUMS_MAX_TOPICS'							=> 'الحد الأقصى للمواضيع / المشاركات',
	'FORUMS_TITLE_MAX_CHARS'					=> 'الحد الأقصى للحروف لكل عنوان',
	'FREQUENCY'									=> 'التردد',
	'FULL'										=> 'كامل',
	'FULLSCREEN'								=> 'ملء الشاشة',

	'GET_TYPE'									=> 'عرض الموضوع/مشاركة؟',

	'HTML'										=> 'HTML',
	'HTML_EXPLAIN'								=> '<strong>استخدم هذا النص لإدخال محتوى HTML خام.</strong><br />يرجى ملاحظة أن أي محتوى منشور هنا سيتجاوز محتوى الكتلة المخصصة ولن يكون محرر الكتلة المرئية متاحا.',
	'HOURS_SHORT'								=> 'ساعات',

	'JS_SCRIPTS'								=> 'سكريبتات JS',

	'LAST_POST_TIME'							=> 'آخر وقت مشاركة',
	'LAST_READ_TIME'							=> 'آخر وقت للقراءة',
	'LIMIT'										=> 'الحد',
	'LIMIT_FORUMS'								=> 'معارف المنتدى (اختياري)',
	'LIMIT_FORUMS_EXPLAIN'						=> 'أدخل معرف كل منتدى مفصول بفاصلة (,). إذا تم تعيينه، سيتم عرض المواضيع فقط من المنتديات المحددة.',
	'LIMIT_POST_TIME'							=> 'الحد حسب وقت النشر',
	'LIMIT_POST_TIME_EXPLAIN'					=> 'إذا تم تعيين المواضيع المنشورة خلال الفترة المحددة فقط سيتم استرجاعها',

	'MAX_DEPTH'									=> 'أقصى عمق',
	'MAX_ITEMS'									=> 'الحد الأقصى لعدد العناصر',
	'MAX_MEMBERS'								=> 'الحد الأقصى للأعضاء',
	'MAX_POSTS'									=> 'الحد الأقصى لعدد المشاركات',
	'MAX_TOPICS'								=> 'الحد الأقصى لعدد المواضيع',
	'MAX_WORDS'									=> 'الحد الأقصى لعدد الكلمات',
	'MANAGE_MENUS'								=> 'إدارة القوائم',
	'MAP_COORDINATES'							=> 'الإحداثيات',
	'MAP_COORDINATES_EXPLAIN'					=> 'أدخل الإحداثيات في شكل خط العرض، خط الطول',
	'MAP_HEIGHT'								=> 'الارتفاع',
	'MAP_LOCATION'								=> 'الموقع',
	'MAP_TITLE'									=> 'العنوان',
	'MAP_VIEW'									=> 'عرض',
	'MAP_VIEW_HYBRID'							=> 'هجين',
	'MAP_VIEW_MAP'								=> 'الخريطة',
	'MAP_VIEW_SATELITE'							=> 'ساتل',
	'MAP_VIEW_TERRAIN'							=> 'Terrain',
	'MAP_ZOOM_LEVEL'							=> 'تكبير مستوى',
	'MEMBERS_DATE'								=> 'التاريخ',
	'MENU_NO_ITEMS'								=> 'لا توجد عناصر نشطة لعرضها',
	'MINI'										=> 'مصغر',

	'OR'										=> '<strong>أو</strong>',
	'ORDER_BY'									=> 'الترتيب حسب',

	'POLL_FROM_FORUMS'							=> 'عرض استطلاعات الرأي من المنتديات',
	'POLL_FROM_FORUMS_EXPLAIN'					=> 'سيتم عرض استطلاعات الرأي فقط من المنتديات المحددة طالما لم يتم تحديد أي مواضيع أعلاه',
	'POLL_FROM_GROUPS'							=> 'عرض استطلاعات الرأي من المجموعات (المجموعات)',
	'POLL_FROM_GROUPS_EXPLAIN'					=> 'سيتم عرض استطلاعات الرأي فقط من أعضاء المجموعات المحددة طالما لم يتم تحديد المستخدم (المستخدمين) أعلاه',
	'POLL_FROM_TOPICS'							=> 'عرض استطلاعات الرأي من المواضيع',
	'POLL_FROM_TOPICS_EXPLAIN'					=> 'معرف (مواضيع) لاسترداد استطلاعات الرأي، مفصولة بـ <strong>فواصل</strong>(,). اتركه فارغا لتحديد أي موضوع.',
	'POLL_FROM_USERS'							=> 'عرض استطلاعات الرأي من المستخدمين',
	'POLL_FROM_USERS_EXPLAIN'					=> 'معرف المستخدم (المستخدمين) الذين ترغب في عرض استطلاعاتهم، مفصولة بفواصل <strong></strong>(,). اتركه فارغا لتحديد استطلاعات الرأي من أي مستخدم.',
	'POSTS_TITLE_LIMIT'							=> 'الحد الأقصى # من الأحرف لعنوان المشاركة',
	'PREVIEW_MAX_CHARS'							=> 'عدد الأحرف المراد معاينتها',

	'QUERY_TYPE'								=> 'وضع العرض',

	'ROTATE_DAILY'								=> 'يومياً',
	'ROTATE_HOURLY'								=> 'ساعة',
	'ROTATE_MONTHLY'							=> 'شهريا',
	'ROTATE_PAGELOAD'							=> 'تحميل الصفحة',
	'ROTATE_WEEKLY'								=> 'أسبوعيا',

	'SAMPLES'									=> 'عينات',
	'SCRIPTS'									=> 'البرامج النصية',
	'SELECT_FORUMS'								=> 'حدد المنتديات',
	'SELECT_FORUMS_EXPLAIN'						=> 'حدد المنتديات التي تعرض منها المواضيع/المشاركات. اتركه فارغاً للاختيار من جميع المنتديات',
	'SELECT_MENU'								=> 'حدد القائمة',
	'SELECT_PROFILE_FIELDS'						=> 'حدد حقول الملف الشخصي',
	'SELECT_PROFILE_FIELDS_EXPLAIN'				=> 'سيتم عرض حقول الملف الشخصي المختارة فقط إذا كانت متاحة.',
	'SHOW_FIRST_POST'							=> 'أول منشور',
	'SHOW_HIDE_ME'								=> 'السماح بإخفاء الحالة على الإنترنت؟',
	'SHOW_LAST_POST'							=> 'آخر مشاركة',
	'SHOW_MEMBER_MENU'							=> 'إظهار قائمة المستخدمين؟',
	'SHOW_MEMBER_MENU_EXPLAIN'					=> 'استبدال مربع تسجيل الدخول بقائمة المستخدم إذا تم تسجيل دخول المستخدم',
	'SHOW_WORD_COUNT'							=> 'إظهار عدد الكلمات؟',

	'TEMPLATE'									=> 'قالب',
	'TOPIC_TITLE_LIMIT'							=> 'الحد الأقصى # من الأحرف لعنوان الموضوع',
	'TOPIC_TYPE'								=> 'نوع الموضوع',
	'TOPIC_TYPE_EXPLAIN'						=> 'حدد أنواع المواضيع التي ترغب في عرضها. اترك المربعات غير محددة للاختيار من جميع أنواع المواضيع',
	'TOPICS_LOOK_BACK'							=> 'انظر إلى الوراء',
	'TOPICS_ONLY'								=> 'المواضيع فقط؟',
	'TOPICS_PER_PAGE'							=> 'لكل صفحة',

	'WORD_MAX_SIZE'								=> 'الحد الأقصى لحجم الخط',
	'WORD_MIN_SIZE'								=> 'الحد الأدنى لحجم الخط',
));
