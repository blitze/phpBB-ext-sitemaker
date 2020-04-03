---
id: bloques-personalizados
title: Bloque personalizado
---

Si los bloques disponibles no te dan la libertad que necesitas, hay el `Bloque Personalizado` que te permite la libertad de mostrar tu propio contenido usando BBcode o HTML. El bloque viene con un editor WYSIWYG (TinyMCE), un [Administrador de archivos](./filemanager.md)y un administrador de scripts:

## El editor

* Puede usar el editor para crear contenido HTML
* Puede editar el código fuente si necesita ese nivel de control haciendo clic en el icono `Código fuente` (`<>`) en el editor
* El editor te permite subir y modificar imágenes
* El editor filtra cualquier script potencialmente peligroso como javascript, etc. Si necesitas añadir contenido como anuncios de google, el javascript será filtrado, pero puedes evitarlo haciendo lo siguiente: 
    * Añadir el bloque personalizado a la ubicación deseada
    * Editar el bloque personalizado, haga clic en la pestaña `HTML` y pegue su Javascript

## El Administrador de Archivos

El `bloque personalizado` también viene con un [Administrador de archivos](./filemanager.md) como un pluglin TinyMCE * Crea una nueva carpeta en phpBB/images/sitemaker_uploads/ para cada usuario que tiene acceso a él * Puedes ver/administrar todas las carpetas de usuario

## El Administrador de Scripts

El bloque personalizado también le permite añadir archivos CSS y Javascript personalizados a su página. Para hacer esto: * Añadir un `Bloque Personalizado` a cualquier posición del bloque. La posición no importa a menos que también estés mostrando contenido con el bloque * Editar el bloque, haz clic en la pestaña `Scripts` y añade tus archivos CSS o Javascript

> Sin embargo, la advertencia es: añadir a muchos scripts en tu página puede afectar los tiempos de carga