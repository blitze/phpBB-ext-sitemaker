---
title: Blokker Arv
sidebar_position: 5
---

Vi har allerede sett at ved å sette et standardoppsett, andre sider som ikke har egne blokker vil arve blokkene fra standardoppsettet. Det finnes imidlertid en annen form for arv.

## Foreldre/Underordnede ruter
I phpBB SiteMaker snakker vi om nestede ruter i form av ekte nested (sub) kataloger eller tilnærmet nested paths/routes. Bli med meg :).
* Virkelige foreldre/barn-veier: For eksempel er stien /some_directory/sub_directory/index.php et barn av /some_directory/index.php
* Virtuelle foreldre/barn-veier: For eksempel behandles viewtopic.php som barn i viewforum.php.

Her er noen eksempler på foreldre/barn-veier:

| Forelder           | Barn                           |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/artikler  | /app.php/articles/my-article   |

## Foreldre/Barn blokkerer Inheritance
For foreldre/barn-veier, barnetruten arver blokker av overordnet rute (hvis overordnet har egne blokker) eller fra standardoppsettet (hvis den er angitt). Med andre ord, selv om det er standardutforming, Barneveien vil arve blokker fra overordnet rute dersom overordnet rute har egne blokker. Men ikke alle blokker av morsveien skal arves.

## Styring av blokker arving
På et blokknivå kan du kontrollere når en blokk kan arves av underordnede ruter. Vi berørte dette tidligere i [Redigeringsblokkinnstillinger](/docs/user/blocks/managing-blocks#editing-block-settings).

Ta i betraktning følgende virkelige mappestruktur:
```text
phpBB
LaborLabor″index.php
iNatur″εεεεε″Movies/
    AtriAtriindex.php
    ephal″Side page.php
    1993-¦ Comedy/
        ¤ index.php
```

I forbindelse med arving av blokker, sier vi:
* Overordnet rute i /phpBB/Movies/Comedy/index.php er /phpBB/Movies/index.php og ikke /phpBB/Movies/page.php
* Alle sider i en underkatalog relativ til /phpBB/index.php er en underrute i /phpBB/index.php. Så /phpBB/Movies/index.php og /phpBB/Movies/page.php er alle barn på /phpBB/index.php og vil derfor arve blokker dersom de ikke har blokker av sine egen. I dette tilfellet:
    * Når en blokk på /phpBB/index.php er satt til å vise på **Skjul på underordnede ruter**, vil blokken vises på /phpBB/index. hp (overordnet rute) men ikke på underveiene
    * Når en blokk på /phpBB/index.php er satt til å vise på **Vis bare på underordnede ruter**, vil den vises på /phpBB/Movies/index. hp and /phpBB/Movies/page.php (barn-ruter) men ikke i /phpBB/index.php (foreldr), eller /phpBBBB/Movies/Comedy/index.php (vi går bare et nivå dypt)
    * Når en blokk på /phpBB/index.php er satt til å vise **alltid** (standard), vil den vises på /phpBB/index. hp (foreldr), /phpBB/Movies/index.php og /phpBB/page.php (barn-ruter) men ikke på /phpBB/Movies/Comedy/index.php (vi går bare et nivå dyp). I dette tilfellet, /phpBB/Movies/Comedy/index.php vil arve fra standard rute (hvis den eksisterer)

## Tillatt status over fremtid
Jeg har stor interesse av deres tilbakemeldinger på dette feltet. De fleste phpBB brukere vil ikke ha ekte mapper som beskrevet ovenfor. Så jeg tenker på å bruke strukturen som er definert i en menyblokk som en virtuell mappestruktur, og bruke denne forelderen/barnet arv på den. Jeg vurderer også å gå videre utover ett nivå dypt. Vennligst gi meg beskjed om dette vil være nyttig for deg.