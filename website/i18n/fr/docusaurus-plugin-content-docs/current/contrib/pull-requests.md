---
title: Soumettre une Pull Request
sidebar_label: Demandes de tirage
---

`Les demandes d'ajout vous permettent de parler aux autres des changements que vous avez poussés vers une branche dans un dépôt sur GitHub. Une fois qu'une pull request est ouverte, vous pouvez discuter et examiner les changements potentiels avec des collaborateurs et ajouter des commits de suivi avant que vos changements ne soient fusionnés dans la branche de base.` [Lire la suite](https://help.github.com/articles/about-pull-requests/)

## Forking/Clonage

* Créez un compte github si vous n'en avez pas déjà un
* Allez sur https://github.com/blitze/phpBB-ext-sitemaker.git et cliquez sur "Fork"

Cloner votre fork du référentiel:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

À partir de la ligne de commande, allez dans le répertoire sitemaker :

    cd phpBB/ext/blitze/sitemaker

**Configurer git:**

Ajoutez votre nom d'utilisateur à Git sur votre système :

    config git --global user.name "Votre nom ici"

Ajoutez votre adresse e-mail à Git sur votre système :

    config git --add user.email username@phpbb.com

Ajouter la télécommande en amont (vous pouvez changer « amont» à ce que vous voulez):

    git remote add git://github.com/blitze/phpBB-ext-sitemaker.git

**Installer les vendeurs**

    installation de compositeur

**Installer les paquets NPM**

    npm install

Vous pouvez également utiliser [yarn](https://yarnpkg.com):

    yarn install

## Demandes de tirage

    # Créer une nouvelle branche pour votre fonctionnalité & basculer vers elle
    git checkout -b feature/my-fancy-new-feature
    
    # créer une nouvelle branche pour le problème sur lequel vous travaillez sur * (le ticket # provient de github tracker)
    git checkout -b ticket/1234

Effectuez vos modifications

    # Stage les fichiers
    git add <files> 
    
    # Commit les fichiers staged - veuillez utiliser un message de commit correct
    git commit -m "my commit message"

Repousser la branche vers GitHub git push origin feature/my-fancy-new-feature

Soumettre une [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
