---
id: blok-arv
title: Forståelse Af Blokarv
---

Vi har allerede set, at ved at indstille et standardlayout andre sider, der ikke har blokke af deres egen vil arve blokkene fra standard layout. Der er imidlertid en anden type blokarv.

## Forældre/Barneruter

I phpBB SiteMaker, vi taler om indlejrede ruter i form af reelle indlejrede (sub) mapper eller næsten indlejrede stier/ruter. Vær venlig at blive hos mig :). * Rigtige forældre/Barn-ruter: For eksempel, stien /some_directory/sub_directory/index.php er et barn af /some_directory/index. hp * Virtuelle forældre / Barn ruter: For eksempel viewtopic.php behandles som et barn af viewforum.php.

Her er nogle eksempler på forældre/barn ruter:

| Overordnet         | Barn                           |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/artikler  | /app.php/articles/min-article  |

## Forældre/Barneblok Arv

For forældre/barn ruter barnets rute arver blokkene på den overordnede rute (hvis forælderen har sine egne blokke) eller fra standardlayoutet (hvis en er indstillet). Med andre ord, selv om der er et standard layout, barnets rute vil arve blokke fra sin overordnede rute, hvis den overordnede rute har sine egne blokke. Men ikke alle blokke fra forældreruten skal arves.

## Kontrollerende Blok Nedarvning

På et blokniveau kan du styre, hvornår en blok kan arves af børneruter. Vi berørte dette tidligere i [Redigering af blok indstillinger](./blocks-managing#editing-block-settings).

Overvej følgende rigtige mappestruktur:

```text
phpBB
- opdatering: index.php
- opdateringen/
    - opdateringen/ - index.php
    - opdateringen,page.php
    - opdateringen/ - kammerat/
        - opdateringen,index.php
```

Med henblik på at arve blokke, siger vi: * Den overordnede rute for /phpBB/Movies/Comedy/index.php er /phpBB/Movies/index. hp og ikke /phpBB/Movies/page.php * Alle sider i en undermappe i forhold til /phpBB/index.php er en underrute til /phpBB/index.php. Så /phpBB/Movies/index.php og /phpBB/Movies/page.php er alle børn af /phpBB/index.php og vil derfor arve sine blokke, hvis de ikke har deres egne blokke. I dette tilfælde: * Når en blok på /phpBB/index. hp er sat til at vise på **Skjul på underordnede ruter**, blokken vil blive vist på /phpBB/index. hp (overordnet rute), men ikke på dens underruter * Når en blok på /phpBB/index. hp er sat til at vise på **Vis kun på underordnede ruter**, den vil blive vist på /phpBB/Movies/index.php og /phpBB/Movies/page. hp (barnruter), men ikke på /phpBB/index.php (forælder), eller /phpBB/Film / Comedy/index. hp (vi går kun et niveau dybt) * Når en blok på /phpBB/index. hp er sat til at vise **altid** (standard), den vil blive vist på /phpBB/index.php (forælder), /phpBB/Movies/index. hp og /phpBB/page.php (børneruter), men ikke på /phpBB/Movies/Comedy/index.php (vi går kun et niveau dybt). I dette tilfælde arver /phpBB/Movies/Comedy/index.php fra standardruten (hvis den eksisterer)

## Potentiel Fremtidig Stat

Jeg er virkelig interesseret i din feedback på dette område. De fleste phpBB-brugere vil ikke have rigtige mapper som beskrevet ovenfor. Så jeg tænker på at bruge den struktur, der er defineret i en menublok som en virtuel mappestruktur og anvende denne forældre/barn arv til det. Jeg overvejer også at gå ud over et niveau dyb. Lad mig vide, om dette vil være nyttigt for dig.