# phpBB SiteMaker Events

You can modify the behavior of phpBB SiteMaker using phpBB's event system.

## Table of Contents

- [PHP Events](#php-events)
  * [blitze.sitemaker.acp_add_bulk_menu_options](#blitzesitemakeracp_add_bulk_menu_options)
  * [blitze.sitemaker.acp_display_settings_form](#blitzesitemakeracp_display_settings_form)
  * [blitze.sitemaker.acp_save_settings](#blitzesitemakeracp_save_settings)
  * [blitze.sitemaker.admin_bar.set_assets](#blitzesitemakeradmin_barset_assets)
  * [blitze.sitemaker.modify_block_positions](#blitzesitemakermodify_block_positions)
  * [blitze.sitemaker.modify_rendered_block](#blitzesitemakermodify_rendered_block)
- [Template Events](#template-events)
  * [blitze_sitemaker_acp_settings](#blitze_sitemaker_acp_settings)
  * [blitze_sitemaker_admin_bar_append](#blitze_sitemaker_admin_bar_append)
  * [blitze_sitemaker_admin_bar_templates](#blitze_sitemaker_admin_bar_templates)
- [Javascript Events](#javascript-events)
  * [blitze_sitemaker_showAllBlockPositions](#blitze_sitemaker_showallblockpositions)
  * [blitze_sitemaker_hideEmptyBlockPositions](#blitze_sitemaker_hideemptyblockpositions)
  * [blitze_sitemaker_renderBlock_before](#blitze_sitemaker_renderblock_before)
  * [blitze_sitemaker_renderBlock_after](#blitze_sitemaker_renderblock_after)
  * [blitze_sitemaker_layout_changed](#blitze_sitemaker_layout_changed)

## PHP Events

blitze.sitemaker.acp_add_bulk_menu_options
===
* Location: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
* Since: 3.1.0
* Purpose: Add bulk menu options in acp menu

blitze.sitemaker.acp_display_settings_form
===
* Location: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
* Since: 3.1.0
* Purpose: display acp (sitemaker) settings form

blitze.sitemaker.acp_save_settings
===
* Location: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
* Since: 3.1.0
* Purpose: Save acp (sitemaker) settings

blitze.sitemaker.admin_bar.set_assets
===
* Location: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
* Since: 3.0.1-RC1
* Purpose: Add assets for available blocks in edit mode

blitze.sitemaker.modify_block_positions
===
* Location: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
* Since: 3.0.1-RC1
* Purpose: Modify block positions

blitze.sitemaker.modify_rendered_block
===
* Location: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
* Since: 3.0.1-RC1
* Purpose: Modify a rendered block

## Template Events

blitze_sitemaker_acp_settings
===
* Location: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
* Since: 3.1.0
* Purpose: Add form fields for sitemaker settings

blitze_sitemaker_admin_bar_append
===
* Location: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
* Since: 3.1.0
* Purpose: Add menu items to admin bar

blitze_sitemaker_admin_bar_templates
===
* Location: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
* Since: 3.1.0
* Purpose: Add template files to be used in JS for block views, etc

## Javascript Events

blitze_sitemaker_showAllBlockPositions
===
* Location: /phpBB/ext/blitze/sitemaker/develop/blocks/manager.js
* Since: 3.0.1
* Purpose: Modify blocks positions and/or empty positions when drag and drop is started

blitze_sitemaker_hideEmptyBlockPositions
===
* Location: /phpBB/ext/blitze/sitemaker/develop/blocks/manager.js
* Since: 3.0.1
* Purpose: Modify blocks positions and/or empty positions when drag and drop has stopped

blitze_sitemaker_renderBlock_after
===
* Location: /phpBB/ext/blitze/sitemaker/develop/blocks/manager.js
* Since: 3.0.1
* Purpose: Do something after block is rendered when adding/editing/previewing block

blitze_sitemaker_renderBlock_before
===
* Location: /phpBB/ext/blitze/sitemaker/develop/blocks/manager.js
* Since: 3.0.1
* Purpose: Modify block data when adding/editing/previewing block

blitze_sitemaker_layout_changed
===
* Location: /phpBB/ext/blitze/sitemaker/develop/blocks/manager.js
* Since: 3.0.1
* Purpose: Triggered when layout has changed either because a block was added/deleted/moved
