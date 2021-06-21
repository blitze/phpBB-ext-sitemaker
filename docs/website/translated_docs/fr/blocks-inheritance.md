---
id: héritage-blocs
title: Comprendre l'héritage du bloc
---

Nous avons déjà vu qu'en définissant une mise en page par défaut, d'autres pages qui n'ont pas de blocs de leurs propres hériteront des blocs de la mise en page par défaut. Il y a cependant un autre type d'héritage de bloc.

## Routes parent/enfant

Dans phpBB SiteMaker, nous parlons de routes imbriquées en termes de véritables répertoires imbriqués (sous) ou de routes virtuellement imbriquées. Veuillez rester avec moi :). * Real Parent/Child routes: Par exemple, le chemin /some_directory/sub_directory/index.php est un enfant de /some_directory/index.php * Virtual Parent/Child routes: Par exemple, viewtopic.php est traité comme un enfant de viewforum.php.

Voici quelques exemples de routes parent/enfant :

| Parent             | Enfant                         |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articles/mon-article  |

## Hérité du bloc parent/enfant

Pour les routes parent/enfant, le chemin enfant hérite des blocs de la route mère (si le parent a ses propres blocs) ou de la mise en page par défaut (si l'un a été défini). En d'autres termes, même s'il y a une disposition par défaut, la route enfant héritera des blocs de sa route parente si la route parente a ses propres blocs. Mais tous les blocs de la route mère ne doivent pas être hérités.

## Contrôle de l'héritage des blocs

À un niveau de bloc, vous pouvez contrôler quand un bloc peut être hérité par des routes enfants. Nous l'avons déjà touché dans les [Paramètres d'édition des blocs](./blocks-managing#editing-block-settings).

Considérez la structure de répertoire réelle suivante :

```text
phpBB
├── index.php
└── Movies/
    ├── index.php
    ├── page.php
    └── Comedy/
        └── index.php
```

Pour l'héritage de blocs, nous disons : * Le chemin parent de /phpBB/Movies/Comedy/index.php est /phpBB/Movies/index.php et non /phpBB/Movies/page.php * Toutes les pages d'un sous répertoire relatif à /phpBB/index.php est un chemin enfant de /phpBB/index.php. Donc /phpBB/Movies/index.php et /phpBB/Movies/page.php sont tous des enfants de /phpBB/index.php et hériteront donc de ses blocs s'ils n'ont pas de blocs. Dans ce cas: * Quand un bloc sur /phpBB/index. hp est configuré pour afficher sur **Cacher sur les routes enfants**, le bloc s'affichera sur /phpBB/index. hp (route parentale) mais pas sur ses routes enfants * Quand un bloc sur /phpBB/index. hp est configuré pour afficher sur **Afficher sur les routes enfants seulement**, il s'affichera sur /phpBB/Movies/index.php et /phpBB/Movies/page. hp (routes enfants) mais pas sur /phpBB/index.php (parent), ni /phpBB/Movies/Comedy/index. hp (nous ne faisons qu'un niveau de profondeur) * Quand un bloc sur /phpBB/index. hp est configuré pour afficher **toujours** (par défaut), il s'affichera sur /phpBB/index.php (parent), /phpBB/Movies/index. hp et /phpBB/page.php (routes enfants) mais pas sur /phpBB/Movies/Comedy/index.php (nous ne faisons qu'un niveau de profondeur). Dans ce cas, /phpBB/Movies/Comedy/index.php héritera de la route par défaut (si elle existe)

## État d'avenir acceptable

Je suis vraiment intéressé par vos commentaires dans ce domaine. La plupart des utilisateurs de phpBB n'auront pas de répertoires réels comme indiqué ci-dessus. Donc, je pense à utiliser la structure qui est définie dans un bloc de menu comme une structure de répertoire virtuel et d'y appliquer cet héritage parent/enfant. Je pense aussi aller au-delà d'un niveau profond. Veuillez me dire si cela vous sera utile.