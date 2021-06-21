---
id: sviluppatori-eventi
title: phpBB SiteMaker eventi
---

Puoi modificare il comportamento di phpBB SiteMaker utilizzando il sistema di eventi di phpBB.

## Eventi PHP

# blitze.sitemaker.acp_add_bulk_menu_options

- Posizione: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- Da: 3.1.0
- Scopo: Aggiungi opzioni menu massivo nel menu acp

# blitze.sitemaker.acp_display_settings_form

- Posizione: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Da: 3.1.0
- Scopo: visualizzare il modulo di impostazioni acp (sitemaker)

# blitze.sitemaker.acp_save_settings

- Posizione: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Da: 3.1.0
- Scopo: Salva impostazioni acp (sitemaker)

# blitze.sitemaker.admin_bar.set_assets

- Posizione: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- Da: 3.0.1-RC1
- Scopo: aggiungere risorse per i blocchi disponibili in modalità modifica

# blitze.sitemaker.modify_block_positions

- Posizione: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Da: 3.0.1-RC1
- Scopo: Modifica posizione blocco

# blitze.sitemaker.modify_rendered_block

- Posizione: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Da: 3.0.1-RC1
- Scopo: Modifica un blocco renderizzato

## Eventi Template

# blitze_sitemaker_acp_settings

- Posizione: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- Da: 3.1.0
- Scopo: Aggiungi i campi del modulo per le impostazioni sitemaker

# blitze_sitemaker_admin_bar_append

- Posizione: /phpBB/ext/blitze/sitemaker/stili/all/template/admin_bar.html
- Da: 3.1.0
- Scopo: aggiungere voci di menu alla barra di amministrazione

# blitze_sitemaker_admin_bar_templates

- Posizione: /phpBB/ext/blitze/sitemaker/stili/all/template/admin_bar.html
- Da: 3.1.0
- Scopo: Aggiungere file modello da utilizzare in JS per visualizzare i blocchi, ecc

## Eventi Javascript

# blitze_sitemaker_layout_salvato

- Posizione: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- Da: 3.1.2
- Scopo: Evento per consentire ad altre estensioni di fare qualcosa quando vengono salvate le modifiche di layout

# blitze_sitemaker_render_block_precedente

- Posizione: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Da: 3.1.2
- Scopo: Evento per consentire ad altre estensioni di fare qualcosa prima che il blocco venga visualizzato o impedire che venga ri-reso

# blitze_sitemaker_render_block_dopo

- Posizione: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Da: 3.1.2
- Scopo: Evento per consentire ad altre estensioni di fare qualcosa dopo che il blocco è stato renderizzato

# blitze_sitemaker_save_block_precedente

- Posizione: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- Da: 3.1.2
- Scopo: Evento per consentire ad altre estensioni di modificare i dati del blocco prima di essere salvato

# blitze_sitemaker_show_all_block_positions

- Posizione: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Da: 3.1.2
- Scopo: Evento per consentire ad altre estensioni di fare qualcosa quando vengono mostrate tutte le posizioni di blocco

# blitze_sitemaker_hide_empty_block_positions

- Posizione: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Da: 3.1.2
- Scopo: Evento per consentire ad altre estensioni di fare qualcosa quando le posizioni vuote sono nascoste

# blitze_sitemaker_layout_cancellato

- Posizione: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Da: 3.1.2
- Scopo: Evento per consentire ad altre estensioni di fare qualcosa quando il layout viene cancellato

# blitze_sitemaker_layout_aggiornato

- Posizione: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Da: 3.1.2
- Scopo: Evento per consentire ad altre estensioni di fare qualcosa quando il layout è aggiornato

# blitze_sitemaker_tinymce_options

- Ubicazione: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- Poiché: 3.3.0
- Scopo: Evento per consentire ad altre estensioni di modificare le opzioni di timo