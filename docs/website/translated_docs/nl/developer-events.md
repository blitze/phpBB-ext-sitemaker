---
id: ontwikkelaars-events
title: phpBB SiteMaker Evenementen
---

U kunt het gedrag van phpBB SiteMaker wijzigen met behulp van phpBB's event systeem.

## PHP Events

# blitze.sitemaker.acp_add_bulk_menu_options

- Locatie: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- Sinds: 3.1.0
- Purpose: bulk menu opties toevoegen in acp menu

# blitze.sitemaker.acp_display_settings_form

- Locatie: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Sinds: 3.1.0
- Purpose: toon veld (sitemaker) instellingen formulier

# blitze.sitemaker.acp_save_settings

- Locatie: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Sinds: 3.1.0
- Purpose: Bewaar acp (sitemaker) instellingen

# blitze.sitemaker.admin_bar.set_assets

- Locatie: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- Sinds: 3.0.1-RC1
- Doel: Voeg assets toe voor beschikbare blokken in bewerkmodus

# blitze.sitemaker.modify_block_posities

- Locatie: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Sinds: 3.0.1-RC1
- Doel: Blok posities wijzigen

# blitze.sitemaker.modify_rendered_block

- Locatie: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Sinds: 3.0.1-RC1
- Doel: Wijzig een gerenommeerd blok

## Sjabloon gebeurtenissen

# blitze_sitemaker_acp_settings

- Locatie: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- Sinds: 3.1.0
- Doel: Formuliervelden toevoegen voor sitemaker instellingen

# blitze_sitemaker_admin_bar_bijlage

- Locatie: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Sinds: 3.1.0
- Purpose: Menu-items toevoegen aan admin bar

# blitze_sitemaker_admin_bar_templates

- Locatie: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Sinds: 3.1.0
- Purpose: Voeg template bestanden toe die gebruikt worden in JS voor blok weergaven, etc

## Javascript gebeurtenissen

# blitze_sitemaker_layout_saved

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componenten/AdminBar/SaveLayout/index.js
- Sinds: 3.1.2
- Doel: Gebeurtenis om andere extensies toe te staan iets te doen wanneer lay-out wijzigingen worden opgeslagen

# blitze_sitemaker_render_block_before

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componenten/BlockRenderer/index.js
- Sinds: 3.1.2
- Doel: Gebeurtenis om andere extensies toe te staan iets te doen voordat het blok wordt weergegeven of te voorkomen dat het opnieuw wordt weergegeven

# blitze_sitemaker_render_block_after

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componenten/BlockRenderer/index.js
- Sinds: 3.1.2
- Doel: Gebeurtenis om andere extensies toe te staan iets te doen nadat het blok is weergegeven

# blitze_sitemaker_save_block_before

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componenten/BlocksManager/Edit/index.js
- Sinds: 3.1.2
- Doel: Gebeurtenis om andere extensies toe te staan block data te wijzigen voordat deze is opgeslagen

# blitze_sitemaker_show_all_block_posities

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componenten/Posities/Positions.js
- Sinds: 3.1.2
- Doel: Evenement om andere extensies toe te staan iets te doen wanneer alle blokposities worden weergegeven

# blitze_sitemaker_Verberg_lege_block_posities

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componenten/Posities/Positions.js
- Sinds: 3.1.2
- Doel: Evenement om andere extensies toe te staan iets te doen wanneer lege posities verborgen zijn

# blitze_sitemaker_layout_cleared

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componenten/Posities/Positions.js
- Sinds: 3.1.2
- Doel: Gebeurtenis om andere extensies toe te staan iets te doen wanneer de lay-out is gewist

# blitze_sitemaker_layout_geüpdatet

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componenten/Posities/Positions.js
- Sinds: 3.1.2
- Doel: Gebeurtenis om andere extensies toe te staan iets te doen wanneer de lay-out is bijgewerkt

# blitze_sitemaker_tinymce_opties

- Locatie: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- Sinds: 3.0
- Doel: Gebeurtenis toestaan dat andere extensies tinymce opties wijzigen