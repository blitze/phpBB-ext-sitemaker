---
title: Odeslání žádosti o natažení
sidebar_label: Požadavky na natažení
---

`Požadavky na natažení vám umožní informovat ostatní o změnách, které jste nahráli do větve v repozitáři na GitHubu. Jakmile je otevřen požadavek na natažení, můžete diskutovat a zkontrolovat případné změny se spolupracovníky a přidat následné revize před sloučením změn do základní větve.` [Číst více](https://help.github.com/articles/about-pull-requests/)

## Přídavná přísada/klonování

* Vytvořte si github účet, pokud ho již nemáš
* Přejděte na https://github.com/blitze/phpBB-ext-sitemaker.git a klikněte na "Fork"

Klonovat rozštěpení repozitáře:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Z příkazové řádky přejděte do adresáře sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Konfigurovat git:**

Přidejte své uživatelské jméno do systému Git:

    git config --global user.name "Vaše jméno zde"

Přidejte svou e-mailovou adresu do Gitu ve vašem systému:

    git config --add user.email username@phpb.com

Přidejte před streamem vzdálený (můžete změnit „nahoru“ na cokoliv chcete):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git

**Instalovat dodavatele**

    instalace editoru

**Instalovat NPM balíčky**

    npm install

Případně můžete použít [příze](https://yarnpkg.com):

    montáž příze

## Požadavky na natažení

    # Vytvořte novou větev pro vaši funkci & přepněte na ni
    git checkout -b feature/my-fancy-new-feature
    
    # vytvořte novou větev pro problém, na kterém pracujete* (tiket # je z github tracker)
    git checkout -b ticket/1234

Proveďte změny

    # Fager soubory
    git add <files> 
    
    # Commit stage files - použijte správnou zprávu
    git commit -m "my commit message"

Stiskněte větev zpět na GitHub git push výchozí funkci/my-fancy-new-feature

Odeslat [požadavek na natažení](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
