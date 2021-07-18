---
id: moștenirea-blocuri
title: Înțelegerea moștenirii blocului
---

Am văzut deja acest lucru prin setarea unui layout implicit, alte pagini care nu au blocuri proprii vor moșteni blocurile de la layout-ul implicit. Există, totuşi, un alt tip de moştenire în bloc.

## Rute părinte/copil

In phpBB SiteMaker, vorbim de rute imbricate in termeni de directoarele imbricate reale (sub) sau practic imbricate pe rute. Te rog să stai cu mine :). * Adevărate trasee pentru părinți/copii: De exemplu, calea /unul_directory/sub_directory/index.php este un copil al /some_directory/index. hp * Virtual Parent/Copil: De exemplu, viewtopic.php este tratat ca un copil de viewforum.php.

Iată câteva exemple de piste pentru părinți/copii:

| Părinte            | Copil                          |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articles/my-article   |

## Moștenire părinte/bloc copil

Pentru rutele părinte/copil, ruta copil moștenește blocurile rutei părinte (dacă părintele are propriile blocuri) sau din aspectul implicit (dacă unul a fost stabilit). Cu alte cuvinte, chiar dacă există un aspect implicit, ruta copil va moșteni blocuri de pe ruta sa părinte, în cazul în care ruta părinte are propriile blocuri. Dar nu toate blocurile din ruta părinte trebuie moştenite.

## Controlul moștenirii blocului

La un nivel de bloc, poți controla când un bloc poate fi moștenit de trasee pentru copii. Am atins acest lucru mai devreme în [Editarea Setări blocului](./blocks-managing#editing-block-settings).

Luați în considerare următoarea structură de directoare reală:

```text
phpBB
Ribavirin ─ index.php
Ribavirin ─ filme/
    <unk> • ─ index.php
    ß ─ pagină.php
    <unk> 3.2.3 ─ Comedie/
        Ribavirin ─ index.php
```

În scopul moştenirii blocurilor, spunem * Calea părinte a /phpBB/Movies/Comedy/index.php este /phpBB/film/index. hp și nu /phpBB/Movies/page.php * Toate paginile dintr-un subdirector în raport cu /phpBB/index.php este o rută copil de /phpBB/index.php. Așadar /phpBB/Movies/index.php și /phpBB/Movies/page.php sunt copii de /phpBB/index.php și, prin urmare, își va moșteni blocurile dacă nu au blocuri proprii. În acest caz: * Când un bloc este pe /phpBB/index. hp este setat pe **Ascundeți pe rutele copii**, blocul va afișa pe /phpBB/index. hp (ruta părinte), dar nu pe traseul său * Atunci când un bloc este pornit /phpBB/index. hp este setat pe **Afișat doar pe rutele pentru copii**, va fi afișat pe /phpBB/filme/index.php și /phpBB/film/pagină. hp (rute pentru copii), dar nu pe /phpBB/index.php (părinte), nici /phpBB/Movies/Comedy/index. hp (mergem doar un singur nivel adâncime) * Când un bloc este pe /phpBB/index. hp este setat să afișeze **întotdeauna** (implicit), va afișa pe /phpBB/index.php (părinte), /phpBB/Movies/index. hp and /phpBB/page.php (rute copii), dar nu pe /phpBB/Movies/Comedy/index.php (mergem doar un singur nivel adânc). În acest caz, /phpBB/Movies/Comedy/index.php va moșteni de pe ruta implicită (dacă există)

## Starea Posibil a viitorului

Sunt foarte interesat de feedback-ul tău în acest domeniu. Majoritatea utilizatorilor phpBB nu vor avea directoare reale, așa cum se subliniază mai sus. Așa că mă gândesc să folosesc structura care este definită într-un bloc de meniu ca o structură de director virtual și să aplicați această moștenire părinte/copil la ea. Mă gândesc, de asemenea, să depăşim un nivel mai adânc. Te rog spune-mi dacă acest lucru îți va fi util.