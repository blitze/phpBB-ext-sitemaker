---
id: udvikler-events
title: phpBB SiteMaker begivenheder
---

Du kan ændre phpBB SiteMakers adfærd ved hjælp af phpBB's event system.

## Php Begivenheder

# blitze.sitemaker.acp_add_bulk_menu_options

- Sted: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- Efter: 3.1.0
- Formål: Tilføj bulk menuindstillinger i acp menu

# blitze.sitemaker.acp_display_settings_form

- Lokation: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Efter: 3.1.0
- Formål: formular til visning af acp (sitemaker)

# blitze.sitemaker.acp_save_settings

- Lokation: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Efter: 3.1.0
- Formål: Gem acp (sitemaker) indstillinger

# blitze.sitemaker.admin_bar.set_assets

- Sted: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- Siden 3.0.1-RC1
- Formål: Tilføj aktiver for tilgængelige blokke i redigeringstilstand

# blitze.sitemaker.modify_block_positions

- Sted: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Siden 3.0.1-RC1
- Formål: Ændre blokpositioner

# blitze.sitemaker.modify_rendered_block

- Sted: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Siden 3.0.1-RC1
- Formål: Ændre en gengivet blok

## Skabelon Begivenheder

# blitze_sitemaker_acp_settings

- Sted: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- Efter: 3.1.0
- Formål: Tilføj formularfelter til sitemaker indstillinger

# blitze_sitemaker_admin_bar_append

- Sted: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Efter: 3.1.0
- Formål: Tilføj menupunkter til admin bar

# blitze_sitemaker_admin_bar_templates

- Sted: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Efter: 3.1.0
- Formål: Tilføj skabelonfiler, der skal bruges i JS til blokvisninger, osv.

## Javascript Begivenheder

# blitze_sitemaker_layout_gemt

- Placering: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- Dæk: 3.1.2
- Formål: Begivenhed for at tillade andre udvidelser at gøre noget, når layoutændringer gemmes

# blitze_sitemaker_render_block_før

- Placering: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Dæk: 3.1.2
- Formål: Begivenhed for at tillade andre udvidelser at gøre noget før blokken gengives eller forhindre den i at blive gengivet

# blitze_sitemaker_render_block_efter

- Placering: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Dæk: 3.1.2
- Formål: Begivenhed for at tillade andre udvidelser at gøre noget efter blokken er gengivet

# blitze_sitemaker_save_block_før

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- Dæk: 3.1.2
- Formål: Begivenhed for at tillade andre udvidelser at ændre blokdata, før den gemmes

# blitze_sitemaker_show_all_block_positions

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Dæk: 3.1.2
- Formål: Begivenhed for at tillade andre udvidelser at gøre noget, når alle blokpositioner vises

# blitze_sitemaker_hide_empty_block_positions

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Dæk: 3.1.2
- Formål: Begivenhed for at tillade andre udvidelser at gøre noget, når tomme positioner er skjult

# blitze_sitemaker_layout_clearet

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Dæk: 3.1.2
- Formål: Begivenhed for at tillade andre udvidelser at gøre noget, når layout er ryddet

# blitze_sitemaker_layout_opdateret

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Dæk: 3.1.2
- Formål: Begivenhed for at tillade andre udvidelser at gøre noget, når layoutet opdateres

# blitze_sitemaker_tinymce_options

- Placering: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- Efter: 3.3.0
- Formål: Begivenhed for at tillade andre udvidelser at ændre tinymce indstillinger