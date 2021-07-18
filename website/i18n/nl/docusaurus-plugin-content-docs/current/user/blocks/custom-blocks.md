---
title: Aangepaste blok
sidebar_position: 4
---

Als de beschikbare blokken u niet de vrijheid geven die u nodig heeft. er is het `Custom Block` waarmee u de vrijheid krijgt om uw eigen inhoud weer te geven met BBcode of HTML. Het blok wordt geleverd met een WYSIWYG-editor (TinyMCE) en een scriptmanager:

## De editor

-   Je kunt de editor gebruiken om HTML-inhoud te maken
-   Je kunt de broncode bewerken als je dat besturingsniveau nodig hebt door te klikken op het pictogram `Broncode` (`<>`) in de editor
-   Met de editor kunt u afbeeldingen uploaden en wijzigen
    -   Het maakt een nieuwe map aan in phpBB/images/sitemaker_uploads/ voor elke gebruiker die er toegang toe heeft
    -   U kunt alle gebruikersmappen bekijken/beheren
-   De editor filtert alle potentieel gevaarlijke scripts zoals javascript, enz. Als je inhoud wilt toevoegen zoals google advertenties, wordt het javascript uitgefilterd, maar je kunt daar omheen door het volgende te doen:
    -   Voeg het aangepaste blok toe aan de gewenste locatie
    -   Bewerk het aangepaste blok, klik op het tabblad `HTML` en plak uw Javascript

## De Scripts Manager

Met het aangepaste blok kunt u ook aangepaste CSS-- en Javascript-bestanden aan uw pagina toevoegen. Om dit te doen:

-   Voeg een `Eigen blok` toe aan elke block positie. De positie maakt niet uit tenzij je ook inhoud met het blok weergeeft
-   Pas het blok aan klik op het tabblad `Scripts` en voeg je CSS of Javascript bestanden toe > Wees voorzichtig: Toevoegen aan veel scripts op je pagina kan de laadtijden beïnvloeden
