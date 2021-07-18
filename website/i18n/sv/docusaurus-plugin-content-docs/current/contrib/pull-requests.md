---
title: Skicka in en Pull-förfrågan
sidebar_label: Pull förfrågningar
---

`Dra förfrågningar låter dig berätta för andra om ändringar som du har skjutit till en gren i ett utvecklingskatalog på GitHub. När en pull-förfrågan har öppnats, du kan diskutera och granska eventuella ändringar med samarbetspartners och lägga till uppföljningskontroller innan dina ändringar slås samman till basgrenen.` [Läs mer](https://help.github.com/articles/about-pull-requests/)

## Forkar/Kloning

* Skapa ett github-konto om du inte redan har ett
* Gå till https://github.com/blitze/phpBB-ext-sitemaker.git och klicka på "Fork"

Klona din gaffel av utvecklingskatalogen:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Från kommandoraden gå till sitemaker katalog:

    cd phpBB/ext/blitze/sitemaker

**Konfigurera git:**

Lägg till ditt användarnamn till Git på ditt system:

    git config --global user.name "Ditt namn här"

Lägg till din e-postadress till Git på ditt system:

    git config --add user.email användarnamn@phpbb.com

Lägg till uppströms fjärrkontroll (du kan ändra 'uppströms' till vad du vill):

    git remote lägg till uppströms git://github.com/blitze/phpBB-ext-sitemaker.git

**Installera leverantörer**

    installation av kompositör

**Installera NPM-paket**

    npm install

Alternativt kan du använda [garn](https://yarnpkg.com):

    yarn installation

## Pull förfrågningar

    # Skapa en ny affärsenhet för din funktion & växla till den
    git kassan -b funktion/my-fancy-new-feature
    
    # skapa en ny affärsenhet för problemet du arbetar med * växla till det (ärende# är från github tracker)
    git kassan -b biljett/1234

Gör dina ändringar

    # Steg filerna
    git add <files> 
    
    # Commit iscensatta filer - använd ett korrekt commit meddelande
    git commit -m "my commit message"

Tryck tillbaka affärsenheten till GitHub git push-ursprung funktion/my-fancy-new-feature

Skicka in en [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
