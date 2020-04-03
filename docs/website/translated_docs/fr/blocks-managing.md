---
id: gestion des blocs
title: Gestion des blocs
---

Pour gérer les blocs dans phpBB SiteMaker, vous devez être dans la [mode édition](./blocks-overview#edit-mode).

> Lorsqu'un bloc n'affiche aucun contenu, il ne sera pas affiché, sauf en mode édition. De cette façon, vous pouvez soit lui donner du contenu (dans le cas du bloc personnalisé) ou modifier ses paramètres.
> 
> En mode édition, les blocs un peu transparents sont des blocs qui, sinon, ne seront pas affichés mais ne seront affichés que parce que nous sommes en mode édition

## Ajout des blocs

Vous pouvez ajouter des blocs à n'importe quelle page d'accueil, à l'exception des pages du panneau de configuration utilisateur et du panneau de configuration des modérateurs. Pour ajouter un bloc, vous aurez besoin de : * cliquez sur **Blocs** dans la barre d'administration. Ceci affichera une liste de blocs disponibles * Glisser et déposer le bloc désiré à n'importe quelle position de bloc

## Modifier les blocs

### Ajout d'une icône de bloc

À la gauche du titre du bloc (prosilver), il y a une boîte pour l'icône du bloc. Cliquez sur cette case pour obtenir le sélecteur d'icônes. Vous pouvez sélectionner la taille de l'icône, la couleur, le float, la rotation, etc.

### Modifier le titre du bloc

Les blocs phpBB SiteMaker auront un titre traduit par défaut, mais si le titre ne répond pas à vos besoins, vous pouvez le changer. Pour modifier le titre du bloc, * Cliquez sur le titre du bloc pour obtenir un formulaire d'édition en ligne * Changez le titre à ce que vous voulez * Retirez le focus du champ ou appuyez sur Entrée pour soumettre des modifications

> Votre titre de bloc modifié n'est pas traduit
> 
> Pour revenir au titre par défaut, supprimez simplement le titre et appuyez sur Entrée

### Modifier les paramètres du bloc

Lorsque vous survolez un bloc, une icône de cog apparaîtra à droite du bloc qui peut être utilisé pour modifier le bloc. Dans la boîte de dialogue du bloc d'édition, vous pouvez : - Activer/désactiver un bloc [Status] - Choisissez quand le bloc devrait/ne pas être affiché [Display]. Ceci ne s'applique que dans les cas où vous avez des pages imbriquées (voir [Comprendre l'héritage du bloc](./blocks-inheritance.md)) - **Toujours**: Toujours afficher le bloc - **Masquer sur les routes enfantes**: n'afficher que ce bloc sur la route parentale - **Afficher sur les routes enfants seulement**: n'afficher que ce bloc sur une route enfant - Choisissez quels groupes d'utilisateurs peuvent voir le bloc [consultable par]. Utilisez CTRL + cliquez pour sélectionner plusieurs groupes. - Définir des classes personnalisées pour modifier l'apparence du bloc ou des éléments (listes, images, arrière-plan, etc) dans le bloc [Classe CSS] - Afficher/masquer le titre du bloc [Masquer le titre du bloc?] - Sélectionnez la vue du bloc [Vue du bloc]. Vous pouvez sélectionner une vue par défaut lorsque de nouveaux blocs sont ajoutés dans ACP. - **Défaut / Simple**: utilise la classe du panneau d'argent pour envelopper le bloc dans un conteneur rembourré -> **Basique**: le bloc n'a pas de conteneur l'enveloppement -> **Boîté**: utilise la classe forabg prosilver pour envelopper le bloc dans une boîte - Définir / Mettre à jour les paramètres spécifiques du bloc - Si vous avez le même bloc avec les mêmes paramètres sur plusieurs pages, vous pouvez les mettre à jour à la fois en vérifiant les blocs **avec des paramètres similaires**

## Suppression des blocs

- Survolez le bloc que vous souhaitez supprimer
- Cliquez sur l'icône **x** et confirmez que vous souhaitez supprimer le bloc
- Allez dans la barre d'administration et cliquez sur `Enregistrer les modifications`