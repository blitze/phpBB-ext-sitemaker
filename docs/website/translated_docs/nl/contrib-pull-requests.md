---
id: contrib-pull-requests
title: Een Pull request indienen
sidebar_label: Pull verzoeken
---

`Pull verzoeken laten je anderen vertellen over wijzigingen die je hebt doorgevoerd naar een branch in een repository op GitHub. Zodra een pull request is geopend, kunt u de mogelijke wijzigingen met medewerkers bespreken en bekijken en aanvullende commits toevoegen voordat uw wijzigingen worden samengevoegd in de basis branch.` [Lees meer](https://help.github.com/articles/about-pull-requests/)

## Forking/Klonen

* Maak een github account aan als je er nog geen hebt
* Ga naar https://github.com/blitze/phpBB-ext-sitemaker.git en klik op "Fork"

Kloon je fork van de repository:

    git kloon git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Van opdrachtregel ga naar sitemaker directory:

    cd phpBB/ext/blitze/sitemaker
    

**git configureren:**

Voeg uw gebruikersnaam toe aan Git op uw systeem:

    git config --global user.name "Your Name here"
    

Voeg uw e-mailadres toe aan Git op uw systeem:

    git config --user.email gebruikersnaam@phpbb.com toevoegen
    

Voeg de stroomafwaartse afstand toe (u kunt 'upstream' veranderen naar wat u wilt):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git
    

**Fabrikanten installeren**

    componist installatie
    

**NPM-pakketten installeren**

    npm installatie
    

Alternatief kunt u [yarn](https://yarnpkg.com) gebruiken:

    yarn installatie
    

## Pull verzoeken

    # Maak een nieuwe branch voor je functie & switch naar
    git checkout -b functie/my-fancy-new-feature
    
    # maak een nieuwe branch voor het probleem waaraan je werkt * switch naar het probleem (ticket # is van github tracker)
    git checkout -b ticket/1234
    

Maak je wijzigingen

    # Plaats de bestanden
    git add <files> 
    
    # Commit staged files - gebruik een correct commit bericht
    git commit -m "mijn commit bericht"
    

Push de branch terug naar GitHub git push-origin functie/my-fancy-new-feature

Verstuur een [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)