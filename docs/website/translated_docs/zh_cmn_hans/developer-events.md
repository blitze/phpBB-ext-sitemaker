---
id: 开发者事件
title: phpBB SiteMaker 事件
---

你可以使用 phpBB 的事件系统修改 phpBB SiteMaker 的行为。

## PHP 事件

# 添加_批量_菜单选项

- 位置： /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- 自：3.1.0
- 目的：在菜单中添加批量菜单选项

# sitemaker.acp_display_settings_form

- 位置： /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- 自：3.1.0
- 目的：显示acp (sitemaker) 设置表单

# 保存设置

- 位置： /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- 自：3.1.0
- 目的：保存acp (sitemaker) 设置

# 设置 blitze.sitemaker.admin_bar.set_assets

- 位置： /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- 自：3.0.1-RC1
- 目的：在编辑模式中为可用区块添加资源

# 修改_block_positions

- 位置： /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- 自：3.0.1-RC1
- 目的：修改区块位置

# 修改_replication_block

- 位置： /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- 自：3.0.1-RC1
- 目的：修改渲染块

## 模板事件

# blitze_sitemaker_acp_settings

- 位置： /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- 自：3.1.0
- 目的：为站点地图器设置添加表单字段

# blitze_sitemaker_admin_bar_append

- 位置： /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- 自：3.1.0
- 目的：添加菜单项到管理栏

# blitze_sitemaker_admin_bar_templates

- 位置： /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- 自：3.1.0
- 目的：添加模板文件，用于 JS 用于块视图等

## Javascript 事件

# blitze_sitemaker_lang_已保存

- 位置： /phpBB/ext/blitze/sitemaker/development/components/AdminBar/SaveGroup/index.js
- 自：3.1.2
- 目的：事件，允许其他扩展在保存布局更改时做一些事情

# Britze_sitemaker_render_block_before

- 位置： /phpBB/ext/blitze/sitemaker/development/components/BlockRenderer/index.js
- 自：3.1.2
- 目的

# 闪烁_sitemaker_render_block_after

- 位置： /phpBB/ext/blitze/sitemaker/development/components/BlockRenderer/index.js
- 自：3.1.2
- 目的

# blitze_sitemaker_save_block_before

- 位置： /phpBB/ext/blitze/sitemaker/development/components/BlocksManager/Edit/index.js
- 自：3.1.2
- 目的：活动允许其他扩展以在保存前修改区块数据

# blitze_sitemaker_show_all_block_positions

- 位置： /phpBB/ext/blitze/sitemaker/development/components/positions/positions.js
- 自：3.1.2
- 目的：当显示所有方块位置时，允许其他扩展活动

# blitze_sitemaker_隐藏_空_block_positions

- 位置： /phpBB/ext/blitze/sitemaker/development/components/positions/positions.js
- 自：3.1.2
- 目的：当隐藏空位置时，允许其他扩展活动

# 已清除

- 位置： /phpBB/ext/blitze/sitemaker/development/components/positions/positions.js
- 自：3.1.2
- 目的：活动允许其他扩展在布局清除时做一些事情

# 更新 blitze_sitemaker_lang_

- 位置： /phpBB/ext/blitze/sitemaker/development/components/positions/positions.js
- 自：3.1.2
- 目的：事件允许其他扩展在布局更新时做一些事情

# 闪烁_sitemaker_tinymce_options

- 位置： /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- 自： 3.3.0
- 目的：允许其他扩展修改tinymce选项的事件