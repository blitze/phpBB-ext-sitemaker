---
title: Lay-outs
sidebar_position: 1
---

"Lay-outs" bepalen de beschikbare blok posities en hoe ze worden weergegeven.

## Blok posities
Blok posities zijn vooraf gedefinieerde gebieden op je website waar blokken kunnen bestaan. De beschikbare block posities worden bepaald door de template stijl die je gebruikt. Voor prozilver wordt phpBB SiteMaker geleverd met de volgende blokposities:
* paneel: volledige breedte over de bovenkant
* sidebar: links/rechts afhankelijk van onderstaande lay-out
* subcontent: vergelijkbaar met de zijbalk net groter
* top_hor: horizontale blokken over de boven, flanking boven de zijbalk/subinhoud afhankelijk van de lay-out
* bovenkant: boven de hoofdinhoud
* box: gelijke breedte, horizontale blokken onder de hoofdinhoud
* onder: onder de hoofdinhoud
* bottom_hor: horizontale blokken over de onderkant, flanker/subinhoud afhankelijk van de lay-out
* voettekst: horizontale blokken in de voettekst Je kunt meer blok posities toevoegen aan uw eigen stijl templates door de bijbehorende phpBB SiteMaker sjablonen te kopiëren en aan te passen

## Site lay-out
U kunt de layout kiezen voor uw site in ACS-landen (Extensions > Sitemaker > Instellingen):
* **Blog**: subinhoud en zijbalk naast elkaar, push naar rechts, top_hor/botom_hor flank subinhoud
* **Heilige Grail**: gelijke breedte zijbalk en subinhoud aan andere zijden, boven_hor/botom_hor flank subinhoud
* **Portaal**: Sidebar aan links, subinhoud aan de rechterkant, top_hor/botom_hor flank subinhoud
* **Portal Alt**: subcontent aan links, sidebar aan de rechterkant, top_hor/botom_hor flank sidebar
* **Aangepaste**: Handmatig de breedte van de zijbalk instellen als px, %, em of rem. Standaard tot 200px aan elke kant

## Aangepaste templates/stijlen
Zo veel mogelijk we hebben geprobeerd sjabloonbestanden en content in de styles/alle/map te zetten, zodat je ze kunt overschrijven door een bestand met dezelfde naam te maken onder je eigen template-thema. . prozilver. Dus als je wilt aanpassen hoe een bepaald blok wordt weergegeven of als je je eigen lay-out wilt maken met je eigen blokposities, je moet gewoon een bestand maken met dezelfde naam en pad als het origineel in je eigen stijl.

Als u CSS/JS bestanden wilt aanpassen, neem een kijkje naar de [theming](/docs/dev/theming) sectie.