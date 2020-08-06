<?php

/**
 * @copyright (c) 2013 Daniel A. (blitze)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, [
	'ACP_SITEMAKER'		=> 'SiteMaker',
	'ACP_SM_SETTINGS'	=> 'Settings',

	'BLOCKS_CLEANUP'			=> 'Blocks Cleanup',
	'BLOCKS_CLEANUP_EXPLAIN'	=> 'The following items were found to no longer exist or unreachable, and you can therefore delete all blocks associated to them. Please keep in mind that some of these may be false positives',
	'BLOCKS_CLEANUP_BLOCKS'		=> 'Invalid Blocks (e.g. from uninstalled extensions):',
	'BLOCKS_CLEANUP_ROUTES'		=> 'Unreachable/broken Pages:',
	'BLOCKS_CLEANUP_STYLES'		=> 'Uninstalled Styles (ids):',
	'BLOCKS_CLEANUP_SUCCESS'	=> 'Blocks purged sucessfully',

	'FILEMANAGER_SETTINGS'						=> 'File Manager Settings',
	'FILEMANAGER_STATUS'						=> 'Status',
	'FILEMANAGER_NO_EXIST'						=> 'You will need to install the File Manager before you can enable it. Installation instructions are found <a href="%s" target="_blank"  rel="noopener noreferrer"><strong>here</strong></a>',
	'FILEMANAGER_NOT_WRITABLE'					=> 'Dosya yöneticisi ayar kalsörü (root/ResponsiveFilemanager/filemanager/config/) yazılabilir değil. Lütfen tüm izinleri yazılabilir olarak değiştirin (777 veya - FTP aracılığıyla rwxrwxrwx olarak)',
	'FILEMANAGER_IMAGE_AUTO_RESIZE'				=> 'Automatically resize uploaded images?',
	'FILEMANAGER_IMAGE_AUTO_RESIZE_DIMENSIONS'	=> 'Resize to specified dimensions',
	'FILEMANAGER_IMAGE_AUTO_RESIZING_MODE'		=> 'Auto resizing mode',
	'FILEMANAGER_IMAGE_MAX_DIMENSIONS'			=> 'Max. image size',
	'FILEMANAGER_IMAGE_MAX_MODE'				=> 'Max. image size mode',
	'FILEMANAGER_IMAGE_MODE_EXPLAIN'			=> 'Used to calculate the height/width if you only provide height or width but not both above',
	'FILEMANAGER_IMAGE_MODE_AUTO'				=> 'Auto',
	'FILEMANAGER_IMAGE_MODE_CROP'				=> 'Crop',
	'FILEMANAGER_IMAGE_MODE_EXACT'				=> 'Exact',
	'FILEMANAGER_IMAGE_MODE_LANDSCAPE'			=> 'Landscape',
	'FILEMANAGER_IMAGE_MODE_PORTRAIT'			=> 'Portrait',
	'FILEMANAGER_WATERMARK'						=> 'Watermark',
	'FILEMANAGER_WATERMARK_EXPLAIN'				=> 'URL of image to use as watermark on all uploaded images',
	'FILEMANAGER_WATERMARK_POSITION'			=> 'Watermark position',
	'FILEMANAGER_WATERMARK_POSITION_EXPLAIN'	=> 'Select a pre-determined position where the watermark should appear or enter the coordinates e.g. 50x100',
	'FILEMANAGER_WATERMARK_POSITION_TL'			=> 'Top Left',
	'FILEMANAGER_WATERMARK_POSITION_T'			=> 'Top',
	'FILEMANAGER_WATERMARK_POSITION_TR'			=> 'Top Right',
	'FILEMANAGER_WATERMARK_POSITION_L'			=> 'Left',
	'FILEMANAGER_WATERMARK_POSITION_M'			=> 'Middle',
	'FILEMANAGER_WATERMARK_POSITION_R'			=> 'Right',
	'FILEMANAGER_WATERMARK_POSITION_BL'			=> 'Bottom Left',
	'FILEMANAGER_WATERMARK_POSITION_B'			=> 'Bottom',
	'FILEMANAGER_WATERMARK_POSITION_BR'			=> 'Bottom Right',
	'FILEMANAGER_WATERMARK_POSITION_SUFFIX'		=> 'or',
	'FILEMANAGER_WATERMARK_PADDING'				=> 'Watermark padding',
	'FILEMANAGER_WATERMARK_PADDING_EXPLAIN'		=> 'If using a pre-determined position you can adjust the padding from the edges. If using co-ordinates, this value is ignored',

	'FORUM_INDEX_SETTINGS'			=> 'Forum Index Settings',
	'FORUM_INDEX_SETTINGS_EXPLAIN'	=> 'These settings only apply when there is no startpage defined',

	'HIDE'			=> 'Hide',
	'HIDE_BIRTHDAY'	=> 'Hide Birthday section',
	'HIDE_LOGIN'	=> 'Hide login box',
	'HIDE_ONLINE'	=> 'Hide Whos online section',

	'LAYOUT_BLOG'		=> 'Blog',
	'LAYOUT_CUSTOM'		=> 'Custom',
	'LAYOUT_HOLYGRAIL'	=> 'Holy Grail',
	'LAYOUT_PORTAL'		=> 'Portal',
	'LAYOUT_PORTAL_ALT'	=> 'Portal (alt)',
	'LAYOUT_SETTINGS'	=> 'Layout Settings',

	'LOG_DELETED_BLOCKS_FOR_STYLE'	=> 'Sitemaker blocks deleted for missing style with id %s',
	'LOG_DELETED_BLOCKS_FOR_ROUTE'	=> 'Sitemaker blocks deleted for broken pages:<br />%s',
	'LOG_DELETED_BLOCKS'			=> 'Invalid Sitemaker blocks deleted:<br />%s',

	'NAVIGATION_SETTINGS'	=> 'Navigation Settings',
	'NO_NAVBAR'				=> 'None',

	'SELECT_NAVBAR_MENU'		=> 'Select main navigation menu',
	'SETTINGS_SAVED'			=> 'Your settings have been saved',
	'SHOW'						=> 'Show',
	'SHOW_FORUM_NAV'			=> 'Show ’Forum’ in navigation bar?',
	'SHOW_FORUM_NAV_EXPLAIN'	=> 'When a page is set as startpage instead of the forum index, should we display ’Forum’ in navigation bar',
	'SHOW_FORUM_NAV_WITH_ICON'	=> 'Yes - with icon:',
]);
