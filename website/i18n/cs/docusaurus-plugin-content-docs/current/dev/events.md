---
title: phpBB události SiteMaker
sidebar_position: 2
---

Můžete změnit chování phpBB SiteMaker pomocí phpBB systému událostí.

## PHP události

### blitze.sitemaker.acp_bulk_menu_options

-   Umístění: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
-   Od: 3.1.0
-   Účel: Přidání možností hromadného menu do acp menu

### blitze.sitemaker.acp_display_settings_form

-   Umístění: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Od: 3.1.0
-   Účel: Zobrazení akp (sitemaker) nastavení formuláře

### blitze.sitemaker.acp_Uložit nastavení

-   Umístění: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Od: 3.1.0
-   Účel: Uložit acp (sitemaker) nastavení

### Blitze.sitemaker.admin_bar.set_assets

-   Umístění: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
-   Od: 3.0.1-RC1
-   Účel: Přidejte aktiva pro dostupné bloky v režimu úprav

### blitze.sitemaker.modify_block_positions

-   Umístění: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Od: 3.0.1-RC1
-   Účel: Úprava pozic bloku

### blitze.sitemaker.modify_rendered_block

-   Umístění: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Od: 3.0.1-RC1
-   Účel: Úprava vykreslovaného bloku

## Události šablony

### blitze_sitemaker_acp_nastavení

-   Umístění: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
-   Od: 3.1.0
-   Účel: Přidat pole formuláře pro nastavení sitemaker

### blitze_sitemaker_admin_bar_připojit

-   Umístění: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Od: 3.1.0
-   Účel: Přidat položky nabídky do admin panelu

### Blitze_sitemaker_admin_bar_šablony

-   Umístění: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Od: 3.1.0
-   Účel: Přidejte šablony souborů, které mají být použity v JS pro zobrazení bloků atd.

## Javascript události

### blitze_sitemaker_layout_uloženo

-   Umístění: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
-   Od: 3.1.2
-   Účel: Událost umožňuje ostatním rozšířením něco udělat, když jsou uloženy změny rozložení

### blitze_sitemaker_render_block_před

-   Umístění: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Od: 3.1.2
-   Účel: Událost umožňující jiným rozšířením udělat něco před vykreslením bloku nebo zabránit jeho překreslování

### blitze_sitemaker_render_block_after

-   Umístění: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Od: 3.1.2
-   Účel: Událost umožňující další rozšíření udělat něco po vykreslení bloku

### blitze_sitemaker_save_block_před

-   Umístění: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
-   Od: 3.1.2
-   Účel: Událost umožňuje jiným rozšířením změnit data bloku před jeho uložením

### blitze_sitemaker_show_all_block_positions

-   Umístění: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Od: 3.1.2
-   Účel: Událost umožňující další rozšíření něco udělat, když jsou zobrazeny všechny pozice bloků

### blitze_sitemaker_hide_empty_block_pozice

-   Umístění: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Od: 3.1.2
-   Účel: Událost umožňující ostatním rozšířením něco udělat, když jsou prázdné pozice skryté

### blitze_sitemaker_layout_vymazáno

-   Umístění: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Od: 3.1.2
-   Účel: Událost umožňující ostatním rozšířením něco udělat, když je rozvržení vymazáno

### blitze_sitemaker_layout_aktualizováno

-   Umístění: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Od: 3.1.2
-   Účel: Událost umožňující ostatním rozšířením něco udělat, když je rozložení aktualizováno

### Blitze_sitemaker_tinymce_možnosti

-   Umístění: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
-   Od: 3.3.0
-   Účel: Událost pro další rozšíření pro změnu možností tinymce
