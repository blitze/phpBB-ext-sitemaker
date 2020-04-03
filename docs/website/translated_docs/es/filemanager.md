---
id: gestor de archivos
title: Filtrador Responsable
---

A partir de la versión 3.1.0, phpBB SiteMaker soporta el [Responsive Filemanager](http://responsivefilemanager.com)

* El gestor de archivos se utiliza como un conector TinyMCE (WYSIWYG editor) al editar bloques personalizados
* Actualmente está configurado para crear carpetas separadas para cada usuario, excepto el usuario con un permiso de_sm_filemanager (Puede ver/administrar las carpetas de otros usuarios), lo que les permite acceder a ver/administrar todas las carpetas de subida.

## Instalación

* Descargar el [Responsive FileManager](http://responsivefilemanager.com/index.php#sthash.5UrnhjX2.dpbs)
* Extractelo y cargue los archivos a su carpeta raíz phpBB. La estructura del archivo debe ser como abajo:

```text
phpBB
<unk> ー<unk> <unk> ー<unk> /
<unk> 하<unk> includes/
...
└── ResponsiveFilemanager/
    └── filemanager/
        └── config/
            ├── .htaccess
            └── config.php
```

## Activación

* Ir a ACP > Extensiones > SiteMaker > Ajustes
* Habilitar función File Manager
* Guardar cambios
* Actualizar permisos de usuario (pestaña Misc) para determinar quién puede usar esta característica [Puede usar el Administrador de archivos]
* Actualizar permisos de administrador (pestaña Misc) para determinar quién puede administrar carpetas de usuario [Puede ver/administrar carpetas de otros usuarios en File Manager]