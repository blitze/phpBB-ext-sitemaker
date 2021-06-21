---
id: site-standaard-lay-out
title: Standaard lay-out instellen
---

Als je een blok toevoegt, wordt het toegevoegd aan die specifieke pagina. Het zou dan ook een vervelende taak zijn om alle pagina's op uw site te blokkeren. U kunt alle gewenste blokken voor een bepaalde pagina instellen, deze pagina vervolgens als standaard lay-out instellen. Met andere woorden, elke pagina die geen eigen blokken heeft, zal blokken van deze pagina overnemen.

Om een standaard lay-out in te stellen * Ga naar de pagina die u wilt instellen als standaard lay-out * Klik op `instellingen` in de beheerbalk * Klik op de `set als standaard lay-out` knop

Zeg dat we blokken toevoegen aan een pagina (phpBB/index.php) met blokken in de zijbalk en top posities, bijvoorbeeld, en deze instellen als onze standaard lay-out. Dit heeft de volgende effecten voor andere pagina's: * Elke pagina die geen eigen blokken heeft, zal de blokken van de standaard lay-out overnemen. Bekijk [Begrepen Blok Erven](./blocks-inheritance.md) voor uitzonderingen. * U kunt nog steeds blokken erven van een standaard lay-out (index.php) maar kies om geen blokken op sommige blokposities weer te geven of helemaal geen blokken weer te geven. To do this, * Go to the page that you don't want all/some blocks to display * Click on `Settings` in the admin bar * Select `Do not show blocks on this page` if you don't want to inherit/display any blocks on this page OR * Use CTRL + click to select the block positions (on the right) that you do not want to display blocks on * In `edit mode`, a page that inherits blocks from the default layout, will not show any blocks, giving you the opportunity to add blocks to the page if you want to * Any page that has its own blocks will not inherit from the default layout