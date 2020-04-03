---
id: filemanager
title: Responsive Filemanager
---

Vanaf versie 3.1.0 ondersteunt phpBB SiteMaker de [Responsive Filemanager](http://responsivefilemanager.com)

* De bestandsbeheerder wordt gebruikt als een TinyMCE pluging (WYSIWYG editor) bij het bewerken van aangepaste blokken
* Het is momenteel geconfigureerd om afzonderlijke mappen voor elke gebruiker te maken, behalve de gebruiker met een_sm_filemanager permissie (kan andere gebruikersmappen zien/beheren), waardoor ze toegang hebben tot het bekijken/beheren van alle uploadmappen.

## Installatie

* Download de [Responsive FileManager](http://responsivefilemanager.com/index.php#sthash.5UrnhjX2.dpbs)
* Haal het uit en upload de bestanden naar uw phpBB hoofdmap. De bestandsstructuur moet als hieronder zijn:

```text
phpBB
<unk> <unk> afbeeldingen/
<unk> <unk> <unk> includes/
<unk> <unk> <unk> <unk> <unk> ...
<unk> ResponsiveFilemanager/
    <unk> <unk> filemanager/
        <unk> <unk> <unk> <unk> config/
            <unk> <unk> <unk> <unk> Toegang
            <unk> config.php
```

## Activering

* Ga naar ACS > Extensies > SiteMaker > Instellingen
* Schakel bestandsbeheerder functie in
* Wijzigingen opslaan
* Wijzig gebruikersrechten (Misc tab) om te bepalen wie deze functie kan gebruiken [Kan Bestandsbeheer gebruiken]
* Update beheerdersrechten (Misc tab) om te bepalen wie de gebruikersmappen kan beheren [Kan mappen van andere gebruikers zien/beheren in Bestandsbeheer]