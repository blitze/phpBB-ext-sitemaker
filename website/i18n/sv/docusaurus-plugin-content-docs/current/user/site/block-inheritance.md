---
title: Blockera arv
sidebar_position: 5
---

Vi har redan sett att genom att ställa in en standardlayout, andra sidor som inte har egna block kommer att ärva blocken från standardlayouten. Det finns dock en annan typ av blockarv.

## Föräldra/underordnade rutter
I phpBB SiteMaker talar vi om nästlade rutter i form av riktiga nästlade (sub) kataloger eller praktiskt taget nästlade vägar/rutter. Var snäll och stanna hos mig :).
* Real Parent/Child routes: Till exempel är sökvägen /some_directory/sub_directory/index.php ett barn till /some_directory/index.php
* Virtual Parent/Child routes: Till exempel, viewtopic.php behandlas som ett barn till viewforum.php.

Här är några exempel på rutter för föräldrar/barn:

| Överordnad         | Barn                           |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/artiklar  | /app.php/articles/my-article   |

## Föräldra/Barn Blockera Arv
För förälder/barnrutter, underordnad rutt ärver blocken på överordnad rutt (om överordnad rutt har egna block) eller från standardlayouten (om en är inställd). Med andra ord, även om det finns en standardlayout, underordnad rutt ärver block från överordnad rutt om överordnad rutt har egna block. Men inte alla block från föräldravägen måste ärvas.

## Styrande Block Arv
På en blocknivå kan du styra när ett block kan ärvas av underordnade rutter. Vi berörde detta tidigare i [redigering Block Settings](/docs/user/blocks/managing-blocks#editing-block-settings).

Tänk på följande verkliga katalogstruktur:
```text
phpBB
wegment ─ index.php
<unk> ─ Movies/
    wegment ─ index.php
    wegment -page.php
    <unk> ˃ ─ Comedy/
        <unk> <unk> -─ index.php
```

I syfte att ärva block, säger vi:
* Den överordnade rutten för /phpBB/Movies/Comedy/index.php är /phpBB/Movies/index.php och inte /phpBB/Movies/page.php
* Alla sidor i en underkatalog i förhållande till /phpBB/index.php är en underordnad rutt för /phpBB/index.php. Så /phpBB/Movies/index.php och /phpBB/Movies/page.php är alla barn till /phpBB/index.php och kommer därför att ärva dess block om de inte har egna block. I detta fall:
    * När ett block på /phpBB/index.php är inställt på att visas på **Dölj på underordnade rutter**visas blocket på /phpBB/index. hk (föräldraväg) men inte på sina barnvägar
    * När ett block på /phpBB/index.php är inställt på att visas på **Visa endast på underordnade rutter**visas det på /phpBB/Movies/index. hp och /phpBB/Movies/page.php (barnrutter) men inte på /phpBB/index.php (förälder), inte heller /phpBB/Movies/Comedy/index.php (vi går bara en nivå djup)
    * När ett block på /phpBB/index.php är inställt på att visa **alltid** (standard) visas det på /phpBB/index. hp (föräldrar), /phpBB/Movies/index.php och /phpBB/page.php (barnvägar) men inte på /phpBB/Movies/Comedy/index.php (vi går bara en nivå djup). I detta fall ärver /phpBB/Movies/Comedy/index.php från standardrutten (om den finns)

## Positivt framtida tillstånd
Jag är verkligen intresserad av din feedback på detta område. De flesta phpBB-användare kommer inte att ha riktiga kataloger som beskrivs ovan. Så jag tänker på att använda den struktur som definieras i ett menyblock som en virtuell katalogstruktur och tillämpa detta förälder/barnarv på den. Jag funderar också på att gå bortom en nivå djup. Låt mig veta om detta kommer att vara till nytta för dig.