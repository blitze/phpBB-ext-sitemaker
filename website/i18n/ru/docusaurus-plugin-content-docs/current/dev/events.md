---
title: phpBB События чайник сайта
sidebar_position: 2
---

Вы можете изменить поведение phpBB SiteMaker с помощью системы событий phpBB.

## События PHP

### blitze.sitemaker.acp_add_bulk_menu_options

-   Местонахождение: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
-   с: 3.1.0
-   Цель: добавить массовые параметры меню в acp меню

### blitze.sitemaker.acp_display_settings_form

-   Местонахождение: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   с: 3.1.0
-   Цель: отображение acp (sitemaker) настройки формы

### blitze.sitemaker.acp_save_settings

-   Местонахождение: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   с: 3.1.0
-   Цель: Сохранить acp (сайт-мейкер)

### blitze.sitemaker.admin_bar.set_assets

-   Расположение: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
-   с: 3.0.1-RC1
-   Цель: Добавить медиафайлы для доступных блоков в режиме редактирования

### blitze.sitemaker.modify_block_positions

-   Расположение: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   с: 3.0.1-RC1
-   Цель: Изменение позиций блока

### blitze.sitemaker.modify_rendered_block

-   Расположение: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   с: 3.0.1-RC1
-   Цель: изменить рендеринг блока

## События шаблона

### blitze_sitemaker_acp_settings

-   Расположение: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
-   с: 3.1.0
-   Цель: Добавить поля формы для настройки sitemaker

### blitze_sitemaker_admin_bar_add

-   Расположение: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   с: 3.1.0
-   Цель: Добавить пункты меню в панель администратора

### blitze_sitemaker_admin_bar_templates

-   Расположение: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   с: 3.1.0
-   Цель: Добавить файлы шаблонов для использования в JS для просмотра блоков и т.д.

## События JavaScript

### blitze_sitemaker_layout_сохранен

-   Местонахождение: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
-   с: 3.1.2
-   Цель: событие, позволяющее другим расширениям делать что-то при сохранении изменений

### blitze_sitemaker_render_block_перед

-   Местонахождение: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   с: 3.1.2
-   Цель: событие, позволяющее другим расширениям сделать что-нибудь, прежде чем блок будет отображен или не будет отображен повторно

### blitze_sitemaker_render_block_после

-   Местонахождение: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   с: 3.1.2
-   Цель: событие для разрешения другим расширениям сделать что-то после отображения блока

### blitze_sitemaker_save_block_раньше

-   Местонахождение: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
-   с: 3.1.2
-   Цель: событие для разрешения другим расширениям изменять данные блока перед сохранением

### blitze_sitemaker_show_all_block_positions

-   Местонахождение: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   с: 3.1.2
-   Цель: событие, позволяющее другим расширениям делать что-нибудь, когда отображаются все позиции блока

### blitze_sitemaker_hide_empty_block_positions

-   Местонахождение: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   с: 3.1.2
-   Цель: событие, позволяющее другим расширениям делать что-нибудь, когда пустые позиции скрыты

### blitze_sitemaker_layout_очищено

-   Местонахождение: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   с: 3.1.2
-   Цель: событие, позволяющее другим расширениям делать что-нибудь, когда макет очищен

### blitze_sitemaker_layout_обновлено

-   Местонахождение: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   с: 3.1.2
-   Цель: событие, позволяющее другим расширениям делать что-то при обновлении макета

### blitze_sitemaker_tinymce_options

-   Местонахождение: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
-   с: 3.3.0
-   Цель: событие для разрешения других расширений для изменения параметров на тиме
