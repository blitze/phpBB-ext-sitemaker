---
title: Inviare una richiesta Pull
sidebar_label: Richieste Pull
---

`Le richieste di pull ti permettono di comunicare agli altri i cambiamenti che hai portato in un ramo in un repository su GitHub. Una volta aperta una pull request è possibile discutere e rivedere i potenziali cambiamenti con i collaboratori e aggiungere i commit di follow-up prima che i cambiamenti siano uniti nel ramo base.` [Per saperne di più](https://help.github.com/articles/about-pull-requests/)

## Forking/Cloning

* Crea un account github se non ne hai già uno
* Vai su https://github.com/blitze/phpBB-ext-sitemaker.git e clicca su "Fork"

Clona il tuo fork del repository:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Dalla riga di comando vai alla directory sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Configura git:**

Aggiungi il tuo nome utente a Git sul tuo sistema:

    git config --global user.name "Il tuo nome qui"

Aggiungi il tuo indirizzo e-mail a Git sul tuo sistema:

    git config --add user.email username@phpbb.com

Aggiungi il telecomando a monte (puoi cambiare 'upstream' a quello che ti piace):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git

**Installa i fornitori**

    installazione compositore

**Installa pacchetti NPM**

    npm install

In alternativa è possibile utilizzare [yarn](https://yarnpkg.com):

    yarn install

## Richieste Pull

    # Crea un nuovo ramo per la tua funzione & passa ad esso
    git checkout -b funzionalità/my-fancy-new-feature
    
    # crea un nuovo ramo per il problema su cui stai lavorando * passa ad esso (il ticket # è da github tracker)
    git checkout -b ticket/1234

Effettua le modifiche

    # Stage the files
    git add <files> 
    
    # Commit staged files - si prega di utilizzare un messaggio di commit corretto
    git commit -m "my commit message"

Spingere nuovamente il ramo su GitHub git push origin feature/my-fancy-new-feature

Invia una [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
