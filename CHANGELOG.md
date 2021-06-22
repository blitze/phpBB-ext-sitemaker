# Changelog

## 3.4.0 - 2021-06-22

-   [feature] Navbar designer/manager
-   [feature] Add Recent Topics block
-   [feature] Add Popular Topics block
-   [feature] Forum specific blocks
-   [feature] Add legend to Whois block
-   [feature] Ability to show blocks to only certain groups or exlude certain groups from viewing blocks
-   Enable topic tracking by default on forum blocks
-   Fix permission issues when adding/editing blocks/menus
-   Improve sidebar width stepper for custom layout
-   Correctly show uploaded images on route and non-route pages
-   Minor bug fixes

## 3.3.2 - 2020-11-25

-   Add support for headers and dividers to Links block
-   Fix display issues for lists as a result of templating change

## 3.3.0 - 2020-11-16

-   Rollback support for fontawesome5 since phpbb has rolled back
-   Better support for other phpBB styles (WIP)
-   Removed support for Responsive Filemanage as phpBB extension rules prohibit optional dependencies
-   Removed noreferrer from external links
-   Improved list display and list modifiers for block content
-   Use error boundary to prevent block issues from breaking site
-   Fix compatibility issues with extensions that use autowire for service container

## 3.2.2 - 2020-09-17

-   Support for fontawesome 5
-   Fix issue with permission keys being added after uninstalling app
-   Grant sitemaker admin rights to Administrators group

## 3.2.1 - 2020-01-16

-   Support for phpBB 3.3

## 3.2.0 - 2019-10-26

-   Switched from Bower/Gulp workflow to npm/yarn/babel/webpack
-   [feature] Use code splitting and dynamic imports to reduce js/css bundle sizes (webpack)
-   [feature] Added Google maps block
-   [feature] Added RSS/Atom feeds block with ability to set display template (uses simplepie)
-   [feature] Added block modifiers to enforce image aspect ratio (1x1, 4x3, 16x9)
-   [feature] We no longer automatically delete orphaned blocks/routes/styles via cron as there are false positives. Give admin control over orphaned blocks
-   Upgraded to Tinymce 5
-   Switch Tinymce to distraction free mode
-   Display Tinymce in users language if translation is available
-   Upgraded to support Responsive Filemanager 9.14.0
-   Ensure Admin Bar and menu items are fully responsive
-   Switched to flexbox grid (gridlex) for layout
-   [feature] Added ability to add js/css files to page using Custom block
-   [feature] Added code editor block config type using codemirror
-   [bug] Fix issue that returned ajax error when marking forums read: https://www.phpbb.com/customise/db/extension/phpbb_sitemaker_2/support/topic/198911
-   [feature] Add new Custom Layout that allows you to set sidebar widths
-   [feature] Recent Forum topics block now uses the 'Context' setting to point to first or last post
-   Created new localized documentation site
-   Provide links to documentation site directly from the extension with english fallback if translation is not available
-   Several other minor bug and display fixes
-   [feature] Added twig filter to use phpBB's format_date function in template files e.g. {{ TOPIC_TIME|format_date('M d, Y') }}

## 3.1.1 - 2018-6-9

-   Fixed several bugs that caused the extension to fail in php 7.2
-   Upgraded to Tinymce 4.7.13
-   Upgraded to support Responsive Filemanager 9.13.1
-   Use user lang and timezone preferences to display filemanager in correct language and timezone
-   Fix issues with saving filemanager settings
-   Provide means to automatically update filemanager config while retaining existing settings
-   Remove max limit of 20 for blocks. So now you can have blocks that display more than 20 items
-   Prevent form token conflicts - thanks kasimi
-   Fixed bug that made it impossible to select multiple items in a multi-select dropdown in block settings
-   Fixed several other minor bugs

## 3.1.0 - 2017-9-26

-   Added horizontal navbar
-   Added support for Responsive Filemanager for uploading, browsing, and editing images. See instructions in the docs
-   Add event to display acp settings form (blitze.sitemaker.acp_display_settings_form)
-   Add event to save acp settings form (blitze.sitemaker.acp_save_settings)
-   Only rename board index to 'home' if a custom start page is set
-   Update to twig syntax
-   Make 'hide all blocks' feature work again
-   Fixed issue that made it impossible to select forum navbar icon in acp
-   Fixed issue with uinstalling/re-enabling the extension (phpbb_sm_blocks does not exist)
-   Renamed event blitze_sitemaker.modify_block_positions to blitze.sitemaker.modify_block_positions
-   Renamed event blitze_sitemaker.modify_rendered_block to blitze.sitemaker.modify_rendered_block

## 3.0.1 - 2017-3-17

-   Added holy grail layout (fixed-width sidebars with flexible middle column)
-   Updated responsive design to more standard responsive design patterns (no more floating sidebars)
-   Added event to modify block positions (blitze_sitemaker.modify_block_positions)
-   Added event to modify a rendered block (blitze_sitemaker.modify_rendered_block)
-   Added javascript events for when blocks are added or updated, or layout is changed

## 3.0.0 - 2017-3-17

-   Support for phpBB 3.2.x
-   Ability to choose icon for 'Forum' in navbar
-   Ability to hide phpBB's login, birthday, and who's online boxes on forum index in ACP
-   Ability to choose default block type (simple, boxed, or borderless) in ACP
-   Ability to choose block type (simple, boxed, or borderless) per block

## 2.0.4 - 2016-10-3

-   Fix issue with massive topic icons and smiles
-   Allow sub-folders as menu items
-   Fix some drag & drop issues after deleting a block
-   Only hide who is online on forum index if whois block is enabled
-   Only hide birthday if birthday block is enabled
-   Only hide stats if stats block is enabled
-   Use codemirror instead of ace editor
-   Add classes to show/hide blocks on small devices
-   Fix relative paths in blocks contents returned via ajax
-   Put main content before sidebar in html structure for better SEO
-   Fix some issues with posting raw html content via ajax
-   Force expand menu item if child items are unreachable
-   Do not add session id to external URLs and directories
-   Show last poster by default on Recent topics block
-   Match phpBB's newest member in Recent Member block
-   Fix issues with block display types for parent/child routes
-   In edit mode, visually reveal blocks that will not be displayed outside of edit mode due to inactive status or no content

## 2.0.3 - 2016-07-28

-   First release
