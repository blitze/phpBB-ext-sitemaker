---
title: Bloque personalizado
sidebar_position: 4
---

Si los bloques disponibles no le dan la libertad que necesita. hay el `bloque personalizado` que te permite mostrar tu propio contenido usando BBcode o HTML. El bloque viene con un editor WYSIWYG (TinyMCE) y un gestor de scrips:

## El editor

-   Puede utilizar el editor para crear contenido HTML
-   Puedes editar el código fuente si necesitas ese nivel de control haciendo clic en el icono del `código fuente` (`<>`) en el editor
-   El editor le permite subir y modificar imágenes
    -   Crea una nueva carpeta en phpBB/images/sitemaker_uploads/ para cada usuario que tenga acceso a ella
    -   Puede ver/administrar todas las carpetas de usuario
-   El editor filtra cualquier script potencialmente peligroso como javascript, etc. Si necesitas añadir contenido como anuncios de Google, el javascript será filtrado, pero puedes evitarlo haciendo lo siguiente:
    -   Agrega el bloque personalizado a la ubicación deseada
    -   Edite el bloque personalizado, haga clic en la pestaña `HTML` y pegue su Javascript

## El Administrador de Scripts

El Bloque Personalizado también le permite añadir archivos CSS y Javascript personalizados a su página. Para hacer esto:

-   Añade un `bloque personalizado` a cualquier posición de bloque. La posición no importa a menos que también muestre contenido con el bloque
-   Editar el bloque, haga clic en la pestaña `Scripts` y añada sus archivos CSS o Javascript > Palabra de precaución: Añadir a muchos scripts en su página puede afectar a los tiempos de carga
