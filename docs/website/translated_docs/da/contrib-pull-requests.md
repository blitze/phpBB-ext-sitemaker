---
id: contrib-pull-requests
title: Indsendelse af en Pull-anmodning
sidebar_label: Træk Forespørgsler
---

`Træk anmodninger lader dig fortælle andre om ændringer, du har skubbet til en gren i et depot på GitHub. Når en pull request er åbnet, du kan diskutere og gennemgå de potentielle ændringer med samarbejdspartnere og tilføje opfølgningsforpligtelser, før dine ændringer bliver flettet ind i basisbranchen.` [Læs mere](https://help.github.com/articles/about-pull-requests/)

## Forking/Kloning

* Opret en github konto hvis du ikke allerede har en
* Gå til https://github.com/blitze/phpBB-ext-sitemaker.git og klik på "Fork"

Klon din gaffel af lageret:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Fra kommandolinjen gå til sitemaker mappe:

    cd phpBB/ext/blitze/sitemaker
    

**Konfigurer git:**

Tilføj dit brugernavn til Git på dit system:

    git config -- global user.name "Dit navn her"
    

Tilføj din e-mailadresse til Git på dit system:

    git config --add user.email brugernavn@phpbb.com
    

Tilføj fjernbetjeningen opstrøms (du kan ændre 'opstrøm' til hvad du vil):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git
    

**Installer sælgere**

    installation af komponist
    

**Installer NPM pakker**

    npm install
    

Alternativt kan du bruge [garn](https://yarnpkg.com):

    garninstallation
    

## Træk Forespørgsler

    # Opret en ny gren for din funktion & skift til den
    git checkout -b feature/min-fancy-new-feature
    
    # oprette en ny gren for det problem, du arbejder på * skifte til det (billet # er fra github tracker)
    git checkout -b billet/1234
    

Foretag dine ændringer

    # Trin filerne
    git add <files> 
    
    # Commit staged files - brug venligst en korrekt commit besked
    git commit -m "min commit besked"
    

Skub grenen tilbage til GitHub git push origin feature/min-fancy-new-feature

Indsend en [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)