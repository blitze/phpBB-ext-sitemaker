---
id: blokken-aangepast
title: Aangepaste blok
---

Als de beschikbare blokken je niet de vrijheid geven die je nodig hebt er is de `Custom Block` die u de vrijheid geeft om uw eigen inhoud te tonen met behulp van BBcode of HTML. The block comes with a WYSIWYG editor (TinyMCE) and a scripts manager:

## De editor

- U kunt de editor gebruiken om HTML-inhoud aan te maken
- Je kunt de broncode bewerken als je die controle nodig hebt door te klikken op het `Broncode` pictogram (`<>`) in de editor
- The editor allows you to upload and modify images 
    - It creates a new folder in phpBB/images/sitemaker_uploads/ for every user who has access to it
    - You can view/manage all user folders
- De editor filtert alle potentieel gevaarlijke scripts zoals javascript, enz. Als u inhoud zoals google ads moet toevoegen, zal de javascript worden gefilterd, maar u kunt er omheen door het volgende te doen: 
    - Voeg het aangepaste blok toe aan de gewenste locatie
    - Bewerk het Aangepast Blok, klik op het `tabblad HTML` en plak uw Javascript

## The Scripts Manager

The Custom Block also allows you to add custom CSS and Javascript files to your page. To do this:

- Add a `Custom Block` to any block position. The position does not matter unless you are also displaying content with the block
- Edit the block, click on the `Scripts` tab and add your CSS or Javascript files > Word of caution though: Adding to many scripts on your page can affect load times