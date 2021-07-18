---
title: Een pull-aanvraag indienen
sidebar_label: Pull Requests
---

`Pull requests laten je anderen vertellen over wijzigingen die je naar een branch in een repository op GitHub hebt gepusht. Zodra een pull-aanvraag is geopend, je kan de potentiële wijzigingen bespreken en bekijken met medewerkers en follow-up commits toevoegen voordat je wijzigingen worden samengevoegd in de basis branch.` [Lees meer](https://help.github.com/articles/about-pull-requests/)

## Toon/Klonen

* Maak een github account aan als je er nog geen hebt
* Ga naar https://github.com/blitze/phpBB-ext-sitemaker.git en klik op "Fork"

Kopieer uw vork van de repository:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Van opdrachtregel ga naar sitemaker directory:

    cd phpBB/ext/blitze/sitemaker

**Git configureren:**

Voeg uw gebruikersnaam toe aan uw systeem:

    git config --global user.name "Your Name Here"

Voeg uw e-mailadres toe aan Git op uw systeem:

    git configuratie --voeg user.email username@phpbb.com toe

Voeg de afstandsbediening stroomopwaarts toe (je kunt ‘upstream’ veranderen naar wat je wilt):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git

**Leveranciers installeren**

    installatie van componist

**Installeer NPM pakketten**

    npm install

U kunt ook [yarn](https://yarnpkg.com) gebruiken:

    yarn installatie

## Pull Requests

    # Maak een nieuw filiaal aan voor uw functie & schakel er naar toe
    git checkout -b functie/my-fancy-new-feature
    
    # maak een nieuwe branch aan voor het issue waaraan u werkt * wissel (ticket # is van github tracker)
    git checkout -b ticket/1234

Maak uw wijzigingen

    # Fase de bestanden
    git add <files> 
    
    # Commit staged bestanden - gebruik een juist commit bericht
    git commit -m "my commit message"

Duw de branch terug naar GitHub git push origin functie/mijn-fancy-new-functie

Verstuur een [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
