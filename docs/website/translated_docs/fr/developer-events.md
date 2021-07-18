---
id: développeur-événements
title: Événements phpBB SiteMaker
---

Vous pouvez modifier le comportement de phpBB SiteMaker en utilisant le système d'événements de phpBB.

## Événements PHP

# sitemaker.acp_add_bulk_menu_options

- Emplacement: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- Depuis : 3.1.0
- But : Ajouter des options de menu en vrac dans le menu acp

# sitemaker.acp_display_settings_form

- Emplacement: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Depuis : 3.1.0
- But : afficher le formulaire de configuration acp (sitemaker)

# paramètres sitemaker.acp_save_settings

- Emplacement: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Depuis : 3.1.0
- But : Sauvegarder les paramètres acp (sitemaker)

# sitemaker.admin_bar.set_assets

- Emplacement: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- Depuis : 3.0.1-RC1
- But : Ajouter des ressources pour les blocs disponibles en mode édition

# modifier_bloquer les positions

- Emplacement: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Depuis : 3.0.1-RC1
- But : Modifier les positions de bloc

# modifier_rendu_bloc

- Emplacement: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Depuis : 3.0.1-RC1
- But : Modifier un bloc rendu

## Événements du modèle

# paramètres du sitemaker_acp

- Emplacement: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- Depuis : 3.1.0
- But : Ajouter les champs de formulaire pour les paramètres du sitemaker

# ajouter une barre d'administration

- Emplacement: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Depuis : 3.1.0
- But : Ajouter des éléments de menu à la barre d'administration

# emaker_admin_bar_templates

- Emplacement: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Depuis : 3.1.0
- But : Ajouter des fichiers de modèle à utiliser en JS pour les vues de bloc, etc

## Événements Javascript

# sitemaker_layout_sauvegardé

- Emplacement: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- Depuis : 3.1.2
- But : Événement permettant à d'autres extensions de faire quelque chose lorsque les changements de mise en page sont sauvegardés

# %1

- Emplacement: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Depuis : 3.1.2
- But : Événement permettant à d'autres extensions de faire quelque chose avant que le bloc soit rendu ou l'empêche d'être ré-rendu

# après

- Emplacement: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Depuis : 3.1.2
- But : Événement permettant aux autres extensions de faire quelque chose après que le bloc soit rendu

# %1

- Emplacement: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- Depuis : 3.1.2
- But : Événement permettant aux autres extensions de modifier les données de bloc avant qu'elles ne soient enregistrées

# afficher tous les blocs

- Emplacement: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Depuis : 3.1.2
- But : Événement permettant aux autres extensions de faire quelque chose lorsque toutes les positions de blocage sont affichées

# afficher les positions vides

- Emplacement: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Depuis : 3.1.2
- But : Événement permettant aux autres extensions de faire quelque chose quand les positions vides sont masquées

# sitemaker_layout_effacé

- Emplacement: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Depuis : 3.1.2
- But : Événement permettant aux autres extensions de faire quelque chose quand la mise en page est effacée

# mise à jour

- Emplacement: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Depuis : 3.1.2
- But : Événement permettant aux autres extensions de faire quelque chose lorsque la mise en page est mise à jour

# Options de mise à jour du site

- Lieu: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- Depuis : 3.3.0
- But : Événement permettant aux autres extensions de modifier les options de tinymce