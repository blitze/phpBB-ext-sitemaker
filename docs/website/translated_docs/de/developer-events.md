---
id: Entwicklerevents
title: phpBB SiteMaker Events
---

Sie können das Verhalten von phpBB SiteMaker mit phpBB's Eventsystem ändern.

## PHP-Ereignisse

# blitze.sitemaker.acp_add_bulk_menu_options

- Ort: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- Seit: 3.1.0
- Zweck: Bulk-Menü-Optionen im Akp-Menü hinzufügen

# blitze.sitemaker.acp_display_settings_form

- Ort: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Seit: 3.1.0
- Zweck: Anzeige Akp (Sitemaker) Einstellungsformular

# blitze.sitemaker.acp_save_settings

- Ort: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Seit: 3.1.0
- Zweck: acp (sitemaker) Einstellungen speichern

# blitze.sitemaker.admin_bar.set_assets

- Ort: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- Seit: 3.0.1-RC1
- Zweck: Assets für verfügbare Blöcke im Bearbeitungsmodus hinzufügen

# blitze.sitemaker.modify_block_position

- Ort: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Seit: 3.0.1-RC1
- Zweck: Blockpositionen ändern

# blitze.sitemaker.modify_rendered_block

- Ort: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Seit: 3.0.1-RC1
- Zweck: Bearbeite einen gerenderten Block

## Vorlagenereignisse

# blitze_sitemaker_acp_settings

- Lage: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- Seit: 3.1.0
- Zweck: Formularfelder für Sitemaker-Einstellungen hinzufügen

# blitze_sitemaker_admin_bar_append

- Ort: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Seit: 3.1.0
- Zweck: Menüeinträge zur Admin-Leiste hinzufügen

# blitze_sitemaker_admin_bar_templates

- Ort: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Seit: 3.1.0
- Zweck: Füge Template-Dateien hinzu, die in JS für Block-Ansichten verwendet werden, etc

## Javascript-Ereignisse

# blitze_sitemaker_layout_saved

- Ort: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- Seit: 3.1.2
- Zweck: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, wenn Layout-Änderungen gespeichert werden

# blitze_sitemaker_render_block_before

- Ort: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Seit: 3.1.2
- Zweck: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, bevor der Block gerendert wird oder um zu verhindern, dass er wiedergegeben wird

# blitze_sitemaker_render_block_after

- Ort: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Seit: 3.1.2
- Zweck: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, nachdem der Block gerendert wurde

# blitze_sitemaker_save_block_before

- Ort: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- Seit: 3.1.2
- Zweck: Ereignis, um anderen Erweiterungen zu erlauben, Blockdaten zu ändern, bevor sie gespeichert werden

# blitze_sitemaker_show_all_block_position

- Lage: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Seit: 3.1.2
- Zweck: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, wenn alle Blockpositionen angezeigt werden

# blitze_sitemaker_hide_empty_block_position

- Lage: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Seit: 3.1.2
- Zweck: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, wenn leere Positionen versteckt sind

# blitze_sitemaker_layout_cleared

- Lage: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Seit: 3.1.2
- Zweck: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, wenn das Layout gelöscht wird

# blitze_sitemaker_layout_updated

- Lage: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Seit: 3.1.2
- Zweck: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, wenn das Layout aktualisiert wird

# blitze_sitemaker_tinymce_options

- Ort: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- Mehr noch: 3.3.0
- Zweck: Ereignis um anderen Erweiterungen zu erlauben, Tinkymce-Optionen zu ändern