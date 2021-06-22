---
title: Définir une mise en page par défaut
sidebar_position: 4
---

Lorsque vous ajoutez un bloc, il est ajouté à cette page spécifique. Il serait donc fastidieux de mettre en place des blocs pour toutes les pages de votre site. Vous pouvez définir tous les blocs désirés pour une page particulière, puis définir cette page comme mise en page par défaut. En d'autres termes, toute page qui n'a pas ses propres blocs, héritera des blocs de cette page.

Pour définir une mise en page par défaut
* Aller à la page que vous souhaitez définir comme mise en page par défaut
* Cliquez sur `Paramètres` dans la barre d'administration
* Cliquez sur le bouton `Définir comme disposition par défaut`

Dire que nous ajoutons des blocs à une page (phpBB/index.php) avec des blocs dans la barre latérale et les positions supérieures, par exemple, et le définir comme notre disposition par défaut. Ceci a les effets suivants pour les autres pages :
* N'importe quelle page qui n'a pas ses propres blocs, héritera les blocs de la disposition par défaut. Voir [Comprendre le patrimoine des blocs](/docs/user/site/block-inheritance) pour les exceptions.
* Vous pouvez toujours hériter des blocs d'une mise en page par défaut (index. hp) mais choisissez de ne pas afficher les blocs sur certaines positions de blocs ou d'afficher aucun bloc du tout. Pour cela,
    * Allez à la page que vous ne voulez pas tous / certains blocs à afficher
    * Cliquez sur `Paramètres` dans la barre d'administration
    * Sélectionnez `Ne pas afficher les blocs sur cette page` si vous ne voulez pas hériter/afficher de blocs sur cette page OU
    * Utilisez CTRL + clic pour sélectionner les positions des blocs (à droite) sur lesquelles vous ne voulez pas afficher les blocs
* En `mode d'édition`, une page qui hérite des blocs de la disposition par défaut, n'affichera aucun bloc, vous donnant la possibilité d'ajouter des blocs à la page si vous voulez
* N'importe quelle page qui a ses propres blocs n'héritera pas de la mise en page par défaut
