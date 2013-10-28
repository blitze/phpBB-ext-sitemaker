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
* Primetime icons - Font-awesome
*/
class icons
{
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

    function __construct(\phpbb\template\template $template, \phpbb\user $user)
	{
		$this->template = $template;
    	$this->user = $user;
	}

	/**
	* Constructor
	*
	* @param \phpbb\template\template $template Template object
    * @param \phpbb\user $user User object
	*/
    public function get()
	{
        $this->user->add_lang_ext('primetime/primetime', 'icons');

		return array(
			'web_applications'	=> array(
				'-icon-adjust',
				'-icon-asterisk',
				'-icon-ban-circle',
				'-icon-bar-chart',
				'-icon-barcode',
				'-icon-beaker',
				'-icon-beer',
				'-icon-bell',
				'-icon-bell-alt',
				'-icon-bolt',
				'-icon-book',
				'-icon-bookmark',
				'-icon-bookmark-empty',
				'-icon-briefcase',
				'-icon-bullhorn',
				'-icon-calendar',
				'-icon-camera',
				'-icon-camera-retro',
				'-icon-certificate',
				'-icon-check',
				'-icon-check-empty',
				'-icon-circle',
				'-icon-circle-blank',
				'-icon-cloud',
				'-icon-cloud-download',
				'-icon-cloud-upload',
				'-icon-coffee',
				'-icon-cog',
				'-icon-cogs',
				'-icon-comment',
				'-icon-comment-alt',
				'-icon-comments',
				'-icon-comments-alt',
				'-icon-credit-card',
				'-icon-dashboard',
				'-icon-desktop',
				'-icon-download',
				'-icon-download-alt',
				'-icon-edit',
				'-icon-envelope',
				'-icon-envelope-alt',
				'-icon-exchange',
				'-icon-exclamation-sign',
				'-icon-external-link',
				'-icon-eye-close',
				'-icon-eye-open',
				'-icon-facetime-video',
				'-icon-fighter-jet',
				'-icon-film',
				'-icon-filter',
				'-icon-fire',
				'-icon-flag',
				'-icon-folder-close',
				'-icon-folder-open',
				'-icon-folder-close-alt',
				'-icon-folder-open-alt',
				'-icon-food',
				'-icon-gift',
				'-icon-glass',
				'-icon-globe',
				'-icon-group',
				'-icon-hdd',
				'-icon-headphones',
				'-icon-heart',
				'-icon-heart-empty',
				'-icon-home',
				'-icon-inbox',
				'-icon-info-sign',
				'-icon-key',
				'-icon-leaf',
				'-icon-laptop',
				'-icon-legal',
				'-icon-lemon',
				'-icon-lightbulb',
				'-icon-lock',
				'-icon-unlock',
				'-icon-magic',
				'-icon-magnet',
				'-icon-map-marker',
				'-icon-minus',
				'-icon-minus-sign',
				'-icon-mobile-phone',
				'-icon-money',
				'-icon-move',
				'-icon-music',
				'-icon-off',
				'-icon-ok',
				'-icon-ok-circle',
				'-icon-ok-sign',
				'-icon-pencil',
				'-icon-picture',
				'-icon-plane',
				'-icon-plus',
				'-icon-plus-sign',
				'-icon-print',
				'-icon-pushpin',
				'-icon-qrcode',
				'-icon-question-sign',
				'-icon-quote-left',
				'-icon-quote-right',
				'-icon-random',
				'-icon-refresh',
				'-icon-remove',
				'-icon-remove-circle',
				'-icon-remove-sign',
				'-icon-reorder',
				'-icon-reply',
				'-icon-resize-horizontal',
				'-icon-resize-vertical',
				'-icon-retweet',
				'-icon-road',
				'-icon-rss',
				'-icon-screenshot',
				'-icon-search',
				'-icon-share',
				'-icon-share-alt',
				'-icon-shopping-cart',
				'-icon-signal',
				'-icon-signin',
				'-icon-signout',
				'-icon-sitemap',
				'-icon-sort',
				'-icon-sort-down',
				'-icon-sort-up',
				'-icon-spinner',
				'-icon-star',
				'-icon-star-empty',
				'-icon-star-half',
				'-icon-tablet',
				'-icon-tag',
				'-icon-tags',
				'-icon-tasks',
				'-icon-thumbs-down',
				'-icon-thumbs-up',
				'-icon-time',
				'-icon-tint',
				'-icon-trash',
				'-icon-trophy',
				'-icon-truck',
				'-icon-umbrella',
				'-icon-upload',
				'-icon-upload-alt',
				'-icon-user',
				'-icon-user-md',
				'-icon-volume-off',
				'-icon-volume-down',
				'-icon-volume-up',
				'-icon-warning-sign',
				'-icon-wrench',
				'-icon-zoom-in',
				'-icon-zoom-out',
			),

			'text_editor'	=> array(
				'-icon-file',
				'-icon-file-alt',
				'-icon-cut',
				'-icon-copy',
				'-icon-paste',
				'-icon-save',
				'-icon-undo',
				'-icon-repeat',
				'-icon-text-height',
				'-icon-text-width',
				'-icon-align-left',
				'-icon-align-center',
				'-icon-align-right',
				'-icon-align-justify',
				'-icon-indent-left',
				'-icon-indent-right',
				'-icon-font',
				'-icon-bold',
				'-icon-italic',
				'-icon-strikethrough',
				'-icon-underline',
				'-icon-link',
				'-icon-paper-clip',
				'-icon-columns',
				'-icon-table',
				'-icon-th-large',
				'-icon-th',
				'-icon-th-list',
				'-icon-list',
				'-icon-list-ol',
				'-icon-list-ul',
				'-icon-list-alt',
			),

			'directional'	=> array(
				'-icon-angle-left',
				'-icon-angle-right',
				'-icon-angle-up',
				'-icon-angle-down',
				'-icon-arrow-down',
				'-icon-arrow-left',
				'-icon-arrow-right',
				'-icon-arrow-up',
				'-icon-caret-down',
				'-icon-caret-left',
				'-icon-caret-right',
				'-icon-caret-up',
				'-icon-chevron-down',
				'-icon-chevron-left',
				'-icon-chevron-right',
				'-icon-chevron-up',
				'-icon-circle-arrow-down',
				'-icon-circle-arrow-left',
				'-icon-circle-arrow-right',
				'-icon-circle-arrow-up',
				'-icon-double-angle-left',
				'-icon-double-angle-right',
				'-icon-double-angle-up',
				'-icon-double-angle-down',
				'-icon-hand-down',
				'-icon-hand-left',
				'-icon-hand-right',
				'-icon-hand-up',
				'-icon-circle',
				'-icon-circle-blank',
			),

			'video_player'	=> array(
				'-icon-play-circle',
				'-icon-play',
				'-icon-pause',
				'-icon-stop',
				'-icon-step-backward',
				'-icon-fast-backward',
				'-icon-backward',
				'-icon-forward',
				'-icon-fast-forward',
				'-icon-step-forward',
				'-icon-eject',
				'-icon-fullscreen',
				'-icon-resize-full',
				'-icon-resize-small',
			),

			'social'	=> array(
				'-icon-phone',
				'-icon-phone-sign',
				'-icon-facebook',
				'-icon-facebook-sign',
				'-icon-twitter',
				'-icon-twitter-sign',
				'-icon-github',
				'-icon-github-alt',
				'-icon-github-sign',
				'-icon-linkedin',
				'-icon-linkedin-sign',
				'-icon-pinterest',
				'-icon-pinterest-sign',
				'-icon-google-plus',
				'-icon-google-plus-sign',
				'-icon-sign-blank'
			),

			'medical'	=> array(
				'-icon-ambulance',
				'-icon-beaker',
				'-icon-h-sign',
				'-icon-hospital',
				'-icon-medkit',
				'-icon-plus-sign-alt',
				'-icon-stethoscope',
				'-icon-user-md'
			),
		);
	}

	public function display($cat_handle = 'icon_cat', $icon_handle = 'icon')
	{
		$icons_ary = $this->get();
		foreach ($icons_ary as $cat => $icons)
		{
			$this->template->assign_block_vars($cat_handle, array(
                'NAME'	=> $cat,
                'TITLE'	=> $this->user->lang[strtoupper($cat)])
            );

			for ($i = 0, $size = sizeof($icons); $i < $size; $i++)
			{
				$this->template->assign_block_vars($cat_handle . '.' . $icon_handle, array('NAME' => $icons[$i]));
			}
		}
	}
}
