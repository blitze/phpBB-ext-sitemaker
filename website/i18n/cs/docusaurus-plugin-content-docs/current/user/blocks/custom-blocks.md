---
title: Vlastní blok
sidebar_position: 4
---

Pokud vám dostupné bloky nedávají svobodu, kterou potřebujete, existuje `vlastní blok` , který vám umožňuje svobodně zobrazit svůj vlastní obsah pomocí BBcode nebo HTML. Blok přichází s WYSIWYG editorem (TinyMCE) a manažerem skriptů:

## Editor

-   Můžete použít editor k vytvoření HTML obsahu
-   Pokud potřebujete tuto úroveň ovládání, můžete upravit zdrojový kód kliknutím na ikonu `zdrojového kódu` (`<>`) v editoru
-   Editor umožňuje nahrát a upravovat obrázky
    -   Vytváří novou složku v phpBB/images/sitemaker_uploads/ pro každého uživatele, který k ní má přístup
    -   Můžete zobrazit/spravovat všechny uživatelské složky
-   Editor filtruje všechny potenciálně nebezpečné skripty jako javascript, atd. Pokud potřebujete přidat obsah, jako jsou reklamy google, javascript bude filtrován, ale můžete se tomu dostat následujícím způsobem:
    -   Přidat vlastní blok do požadovaného umístění
    -   Upravte vlastní blok, klikněte na záložku `HTML` a vložte svůj Javascript

## Správce skriptů

Vlastní blok vám také umožňuje přidat vlastní CSS a Javascript soubory na vaši stránku. Abych to udělal:

-   Přidejte `vlastní blok` do libovolné pozice bloku. Pozice nezáleží, pokud také nezobrazujete obsah s blokem
-   Upravit blok, klikněte na záložku `skripty` a přidejte soubory CSS nebo Javascript > Slovo opatrnosti: Přidání mnoha skriptů na vaší stránce může ovlivnit časy načítání
