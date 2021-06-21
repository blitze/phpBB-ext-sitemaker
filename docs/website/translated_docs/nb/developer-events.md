---
id: utviklerhendelser
title: phpBB SiteMaker Hendelser
---

Du kan endre adferden til phpBB SiteMaker ved hjelp av phpBB's hendelsessystem.

## PHP hendelser

# blitze.sitemaker.acp_add_bulk_menu_options

- Sted: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- Siden: 3.1.0
- Formål: Legg til massealternativer i blokk-menyen

# blitze.sitemaker.acp_display_settings_form

- Sted: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Siden: 3.1.0
- Formål: vis acp (sitemaker) innstillingsskjema

# blitze.sitemaker.acp_save_settings

- Sted: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Siden: 3.1.0
- Formål: Lagre acp (sitemaker) innstillinger

# blitze.sitemaker.admin_bar.set_assets

- Sted: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- Siden: 3.0.1-RC1
- Formål: Legg til ressurser for tilgjengelige blokker i redigeringsmodus

# blitze.sitemaker.modify_block_posier

- Sted: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Siden: 3.0.1-RC1
- Formål: posisjoner endre blokker

# blitze.sitemaker.modify_rendered_block

- Sted: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Siden: 3.0.1-RC1
- Formål: endre en rendret blokk

## Mal hendelser

# blitze_sitemaker_acp_innstillinger

- Sted: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- Siden: 3.1.0
- Formål: Legg til skjemafelter for sidemaker innstillinger

# blitze_sitemaker_admin_bar_append

- Sted: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Siden: 3.1.0
- Formål: Legg til menyelementer i adminbar

# blitze_sitemaker_admin_bar_maler

- Sted: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Siden: 3.1.0
- Formål: Legg til malfiler som skal brukes i JS for blokkvisning, osv

## Javascript hendelser

# blitze_sitemaker_layout_lagret

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- Sid: 3.1.2
- Formål: Hendelse for å tillate andre utvidelser å gjøre noe når endringer i oppsett blir lagret

# blitze_sitemaker_render_block_før

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Sid: 3.1.2
- Formål: Hendelse som tillater andre utvidelser å gjøre noe før blokk gjengis eller forhindre at den blir gjengitt

# blitze_sitemaker_render_block_etter

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Sid: 3.1.2
- Formål: Hendelse for å tillate andre utvidelser å gjøre noe etter at blokk er gjengitt

# blitze_sitemaker_save_block_før

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- Sid: 3.1.2
- Formål: Hendelse for å tillate andre utvidelser å endre blokkdata før den blir lagret

# blitze_sitemaker_show_all_block_positions

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/Positions.js
- Sid: 3.1.2
- Formål: Hendelse for å tillate andre utvidelser å gjøre noe når alle blokkposisjoner vises

# blitze_sitemaker_hide_empty_block_posier

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/Positions.js
- Sid: 3.1.2
- Formål: Hendelse som tillater andre utvidelser å gjøre noe når tomme posisjoner er skjult

# blitze_sitemaker_layout_cleared

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/Positions.js
- Sid: 3.1.2
- Formål: Hendelse for å tillate andre utvidelser å gjøre noe når oppsettet er tømt

# blitze_sitemaker_oppsett_oppdatert

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/Positions.js
- Sid: 3.1.2
- Formål: Hendelse som tillater andre utvidelser å gjøre noe når oppsett blir oppdatert

# blitze_sitemaker_tinymce_innstillinger

- Sted: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- Siden: 3.3.0
- Formål: Hendelse for å tillate andre utvidelser å endre tinymce alternativer