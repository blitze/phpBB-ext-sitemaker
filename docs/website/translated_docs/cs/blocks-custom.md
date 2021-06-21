---
id: bloky na míru
title: Celní blok
---

Pokud dostupné bloky neposkytují potřebnou svobodu. existuje `Vlastní blok` umožňující zobrazení vlastního obsahu pomocí BBCode nebo HTML. Blok přichází s WYSIWYG editorem (TinyMCE) a manažerem skriptů:

## Redaktor

- Můžete použít editor k vytvoření obsahu HTML
- Pokud potřebujete tuto úroveň řízení, můžete upravit kliknutím na ikonu `zdrojového kódu` (`<>`) v editoru
- Editor umožňuje nahrát a upravovat obrázky 
    - Vytváří novou složku v phpBB/images/sitemaker_uploads/ pro každého uživatele, který k ní má přístup
    - Můžete zobrazit/spravovat všechny uživatelské složky
- Editor filtruje jakékoli potenciálně nebezpečné skripty, jako je javascript atd. Pokud potřebujete přidat obsah jako google reklamy, javascript bude odfiltrován, ale můžete si to obejít pomocí následující: 
    - Přidejte celní blok na požadovanou polohu
    - Upravte vlastní blok, klikněte na záložku `HTML` a vložte svůj JavaScript

## Správce skriptů

Vlastní blok vám také umožňuje přidat vlastní CSS a Javascript soubory na vaši stránku. Abych to udělal:

- Přidejte `vlastní blok` do libovolné pozice bloku. Pozice nezáleží, pokud také nezobrazujete obsah s blokem
- Upravit blok, klikněte na záložku `skripty` a přidejte soubory CSS nebo Javascript > Slovo opatrnosti: Přidání mnoha skriptů na vaší stránce může ovlivnit časy načítání