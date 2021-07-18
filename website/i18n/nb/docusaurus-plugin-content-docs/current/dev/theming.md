---
title: Utseende
sidebar_position: 3
---

Vi forstår at designmalfilene og JS/CSS ikke vil fungere for alle stiler, så under er noen måter du kan bruke dine egne maler og opprette JS/CSS-filer for din aktuelle stil.

## Bruker din egen mal

Hvis standardmalene som kommer med phpBB Sitemaker ikke fungerer bra for din aktuelle stil, du kan enkelt overskrive den til å bruke din egen malfil ved å lage den tilsvarende filen i stilmappen din.

For eksempel, si at stilen din er `Backlash` og den har en spesiell måte hvor HTML for overskriften i blokkoverskriften må struktureres for [kodet visning](/docs/user/blocks/block-views). Du kan overskrive den bestemte malen ved å opprette en fil av samme navn, som: `phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

Med andre ord, for å bruke din egen malfil, må du:
* Identifiser hvilken phpBB Sitemaker-fil som må overskrives
* Opprett en fil med samme navn i lokalisering `stiler` mappen under ditt stilnavn

> Merk: Hvis du lager dine egne malfiler, at du ikke sletter `phpbb/ext/blitze/sitemaker` mappen når du oppdaterer utvidelsen, som dine egendefinerte filer vil bli slettet. Bare overskriv de nye filene med dem.

## Oppretter JS/CSS-filer for din stil

Merk:
* I de nedenfor instruksene vil vi anta at du har en stil kalt mystil.

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

> Denne utvidelsen bruker jQuery UI for faner, dialoger og knapper. Det standard jQuery temaet er 'glatt'. Du kan bruke et annet jQuery UI tema som passer ditt beste tema. Du kan spesifisere jQuery UI temaet ved hjelp av flagget --jq_ui_theme. For eksempel:

    garn bygge --theme min-style --jq_ui_theme ui-lightness
