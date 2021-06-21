---
id: layout-uri
title: Aranjări
---

"Schemele" determină pozițiile disponibile ale blocului și modul în care acestea sunt afișate.

## Poziții bloc

Pozițiile blocului sunt zone predefinite pe site-ul tău unde blocurile pot exista. Pozițiile disponibile ale blocului sunt determinate de stilul șablonului pe care îl utilizați. Pentru prosilver, phpBB SiteMaker vine cu următoarele poziții ale blocului: * panou: lățimea completă în partea de sus * bara laterală: stânga/dreapta în funcție de aspectul de sub * subconținut: similar cu bara laterală puțin mai mare * blocuri orizontale în partea de sus, atașat deasupra sidebar/subconținutului în funcție de aspectul * sus: deasupra conținutului principal * casetă: lățime egală, blocuri orizontale sub conţinutul principal * dedesubtul conţinutului principal * blocuri orizontale de jos în jos, atașarea sidebar/subconținut în funcție de layout * subsol: blocuri orizontale în subsol Puteți adăuga mai multe poziții de bloc în stilul dvs prin copierea și modificarea șabloanelor corespunzătoare phpBB SiteMaker

## Aspect site

Poți alege aspectul site-ului tău în ACP (Extensii > Sitemaker > Setări): * **Blog**: subconținut și bară laterală una lângă cealaltă, împins la dreapta, sus hor/botom_hor flank subconţinut * **Graal Sfânt**: lăţime laterală egală şi subconţinut pe laturile opuse, subconţinut în flanc top_hor/botom_hor * **Portal**: sidebar în stânga, subconţinut în dreapta, top_hor/botom_hor în flanc * **Alt portal**: subconținut în stânga, bara laterală din dreapta, bara laterală top_hor/botom_hor * **Personalizată**: setează manual lățimea sidebarelor ca px, %, em sau rece. Implicit este 200px pe fiecare parte

## Sabloane/stiluri personalizate

cât mai mult posibil, am încercat să punem fișiere șablon și active în stiluri/toți/folderul pentru a le putea suprascrie creând un fișier cu același nume în tema dvs. temă. . prosilver. Așa că dacă doriți să modificați modul în care se afișează un anumit bloc sau dacă doriți să vă creați propriul layout cu propriile dvs. poziții blocate, trebuie doar să creați un fișier cu același nume și aceeași cale ca și originalul din propriul stil.

Dacă trebuie să personalizați fișierele CSS/JS, aruncați o privire la secțiunea [Tema](./developer-theming.md).