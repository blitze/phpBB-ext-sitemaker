---
title: Tema
sidebar_position: 3
---

Vi förstår att mallfilerna och JS/CSS-filerna inte kommer att fungera för varje stil, så nedan är några sätt du kan använda dina egna mallar och skapa JS/CSS-filer för just din stil.

## Använda din egen mall

Om standardmallar som kommer med phpBB Sitemaker fungerar inte bra för just din stil, du kan enkelt skriva över den för att använda din egen mallfil genom att skapa motsvarande fil i din stilmapp.

Till exempel, säg att din stil heter `Backlash` och det har ett visst sätt på vilket HTML-koden för blockets header-sektion måste struktureras för [boxade vyn](/docs/user/blocks/block-views). Du kan skriva över den mallen genom att skapa en fil med samma namn som så: `phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

Med andra ord, för att använda din egen mallfil måste du:
* Identifiera vilken phpBB Sitemaker fil måste skrivas över
* Skapa en fil med samma namn i mappen Sitemaker `stilar` under ditt stilnamn

> Obs: Om du skapar dina egna mallfiler, se till att inte ta bort mappen `phpbb/ext/blitze/sitemaker` när du uppdaterar tillägget som dina anpassade filer kommer att raderas. Snarare bara skriva över befintliga filer med de nya.

## Skapa JS/CSS-filer för din stil

Notera:
* För syftet med nedanstående instruktioner kommer vi att anta att du har en stil som kallas min-stil.

Klona in i phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Från kommandoraden gå till sitemaker katalog:

    cd phpBB/ext/blitze/sitemaker

**Installera leverantörer**

    installation av kompositör

**Installera paket**

För nedanstående kommandon kan du använda npm eller [garn](https://yarnpkg.com)

    yarn installation

**Titta på ändringar**

    yarn start --tema min stil

**Gör ändringar**

* Gör dina ändringar i filerna i mappen phpBB/ext/blitze/sitemaker.
* Titta på phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss för sassvariabler

**Bygg tillgångar**

    yarn bygga --tema min stil

**Distribuera**

Du kan nu kopiera de genererade filerna från phpBB/ext/blitze/sitemaker/styles/my-style och ladda upp dem till din produktionsserver.

> Detta tillägg använder jQuery UI för flikar, dialogrutor och knappar. Standardtemat för jQuery är "smoothness". Du kan använda en annan jQuery UI tema som bäst passar ditt tema. Du kan ange jQuery UI tema med flaggan --jq_ui_theme. Till exempel:

    yarn bygga --tema min stil --jq_ui_theme ui-lätthet
