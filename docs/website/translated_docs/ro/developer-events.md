---
id: evenimente dezvoltator
title: Evenimente fpBB SiteMaker
---

Puteți modifica comportamentul phpBB SiteMaker folosind sistemul de evenimente al phpBB.

## Evenimente PHP

# blitze.sitemaker.acp_add_bulk_menu

- Locatie: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- De la: 3.1.0
- Scop : Adăugare opţiuni meniu în meniul acp

# blitze.sitemaker.acp_display_settings_form

- Locatie: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- De la: 3.1.0
- Scopul: display acp (sitemaker) setări formular

# blitze.sitemaker.acp_save_settings

- Locatie: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- De la: 3.1.0
- Scop : Salvare acp (sitemaker) setări

# blitze.sitemaker.admin_bar.set_assets

- Locatie: /phpBB/ext/blitze/sitemaker/servicii/blocuri/admin_bar.php
- De la: 3,0,1 RC1
- Scopul: Adaugă active pentru blocurile disponibile în modul editare

# blitze.sitemaker.modify_block_positions

- Locatie: /phpBB/ext/blitze/sitemaker/servicii/blocuri/blocks.php
- De la: 3,0,1 RC1
- Scopul: Modifică pozițiile blocului

# blitze.sitemaker.modify_rendered_block

- Locatie: /phpBB/ext/blitze/sitemaker/servicii/blocuri/blocks.php
- De la: 3,0,1 RC1
- Scop : Modifică un bloc randat

## Evenimente șablon

# setari blitze_sitemaker_acp_

- Locatie: /phpBB/ext/blitze/sitemaker/ad/style/acp_settings.html
- De la: 3.1.0
- Scopul: Adăugați câmpuri formular pentru setările de sitemaker

# blitze_sitemaker_admin_bar_append

- Locație: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- De la: 3.1.0
- Scop : Adaugă elemente de meniu în bara de administrare

# blitze_sitemaker_admin_bar_template-uri

- Locație: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- De la: 3.1.0
- Scop : Adauga sablon fisiere pentru a fi folosite in JS pentru vizualizari blocate, etc

## Evenimente Javascript

# blitze_sitemaker_layout_saved

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componente/AdminBar/SaveLayout/index.js
- De la: 3.1.2
- Scopul: Eveniment pentru a permite altor extensii să facă ceva atunci când modificările de aspect sunt salvate

# blitze_sitemaker_render_block_înainte

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componente/BlockRenderer/index.js
- De la: 3.1.2
- Scopul: Eveniment pentru a permite altor extensii să facă ceva înainte ca blocul să fie randat sau să împiedice reredarea lui

# blitze_sitemaker_render_block_after

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componente/BlockRenderer/index.js
- De la: 3.1.2
- Scopul: Eveniment pentru a permite altor extensii să facă ceva după bloc este randat

# blitze_sitemaker_save_block_înainte

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componente/BlocksManager/Edit/index.js
- De la: 3.1.2
- Scop : Eveniment pentru a permite altor extensii să modifice datele blocului înainte de a fi salvat

# blitze_sitemaker_show_all_block_positions

- Locație: /phpBB/ext/blitze/sitemaker/develop/componente/poziții/poziții.js
- De la: 3.1.2
- Scopul: Eveniment pentru a permite altor extensii să facă ceva atunci când toate pozițiile blocului sunt afișate

# blitze_sitemaker_hide_empty_block_positions

- Locație: /phpBB/ext/blitze/sitemaker/develop/componente/poziții/poziții.js
- De la: 3.1.2
- Scopul: Eveniment pentru a permite altor extensii să facă ceva atunci când pozițiile goale sunt ascunse

# blitze_sitemaker_layout_cleared

- Locație: /phpBB/ext/blitze/sitemaker/develop/componente/poziții/poziții.js
- De la: 3.1.2
- Scopul: Eveniment pentru a permite altor extensii să facă ceva atunci când aspectul este eliminat

# blitze_sitemaker_layout_actualizat

- Locație: /phpBB/ext/blitze/sitemaker/develop/componente/poziții/poziții.js
- De la: 3.1.2
- Scopul: Eveniment pentru a permite altor extensii să facă ceva atunci când layout este actualizat

# opțiuni blitze_sitemaker_tinymce_optiones

- Locatie: /phpBB/ext/blitze/sitemaker/develop/componente/CustomBlock/index.js
- De la: 3,0
- Scopul: Eveniment pentru a permite altor extensii să modifice opțiunile tinymce