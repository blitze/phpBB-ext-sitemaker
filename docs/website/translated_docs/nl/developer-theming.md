---
id: ontwikkelaar-theming
title: Thema
---

phpBB SiteMaker komt met stijlen en kleuren gemaakt voor prosilver. U kunt CSS, JS en HTML bestanden overschrijven door het bijbehorende bestand in de map van uw stijl te maken.

# Het maken van JS/CSS bestanden voor uw stijl

Opmerking: * Voor het doel van de onderstaande instructies gaan we ervan uit dat u een stijl heeft genaamd mijn-stijl.

Kloon in phpBB/ext/blitze/sitemaker:

    git kloon https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Van opdrachtregel ga naar sitemaker directory:

    cd phpBB/ext/blitze/sitemaker
    

**Fabrikanten installeren**

    componist installatie
    

**Installeer pakketten**

Voor de onderstaande opdrachten kunt u npm of [yarn](https://yarnpkg.com) gebruiken

    yarn installatie
    

**Bekijk wijzigingen**

    yarn start --thema mijn-stijl
    

**Wijzigingen maken**

* Maak uw wijzigingen in bestanden in de phpBB/ext/blitze/sitemaker/develop map.
* Kijk naar phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss voor sass variabelen

**Bouw Assets**

    yarn build --thema mijn-stijl
    

**Deployen**

U kunt nu de gegenereerde bestanden kopiëren van phpBB/ext/blitze/sitemaker/styles/my-style en deze uploaden naar uw productieserver.

> Deze extensie gebruikt jQuery UI voor tabbladen, dialogen en knoppen. Het standaard jQuery thema is 'smoothness.' U kunt een ander jQuery UI thema gebruiken dat het beste past bij uw thema. U kunt het jQuery UI thema met de vlag --jq_ui_theme specificeren. Bijvoorbeeld:

    yarn build --thema mijn-stijl --jq_ui_theme ui-lightness