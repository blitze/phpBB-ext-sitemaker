---
id: blocs-personnalisés
title: Bloc personnalisé
---

Si les blocs disponibles ne vous donnent pas la liberté dont vous avez besoin. il y a le `Custom Block` qui vous permet d'afficher votre propre contenu en utilisant le BBcode ou le HTML. Le bloc est livré avec un éditeur WYSIWYG (TinyMCE), un gestionnaire de fichiers [](./filemanager.md), et un gestionnaire de scripts :

## L'éditeur

* Vous pouvez utiliser l'éditeur pour créer du contenu HTML
* Vous pouvez modifier le code source si vous avez besoin de ce niveau de contrôle en cliquant sur l'icône `Code source` (`<>`) dans l'éditeur
* L'éditeur vous permet de télécharger et modifier des images
* L'éditeur filtre tous les scripts potentiellement dangereux comme javascript, etc. Si vous avez besoin d'ajouter du contenu comme google ads, le javascript sera filtré, mais vous pouvez le contourner en faisant ce qui suit : 
    * Ajouter le bloc personnalisé à l'emplacement désiré
    * Modifiez le bloc personnalisé, cliquez sur l'onglet `HTML` et collez votre Javascript

## Le gestionnaire de fichiers

Le `Bloc personnalisé` est également livré avec un [Gestionnaire de fichiers](./filemanager.md) en tant que plugin TinyMCE * Il crée un nouveau dossier dans phpBB/images/sitemaker_uploads/ pour chaque utilisateur qui y a accès. * Vous pouvez voir/gérer tous les dossiers utilisateurs

## Le Gestionnaire de scripts

Le bloc personnalisé vous permet également d'ajouter des fichiers CSS et Javascript personnalisés à votre page. Pour faire ceci: * Ajouter un bloc `Personnalisé` à n'importe quelle position de bloc. La position n'a pas d'importance, sauf si vous affichez également du contenu avec le bloc * Éditez le bloc, cliquez sur l'onglet `Scripts` et ajoutez vos fichiers CSS ou Javascript

> Mise en garde : L'ajout à de nombreux scripts sur votre page peut affecter les temps de chargement