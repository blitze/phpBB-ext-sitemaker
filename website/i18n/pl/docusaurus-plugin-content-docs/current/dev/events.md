---
title: Wydarzenia phpBB SiteMaker
sidebar_position: 2
---

Możesz zmodyfikować zachowanie phpBB SiteMaker za pomocą systemu wydarzeń phpBB.

## Wydarzenia PHP

### blitze.sitemaker.acp_add_bulk_menu

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
-   Odp.: 3.1.0
-   Przeznaczenie: Dodaj opcje menu zbiorczego w menu acp

### blitze.sitemaker

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Odp.: 3.1.0
-   Przeznaczenie: wyświetl formularz ustawień acp (sitemaker)

### Ustawienia zapisu

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Odp.: 3.1.0
-   Przeznaczenie: Zapisz ustawienia acp (sitemaker)

### Blitze.sitemaker.admin_bar.set_assets

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
-   Odp.: 3.0.1-RC1
-   Przeznaczenie: Dodaj zasoby dla dostępnych bloków w trybie edycji

### Modyfikacja pozycji

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Odp.: 3.0.1-RC1
-   Przeznaczenie: Modyfikowanie pozycji bloku

### Edycja bloków

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Odp.: 3.0.1-RC1
-   Przeznaczenie: Modyfikuj renderowany blok

## Wydarzenia szablonu

### ustawienia_strony

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
-   Odp.: 3.1.0
-   Przeznaczenie: Dodaj pola formularza dla ustawień strony

### 1201***blitze_sitemer_admin_bar_append

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Odp.: 3.1.0
-   Przeznaczenie: Dodaj pozycje menu do paska administratora

### Szablony

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Odp.: 3.1.0
-   Przeznaczenie: Dodaj pliki szablonów do użycia w JS dla widoków bloków, itp

## Zdarzenia Javascript

### Zapisano układ_strony

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
-   Odp.: 3.1.2
-   Przeznaczenie: Wydarzenie pozwalające innym rozszerzeniom zrobić coś po zapisaniu zmian w układzie

### Blitze_aktor_witryna_blok_przed

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Odp.: 3.1.2
-   Przeznaczenie: Zdarzenie pozwalające innym rozszerzeniom zrobić coś przed renderowaniem bloku lub uniemożliwieniem jego ponownego renderowania

### Blitze_aktor_witryny_render_po

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Odp.: 3.1.2
-   Przeznaczenie: Wydarzenie pozwalające innym rozszerzeniom zrobić coś po renderowaniu bloku

### Blitze_aker_strony przed

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
-   Odp.: 3.1.2
-   Przeznaczenie: Zdarzenie umożliwiające innym rozszerzeniom modyfikację danych blokowych przed zapisaniem

### Pokaż wszystkie pozycje_blok_strony

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Odp.: 3.1.2
-   Przeznaczenie: Wydarzenie pozwala innym rozszerzeniom zrobić coś, gdy wszystkie pozycje bloków są wyświetlane

### Blitze_aktor_witryny_ukryj_puste pozycje

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Odp.: 3.1.2
-   Przeznaczenie: Wydarzenie pozwalające innym rozszerzeniom zrobić coś gdy puste pozycje są ukryte

### Wyczyszczono układ_strony

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Odp.: 3.1.2
-   Przeznaczenie: Zdarzenie pozwalające innym rozszerzeniom zrobić coś po usunięciu układu

### Zaktualizowano układ strony blitze_strony

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Odp.: 3.1.2
-   Przeznaczenie: Wydarzenie pozwala innym rozszerzeniom zrobić coś po aktualizacji układu

### [PLACEHOLDER] blitze_sitemera

-   Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
-   Od: 3.3.0
-   Przeznaczenie: Wydarzenie umożliwiające innym rozszerzeniom modyfikowanie opcji tinymce
