---
id: wydarzenia deweloperskie
title: phpBB SiteMaker Wydarzenia
---

Możesz modyfikować zachowanie phpBB SiteMaker za pomocą systemu zdarzeń phpBB.

## Zdarzenia PHP

# Opcje edytora strony

- Lokalizacja: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- od: 3.1.0
- Przeznaczenie: Dodaj opcje menu zbiorczego w menu acp

# Formularz wyświetlacza

- Lokalizacja: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- od: 3.1.0
- Przeznaczenie: wyświetlanie ustawień acp (sitemaker)

# Zapisuj ustawienia

- Lokalizacja: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- od: 3.1.0
- Zastosowanie: Zapisz ustawienia acp (sitemaker)

# Admin_Blitze

- Lokalizacja: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- od: 3.0.1-RC1
- Zastosowanie: Dodaj zasoby dla dostępnych bloków w trybie edycji

# Modyfikator pozycji

- Lokalizacja: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- od: 3.0.1-RC1
- Przeznaczenie: Modyfikacja pozycji bloków

# Zmodyfikuj blok

- Lokalizacja: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- od: 3.0.1-RC1
- Przeznaczenie: Modyfikuj renderowany blok

## Wydarzenia szablonu

# blitze_sitemaker_ustawienia acp_

- Lokalizacja: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- od: 3.1.0
- Przeznaczenie: Dodaj pola formularza dla ustawień sitemakera

# blitze_administrator_admin_bar_dołącz

- Lokalizacja: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- od: 3.1.0
- Zastosowanie: Dodaj elementy menu do paska administratora

# [PLACEHOLDER] blitze_sitemaker_admin_bar

- Lokalizacja: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- od: 3.1.0
- Zastosowanie: Dodaj pliki szablonu do użycia w JS dla widoków bloków itp

## Wydarzenia JavaScript

# blitze_layout_zapisany

- Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- Ponieważ: 3.1.2
- Zastosowanie: Zdarzenie, aby zezwolić innym rozszerzeniom na coś podczas zapisywania zmian układu

# Blitze_wyrenderowanie_przed

- Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Ponieważ: 3.1.2
- Zastosowanie: Zdarzenie, aby zezwolić innym rozszerzeniom na coś przed renderowaniem bloku lub uniemożliwienie jego renderowania

# blitze_twórca_render_po

- Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Ponieważ: 3.1.2
- Zastosowanie: Zdarzenie, aby zezwolić innym rozszerzeniom na coś po wykonaniu bloku

# Blitze_zapisywanie_przed

- Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- Ponieważ: 3.1.2
- Przeznaczenie: Zdarzenie pozwalające innym rozszerzeniom na modyfikację danych bloku przed ich zapisaniem

# [PLACEHOLDER] blitze_sitemaker_show_all_block_positions

- Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Ponieważ: 3.1.2
- Zastosowanie: Zdarzenie, aby umożliwić innym rozszerzeniom coś zrobić, gdy wszystkie pozycje bloków są pokazane

# [PLACEHOLDER] blitze_sitemaker_hiide_empty_block_positions

- Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Ponieważ: 3.1.2
- Zastosowanie: Zdarzenie, aby umożliwić innym rozszerzeniom coś zrobić, gdy puste pozycje są ukryte

# [PLACEHOLDER] blitze_sitemaker_layout_clear

- Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Ponieważ: 3.1.2
- Przeznaczenie: Zdarzenie, aby umożliwić innym rozszerzeniom coś zrobić, gdy układ jest wyczyszczony

# zaktualizowana_układ_blitze_strony

- Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Ponieważ: 3.1.2
- Zastosowanie: Zdarzenie, aby zezwolić innym rozszerzeniom na coś podczas aktualizacji układu

# [PLACEHOLDER] blitze_sitemera

- Lokalizacja: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- Od: 3.3.0
- Przeznaczenie: Wydarzenie umożliwiające innym rozszerzeniom modyfikowanie opcji tinymce