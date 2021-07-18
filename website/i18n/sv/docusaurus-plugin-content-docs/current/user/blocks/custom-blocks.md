---
title: Anpassat block
sidebar_position: 4
---

Om de tillgängliga blocken inte ger dig den frihet du behöver, det finns `Anpassade Block` som låter dig visa ditt eget innehåll med BBcode eller HTML. Blocket kommer med en WYSIWYG editor (TinyMCE) och en skript manager:

## Redigeraren

-   Du kan använda redigeraren för att skapa HTML-innehåll
-   Du kan redigera källkoden om du behöver den kontrollnivån genom att klicka på `källkod` ikonen (`<>`) i redigeraren
-   Redigeraren låter dig ladda upp och ändra bilder
    -   Det skapar en ny mapp i phpBB/images/sitemaker_uploads/ för varje användare som har tillgång till den
    -   Du kan visa/hantera alla användarmappar
-   Redigeraren filtrerar bort eventuella potentiellt farliga skript som javascript, etc. Om du behöver lägga till innehåll som Google annonser, javascript kommer att filtreras ut, men du kan komma runt det genom att göra följande:
    -   Lägg till det anpassade blocket till önskad plats
    -   Redigera Custom Block, klicka på fliken `HTML` och klistra in Javascript

## Skript Manager

Anpassade blocket låter dig också lägga till anpassade CSS och Javascript-filer på din sida. Att göra detta:

-   Lägg till ett `anpassat block` till valfri blockposition. Positionen spelar ingen roll om du också visar innehåll med blocket
-   Redigera blocket, Klicka på fliken `skript` och lägg till dina CSS eller Javascript-filer > Varningens ord dock: Lägga till många skript på din sida kan påverka laddningstiderna
