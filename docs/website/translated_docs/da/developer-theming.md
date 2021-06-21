---
id: udvikler-tema
title: Temaer
---

phpBB SiteMaker kommer med stilarter og farver lavet til prosilver. Du kan overskrive CSS, JS og HTML-filer ved at oprette den tilsvarende fil i din stils mappe.

# Oprettelse af JS/CSS-filer til din stil

Bemærk: * Med henblik på nedenstående instruktioner vil vi antage, at du har en stil kaldet min-stil.

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

> Denne udvidelse bruger jQuery UI til faner, dialoger og knapper. Standard jQuery tema er 'smoothness.' Du kan bruge et andet jQuery UI tema, der passer bedst til dit tema. Du kan angive jQuery UI temaet ved hjælp af flaget --jq_ui_theme. For eksempel:

    garn build --theme min-stil --jq_ui_theme ui-lethed