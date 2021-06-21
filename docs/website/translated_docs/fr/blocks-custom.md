---
id: blocs-personnalisés
title: Bloc personnalisé
---

Si les blocs disponibles ne vous donnent pas la liberté dont vous avez besoin. il y a le `Custom Block` qui vous permet d'afficher votre propre contenu en utilisant le BBcode ou le HTML. The block comes with a WYSIWYG editor (TinyMCE) and a scripts manager:

## L'éditeur

- Vous pouvez utiliser l'éditeur pour créer du contenu HTML
- Vous pouvez modifier le code source si vous avez besoin de ce niveau de contrôle en cliquant sur l'icône `Code source` (`<>`) dans l'éditeur
- The editor allows you to upload and modify images 
    - It creates a new folder in phpBB/images/sitemaker_uploads/ for every user who has access to it
    - You can view/manage all user folders
- L'éditeur filtre tous les scripts potentiellement dangereux comme javascript, etc. Si vous avez besoin d'ajouter du contenu comme google ads, le javascript sera filtré, mais vous pouvez le contourner en faisant ce qui suit : 
    - Ajouter le bloc personnalisé à l'emplacement désiré
    - Modifiez le bloc personnalisé, cliquez sur l'onglet `HTML` et collez votre Javascript

## The Scripts Manager

The Custom Block also allows you to add custom CSS and Javascript files to your page. To do this:

- Add a `Custom Block` to any block position. The position does not matter unless you are also displaying content with the block
- Edit the block, click on the `Scripts` tab and add your CSS or Javascript files > Word of caution though: Adding to many scripts on your page can affect load times