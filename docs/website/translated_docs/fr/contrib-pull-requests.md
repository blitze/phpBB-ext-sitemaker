---
id: Demandes contrib-pull
title: Soumettre une demande de Pull
sidebar_label: Demandes de Pull
---

`Les requêtes Pull vous permettent d'informer les autres des changements que vous avez poussés vers une branche dans un référentiel sur GitHub. Une fois qu'une pull request est ouverte, vous pouvez discuter et examiner les changements potentiels avec des collaborateurs et ajouter des commits de suivi avant que vos changements ne soient fusionnés dans la branche de base.` [Lire la suite](https://help.github.com/articles/about-pull-requests/)

## Forcer/Cloner

* Créer un compte github si vous n'en avez pas déjà un
* Allez sur https://github.com/blitze/phpBB-ext-sitemaker.git et cliquez sur "Fork"

Cloner votre fork du dépôt :

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

De la ligne de commande, allez au répertoire sitemaker :

    cd phpBB/ext/blitze/sitemaker
    

**Configurer git :**

Ajoutez votre nom d'utilisateur à Git sur votre système :

    git config --global user.name "Votre nom ici"
    

Ajoutez votre adresse e-mail à Git sur votre système :

    git config --add user.email username@phpbb.com
    

Ajouter la télécommande amont (vous pouvez changer 'amont' à ce que vous voulez) :

    git distant add upstream git://github.com/blitze/phpBB-ext-sitemaker.git
    

**Installer des vendeurs**

    installation du compositeur
    

**Installer les paquets NPM**

    installation npm
    

Vous pouvez également utiliser le fil [](https://yarnpkg.com):

    yarn install
    

## Demandes de Pull

    # Créez une nouvelle branche pour votre fonctionnalité & basculez vers lui
    git checkout -b feature/my-fancy-new-feature
    
    # créez une nouvelle branche pour le problème sur lequel vous travaillez * basculez vers elle (ticket # est depuis github tracker)
    git checkout -b ticket/1234
    

Modifier

    # Stage the files
    git add <files> 
    
    # Commit staged files - please use a correct commit message
    git commit -m "my commit message"
    

Retournez la branche vers GitHub fonctionnalité de push git/ma-fancy-new-feature

Soumettre une pull-request [](https://github.com/blitze/phpBB-ext-sitemaker/pulls)