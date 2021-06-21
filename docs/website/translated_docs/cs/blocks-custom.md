---
id: bloky na míru
title: Celní blok
---

Pokud dostupné bloky neposkytují potřebnou svobodu. existuje `Vlastní blok` umožňující zobrazení vlastního obsahu pomocí BBCode nebo HTML. The block comes with a WYSIWYG editor (TinyMCE) and a scripts manager:

## Redaktor

- Můžete použít editor k vytvoření obsahu HTML
- Pokud potřebujete tuto úroveň řízení, můžete upravit kliknutím na ikonu `zdrojového kódu` (`<>`) v editoru
- The editor allows you to upload and modify images 
    - It creates a new folder in phpBB/images/sitemaker_uploads/ for every user who has access to it
    - You can view/manage all user folders
- Editor filtruje jakékoli potenciálně nebezpečné skripty, jako je javascript atd. Pokud potřebujete přidat obsah jako google reklamy, javascript bude odfiltrován, ale můžete si to obejít pomocí následující: 
    - Přidejte celní blok na požadovanou polohu
    - Upravte vlastní blok, klikněte na záložku `HTML` a vložte svůj JavaScript

## The Scripts Manager

The Custom Block also allows you to add custom CSS and Javascript files to your page. To do this:

- Add a `Custom Block` to any block position. The position does not matter unless you are also displaying content with the block
- Edit the block, click on the `Scripts` tab and add your CSS or Javascript files > Word of caution though: Adding to many scripts on your page can affect load times