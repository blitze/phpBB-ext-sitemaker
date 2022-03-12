---
title: Aranjări
sidebar_position: 1
---

"Schemele" determină pozițiile disponibile ale blocului și modul în care acestea sunt afișate.

## Poziții bloc
Pozițiile blocului sunt zone predefinite pe site-ul tău unde blocurile pot exista. Pozițiile disponibile ale blocului sunt determinate de stilul șablonului pe care îl utilizați. Pentru prosilver, fpBB SiteMaker vine cu următoarele poziții ale blocului:
* panou: lăţime completă peste tot
* sidebar: stânga/dreapta în funcție de aspectul de mai jos
* subconţinut: similar barei laterale doar mai mari
* top_hor: blocuri orizontale deasupra capului, atașate peste sidebar/subconținut în funcție de aspect
* sus: deasupra conținutului principal
* casetă: lățime egală, blocuri orizontale sub conținutul principal
* jos: sub conţinutul principal
* jos_cal: blocuri orizontale dedesubt, alăturând sidebar/subconținutul în funcție de aspect
* subsol: blocuri orizontale în subsol Puteţi adăuga mai multe poziţii de bloc în stilul dvs prin copierea şi modificarea şabloanelor corespunzătoare phpBB SiteMaker

## Aspect site
Puteți alege aspectul site-ului dvs. în ACP (Extensii > Sitemaker > Setări):
* **Blog**: subconținut și bară laterală, împins la dreapta, top_hor/botom_hor flank subconținut
* **Gri Sfânt**: lățime laterală și subconținut pe laturile opuse, subconținut în flanc top_hor/botom_hor
* **Portal**: bara laterală în stânga, subconținut în dreapta, top_hor/botom_hor flank subconținut
* **Portal Alt**: subconținut pe partea stângă a barei laterale, partea de sus a barelor_botom_hor
* **Personalizat**: Setează manual lățimea sidebarurilor ca px, %, em sau rem. Implicit este 200px pe fiecare parte

## Sabloane/stiluri personalizate
cât mai mult posibil, am încercat să punem fișiere șablon și active în stiluri/toți/folderul pentru a le putea suprascrie creând un fișier cu același nume în tema dvs. temă. . prosilver. Așa că dacă doriți să modificați modul în care se afișează un anumit bloc sau dacă doriți să vă creați propriul layout cu propriile dvs. poziții blocate, trebuie doar să creați un fișier cu același nume și aceeași cale ca și originalul din propriul stil.

Dacă trebuie să personalizați fișierele CSS/JS, aruncați o privire la secțiunea [Tema](/docs/dev/theming).