---
title: phpBBサイトメーカーのイベント
sidebar_position: 2
---

phpBBのイベントシステムを使ってphpBB SiteMakerの動作を変更できます。

## PHPイベント

### blitze.sitemaker.acp_add_bulk_menu_options

-   場所: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
-   以降: 3.1.0
-   目的: 一括メニューオプションを acp メニューに追加

### blitze.sitemaker.acp_display_settings_form

-   場所: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   以降: 3.1.0
-   目的: acp (sitemaker) 設定フォームの表示

### blitze.sitemaker.acp_save_settings

-   場所: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   以降: 3.1.0
-   目的: acp (sitemaker) 設定を保存

### blitze.sitemaker.admin_bar.set_assets

-   場所: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
-   以降: 3.0.1-RC1
-   目的: 編集モードで利用可能なブロックにアセットを追加

### blitze.sitemaker.modify_block_positions

-   場所: /phpBB/ext/blitze/sitemaker/services/blocks.php
-   以降: 3.0.1-RC1
-   目的: ブロック位置の変更

### blitze.sitemaker.modify_rendered_block

-   場所: /phpBB/ext/blitze/sitemaker/services/blocks.php
-   以降: 3.0.1-RC1
-   目的: レンダリングされたブロックを変更

## テンプレートイベント

### blitze_sitemaker_acp_settings

-   場所: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
-   以降: 3.1.0
-   目的: サイトマッカー設定用のフォームフィールドを追加

### blitze_sitemaker_admin_bar_append

-   場所: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   以降: 3.1.0
-   目的: 管理バーにメニュー項目を追加

### blitze_sitemaker_admin_bar_templates

-   場所: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   以降: 3.1.0
-   目的: ブロックビューなどの JS で使用するテンプレートファイルを追加

## Javascriptイベント

### blitze_sitemaker_layout_saved

-   場所: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
-   以降: 3.1.2
-   目的: レイアウトの変更が保存されたときに他の拡張機能が何かを行うことを許可するイベント

### blitze_sitemaker_render_block_before

-   場所: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   以降: 3.1.2
-   目的: ブロックがレンダリングされる前に他の拡張機能が何かを行えるようにするイベント、または再レンダリングされないようにするイベント

### blitze_sitemaker_render_block_after

-   場所: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   以降: 3.1.2
-   目的: ブロックがレンダリングされた後に他の拡張機能が何かを行えるようにするイベント

### blitze_sitemaker_save_block_before

-   場所: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
-   以降: 3.1.2
-   目的: 他の拡張機能がブロックデータを保存する前に変更できるイベント

### blitze_sitemaker_show_all_block_positions

-   場所: /phpBB/ext/blitze/sitemaker/develop/components/Positions.js
-   以降: 3.1.2
-   目的: すべてのブロック位置が表示されているときに他の拡張機能が何かを行うことを許可するイベント

### blitze_sitemaker_hide_empty_block_positions

-   場所: /phpBB/ext/blitze/sitemaker/develop/components/Positions.js
-   以降: 3.1.2
-   目的: 空の位置が非表示の場合、他の拡張機能が何かを行えるようにするイベント

### blitze_sitemaker_layout_clear

-   場所: /phpBB/ext/blitze/sitemaker/develop/components/Positions.js
-   以降: 3.1.2
-   目的: レイアウトがクリアされたときに他の拡張機能が何かを行えるようにするイベント

### blitze_sitemaker_layout_updated

-   場所: /phpBB/ext/blitze/sitemaker/develop/components/Positions.js
-   以降: 3.1.2
-   目的: レイアウトが更新されたときに他の拡張機能が何かを行うことを許可するイベント

### blitze_sitemaker_tinymce_options

-   場所: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
-   以降: 3.3.0
-   目的: 他のエクステンションがtinymceオプションを変更できるようにするイベント
