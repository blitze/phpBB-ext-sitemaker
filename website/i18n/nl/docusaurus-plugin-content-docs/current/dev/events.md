---
title: phpBB SiteMaker Gebeurtenissen
sidebar_position: 2
---

Je kunt het gedrag van phpBB SiteMaker aanpassen met behulp van phpBB's event systeem.

## PHP gebeurtenissen

### blitze.sitemaker.acp_add_bulk_menu_options

-   Locatie: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
-   Sinds: 3.1.0
-   Doel: Voeg bulk menu opties toe in acp menu

### blitze.sitemaker.acp_display_settings_form

-   Locatie: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Sinds: 3.1.0
-   Purpose: acp (sitemaker) instellingen formulier

### blitze.sitemaker.acp_save_settings

-   Locatie: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Sinds: 3.1.0
-   Doel: acp (sitemaker) instellingen opslaan

### blitze.sitemaker.admin_bar.set_assets

-   Locatie: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
-   Sinds: 3.0.1-RC1
-   Doel: Voeg assets toe voor beschikbare blokken in bewerkingsmodus

### blitze.sitemaker.modify_block_positions

-   Locatie: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Sinds: 3.0.1-RC1
-   Doel: Wijzig blokposities

### blitze.sitemaker.modify_rendered_blok

-   Locatie: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Sinds: 3.0.1-RC1
-   Doel: Wijzig een weergegeven blok

## Sjabloon gebeurtenissen

### blitze_sitemaker_acp_instellingen

-   Locatie: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
-   Sinds: 3.1.0
-   Doel: Formuliervelden toevoegen voor sitemakerinstellingen

### blitze_sitemaker_admin_append

-   Locatie: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Sinds: 3.1.0
-   Doel: menu-items toevoegen aan de beheerbalk

### blitze_sitemaker_admin_sjablonen

-   Locatie: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Sinds: 3.1.0
-   Doel: sjabloonbestanden toevoegen die worden gebruikt in JS voor blokweergaven, enz

## Javascript gebeurtenissen

### blitze_sitemaker_layout_opgeslagen

-   Locatie: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
-   Sinds: 3.1.2
-   Doel: Event om andere extensies iets te laten doen wanneer de lay-out verandert

### blitze_sitemaker_render_block_vóór

-   Locatie: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Sinds: 3.1.2
-   Doel: Event toestaan om iets te doen voordat het blok wordt weergegeven of voorkomen dat het opnieuw wordt weergegeven

### blitze_sitemaker_render_block_na

-   Locatie: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Sinds: 3.1.2
-   Doel: Event toestaan om iets te doen nadat het blok is weergegeven

### blitze_sitemaker_save_block_voor

-   Locatie: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
-   Sinds: 3.1.2
-   Doel: Event toestaan om blokgegevens te wijzigen voordat het wordt opgeslagen

### blitze_sitemaker_show_all_block_positions

-   Locatie: /phpBB/ext/blitze/sitemaker/develop/components/Positions.js
-   Sinds: 3.1.2
-   Doel: Event om andere extensies toe te staan iets te doen wanneer alle blokposities worden getoond

### blitze_sitemaker_hide_empty_block_positions

-   Locatie: /phpBB/ext/blitze/sitemaker/develop/components/Positions.js
-   Sinds: 3.1.2
-   Doel: Event toestaan om andere extensies iets te laten doen wanneer lege posities worden verborgen

### blitze_sitemaker_layout_gewist

-   Locatie: /phpBB/ext/blitze/sitemaker/develop/components/Positions.js
-   Sinds: 3.1.2
-   Doel: Event om andere extensies iets te laten doen wanneer de lay-out is gewist

### blitze_sitemaker_layout_geüpdatet

-   Locatie: /phpBB/ext/blitze/sitemaker/develop/components/Positions.js
-   Sinds: 3.1.2
-   Doel: Gebeurtenis toestaan dat andere extensies iets doen wanneer de lay-out wordt bijgewerkt

### blitze_sitemaker_tinymce_opties

-   Locatie: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
-   Sinds: 3.0
-   Doel: Gebeurtenis toestaan dat andere extensies tinymce opties wijzigen
