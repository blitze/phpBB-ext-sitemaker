---
title: Mises en page
sidebar_position: 1
---

Les « mises en page » déterminent la position des blocs disponibles et la façon dont ils sont affichés.

## Positions du bloc
Les positions de bloc sont des zones prédéfinies sur votre site où des blocs peuvent exister. Les positions de blocs disponibles sont déterminées par le style de modèle que vous utilisez. Pour prosilver, phpBB SiteMaker est livré avec les positions de bloc suivantes :
* panneau: pleine largeur sur le dessus
* sidebar: gauche/droite selon la mise en page ci-dessous
* sous-contenu: similaire à la barre latérale juste plus grande
* top_hor: blocs horizontaux sur le haut, flanking au-dessus de la barre latérale/sous-contenu en fonction de la disposition
* haut: au-dessus du contenu principal
* box : largeur égale, blocs horizontaux en dessous du contenu principal
* bas : en dessous du contenu principal
* bottom_hor: blocs horizontaux à travers le bas, en flanquant la barre latérale/sous-contenu en fonction de la mise en page
* pied de page : blocs horizontaux dans le pied de page Vous pouvez ajouter plus de positions de bloc dans vos propres modèles de style en copiant et modifiant les modèles phpBB SiteMaker correspondants

## Mise en page du site
Vous pouvez choisir la mise en page de votre site dans ACP (Extensions > Sitemaker > Paramètres):
* **Blog**: sous-contenu et barre latérale à côté l'un de l'autre, poussé à droite, top_hor/botom_hor sous-contenu du flanc
* **Saint Graal**: largeur égale de la barre latérale et du sous-contenu sur les côtés opposés, top_hor/botom_hor sous-contenu du flanc
* **Portail**: barre latérale à gauche, sous-contenu à droite, top_hor/botom_hor sous-contenu du flanc
* **Portail Alt**: sous-contenu à gauche, barre latérale à droite, top_hor/botom_hor barre latérale
* **Personnalisé**: Définissez manuellement la largeur des barres latérales en px, %, em ou rem. La valeur par défaut est 200px de chaque côté

## Modèles/styles personnalisés
Autant que possible, nous avons essayé de mettre des fichiers modèles et des assets dans le dossier styles/all/ afin que vous puissiez les écraser en créant un fichier avec le même nom sous votre propre thème de modèle e. . - prosil. Donc, si vous voulez modifier comment un certain bloc s'affiche ou si vous voulez créer votre propre mise en page avec vos propres positions de bloc, vous devez simplement créer un fichier avec le même nom et le même chemin que l'original dans votre propre style.

Si vous avez besoin de personnaliser les fichiers CSS/JS, jetez un œil à la section [thème](/docs/dev/theming).