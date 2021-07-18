---
title: Héritage de bloc
sidebar_position: 5
---

Nous l'avons déjà vu en définissant une disposition par défaut, les autres pages qui n'ont pas de blocs propres hériteront des blocs de la disposition par défaut. Il existe cependant un autre type d'héritage de blocs.

## Routes parents/enfants
Dans phpBB SiteMaker, nous parlons de routes imbriquées en termes de vrais répertoires imbriqués (sous-) ou de chemins virtuellement imbriqués / routes. Veuillez rester avec moi :).
* Routes réelles Parent/Enfant: Par exemple, le chemin /some_directory/sub_directory/index.php est un enfant de /some_directory/index.php
* Routes Virtual Parent/Child : Par exemple, viewtopic.php est traité comme un enfant de viewforum.php.

Voici quelques exemples de routes parents/enfants:

| Même page/fenêtre  | Enfant                         |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articles/mon-article  |

## Bloc parent / enfant de l'héritage
Pour les routes parent/enfant, la route enfant hérite des blocs de la route parente (si le parent a ses propres blocs) ou de la disposition par défaut (si elle a été définie). En d'autres termes, même s'il y a une disposition par défaut, la route enfant héritera des blocs de sa route parente si la route parente a ses propres blocs. Mais tous les blocs de la route parentale ne doivent pas être hérités.

## Contrôler l'héritage des blocs
Au niveau d'un bloc, le personnage peut contrôler quand un bloc peut être hérité par des routes enfants. Nous avons touché cela plus tôt dans la section [Modifier les paramètres de bloc](/docs/user/blocks/managing-blocks#editing-block-settings).

Considérez la structure de répertoire réelle:
```text
phpBB
├── index.php
└── Movies/
    ├── index.php
    ├── page.php
    └── Comedy/
        └── index.php
```

Dans le but d'hériter des blocs, nous disons:
* La route parente de /phpBB/Movies/Comedy/index.php est /phpBB/Movies/index.php et non /phpBB/Movies/page.php
* Toutes les pages dans un sous-répertoire relatif à /phpBB/index.php est une route enfant de /phpBB/index.php. Donc /phpBB/Movies/index.php et /phpBB/Movies/page.php sont tous des enfants de /phpBB/index.php et hériteront donc de ses blocs s'ils n'ont pas de blocs propres. Dans ce cas:
    * Quand un bloc sur /phpBB/index.php est configuré pour s'afficher sur **Cacher sur les routes des enfants**, le bloc s'affichera sur /phpBB/index. hp (route parentale) mais pas sur ses routes enfants
    * Quand un bloc sur /phpBB/index.php est configuré pour s'afficher sur **Afficher sur les routes enfants seulement**, il s'affichera sur /phpBB/Movies/index. hp and /phpBB/Movies/page.php (child routes) but not on /phpBB/index.php (parent), nor /phpBB/Movies/Comedy/index.php (we go only one level deep)
    * Quand un bloc sur /phpBB/index.php est configuré pour afficher **toujours** (par défaut), il s'affichera sur /phpBB/index. hp (parent), /phpBB/Movies/index.php and /phpBB/page.php (child routes) but not on /phpBB/Movies/Comedy/index.php (we go only one level deep). Dans ce cas, /phpBB/Movies/Comedy/index.php héritera de la route par défaut (si elle existe)

## État du futur possible
Je suis vraiment intéressé par vos commentaires dans ce domaine. La plupart des utilisateurs de phpBB n'auront pas de vrais répertoires comme décrit ci-dessus. Donc, je pense à utiliser la structure qui est définie dans un bloc de menu comme une structure de répertoire virtuel et appliquer cet héritage parent/enfant à lui. J'envisage également d'aller au-delà d'un niveau de profondeur. S'il vous plaît, faites-moi savoir si cela vous sera utile.