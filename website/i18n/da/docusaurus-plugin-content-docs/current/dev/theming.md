---
title: Temaer
sidebar_position: 3
---

Vi forstår, at skabelonfiler og JS / CSS filer ikke vil fungere for hver stil, så nedenfor er nogle måder, du kan bruge dine egne skabeloner og oprette JS/CSS-filer til din særlige stil.

## Brug din egen skabelon

Hvis standardskabeloner, der kommer med phpBB Sitemaker ikke fungerer godt for din særlige stil, du kan nemt overskrive den til at bruge din egen skabelonfil ved at oprette den tilsvarende fil i din stils mappe.

For eksempel siger, at din stil kaldes `Backlash` , og det har en særlig måde, hvorpå HTML til blok header sektionen skal struktureres til [boxed view](/docs/user/blocks/block-views). Du kan overskrive den pågældende skabelon ved at oprette en fil med samme navn som så: `phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

Med andre ord, for at bruge din egen skabelon fil, skal du:
* Identificer hvilken phpBB Sitemaker fil skal overskrives
* Opret en fil med samme navn i Sitemaker `stilen` mappen under dit stilnavn

> Bemærk: Hvis du opretter dine egne skabelonfiler, sørg for ikke at slette mappen `phpbb/ext/blitze/sitemaker` ved opdatering af udvidelsen, da dine brugerdefinerede filer vil blive slettet. Snarere, bare overskrive de eksisterende filer med de nye.

## Oprettelse af JS/CSS-filer til din stil

Bemærk:
* Med henblik på nedenstående instruktioner vil vi antage, at du har en stil kaldet min-stil.

Klon i phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Fra kommandolinjen gå til sitemaker mappe:

    cd phpBB/ext/blitze/sitemaker

**Installer sælgere**

    installation af komponist

**Installer pakker**

Til nedenstående kommandoer kan du bruge npm eller [garn](https://yarnpkg.com)

    garninstallation

**Overvågning Ændringer**

    garn start -- theme min- style

**Foretag Ændringer**

* Foretag dine ændringer til filer i phpBB/ext/blitze/sitemaker/udvikle mappen.
* Kig på phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss for sass variabler

**Byg Aktiver**

    garn build -- theme min- style

**Deploy**

Du kan nu kopiere de genererede filer fra phpBB/ext/blitze/sitemaker/styles/my-style og uploade dem til din produktionsserver.

> Denne udvidelse bruger jQuery UI til faner, dialoger og knapper. Standard jQuery tema er 'smoothness'. Du kan bruge en anden jQuery UI tema, der passer bedst til dit tema. Du kan angive jQuery UI temaet ved hjælp af flaget --jq_ui_theme. For eksempel:

    garn build --theme min-stil --jq_ui_theme ui-lethed
