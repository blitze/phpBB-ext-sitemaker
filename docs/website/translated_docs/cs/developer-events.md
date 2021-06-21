---
id: Vývojářské akce
title: phpBB SiteMaker Události
---

Umíte změnit chování phpBB SiteMaker pomocí phpBB event systém.

## Události PHP

# blitze.sitemaker.acp_add_bulk_menu_options_options_options_options.

- Location: /phpBB/ext/blitze/sitemaker/acp/menu_module.php.
- Vzhledem k tomu: 3.1.0
- Cíl: Nastavení široké nabídky v menu acp

# blitze.sitemaker.acp_display_settings_form

- Location: /phpBB/ext/blitze/sitemaker/acp/settings_module.php.
- Vzhledem k tomu: 3.1.0
- Účet: zobrazovací formulář (sitemaker)

# blitze.sitemaker.acp_save_settings

- Location: /phpBB/ext/blitze/sitemaker/acp/settings_module.php.
- Vzhledem k tomu: 3.1.0
- Cíl: Uložit acp (sitemaker) nastavení

# blitze.sitemaker.admin_bar.set_assets

- Location: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- Od: 3.0.1-RC1
- Cíl: Přidat aktiva k dostupným blokům v režimu editace

# blitze.sitemaker.modify_block_positions

- Location: /phpBB/ext/blitze/sitemaker/services/blocks.php
- Od: 3.0.1-RC1
- Záměr: změna blokových postojů

# blitze.sitemaker.modify_rendered_block

- Location: /phpBB/ext/blitze/sitemaker/services/blocks.php
- Od: 3.0.1-RC1
- Záměr: Jak změnit tvarovaný blok

## Template Events

# blitze_sitemaker_acp_settings

- Location: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- Vzhledem k tomu: 3.1.0
- Cíl: Přidat pole formuláře pro nastavení sitemaker

# blitze_sitemaker_admin_bar_append

- Location: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Vzhledem k tomu: 3.1.0
- Cíl: Přidat položky menu do admin baru

# blitze_sitemaker_admin_bar_templates

- Location: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Vzhledem k tomu: 3.1.0
- Cíl: Přidat šablony, které mají být použity v JS pro blokové názory, atd.

## Události JavaScript

# blitze_sitemaker_layout_saved

- Místo: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- Od: 3.1.2
- Úmysl: Pokud jsou změny rozložení zachráněny, akce umožňují jiným rozšířením něco udělat.

# blitze_sitemaker_render_block_before before

- Location: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Od: 3.1.2
- Záměr: Příprava umožňující jiným rozšířením něco udělat před odebráním bloku nebo zabránit jeho znovuzavedení.

# blitze_sitemaker_render_block_after

- Location: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Od: 3.1.2
- Úmysl: Příprava povolit další rozšíření tak, aby něco dělal po bloku se provádí

# blitze_sitemaker_save_block_před tím.

- Location: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- Od: 3.1.2
- Cíl: Událost umožňující jiným rozšířením měnit bloková data dříve, než je uložena.

# blitze_sitemaker_show_all_block_positions

- Location: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Od: 3.1.2
- Úmysl: Když se na všechny blokové pozice objeví všechny přípony, povolte jiným rozšířením něco dělat.

# blitze_sitemaker_hide_empty_block_positions

- Location: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Od: 3.1.2
- Záměr: Událost umožňující jiným rozšířením něco dělat, když jsou prázdná místa skryta.

# blitze_sitemaker_layout_cleared

- Location: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Od: 3.1.2
- Cíl: Událost umožňující jiným rozšířením něco dělat, je-li rozložení odstraněno.

# blitze_sitemaker_layout_updated

- Location: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Od: 3.1.2
- Cíl: Událost umožňující jiným rozšířením něco dělat, je-li rozložení aktualizováno

# Blitze_sitemaker_tinymce_možnosti

- Umístění: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- Od: 3.3.0
- Účel: Událost pro další rozšíření pro změnu možností tinymce