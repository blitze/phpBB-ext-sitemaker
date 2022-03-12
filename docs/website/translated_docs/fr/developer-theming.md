---
id: thème développeur
title: Thème
---

phpBB SiteMaker est livré avec des styles et des couleurs faits pour prosilver. Vous pouvez écraser les fichiers CSS, JS et HTML en créant le fichier correspondant dans le dossier de votre style.

# Création de fichiers JS/CSS pour votre style

Note: * Pour les instructions ci-dessous, nous supposerons que vous avez un style appelé mon-style.

Cloner dans phpBB/ext/blitze/sitemaker :

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

De la ligne de commande, allez au répertoire sitemaker :

    cd phpBB/ext/blitze/sitemaker
    

**Installer des vendeurs**

    installation du compositeur
    

**Installer des paquets**

Pour les commandes ci-dessous, vous pouvez utiliser npm ou [yarn](https://yarnpkg.com)

    yarn install
    

**Suivre les changements**

    yarn start --theme mon-style
    

**Modifier**

* Faites vos modifications aux fichiers dans le dossier phpBB/ext/blitze/sitemaker/develop.
* Regardez phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss for sass variables

**Construire des éléments**

    yarn build --theme mon-style
    

**Déployer**

Vous pouvez maintenant copier les fichiers générés depuis phpBB/ext/blitze/sitemaker/styles/my-style et les télécharger sur votre serveur de production.

> Cette extension utilise l'interface jQuery pour les onglets, les dialogues et les boutons. Le thème jQuery par défaut est 'smoothness.' Vous pouvez utiliser un autre thème jQuery UI qui correspond le mieux à votre thème. Vous pouvez spécifier le thème jQuery UI en utilisant le drapeau --jq_ui_theme. Par exemple :

    yarn build --theme my-style --jq_ui_theme ui-lightness