---
id: события разработчика
title: phpBB SiteMaker события
---

Вы можете изменить поведение phpBB SiteMaker, используя систему событий phpBB.

## События PHP

# blitze.sitemaker.acp_add_bulk_menu_options

- Расположение: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- С момента: 3.1.0
- Цель: Добавить опции массового меню в acp меню

# blitze.sitemaker.acp_display_settings_form

- Расположение: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- С момента: 3.1.0
- Цель: отображение формы настроек acp (sitemaker)

# blitze.sitemaker.acp_save_settings

- Расположение: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- С момента: 3.1.0
- Цель: Сохранить настройки acp (sitemaker)

# blitze.sitemaker.admin_bar.set_assets

- Расположение: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- После: 3.0.1-RC1
- Цель: Добавить активы для доступных блоков в режиме редактирования

# blitze.sitemaker.modify_block_positions

- Расположение: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- После: 3.0.1-RC1
- Цель: Изменить позиции блока

# blitze.sitemaker.modify_rendered_block

- Расположение: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- После: 3.0.1-RC1
- Цель: Изменить визуализированный блок

## События шаблона

# blitze_sitemaker_acp_settings

- Расположение: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- С момента: 3.1.0
- Цель: Добавить поля формы для настроек sitemaker

# blitze_sitemaker_admin_bar_append

- Расположение: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- С момента: 3.1.0
- Цель: Добавить пункты меню в панель администратора

# blitze_sitemaker_admin_bar_templates

- Расположение: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- С момента: 3.1.0
- Цель: Добавить файлы шаблонов для использования в JS для просмотра блоков и т. д

## События JavaScript

# blitze_sitemaker_layout_сохранен

- Расположение: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- После: 3.1.2
- Цель: событие, позволяющее другим расширениям делать что-то, когда изменения макета сохраняются

# blitze_sitemaker_render_block_before

- Расположение: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- После: 3.1.2
- Цель: событие, позволяющее другим расширениям делать что-то до того, как блок будет выведен или не допустить его повторного отображения

# blitze_sitemaker_render_block_after

- Расположение: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- После: 3.1.2
- Цель: событие, позволяющее другим расширениям делать что-то после показа блока

# blitze_sitemaker_save_block_before

- Расположение: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- После: 3.1.2
- Цель: событие, позволяющее другим расширениям изменять данные блока перед сохранением

# blitze_sitemaker_show_all_block_positions

- Расположение: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- После: 3.1.2
- Цель: событие, позволяющее другим расширениям делать что-то, когда отображаются все позиции блоков

# blitze_sitemaker_hide_empty_block_positions

- Расположение: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- После: 3.1.2
- Цель: событие, позволяющее другим расширениям делать что-то, когда пустые позиции скрыты

# blitze_sitemaker_layout_cleared

- Расположение: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- После: 3.1.2
- Цель: событие, позволяющее другим расширениям делать что-то, когда макет очищен

# blitze_sitemaker_layout_updated

- Расположение: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- После: 3.1.2
- Цель: событие, позволяющее другим расширениям делать что-то, когда макет обновляется

# blitze_sitemaker_tinymce_options

- Местонахождение: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- с: 3.3.0
- Цель: событие для разрешения других расширений для изменения параметров на тиме