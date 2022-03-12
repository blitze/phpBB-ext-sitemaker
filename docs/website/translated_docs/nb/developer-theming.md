---
id: utviklertema
title: Utseende
---

phpBB SiteMaker kommer med stiler og farger laget for prosilver. Du kan overskrive CSS, JS og HTML filer ved å opprette den tilsvarende filen i stilmappen.

# Oppretter JS/CSS-filer for din stil

Merk: * Med tanke på instruksjonene nedenfor antar vi at du har en stil kalt min-stil.

Klon inn i phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Fra kommandolinjen går til sitemaker mappen:

    cd phpBB/ext/blitze/sitemaker
    

**Installer leverandører**

    installering av komponist
    

**Installer pakker**

For kommandoene under kan du bruke npm eller [garn](https://yarnpkg.com)

    garn installer
    

**Se Endringer**

    garn start --tema min-stil
    

**Gjøre endringer**

* Gjør endringer i filen i phpBB/ext/blitze/sitemaker/utviklingsmappen
* Se på phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss for sass variabler

**Bygg Eiendeler**

    garn bygg --theme min-stil
    

**Installer**

Nå kan du kopiere de genererte filene fra phpBB/ext/blitze/sitemaker/stiler/my-stil og laste dem opp i din produksjonsserver.

> Denne utvidelsen bruker jQuery UI for faner, dialoger og knapper. Det standard jQuery temaet er 'glatt'. Du kan bruke et annet jQuery UI tema som passer ditt tema. Du kan spesifisere jQuery UI temaet ved hjelp av flagget --jq_ui_theme. For eksempel:

    garn bygge --theme min-style --jq_ui_theme ui-lightness