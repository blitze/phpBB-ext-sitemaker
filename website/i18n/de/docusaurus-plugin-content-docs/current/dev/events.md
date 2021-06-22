---
title: phpBB SiteMaker Ereignisse
sidebar_position: 2
---

Sie können das Verhalten von phpBB SiteMaker über das Ereignissystem von phpBB ändern.

## PHP-Ereignisse

### blitze.sitemaker.acp_add_bulk_menu_options

-   Ort: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
-   Mehr noch: 3.1.0
-   Zweck: Fügen Sie Massen-Menüoptionen im Acp-Menü hinzu

### blitze.sitemaker.acp_display_settings_form

-   Ort: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Mehr noch: 3.1.0
-   Zweck: Anzeige acp (Sitemaker) Einstellungsformular

### blitze.sitemaker.acp_save_settings

-   Ort: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Mehr noch: 3.1.0
-   Verwendung: Speichere acp (Sitemaker) Einstellungen

### blitze.sitemaker.admin_bar.set_assets

-   Ort: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
-   Seite: 3.0.1-RC1
-   Zweck: Füge Assets für verfügbare Blöcke im Bearbeitungsmodus hinzu

### blitze.sitemaker.modify_block_Positionen

-   Ort: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Seite: 3.0.1-RC1
-   Zweck: Blockpositionen ändern

### blitze.sitemaker.modify_rendered_block

-   Ort: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Seite: 3.0.1-RC1
-   Zweck: Ändere einen gerenderten Block

## Vorlagenereignisse

### blitze_sitemaker_acp_Einstellungen

-   Ort: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
-   Mehr noch: 3.1.0
-   Ziel: Füge Formularfelder für Sitemaker-Einstellungen hinzu

### blitze_sitemaker_admin_bar anhängen

-   Ort: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Mehr noch: 3.1.0
-   Zweck: Füge Menüpunkte zur Adminleiste hinzu

### blitze_sitemaker_admin_bar_templates

-   Ort: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Mehr noch: 3.1.0
-   Zweck: Füge Template-Dateien hinzu, die in JS für Blockansichten verwendet werden sollen usw.

## Javascript-Ereignisse

### speicherte Sitemaker_Layout

-   Ort: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
-   Mehr noch: 3.1.2
-   Verwendung: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, wenn Layoutänderungen gespeichert werden

### blitze_sitemaker_render_block_vor

-   Ort: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Mehr noch: 3.1.2
-   Zweck: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, bevor der Block gerendert wird, oder um zu verhindern, dass er neu gerendert wird

### blitze_sitemaker_render_block_nach

-   Ort: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Mehr noch: 3.1.2
-   Verwendung: Ereignis, um anderen Erweiterungen zu erlauben, etwas nach dem Block zu tun wird gerendert

### save_block_vor sitemaker_save_blocker

-   Ort: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
-   Mehr noch: 3.1.2
-   Verwendung: Ereignis um anderen Erweiterungen das Ändern von Blockdaten zu gestatten, bevor sie gespeichert werden

### blitze_sitemaker_alle Blockpositionen anzeigen

-   Lage: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Mehr noch: 3.1.2
-   Verwendung: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, wenn alle Blockpositionen angezeigt werden

### blitze_sitemaker_leere Blockpositionen verstecken

-   Lage: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Mehr noch: 3.1.2
-   Verwendung: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, wenn leere Positionen versteckt sind

### blitze_sitemaker_layout_cleared

-   Lage: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Mehr noch: 3.1.2
-   Verwenden: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, wenn das Layout gelöscht wird

### blitze_sitemaker_layout_aktualisiert

-   Lage: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Mehr noch: 3.1.2
-   Verwendung: Ereignis, um anderen Erweiterungen zu erlauben, etwas zu tun, wenn das Layout aktualisiert wird

### blitze_sitemaker_tinymce_options

-   Ort: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
-   Mehr noch: 3.3.0
-   Zweck: Ereignis um anderen Erweiterungen zu erlauben, Tinkymce-Optionen zu ändern
