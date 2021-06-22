---
title: Blochează moștenirea
sidebar_position: 5
---

Am văzut deja acest lucru prin setarea unui layout implicit, alte pagini care nu au blocuri proprii vor moșteni blocurile de la layout-ul implicit. Există, totuşi, un alt tip de moştenire în bloc.

## Rute părinte/copil
In phpBB SiteMaker, vorbim de rute imbricate in termeni de directoarele imbricate reale (sub) sau practic imbricate pe rute. Te rog să stai cu mine :).
* Adevărate trasee părinte/copil: De exemplu, calea /unul_directory/sub_directory/index.php este un copil al /unui_directory/index.php
* Căile virtuale pentru părinte/copii: De exemplu, viewtopic.php este tratat ca un copil de vizualizare.php.

Iată câteva exemple de piste pentru părinți/copii:

| Părinte            | Copil                          |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articles/my-article   |

## Moștenire părinte/bloc copil
Pentru rutele părinte/copil, ruta copil moștenește blocurile rutei părinte (dacă părintele are propriile blocuri) sau din aspectul implicit (dacă unul a fost stabilit). Cu alte cuvinte, chiar dacă există un aspect implicit, ruta copil va moșteni blocuri de pe ruta sa părinte, în cazul în care ruta părinte are propriile blocuri. Dar nu toate blocurile din ruta părinte trebuie moştenite.

## Controlul moștenirii blocului
La un nivel de bloc, poți controla când un bloc poate fi moștenit de trasee pentru copii. Am atins acest lucru mai devreme în [Editarea Setări blocului](/docs/user/blocks/managing-blocks#editing-block-settings).

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

În scopul moştenirii blocurilor, afirmă:
* Calea principală a /phpBB/Movies/Comedy/index.php este /phpBB/Movies/index.php fără /phpBB/Movies/page.php
* Toate paginile dintr-un subdirector relativ la /phpBB/index.php este o rută copil de /phpBB/index.php. Așadar /phpBB/Movies/index.php și /phpBB/Movies/page.php sunt copii de /phpBB/index.php și, prin urmare, își va moșteni blocurile dacă nu au blocuri proprii. În acest caz:
    * Atunci când un bloc pe /phpBB/index.php este setat să fie afișat pe **Ascuns pe rutele pentru copii**, blocul va apărea pe /phpBB/index. hp (ruta părinte), dar nu pe rutele pentru copii
    * Când un bloc pe /phpBB/index.php este setat să fie afișat pe **Numai pe rutele copii**, va fi afișat pe /phpBB/Movies/index. hp and /phpBB/Movies/page.php (rute copii), dar nu pe /phpBB/index.php (părinte), nici /phpBB/Movies/Comedy/index.php (mergem doar un nivel de adâncime)
    * Atunci când un bloc pe /phpBB/index.php este setat să afișeze **întotdeauna** (implicit), va fi afișat pe /phpBB/index. hp (părinte), /phpBB/Movies/index.php și /phpBB/page.php (rute copii), dar nu și pe /phpBB/Movies/Comedy/index.php (mergem doar un singur nivel adânc). În acest caz, /phpBB/Movies/Comedy/index.php va moșteni de pe ruta implicită (dacă există)

## Starea Posibil a viitorului
Sunt foarte interesat de feedback-ul tău în acest domeniu. Majoritatea utilizatorilor phpBB nu vor avea directoare reale, așa cum se subliniază mai sus. Așa că mă gândesc să folosesc structura care este definită într-un bloc de meniu ca o structură de director virtual și să aplicați această moștenire părinte/copil la ea. Mă gândesc, de asemenea, să depăşim un nivel mai adânc. Te rog spune-mi dacă acest lucru îți va fi util.