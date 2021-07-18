---
id: Požadavky na registraci
title: Odesílání žádosti o ubytování
sidebar_label: Pull Requests
---

`Pull requests let you tell others about changes you've ve ve made a branch in a repository on GitHub. Po otevření pull requestu můžete prodiskutovat a zkontrolovat případné změny se spolupracovníky a přidat následné commity před sloučením do základní větve.` [Přečtěte si více](https://help.github.com/articles/about-pull-requests/)

## Klonování

* Pokud již nemáte účet
* Jděte na https://github.com/blitze/phpBB-ext-sitemaker.git a klikněte na "Fork"

Klone Váš vidák repozitáře:

    git klon git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker/
    

Z příkazové řádky přejděte do složky sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Konfigurovat git:**

Přidejte uživatelské jméno Gitovi na váš systém:

    git config --global user.name "Vaše jméno zde"
    

Přidejte svou e-mailovou adresu k Gitu na váš systém:

    git config --add user.email username@phpbb.com
    

Přidejte nahoru vzdálený (můžete změnit ‘upstream’ na to, co chcete):

    git vzdálené přidat upstream git://github.com/blitze/phpBB-ext-sitemaker.git.
    

**Nainstalujte prodejce**

    Jak instalovat skladatele
    

**Nainstalujte NPM balíčky**

    npm install
    

Případně můžete použít [yarn](https://yarnpkg.com):

    yarn instalace
    

## Pull Requests

    # Vytvořte novou větev pro vaši funkci & přepněte na ni
    git checkout -b feature/my-fancy-new-feature
    
    # vytvořte novou větev pro problém, na kterém pracujete* přepnout na (ticket # je z github tracker)
    git checkout -b ticket/1234
    

Učiňte změny

    # Fáze souborů
    git add <files> 
    
    # archivovaných souborů - použijte prosím správnou commit zprávu
    git commit -m "moje commit zpráva"
    

Stiskněte větev zpět na GitHub možnost původu gitu / muj-fancy-new-feature

Podat [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)