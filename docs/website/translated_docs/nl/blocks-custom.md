---
id: blokken-aangepast
title: Aangepaste blok
---

Als de beschikbare blokken je niet de vrijheid geven die je nodig hebt er is de `Custom Block` die u de vrijheid geeft om uw eigen inhoud te tonen met behulp van BBcode of HTML. Het blok wordt geleverd met een WYSIWYG-editor (TinyMCE) en een scriptmanager:

## De editor

- U kunt de editor gebruiken om HTML-inhoud aan te maken
- Je kunt de broncode bewerken als je die controle nodig hebt door te klikken op het `Broncode` pictogram (`<>`) in de editor
- Met de editor kunt u afbeeldingen uploaden en wijzigen 
    - Het maakt een nieuwe map aan in phpBB/images/sitemaker_uploads/ voor elke gebruiker die er toegang toe heeft
    - U kunt alle gebruikersmappen bekijken/beheren
- De editor filtert alle potentieel gevaarlijke scripts zoals javascript, enz. Als u inhoud zoals google ads moet toevoegen, zal de javascript worden gefilterd, maar u kunt er omheen door het volgende te doen: 
    - Voeg het aangepaste blok toe aan de gewenste locatie
    - Bewerk het Aangepast Blok, klik op het `tabblad HTML` en plak uw Javascript

## De Scripts Manager

Met het aangepaste blok kunt u ook aangepaste CSS-- en Javascript-bestanden aan uw pagina toevoegen. Om dit te doen:

- Voeg een `Eigen blok` toe aan elke block positie. De positie maakt niet uit tenzij je ook inhoud met het blok weergeeft
- Pas het blok aan klik op het tabblad `Scripts` en voeg je CSS of Javascript bestanden toe > Wees voorzichtig: het toevoegen aan veel scripts op je pagina kan de laadtijden beïnvloeden