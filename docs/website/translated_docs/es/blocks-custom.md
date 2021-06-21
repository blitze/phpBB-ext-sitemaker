---
id: bloques-personalizados
title: Bloque personalizado
---

Si los bloques disponibles no te dan la libertad que necesitas, hay el `Bloque Personalizado` que te permite la libertad de mostrar tu propio contenido usando BBcode o HTML. The block comes with a WYSIWYG editor (TinyMCE) and a scripts manager:

## El editor

- Puede usar el editor para crear contenido HTML
- Puede editar el código fuente si necesita ese nivel de control haciendo clic en el icono `Código fuente` (`<>`) en el editor
- The editor allows you to upload and modify images 
    - It creates a new folder in phpBB/images/sitemaker_uploads/ for every user who has access to it
    - You can view/manage all user folders
- El editor filtra cualquier script potencialmente peligroso como javascript, etc. Si necesitas añadir contenido como anuncios de google, el javascript será filtrado, pero puedes evitarlo haciendo lo siguiente: 
    - Añadir el bloque personalizado a la ubicación deseada
    - Editar el bloque personalizado, haga clic en la pestaña `HTML` y pegue su Javascript

## El Administrador de Scripts

The Custom Block also allows you to add custom CSS and Javascript files to your page. To do this:

- Add a `Custom Block` to any block position. The position does not matter unless you are also displaying content with the block
- Edit the block, click on the `Scripts` tab and add your CSS or Javascript files > Word of caution though: Adding to many scripts on your page can affect load times