---
title: Tema
sidebar_position: 3
---

Înţelegem că fişierele şablon şi fişierele JS/CSS nu vor funcţiona pentru fiecare stil, mai jos sunt câteva moduri prin care puteți folosi propriile șabloane și crea fișiere JS/CSS pentru stilul dvs. specific.

## Folosind propriul șablon

Daca sabloanele implicite care vin cu fisierul Sitemaker phpBB nu functioneaza bine pentru stilul tau, îl poți suprascrie cu ușurință pentru a utiliza propriul fișier șablon prin crearea fișierului corespunzător în dosarul stilurilor tale.

De exemplu, spune că stilul tău se numește `Backlash` și are un mod special în care codul HTML pentru secțiunea antetului blocului trebuie să fie structurat pentru [vizualizarea introdusă](/docs/user/blocks/block-views). Puteți suprascrie acel șablon prin crearea unui fișier cu același nume: `phpBB/ext/blitze/sitemaker/backlash/template/views/boxed_view.twig`.

Cu alte cuvinte, pentru a folosi propriul fișier șablon, trebuie să:
* Identificati ce fisier Sitemaker phpBB trebuie sa fie suprascris
* Creați un fișier cu același nume în folderul `stiluri` sub stilul dvs

> Notă: Dacă vă creați propriile fișiere șablon, asigurați-vă că nu ștergeți folderul `phpbb/ext/blitze/sitemaker` atunci când actualizați extensia ca fișierele dvs. personalizate vor fi șterse. Mai degrabă, trebuie doar să suprascrieți fișierele existente cu cele noi.

## Se creează fişiere JS/CSS pentru stilul tău

Notă:
* Pentru scopul instrucțiunilor de mai jos vom presupune că ai un stil numit stilul meu.

Clonați în phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

De la linia de comandă mergeți la directorul sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Instalare furnizor**

    Instalare compozitor

**Instalare pachete**

Pentru comenzile de mai jos poți folosi npm sau [yarn](https://yarnpkg.com)

    instalare yarn

**Urmărește modificările**

    yarn start --stil temă mea

**Efectuează modificări**

* Fă modificările tale la fișierele din folderul phpBB/ext/blitze/sitemaker/dezvoltă.
* Uita-te la phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss pentru variabilele sass

**Construiește active**

    yarn build --theme my-style

**Desfășurare**

Acum puteţi copia fişierele generate din phpBB/ext/blitze/sitemaker/styles/my-style şi să le încărcaţi pe serverul de producţie.

> Această extensie folosește jQuery UI pentru file, dialoguri și butoane. Tema implicită jQuery este 'uniformitate'. Puteţi utiliza o altă temă a interfeţei jQuery care se potriveşte cel mai bine temei. Puteţi specifica tema jQuery UI folosind steagul --jq_ui_theme. De exemplu:

    yarn build --theme my-style --jq_ui_theme ui-light
