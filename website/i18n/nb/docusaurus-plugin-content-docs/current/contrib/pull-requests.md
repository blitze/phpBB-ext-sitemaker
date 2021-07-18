---
title: Sender en trekkforespørsel
sidebar_label: Rull Requests
---

`Pull forespørsler lar deg fortelle andre om endringer du har trykket på en gren i et område på GitHub. Når en forespørselsforespørsel er åpnet, Du kan diskutere og gjennomgå mulige endringer med samarbeidspartnere, og legge til en oppfølging før endringene fusjoneres i grunngrenen.` [Les mer](https://help.github.com/articles/about-pull-requests/)

## Tår/Kloning

* Opprett en github konto hvis du ikke allerede har en
* Gå til https://github.com/blitze/phpBB-ext-sitemaker.git og klikk på "Fork"

Klon din gren av depoet:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Fra kommandolinjen går til sitemaker mappen:

    cd phpBB/ext/blitze/sitemaker

**Konfigurer siden:**

Legg brukernavnet ditt til Git i systemet:

    git config --global bruker.navn "Ditt navn her"

Legg til din e-postadresse til Git på ditt system:

    git config --legg til bruker.email brukernavn@phpbbb.com

Legg til fjernkontrollen oppstrøms (du kan endre "oppstrøm" til hva du vil):

    git ekstern legg til oppstrøms git://github.com/blitze/phpBB-ext-sitemaker.git

**Installer leverandører**

    installering av komponist

**Installer NPM pakker**

    npm install

Alternativt kan du bruke [garn](https://yarnpkg.com):

    garn installer

## Rull Requests

    # Lag en ny gren for din funksjon & bytt til den
    git checkout -b funksjon/my-fancy-new-feature
    
    # Opprett en ny filial for feilen du arbeider på * bytt til den (billett # er fra github tracker)
    git sjekk -b ticket/1234

Gjør dine endringer

    # Scene filene
    git legg til <files> 
    
    # Send inn staged filer - Vennligst bruk en korrekt commit melding
    git commit -m "my commit message"

Skyv gren tilbake til GitHub git push-origin funksjon/my-fancy-new-feature

Send inn en [trekk-forespørsel](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
