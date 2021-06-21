---
id: mise en page du site
title: Dispositions
---

Les « Layouts » déterminent les positions de bloc disponibles et la façon dont elles sont affichées.

## Positions du bloc

Les positions des blocs sont des zones prédéfinies sur votre site où des blocs peuvent exister. Les positions de blocs disponibles sont déterminées par le style de modèle que vous utilisez. Pour prosilver, phpBB SiteMaker est livré avec les positions de bloc suivantes: * Panneau : pleine largeur en haut * barre latérale : gauche/droite selon la mise en page en-dessous * sous-contenu: similaire à la barre latérale juste plus grand * top_hor: blocs horizontaux en haut, flanc au-dessus de la barre latérale/sous-contenu en fonction de la mise en page * haut : au-dessus du contenu principal * boîte : largeur égale, blocs horizontaux en dessous du contenu principal * en bas : en bas du contenu principal * en bas : blocs horizontaux en bas, flanquer la barre latérale/sous-contenu en fonction de la disposition * pied de page : blocs horizontaux dans le pied de page Vous pouvez ajouter plus de positions de bloc dans vos propres modèles de style en copiant et en modifiant les modèles phpBB SiteMaker correspondants

## Disposition du site

Vous pouvez choisir la mise en page de votre site en ACP (Extensions > Sitemaker > Paramètres): * **Blog**: sous-contenu et barre latérale à côté. poussé à droite, top_hor/botom_hor sous-contenu flanc * **Saint Graal**: largeur égale et sous-contenu sur les côtés opposés, top_hor/botom_hor sous-contenu flank * **Portail**: barre latérale à gauche, sous-contenu à droite. top_hor/botom_hor sous-contenu flank * **Portail Alt**: sous-contenu à gauche, barre latérale à droite top_hor/botom_hor flank sidebar * **Personnalisé**: Régler manuellement la largeur des barres latérales comme px, %, em ou rem. 200px par défaut sur chaque côté

## Modèles/styles personnalisés

Dans la mesure du possible, nous avons essayé de mettre des fichiers de gabarits et des assets dans le dossier styles/all/ afin que vous puissiez les écraser en créant un fichier avec le même nom sous votre propre thème de gabarit, par exemple prosilver. Donc, si vous voulez modifier la façon dont un certain bloc s'affiche ou si vous voulez créer votre propre disposition avec vos propres positions de bloc, vous devez simplement créer un fichier avec le même nom et le même chemin que l'original dans votre propre style.

Si vous devez personnaliser les fichiers CSS/JS, jetez un œil à la section [de](./developer-theming.md).