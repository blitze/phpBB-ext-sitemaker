---
title: Mananaging Blocks
sidebar_position: 3
---

För att hantera block i phpBB SiteMaker, måste du vara i [Redigera läge](./overview#edit-mode).

> När ett block inte visar något innehåll visas det inte, förutom i redigeringsläge. På så sätt kan du antingen ge det innehåll (i fallet med Anpassat block) eller ändra dess inställningar.

> I redigeringsläge de något transparenta blocken är block som annars inte kommer att visas men som bara visas eftersom vi är i redigeringsläge

## Lägger till block
Du kan lägga till block på alla framsidor, förutom användarkontrollpanelen och moderator Kontrollpanelen. För att lägga till ett block måste du:
* klicka på **Block** i administratörsfältet. Detta visar en lista över tillgängliga block
* Dra och släpp önskat block till alla blockpositioner

## Redigerar block
### Lägger till en block-ikon
Till vänster om blockets titel (prosilver) finns en låda för block-ikonen. Klicka på den här rutan för att få ikonen väljare. Du kan välja ikonens storlek, färg, float, rotation, etc.

### Redigerar blockets titel
phpBB SiteMaker block kommer att ha en standard, översatt titel, men om titeln inte uppfyller dina behov, kan du ändra det. Redigera blockets titel,
* Klicka på blockets titel för att få ett inline redigera formulär
* Ändra titeln till vad du vill
* Ta bort fokus från fältet eller träff enter för att skicka ändringar

> Din ändrade blocktitel är inte översatt

> För att återgå till standardtiteln tar du enkelt bort titeln och trycker på enter

### Redigerar blockinställningar
När du svävar över ett block visas en kugghjulsikon, till höger om blocket som kan användas för att redigera blocket. I dialogrutan redigera block kan du:
- Aktivera/inaktivera ett block [Status]
- Välj när blocket inte ska visas [Display]. Detta gäller endast i de fall du har nästlat sidor (se [Understanding Block Inheritance](/docs/user/site/block-inheritance)):
    - **Alltid**: Visa alltid blocket
    - **Dölj på underordnade rutter**: Visa endast detta block på överordnade rutten
    - **Visa endast på underordnade rutter**: Visa endast detta block på underordnade rutter
- Välj vilka grupper av användare som kan visa blocket [Visas av]. Använd CTRL + klicka för att välja flera grupper.
- Sätt anpassade klasser för att ändra utseendet på blocket eller objekt (listor, bilder, bakgrund, etc) i blocket [CSS-klassen]
- Visa/dölj blockets titel [Dölj blockets titel?]
- Välj blockvyn [Blockvy]. Du kan välja en standard blockvy när nya block läggs till i ACP.
    - **Standard / Enkel**: använder prosilver panel klass för att linda in blocket i en vadderad behållare
    - **Basic**: blocket har inte någon behållare inslagning det
    - **Boxad**: använder prosilver forabg klassen för att linda in blocket i en låda
- Ange / Uppdatera blockspecifika inställningar
- Om du har samma block med samma inställningar på flera sidor, du kan uppdatera dem alla på en gång genom att kontrollera **Uppdateringsblocken med liknande inställningar**

## Tar bort block
- Håll muspekaren över blocket du vill ta bort
- Klicka på ikonen **x** och bekräfta att du vill ta bort blocket
- Gå upp till administratörsfältet och klicka på `Spara ändringar`
