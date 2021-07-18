---
title: SiteMaker Evenemang för phpBB
sidebar_position: 2
---

Du kan ändra beteendet hos phpBB SiteMaker med phpBB: s händelsesystem.

## PHP-händelser

### bulk.sitemaker.acp_add_bulk_menu_options

-   Plats: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
-   Sedan dess : 3.1.0
-   Syfte: Lägg till bulk menyalternativ i acp meny

### Sidansvarig: acp_display_settings_form

-   Plats: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Sedan dess : 3.1.0
-   Syfte: display-acp (sitemaker) inställningsformulär

### blitze.sitemaker.acp_save_settings

-   Plats: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Sedan dess : 3.1.0
-   Syfte: Spara acp (sitemaker) inställningar

### blitze.sitemaker.admin_bar.set_assets

-   Plats: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
-   Sedan dess : 3.0.1-RC1
-   Syfte: Lägg till tillgångar för tillgängliga block i redigeringsläge

### plats.sitemaker.modify_block_positioner

-   Plats: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Sedan dess : 3.0.1-RC1
-   Syfte: Ändra blockpositioner

### blitze.sitemaker.modify_rendered_block

-   Plats: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Sedan dess : 3.0.1-RC1
-   Syfte: Ändra ett renderat block

## Mall Händelser

### Inställningar

-   Plats: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
-   Sedan dess : 3.1.0
-   Syfte: Lägg till formulärfält för sitemaker inställningar

### Bifoga

-   Plats: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Sedan dess : 3.1.0
-   Syfte: Lägg till menyobjekt till administratörsfältet

### Sidmallar

-   Plats: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Sedan dess : 3.1.0
-   Syfte: Lägg till mallfiler som ska användas i JS för blockvyer etc

## Javascript händelser

### Sparad

-   Plats: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
-   Sedan dess : 3.1.2
-   Syfte: Händelse för att tillåta andra tillägg att göra något när layoutändringar sparas

### Före

-   Plats: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Sedan dess : 3.1.2
-   Syfte: Händelse för att tillåta andra tillägg att göra något innan blocket renderas eller förhindra det från att återges

### Efter

-   Plats: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Sedan dess : 3.1.2
-   Syfte: Händelse för att tillåta andra tillägg att göra något efter blocket renderas

### Före

-   Plats: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
-   Sedan dess : 3.1.2
-   Syfte: Händelse för att tillåta andra tillägg att ändra blockdata innan den sparas

### Alla positioner

-   Plats: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Sedan dess : 3.1.2
-   Syfte: Händelse för att tillåta andra tillägg att göra något när alla blockpositioner visas

### Dölj

-   Plats: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Sedan dess : 3.1.2
-   Syfte: Händelse för att tillåta andra tillägg att göra något när tomma positioner är dolda

### Rensa

-   Plats: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Sedan dess : 3.1.2
-   Syfte: Händelse för att tillåta andra tillägg att göra något när layouten rensas

### Uppdaterad

-   Plats: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Sedan dess : 3.1.2
-   Syfte: Händelse för att tillåta andra tillägg att göra något när layouten uppdateras

### Alternativ

-   Plats: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
-   Sedan dess : 3.3.0
-   Syfte: Händelse för att tillåta andra tillägg att ändra tinymce alternativ
