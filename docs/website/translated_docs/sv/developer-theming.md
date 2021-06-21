---
id: tema för utvecklare
title: Tema
---

phpBB SiteMaker levereras med stilar och färger för prosilver. Du kan skriva över CSS, JS och HTML-filer genom att skapa motsvarande fil i din stilmapp.

# Skapa JS/CSS-filer för din stil

Obs: * För nedanstående instruktioner kommer vi att anta att du har en stil som kallas my-style.

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

> Detta tillägg använder jQuery UI för flikar, dialogrutor och knappar. Standardtemat jQuery är "smoothness". Du kan använda en annan jQuery UI tema som bäst passar ditt tema. Du kan ange jQuery UI tema med flaggan --jq_ui_theme. Till exempel:

    yarn bygga --tema min stil --jq_ui_theme ui-lätthet