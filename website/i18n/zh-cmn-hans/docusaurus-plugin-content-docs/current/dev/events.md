---
title: phpBB 站点Maker 事件
sidebar_position: 2
---

您可以使用 phpBB 的事件系统修改 phpBB 站点Maker 的行为。

## PHP 事件

### bulk_menu_options

-   位置： /phpBB/ext/blitze/sitemaker/acp/menu_module.php
-   自： 3.1.0
-   目的：在acp 菜单中添加批量菜单选项

### 显示设置

-   位置： /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   自： 3.1.0
-   目的：显示acp (站点制造商) 设置表

### sitemaker.acp_save_save_settings，

-   位置： /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   自： 3.1.0
-   目的: 保存acp (站点制作者) 设置

### beyrouth.sitemaker.admin_bar.set_assets

-   位置： /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
-   自： 3.0.1-RC1
-   目的：在编辑模式下为可用方块添加资源

### 修改方块位置

-   位置： /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php。
-   自： 3.0.1-RC1
-   目的：修改方块位置

### 修改渲染块

-   位置： /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php。
-   自： 3.0.1-RC1
-   目的：修改渲染块

## 模板事件

### 闪电_sitemaker_acp_settings

-   位置： /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
-   自： 3.1.0
-   目的：为站点制造商设置添加表单字段

### 闪电_sitemaker_admin_bar_追加方案

-   位置： /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   自： 3.1.0
-   目的：将菜单项添加到管理栏

### 闪电_sitemaker_admin_bar_templates

-   位置： /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   自： 3.1.0
-   目的：添加用于块视图的 JS 模板文件等

## Javascript 事件

### 已保存的 sitemaker_layout

-   位置： /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
-   自：3.1.2
-   目的：当布局更改被保存时，允许其他扩展进行某些操作

### 之前闪电_sitemaker_render_block_force

-   位置： /phpBB/ext/blitze/sitemaker/develop/components/BlockRender/index.js
-   自：3.1.2
-   目的：允许其它扩展在方块呈现之前做一些事情或防止其被重新渲染的事件

### 闪电_sitemaker_render_block_after

-   位置： /phpBB/ext/blitze/sitemaker/develop/components/BlockRender/index.js
-   自：3.1.2
-   目的：允许其它扩展在块呈现后做某件事的事件

### 之前闪电_sitemaker_save_block_bloc

-   位置： /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
-   自：3.1.2
-   目的：事件允许其他扩展在保存前修改块数据

### 闪电_sitemaker_show_all_block_位置

-   位置： /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   自：3.1.2
-   目的：当所有方块位置显示时，允许其他扩展做某些事情的事件

### 闪电_sitemaker_hide_empty_block_position

-   位置： /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   自：3.1.2
-   目的：当空白位置被隐藏时，允许其他扩展进行某些操作的事件

### 闪电_sitemaker_layout_cleared

-   位置： /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   自：3.1.2
-   目的：当布局被清理时，允许其他扩展进行某些操作

### 闪电_sitemaker_layout_updated

-   位置： /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   自：3.1.2
-   目的：当布局更新时，允许其他扩展做某些事情的事件

### 闪烁_sitemaker_tinymce_options

-   位置： /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
-   自： 3.3.0
-   目的：允许其他扩展修改tinymce选项的事件
