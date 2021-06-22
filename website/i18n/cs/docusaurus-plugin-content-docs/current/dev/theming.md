---
title: Motivy
sidebar_position: 3
---

Chápeme, že soubory šablon a soubory JS/CSS nebudou fungovat pro každý styl, takže níže jsou některé způsoby, jak můžete použít vlastní šablony a vytvářet JS/CSS soubory pro váš konkrétní styl.

## Pomocí vlastní šablony

Pokud výchozí šablony přicházející s phpBB Sitemaker nefungují dobře pro váš konkrétní styl, můžete jej snadno přepsat tak, aby používal vlastní šablonu vytvořením odpovídajícího souboru ve složce vašich stylů.

Například řekněte, že váš styl se nazývá `Backlash` a má zvláštní způsob, jak musí být HTML pro hlavičku bloku strukturován pro [boxed view](/docs/user/blocks/block-views). Tuto konkrétní šablonu můžete přepsat vytvořením souboru stejným názvem, jako je toto: `phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

Jinými slovy, abyste mohli používat vlastní šablonu souboru, musíte
* Určete, který phpBB Sitemaker soubor musí být přepsán
* Vytvořte soubor se stejným názvem ve složce Sitemaker `stylů` pod vaším názvem

> Poznámka: Pokud vytvoříte vlastní šablony souborů, se ujistěte, že při aktualizaci rozšíření složku `phpb/ext/blitze/sitemaker` , protože vaše vlastní soubory budou smazány. Spíše jednoduše přepište existující soubory novými.

## Vytváření JS/CSS souborů pro váš styl

Pozn.:
* Pro účely níže uvedených pokynů předpokládáme, že máte styl s názvem my-style.

Klonovat do phpBB/ext/blitze/sitemaker:

    git klonovat https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Z příkazové řádky přejděte do adresáře sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Instalovat dodavatele**

    instalace editoru

**Instalovat balíčky**

Pro níže uvedené příkazy můžete použít npm nebo [yarn](https://yarnpkg.com)

    montáž příze

**Sledovat změny**

    nit startovací --theme my-styl

**Provést změny**

* Proveďte změny souborů ve složce phpBB/ext/blitze/sitemaker/Develop.
* Podívejte se na phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss pro proměnné sass

**Postavit majetek**

    příze stavět --theme my-styl

**Publikovat**

Nyní můžete zkopírovat vygenerované soubory z phpBB/ext/blitze/sitemaker/style/muj-styly a nahrát je na váš produkční server.

> Toto rozšíření používá jQuery UI pro panely, dialogy a tlačítka. Výchozí motiv jQuery je 'smoothnes'. Můžete použít jinou jQuery uživatelskou šablonu, která nejlépe vyhovuje vašemu tématu. Šablonu jQuery UI můžete zadat pomocí příznak --jq_ui_theme. Například:

    yarn build --theme my-style --jq_ui_theme ui-lightness
