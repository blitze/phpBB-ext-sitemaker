---
id: dezvoltator-tema
title: Tema
---

phpBB SiteMaker vine cu stiluri și culori create pentru prosilver. Poți suprascrie fișierele CSS, JS și HTML creând fișierul corespunzător în dosarul stilului tău.

# Se creează fişiere JS/CSS pentru stilul tău

Notă: * În scopul instrucțiunilor de mai jos vom presupune că ai un stil numit stilul meu.

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

> Această extensie folosește jQuery UI pentru file, dialoguri și butoane. Tema jQuery implicită este 'netedă'. Puteţi utiliza o altă temă a interfeţei jQuery care se potriveşte cel mai bine temei. Puteţi specifica tema jQuery UI folosind steagul --jq_ui_theme. De exemplu:

    yarn build --theme my-style --jq_ui_theme ui-light