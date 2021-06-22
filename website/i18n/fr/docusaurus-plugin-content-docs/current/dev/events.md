---
title: Événements phpBB SiteMaker
sidebar_position: 2
---

Vous pouvez modifier le comportement de phpBB SiteMaker en utilisant le système d'événements de phpBB.

## Événements PHP

### Vous pouvez ajouter des éléments dans le menu déroulant

-   Lieu: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
-   Depuis : 3.1.0
-   But : Ajouter des options de menu en vrac dans le menu acp

### Les paramètres de ce site sont affichés dans la liste des paramètres

-   Lieu: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Depuis : 3.1.0
-   But : afficher le formulaire de configuration acp (sitemaker)

### Les paramètres de ce site sont sauvegardés

-   Lieu: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Depuis : 3.1.0
-   But : Enregistrer les paramètres acp (sitemaker)

### Définir les actifs de la barre d'administration

-   Lieu: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
-   Depuis : 3.0.1-RC1
-   But : Ajouter des actifs pour les blocs disponibles en mode édition

### modifier les positions de blocs

-   Lieu: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Depuis : 3.0.1-RC1
-   But : Modifier les positions des blocs

### Modification du bloc rendu

-   Lieu: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Depuis : 3.0.1-RC1
-   But : Modifier un bloc rendu

## Événements du modèle

### Paramètres du sitemaker_blitze_acp

-   Lieu: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
-   Depuis : 3.1.0
-   But : Ajouter des champs de formulaire aux paramètres du sitemaker

### admin_bar_admin_append

-   Lieu: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Depuis : 3.1.0
-   But : Ajouter des éléments de menu à la barre d'administration

### Modèles d'administration de la barre de page

-   Lieu: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Depuis : 3.1.0
-   But : Ajouter des fichiers de modèle à utiliser en JS pour les vues de blocs, etc

## Événements Javascript

### Mise en page du sitemaker_blitze enregistrée

-   Lieu: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
-   Depuis : 3.1.2
-   But : Événement permettant aux autres extensions de faire quelque chose lorsque les modifications de la mise en page sont enregistrées

### format@@0 blitze_sitemaker_render_block_before

-   Lieu: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Depuis : 3.1.2
-   But : Événement permettant aux autres extensions de faire quelque chose avant que le bloc ne soit rendu ou d'empêcher son re-rendu

### format@@0 blitze_sitemaker_render_block_after

-   Lieu: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Depuis : 3.1.2
-   But : Événement permettant aux autres extensions de faire quelque chose après le rendu du bloc

### format@@0 blitze_sitemaker_save_block_before

-   Lieu: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
-   Depuis : 3.1.2
-   But : Événement permettant aux autres extensions de modifier les données des blocs avant de les enregistrer

### format@@0 blitze_sitemaker_show_all block_positions

-   Lieu: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Depuis : 3.1.2
-   But : Événement permettant aux autres extensions de faire quelque chose quand toutes les positions de bloc sont affichées

### masquer les positions de blocs vides

-   Lieu: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Depuis : 3.1.2
-   But : Événement permettant aux autres extensions de faire quelque chose lorsque des positions vides sont cachées

### format@@0 blitze_sitemaker_layout_cleared

-   Lieu: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Depuis : 3.1.2
-   But : Événement permettant aux autres extensions de faire quelque chose lorsque la mise en page est effacée

### format@@0 blitze_sitemaker_layout_updated

-   Lieu: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Depuis : 3.1.2
-   But : Événement permettant aux autres extensions de faire quelque chose lorsque la mise à jour de la mise en page est mise à jour.

### Options de mise à jour du site

-   Lieu: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
-   Depuis : 3.3.0
-   But : Événement permettant aux autres extensions de modifier les options de tinymce
