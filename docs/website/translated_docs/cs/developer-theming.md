---
id: projektová tematika
title: Teorie
---

phpBB SiteMaker přichází se styly a barvy vyrobené pro prosilver. Můžete přepsat soubory CSS, JS a HTML vytvořením odpovídajícího souboru ve složce vašeho stylu.

# Vytváření souborů JS/CSS pro váš styl

Poznámka: * Pro účely níže uvedených pokynů budeme předpokládat, že máte styl zvaný muj-styl.

Klone do phpBB/ext/blitze/sitemaker:

    git klon https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker.
    

Z příkazové řádky přejděte do složky sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Nainstalujte prodejce**

    Jak instalovat skladatele
    

**Instalace balíčků**

Pro níže uvedené příkazy můžete použít npm nebo [yarn](https://yarnpkg.com)

    yarn instalace
    

**Pozor na změny**

    yarn start --theme my-styl
    

**Změny**

* Udělejte změny v souborech ve složce phpBB/ext/blitze/sitemaker/develop.
* Podívejte se na phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss for sass variables.

**Sestavovat aktiva**

    yarn staví --téma můj styl
    

**Deploy**

Nyní můžete zkopírovat zdrojové soubory z phpBB/ext/blitze/sitemaker/styles/my-styl a nahrát je na váš výrobní server.

> Toto rozšíření používá jQuery UI pro taby, dialogy a tlačítka. Výchozí jQuery téma je 'smoothness.' Můžete použít různé jQuery UI téma, které nejlépe vyhovuje vaší téma. Můžete zadat jQuery UI téma s použitím vlajky --jq_ui_theme. Například:

    yarn build --theme my-styl --jq_ui_theme ui-lightness ness