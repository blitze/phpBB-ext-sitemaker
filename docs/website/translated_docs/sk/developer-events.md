---
id: developer-events
title: phpBB SiteMaker Events
---
You can modify the behavior of phpBB SiteMaker using phpBB's event system.

## PHP Events

# blitze.sitemaker.acp_add_bulk_menu_options

* Location: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
* Since: 3.1.0
* Purpose: Add bulk menu options in acp menu

# blitze.sitemaker.acp_display_settings_form

* Location: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
* Since: 3.1.0
* Purpose: display acp (sitemaker) settings form

# blitze.sitemaker.acp_save_settings

* Location: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
* Since: 3.1.0
* Purpose: Save acp (sitemaker) settings

# blitze.sitemaker.admin_bar.set_assets

* Location: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
* Since: 3.0.1-RC1
* Purpose: Add assets for available blocks in edit mode

# blitze.sitemaker.modify_block_positions

* Location: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
* Since: 3.0.1-RC1
* Purpose: Modify block positions

# blitze.sitemaker.modify_rendered_block

* Location: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
* Since: 3.0.1-RC1
* Purpose: Modify a rendered block

## Template Events

# blitze_sitemaker_acp_settings

* Location: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
* Since: 3.1.0
* Purpose: Add form fields for sitemaker settings

# blitze_sitemaker_admin_bar_append

* Location: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
* Since: 3.1.0
* Purpose: Add menu items to admin bar

# blitze_sitemaker_admin_bar_templates

* Location: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
* Since: 3.1.0
* Purpose: Add template files to be used in JS for block views, etc

## Javascript Events

# blitze_sitemaker_layout_saved

* Location: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
* Since: 3.1.2
* Purpose: Event to allow other extensions to do something when layout changes are saved

# blitze_sitemaker_render_block_before

* Location: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
* Since: 3.1.2
* Purpose: Event to allow other extensions to do something before block is rendered or prevent it from being re-rendered

# blitze_sitemaker_render_block_after

* Location: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
* Since: 3.1.2
* Purpose: Event to allow other extensions to do something after block is rendered

# blitze_sitemaker_save_block_before

* Location: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
* Since: 3.1.2
* Purpose: Event to allow other extensions to modify block data before it is saved

# blitze_sitemaker_show_all_block_positions

* Location: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
* Since: 3.1.2
* Purpose: Event to allow other extensions to do something when all block positions are shown

# blitze_sitemaker_hide_empty_block_positions

* Location: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
* Since: 3.1.2
* Purpose: Event to allow other extensions to do something when empty positions are hidden

# blitze_sitemaker_layout_cleared

* Location: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
* Since: 3.1.2
* Purpose: Event to allow other extensions to do something when layout is cleared

# blitze_sitemaker_layout_updated

* Location: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
* Since: 3.1.2
* Purpose: Event to allow other extensions to do something when layout is updated