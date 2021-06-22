---
title: Thematisering
sidebar_position: 3
---

We begrijpen dat de sjabloonbestanden en de JS/CSS-bestanden niet voor elke stijl zullen werken, dus hieronder vind je een aantal manieren om je eigen templates te gebruiken en JS/CSS-bestanden te maken voor je specifieke stijl.

## Gebruik van uw eigen template

Als de standaard templates met phpBB Sitemaker niet goed werken voor uw specifieke stijl, U kunt het eenvoudig overschrijven om gebruik te maken van uw eigen sjabloonbestand door het bijbehorende bestand aan te maken in de map van uw stijl.

Bijvoorbeeld zegt dat je stijl `Backlash` wordt genoemd en het heeft een bepaalde manier waarop de HTML voor de blok header sectie moet worden gestructureerd voor de [boxed weergave](/docs/user/blocks/block-views). U kunt dit sjabloon overschrijven door een bestand aan te maken met dezelfde naam als bij: `phpBB/ext/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

Met andere woorden, om uw eigen sjabloonbestand te gebruiken, moet u:
* Identificeren welke phpBB Sitemaker bestand moet worden overschreven
* Maak een bestand met dezelfde naam in de Sitemaker `styles` map onder uw style name

> Opmerking: Als u uw eigen sjabloonbestanden aanmaakt, zorg ervoor dat u de map `phpbb/ext/blitze/sitemaker` niet verwijdert bij het bijwerken van de extensie, omdat uw aangepaste bestanden zullen worden verwijderd. Veeleer overschrijft u de bestaande bestanden met de nieuwe.

## JS/CSS-bestanden voor uw stijl maken

Opmerking:
* Voor de onderstaande instructies gaan we ervan uit dat je een stijl hebt met de naam mijn-stijl.

Kloon in phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Van opdrachtregel ga naar sitemaker directory:

    cd phpBB/ext/blitze/sitemaker

**Leveranciers installeren**

    installatie van componist

**Installeer pakketten**

Voor onderstaande commando's kan je npm of [yarn](https://yarnpkg.com) gebruiken

    yarn installatie

**Wijzigingen bekijken**

    yarn start --thema mijn-stijl

**Wijzigingen aanbrengen**

* Verander uw wijzigingen in de bestanden in de phpBB/ext/blitze/sitemaker/develop map.
* Kijk naar phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss voor sass variabelen

**Bouw Activa**

    yarn build --thema mijn-stijl

**Implementeren**

U kunt nu de gegenereerde bestanden kopiëren van phpBB/ext/blitze/sitemaker/styles/mijn-stijl en ze uploaden naar uw productieserver.

> Deze extensie maakt gebruik van jQuery UI voor tabs, dialogen en knoppen. Het standaard jQuery thema is 'gladheid'. U kunt een ander jQuery UI thema gebruiken dat het beste bij uw thema past. U kunt het jQuery UI thema specificeren met behulp van de vlag --jq_ui_thema. Bijvoorbeeld:

    yarn build --theme mijn-stijl --jq_ui_theme ui-lightness
