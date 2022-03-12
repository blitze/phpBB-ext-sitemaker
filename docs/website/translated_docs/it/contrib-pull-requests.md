---
id: contrib-pull-requests
title: Invio di una Pull Request
sidebar_label: Pull Requests
---

`Le richieste di Pull ti permettono di dire agli altri le modifiche che hai spinto su un ramo in un repository su GitHub. Una volta aperta una richiesta di pull, è possibile discutere e rivedere i potenziali cambiamenti con i collaboratori e aggiungere commit di follow-up prima che le modifiche vengano unite nel ramo base.` [Leggi di più](https://help.github.com/articles/about-pull-requests/)

## Forzare/Clonazione

* Crea un account github se non ne hai già uno
* Vai su https://github.com/blitze/phpBB-ext-sitemaker.git e clicca su "Fork"

Clona la tua fork del repository:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Dalla linea di comando vai alla directory sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Configura git:**

Aggiungi il tuo nome utente a Git sul tuo sistema:

    git config --global user.name "Your Name Here"
    

Aggiungi il tuo indirizzo e-mail a Git sul tuo sistema:

    git config --add user.email username@phpbb.com
    

Aggiungi il monte remoto (puoi cambiare 'upstream' a qualsiasi cosa tu voglia):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git
    

**Installa venditori**

    installazione compositore
    

**Installa pacchetti NPM**

    Installazione npm
    

In alternativa puoi utilizzare [yarn](https://yarnpkg.com):

    installa yarn
    

## Pull Requests

    # Crea un nuovo ramo per la tua funzione & passa a questo
    git checkout -b feature/my-fancy-new-feature
    
    # crea un nuovo ramo per il problema su cui stai lavorando * passa ad esso (ticket # è dal tracker di github)
    git checkout -b/1234
    

Effettua le tue modifiche

    # Fase i file
    git add <files> 
    
    # Commit staged files - si prega di utilizzare un messaggio di commit corretto
    git commit -m "my commit message"
    

Spingere il ramo su GitHub opzione di origine git/mia-fantastica-nuova-funzione

Invia una [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)