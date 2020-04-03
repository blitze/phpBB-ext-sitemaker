---
id: gestionnaire de fichier
title: Gestionnaire de fichiers réactif
---

Depuis la version 3.1.0, phpBB SiteMaker utilize [Responsive Filemanager](http://responsivefilemanager.com) pour la gestion des fichiers

* Le gestionnaire de fichiers est utilisé comme un plugin TinyMCE (éditeur WYSIWYG) lors de l'édition de blocs personnalisés
* Il est actuellement configuré pour créer des dossiers séparés pour chaque utilisateur, à l'exception de l'utilisateur avec une permission_sm_filemanager (Peut voir/gérer les dossiers des autres utilisateurs), ce qui leur permet d'accéder/gérer tous les dossiers téléchargés.

## Installation

* Téléchargez le [Responsive FileManager](http://responsivefilemanager.com/index.php#sthash.5UrnhjX2.dpbs)
* Extrayez-le, et téléchargez les fichiers dans votre dossier racine phpBB. La structure du fichier doit être comme ci-dessous :

```text
phpBB
<unk> <unk> <unk> <unk> <unk> <unk> -images/
<unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> /
...
└── ResponsiveFilemanager/
    └── filemanager/
        └── config/
            ├── .htaccess
            └── config.php
```

## Activation

* Allez dans ACP > Extensions > SiteMaker > Paramètres
* Activer la fonction Gestionnaire de fichiers
* Enregistrer
* Mettre à jour les permissions utilisateur (onglet Misc) pour déterminer qui peut utiliser cette fonctionnalité [Peut utiliser File Manager]
* Mettre à jour les permissions d'administration (onglet Misc) pour déterminer qui peut gérer les dossiers utilisateurs [Peut voir/gérer les dossiers des autres utilisateurs dans le Gestionnaire de fichiers]