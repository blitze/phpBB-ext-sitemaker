---
id: site-lay-outs
title: Lay-outs
---

"Layouts" bepalen de beschikbare blokposities en hoe ze worden weergegeven.

## Blokkeer posities

Blokkeer posities zijn vooraf gedefinieerde gebieden op je site waar blokken kunnen bestaan. De beschikbare blokposities worden bepaald door de template stijl die u gebruikt. Voor prosilver, phpBB SiteMaker komt met de volgende blokposities: paneel: volledige breedte over de top * sidebar: links/rechts afhankelijk van de lay-out onder * subinhoud: vergelijkbaar met de zijbalk die net groter is * top_hor: horizontale blokken aan de top, flanken boven sidebar/subinhoud afhankelijk van lay-out * top: boven hoofdinhoud * box: gelijke breedte, horizontale blokken onder hoofdinhoud * onder: onder hoofdinhoud * bottom_hor: horizontale blokken overal onderaan De sidebar/subcontent flankeren afhankelijk van lay-out * footer: horizontale blokken in de footer Je kunt meer blokken toevoegen in je eigen stijl sjablonen door de bijbehorende phpBB SiteMaker sjablonen te kopiëren en aan te passen

## Site lay-out

U kunt de indeling voor uw site in de ACS kiezen (Extensions > Sitemaker > Instellingen): * **Blog**: subinhoud en sidebar naast elkaar duwde naar rechts, boven_hoor/botom_hor subinhoud * **Heilige Grail**: gelijke breedte zijbalk en subinhoud aan tegenzijde. top_hor/botom_hor flank subinhoud * **Portal**: sidebar aan de linkerkant, subinhoud aan de rechterkant top_hor/botom_hor flank subinhoud * **Portal Alt**: subinhoud links zijbalk aan de rechterkant top_hor/botom_hor flank sidebar * **Aangepast**: Stel de breedte van de sidebars handmatig in als px, %, em of rem. Standaard op 200px aan elke kant

## Aangepaste templates/stijlen

We hebben zo veel mogelijk geprobeerd sjabloonbestanden en bestanden in stijlen/all/ map te plaatsen, zodat je ze kunt overschrijven door een bestand met dezelfde naam te maken onder je eigen template thema, bijvoorbeeld prosilver. Dus als je wilt aanpassen hoe een bepaald blok displays of als je je eigen lay-out wilt maken met je eigen blokposities, moet je simpelweg een bestand maken met dezelfde naam en pad als het origineel in je eigen stijl.

Als u CSS/JS bestanden moet aanpassen, kijk dan naar de [theming](./developer-theming.md) sectie.