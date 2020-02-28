---
id: bloky na míru
title: Celní blok
---

Pokud dostupné bloky neposkytují potřebnou svobodu. existuje `Vlastní blok` umožňující zobrazení vlastního obsahu pomocí BBCode nebo HTML. Blok je dodáván s WYSIWYG editorem (TinyMCE), [Správce souborů](./filemanager.md)a správce skriptů:

## Redaktor

* Můžete použít editor k vytvoření obsahu HTML
* Pokud potřebujete tuto úroveň řízení, můžete upravit kliknutím na ikonu `zdrojového kódu` (`<>`) v editoru
* Editor vám umožní nahrát a upravovat obrázky
* Editor filtruje jakékoli potenciálně nebezpečné skripty, jako je javascript atd. Pokud potřebujete přidat obsah jako google reklamy, javascript bude odfiltrován, ale můžete si to obejít pomocí následující: 
    * Přidejte celní blok na požadovanou polohu
    * Upravte vlastní blok, klikněte na záložku `HTML` a vložte svůj JavaScript

## Správce souborů

`Custom Block` také obsahuje [File Manager](./filemanager.md) jako TinyMCE pluglin * Vytváří novou složku v phpBB/images/sitemaker_uploads/ pro každého uživatele, který k ní má přístup. * Můžete prohlížet/spravovat všechny složky uživatele

## Správce skriptů

Vlastní blok také umožňuje přidat na stránku vlastní CSS a JavaScript soubory. Chcete-li tak učinit: * Přidejte `vlastní blok` do libovolné pozice bloku. Na pozici nezáleží, pokud nezobrazujete obsah s blokem * Upravte blok, klikněte na kartu `Scripts` a přidejte CSS nebo JavaScript soubory

> Ale opatrnost: Přidání mnoha skriptů na vaší stránce může ovlivnit dobu nahrávání