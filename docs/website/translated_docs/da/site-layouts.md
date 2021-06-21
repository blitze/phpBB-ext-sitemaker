---
id: site-layouts
title: Layout
---

"Layouts" bestemmer de tilgængelige blokpositioner og hvordan de vises.

## Blok Positioner

Blok positioner er foruddefinerede områder på dit websted, hvor blokke kan eksistere. De tilgængelige blokpositioner bestemmes af den skabelonstil, du bruger. Til prosilver phpBB SiteMaker kommer med følgende blok positioner: * panel: fuld bredde over toppen * sidepanel: Venstre/højre afhængigt af layout under * subindhold: ligner sidepanel lige større * top_hor: vandrette blokke over toppen, flanking over sidebar/underindhold afhængigt af layout * top: ovenfor hovedindhold * boks: lige bredde vandrette blokke under hovedindholdet * nederst: under hovedindholdet * bottom_hor: vandrette blokke over bunden, flanking af sidebjælke/underindhold afhængigt af layout * footer: horisontale blokke i footer Du kan tilføje flere blokpositioner i dine egne stil skabeloner ved at kopiere og ændre de tilsvarende phpBB SiteMaker skabeloner

## Websteds Layout

Du kan vælge layoutet for dit websted i AVS (Extensions > Sitemaker > Indstillinger): * **Blog**: subcontent og sidebar ved siden af hinanden, skubbet til højre, top_hor/botom_hor flank subcontent * **Holy Grail**: lige bredde sidebar og subcontent på modsatte sider, top_hor/botom_hor flank underindhold * **Portal**: sidebar til venstre, underindhold til højre, top_hor/botom_hor flank underindhold * **Portal Alt**: underindhold til venstre sidepanel til højre top_hor/botom_hor flank sidebar * **Brugerdefineret**: Indstil bredden af sidebjælkerne manuelt som px, %, em eller rem. Standard er 200px på hver side

## Brugerdefinerede skabeloner/stilarter

Så vidt muligt vi forsøgte at sætte skabelonfiler og -filer i stil/alle / mappe, så du kan overskrive dem ved at oprette en fil med samme navn under dit eget skabelontema . . prosilver. Så hvis du ønsker at ændre, hvordan en bestemt blok vises, eller hvis du ønsker at oprette dit eget layout med dine egne blok positioner, du simpelthen nødt til at oprette en fil med samme navn og sti som originalen i din egen stil.

Hvis du har brug for at tilpasse CSS/JS-filer, så tag et kig på afsnittet [theming](./developer-theming.md).