---
title: Gestion des blocs
sidebar_position: 3
---

Pour gérer les blocs dans phpBB SiteMaker, vous devez être dans la [mode édition](./overview#edit-mode).

> Lorsqu'un bloc n'affiche aucun contenu, il ne sera pas affiché, sauf en mode édition. De cette façon, vous pouvez soit lui donner du contenu (dans le cas du bloc Personnalisé) ou modifier ses paramètres.

> En mode édition, les blocs quelque peu transparents sont des blocs qui ne seront pas affichés mais ne sont affichés que parce que nous sommes en mode édition

## Ajout des blocs
Vous pouvez ajouter des blocs à n'importe quelle page frontale, à l'exception des pages du panneau de contrôle de l'utilisateur et du panneau de configuration du modérateur. Pour ajouter un bloc, vous devrez :
* cliquez sur **Blocs** dans la barre d'administration. Ceci affichera une liste des blocs disponibles
* Glissez et déposez le bloc désiré à n'importe quelle position de bloc

## Édition des blocs
### Ajout d'une icône de bloc
À la gauche du titre du bloc (prosilver), il y a une boîte pour l'icône du bloc. Cliquez sur cette case pour obtenir le sélecteur d'icônes. Vous pouvez sélectionner la taille de l'icône, la couleur, le float, la rotation, etc.

### Modifier le titre du bloc
Les blocs phpBB SiteMaker auront un titre par défaut, traduit mais si le titre ne répond pas à vos besoins, vous pouvez le changer. Pour modifier le titre du bloc,
* Cliquez sur le titre du bloc pour obtenir un formulaire d'édition en ligne
* Remplacer le titre par ce que vous voulez
* Retirer le focus du champ ou appuyer sur Entrée pour soumettre les modifications

> Votre titre de bloc modifié n'est pas traduit

> Pour revenir au titre par défaut, supprimez simplement le titre et appuyez sur Entrée

### Édition des paramètres de blocage
Lorsque tu survoles un bloc, une icône de roue apparaîtra à droite du bloc qui peut être utilisé pour modifier le bloc. Dans la boîte de dialogue d'édition, vous pouvez:
- Activer/désactiver un bloc [Status]
- Choisissez quand le bloc ne devrait pas être affiché [Display]. Cela ne s'applique que dans les cas où vous avez des pages imbriquées (voir [Comprendre l'héritage des blocs](/docs/user/site/block-inheritance) ) :
    - **Toujours**: Toujours afficher le bloc
    - **Cacher sur les routes enfants**: afficher uniquement ce bloc sur la route parente
    - **Afficher uniquement sur les routes enfants**: afficher ce bloc uniquement sur une route enfant
- Choisissez quels groupes d'utilisateurs peuvent voir le bloc [Visible par]. Utilisez CTRL + cliquez pour sélectionner plusieurs groupes.
- Définir des classes personnalisées pour modifier l'apparence du bloc ou des éléments (listes, images, arrière-plan, etc.) dans le bloc [classe CSS]
- Afficher/masquer le titre du bloc [Cacher le titre du bloc ?]
- Sélectionnez la vue bloc [Vue bloc]. Vous pouvez sélectionner une vue de bloc par défaut lorsque de nouveaux blocs sont ajoutés dans ACP.
    - **Par défaut / Simple**: utilise la classe du panneau prosilver pour envelopper le bloc dans un conteneur rembourré
    - **Basic**: le bloc n'a pas de conteneur le enveloppant
    - **Boxed**: utilise la classe prosilver forabg pour envelopper le bloc dans une boîte
- Définir / Mettre à jour les paramètres spécifiques du bloc
- Si vous avez le même bloc avec les mêmes paramètres sur plusieurs pages, vous pouvez tous les mettre à jour en même temps en vérifiant les blocs de mise à jour **avec des paramètres similaires**

## Suppression des blocs
- Survolez le bloc que vous souhaitez supprimer
- Cliquez sur l'icône **x** et confirmez que vous souhaitez supprimer le bloc
- Montez dans la barre d'administration et cliquez sur `Enregistrer les modifications`
