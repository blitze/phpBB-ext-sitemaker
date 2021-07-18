---
title: Layout
sidebar_position: 1
---

"Layouts" bestemmer de tilgængelige blokpositioner og hvordan de vises.

## Blok Positioner
Blok positioner er foruddefinerede områder på dit websted, hvor blokke kan eksistere. De tilgængelige blokpositioner bestemmes af den skabelonstil, du bruger. For prosilver, phpBB SiteMaker kommer med følgende blok positioner:
* panel: fuld bredde over toppen
* sidepanel: Venstre/højre afhængigt af layout nedenfor
* underindhold: ligner sidepanel lige større
* top_hor: vandrette blokke over toppen, flanking over sidebar/underindhold afhængigt af layout
* top: over hovedindhold
* box : lige bredde, vandrette blokke under hovedindholdet
* bund: under hovedindhold
* bottom_hor: horisontale blokke over bunden, flanking sidebar/underindhold afhængigt af layout
* footer: horisontale blokke i footer Du kan tilføje flere blokpositioner i dine egne stilskabeloner ved at kopiere og ændre de tilsvarende phpBB SiteMaker skabeloner

## Websteds Layout
Du kan vælge layoutet for dit websted i AVS (ekstensioner > Sitemaker > Indstillinger):
* **Blog**: subindhold og sidebar ved siden af hinanden, skubbet til det højre, top_hor/botom_hor flank underindhold
* **Holy Grail**: lige bredde sidebar og subcontent på modsatte sider, top_hor/botom_hor flank subcontent
* **Portal**: sidebar til venstre, subcontent til højre, top_hor/botom_hor flank subcontent
* **Portal Alt**: underindhold til venstre, sidebar til højre, top_hor/botom_hor flank sidebar
* **Brugerdefineret**: Indstil bredden af sidepanelerne manuelt som px, %, em eller rem. Standard er 200px på hver side

## Brugerdefinerede skabeloner/stilarter
Så vidt muligt vi forsøgte at sætte skabelonfiler og -filer i stil/alle / mappe, så du kan overskrive dem ved at oprette en fil med samme navn under dit eget skabelontema . . prosilver. Så hvis du ønsker at ændre, hvordan en bestemt blok vises, eller hvis du ønsker at oprette dit eget layout med dine egne blok positioner, du simpelthen nødt til at oprette en fil med samme navn og sti som originalen i din egen stil.

Hvis du har brug for at tilpasse CSS/JS-filer, så tag et kig på afsnittet [theming](/docs/dev/theming).