---
title: Eventi phpBB SiteMaker
sidebar_position: 2
---

È possibile modificare il comportamento di phpBB SiteMaker utilizzando il sistema di eventi di phpBB.

## Eventi PHP

### blitze.sitemaker.acp_add_bulk_menu_options

-   Ubicazione: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
-   Poiché: 3.1.0
-   Scopo: Aggiungi opzioni del menu bulk nel menu acp

### blitze.sitemaker.acp_display_settings_form

-   Ubicazione: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Poiché: 3.1.0
-   Scopo: display modulo di impostazioni acp (sitemaker)

### blitze.sitemaker.acp_save_settings

-   Ubicazione: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Poiché: 3.1.0
-   Scopo: Salva impostazioni acp (sitemaker)

### blitze.sitemaker.admin_bar.set_assets

-   Ubicazione: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
-   Poiché: 3.0.1-RC1
-   Scopo: Aggiungi asset per i blocchi disponibili in modalità modifica

### blitze.sitemaker.modify_block_positions

-   Posizione: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Poiché: 3.0.1-RC1
-   Scopo: Modificare le posizioni del blocco

### blitze.sitemaker.modify_rendered_block

-   Posizione: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Poiché: 3.0.1-RC1
-   Scopo: Modificare un blocco renderizzato

## Eventi Template

### blitze_sitemaker_acp_settings

-   Posizione: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
-   Poiché: 3.1.0
-   Scopo: Aggiungi campi modulo per le impostazioni del sitemaker

### blitze_sitemaker_admin_bar_append

-   Ubicazione: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Poiché: 3.1.0
-   Scopo: Aggiungi voci di menu alla barra di amministrazione

### blitze_sitemaker_admin_bar_template

-   Ubicazione: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Poiché: 3.1.0
-   Scopo: Aggiungere i file di modello da usare in JS per le viste a blocchi, ecc

## Eventi Javascript

### blitze_sitemaker_layout_saved

-   Ubicazione: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
-   Poiché: 3.1.2
-   Scopo: Evento per consentire ad altre estensioni di fare qualcosa quando i cambiamenti di layout vengono salvati

### blitze_sitemaker_render_block_before

-   Ubicazione: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Poiché: 3.1.2
-   Scopo: Evento per consentire ad altre estensioni di fare qualcosa prima che il blocco venga renderizzato o impedire che venga ri-renderizzato

### blitze_sitemaker_render_block_after

-   Ubicazione: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Poiché: 3.1.2
-   Scopo: Evento per consentire ad altre estensioni di fare qualcosa dopo che il blocco è renderizzato

### blitze_sitemaker_save_block_before

-   Ubicazione: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
-   Poiché: 3.1.2
-   Scopo: Evento per consentire ad altre estensioni di modificare i dati del blocco prima di essere salvato

### blitze_sitemaker_show_all_block_positions

-   Ubicazione: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Poiché: 3.1.2
-   Scopo: Evento per consentire ad altre estensioni di fare qualcosa quando tutte le posizioni dei blocchi sono mostrate

### blitze_sitemaker_hide_empty_block_positions

-   Ubicazione: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Poiché: 3.1.2
-   Scopo: Evento per consentire ad altre estensioni di fare qualcosa quando le posizioni vuote sono nascoste

### blitze_sitemaker_layout_cleared

-   Ubicazione: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Poiché: 3.1.2
-   Scopo: Evento per consentire ad altre estensioni di fare qualcosa quando il layout viene cancellato

### blitze_sitemaker_layout_updated

-   Ubicazione: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Poiché: 3.1.2
-   Scopo: Evento per consentire ad altre estensioni di fare qualcosa quando il layout viene aggiornato

### blitze_sitemaker_tinymce_options

-   Ubicazione: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
-   Poiché: 3.3.0
-   Scopo: Evento per consentire ad altre estensioni di modificare le opzioni di timo
