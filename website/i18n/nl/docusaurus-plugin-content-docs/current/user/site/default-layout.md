---
title: Instellen van een standaard lay-out
sidebar_position: 4
---

Wanneer je een blok toevoegt, wordt deze toegevoegd aan die specifieke pagina. Het zou daarom een vervelende taak zijn om blokken in te stellen voor alle pagina's op je site. Je kunt alle gewenste blokken voor een bepaalde pagina instellen en die pagina dan als standaard lay-out instellen. In andere woorden, elke pagina die geen eigen blokken heeft, zal deze pagina blokkeren.

Om een standaard lay-out in te stellen
* Ga naar de pagina die u wilt instellen als standaard layout
* Klik op `Instellingen` in de admin balk
* Klik op de `Set as default layout` button

Zeg dat we blokken toevoegen aan een pagina (phpBB/index.php) met blokken in bijvoorbeeld de sidebar en top posities, en stel het in als onze standaard lay-out. Dit heeft de volgende effecten voor andere pagina's:
* Elke pagina die geen eigen blokken heeft, erft de blokken van de standaard lay-out. Zie [Blok Overerving](/docs/user/site/block-inheritance) voor uitzonderingen.
* Je kan nog steeds blokken erven van een standaard lay-out (index. hp) maar kies ervoor om geen blokken op sommige blok posities weer te geven of helemaal geen blokken weer te geven. Om dit te doen
    * Ga naar de pagina waarvan je niet wilt dat alle/sommige blokken worden weergegeven
    * Klik op `Instellingen` in de admin balk
    * Selecteer `Laat geen blokken op deze pagina` zien als je geen blokken op deze pagina wilt overnemen of weergeven
    * Gebruik CTRL + klik om de blokposities te selecteren (aan de rechterkant) waar je geen blokken op wilt weergeven
* In `bewerkingsmodus`, een pagina die blokken erft van de standaard lay-out, zal geen blokken tonen, wat je de mogelijkheid geeft om blokken toe te voegen aan de pagina als je wilt
* Een pagina met eigen blokken erft niet van de standaard lay-out
