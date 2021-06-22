---
title: Trimiterea unei cereri de tragere
sidebar_label: Trageți cererile
---

`Trageți cererile pentru a le spune celorlalți despre modificările pe care le-ați împins la o sucursală dintr-un depozit pe GitHub. Odată ce cererea de tragere este deschisă, puteți discuta și analiza schimbările potențiale cu colaboratori și adăuga angajamente de monitorizare înainte ca modificările să fie îmbinate în sucursala de bază.` [Citește mai mult](https://help.github.com/articles/about-pull-requests/)

## Forjare/Clonare

* Creează un cont github dacă nu ai deja unul
* Mergeți la https://github.com/blitze/phpBB-ext-sitemaker.git și faceți clic pe "Fork"

Clonați furculița din depozit:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

De la linia de comandă mergeți la directorul sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Configurare git:**

Adaugă numele tău de utilizator la Git în sistemul tău:

    git config --global user.name "Numele dvs aici"

Adaugă adresa ta de e-mail la Git pe sistem:

    git config --add user.email username@phpbb.com

Adaugă telecomanda din amonte (poți schimba 'în amonte' în orice dorești):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git

**Instalare furnizor**

    Instalare compozitor

**Instalaţi pachetele NPM**

    npm install

Alternativ, poți folosi [yarn](https://yarnpkg.com):

    instalare yarn

## Trageți cererile

    # Creați o sucursală nouă pentru caracteristica dvs. & comutați la aceasta
    caracteristica git checkout -b /my-fancy-new-feature
    
    # creați o sucursală nouă pentru problema la care lucrați * comutați la ea (ticket # is from github tracker)
    git checkout -b ticket/1234

Efectuați modificările

    # Etapa fișierelor
    git add <files> 
    
    # Fișiere de angajament în etape - vă rugăm să utilizați un mesaj de comitere corect
    git commit -m "Mesajul meu de comitere"

Apăsați sucursala înapoi la GitHub git push origin feature/my-fancy-new-feature

Trimite o [cerere de tragere](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
