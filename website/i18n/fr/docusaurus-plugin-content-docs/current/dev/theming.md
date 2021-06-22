---
title: Thème
sidebar_position: 3
---

Nous comprenons que les fichiers de modèles et les fichiers JS/CSS ne fonctionneront pas pour tous les styles, ainsi vous pouvez utiliser vos propres modèles et créer des fichiers JS/CSS pour votre style particulier.

## Utiliser votre propre modèle

Si les modèles par défaut fournis avec phpBB Sitemaker ne fonctionnent pas correctement pour votre style particulier, vous pouvez facilement l'écraser pour utiliser votre propre fichier de modèle en créant le fichier correspondant dans le dossier de vos styles.

Par exemple, disons que votre style s'appelle `Backlash` et qu'il a une façon particulière de structurer le HTML de la section d'en-tête de bloc pour la [vue en boîte](/docs/user/blocks/block-views). Vous pouvez écraser ce modèle en créant un fichier sous le même nom que celui-ci : `phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

En d'autres termes, pour utiliser votre propre fichier de modèle, vous devez :
* Identifier quel fichier phpBB Sitemaker doit être écrasé
* Créez un fichier avec le même nom dans le dossier `styles` du Sitemaker sous votre nom de style

> Remarque : Si vous créez vos propres fichiers de modèles, Assurez-vous de ne pas supprimer le dossier `phpbb/ext/blitze/sitemaker` lors de la mise à jour de l'extension car vos fichiers personnalisés seront supprimés. Plutôt, il suffit d'écraser les fichiers existants avec les nouveaux.

## Création de fichiers JS/CSS pour votre style

Note :
* Aux fins des instructions ci-dessous, nous supposerons que vous avez un style appelé mon-style.

Cloner dans phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

À partir de la ligne de commande, allez dans le répertoire sitemaker :

    cd phpBB/ext/blitze/sitemaker

**Installer les vendeurs**

    installation de compositeur

**Installer des paquets**

Pour les commandes ci-dessous, vous pouvez utiliser npm ou [yarn](https://yarnpkg.com)

    yarn install

**Regarder les changements**

    yarn start --theme mon-style

**Effectuer des modifications**

* Effectuez vos modifications dans le dossier phpBB/ext/blitze/sitemaker/developper.
* Regardez phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss pour les variables sass

**Actifs de construction**

    yarn build --theme mon-style

**Déployer**

Vous pouvez maintenant copier les fichiers générés à partir de phpBB/ext/blitze/sitemaker/styles/mon-style et les télécharger sur votre serveur de production.

> Cette extension utilise l'interface jQuery pour les onglets, les dialogues et les boutons. Le thème jQuery par défaut est 'smoothness'. Vous pouvez utiliser un thème jQuery différent qui correspond le mieux à votre thème. Vous pouvez spécifier le thème jQuery en utilisant l'option --jq_ui_theme. Par exemple :

    yarn build --theme mon-style --jq_ui_theme ui-lightness
