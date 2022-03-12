---
title: Mananaging Blocks
sidebar_position: 3
---

Para gestionar bloques en phpBB SiteMaker, debe estar en [Modo de edición](./overview#edit-mode).

> Cuando un bloque no muestra ningún contenido, no se mostrará, excepto en modo edición. De esta manera, puede darle contenido (en el caso del bloque personalizado) o cambiar sus ajustes.

> En modo edición, los bloques algo transparentes son bloques que de otro modo no se mostrarán pero que sólo se muestran porque estamos en modo edición

## Añadiendo bloques
Puede añadir bloques a cualquier página de cara frontal, excepto el Panel de Control del Usuario y las páginas del Panel de Control del Moderador. Para añadir un bloque, necesitas:
* haga clic en **Bloques** en la barra de administración. Esto mostrará una lista de bloques disponibles
* Arrastra y suelta el bloque deseado a cualquier posición de bloque

## Editando bloques
### Añadir un icono de bloque
A la izquierda del título del bloque (prosilver), hay una caja para el icono del bloque. Haga clic en esta casilla para obtener el selector de iconos. Puede seleccionar el tamaño del icono, color, flotante, rotación, etc.

### Editando el título del bloque
Los bloques de phpBB SiteMaker tendrán un título predeterminado y traducido, pero si el título no satisface sus necesidades, puede cambiarlo. Para editar el título del bloque,
* Haga clic en el título del bloque para obtener un formulario de edición en línea
* Cambiar el título a lo que quieras
* Eliminar foco del campo o pulse Enter para enviar cambios

> El título del bloque modificado no está traducido

> Para revertir al título predeterminado, simplemente elimine el título y pulse Enter

### Editando ajustes de bloque
Cuando pasas el cursor sobre un bloque, un icono de engranaje aparecerá a la derecha del bloque que puede ser usado para editar el bloque. En el cuadro de diálogo de bloques de edición, puede:
- Activar/desactivar un bloque [Status]
- Elija cuándo debe o no mostrarse el bloque [Display]. Esto sólo se aplica en los casos en los que has anidado páginas (ver [Herencia de Bloques Enteros](/docs/user/site/block-inheritance)):
    - **Siempre**: Mostrar siempre el bloque
    - **Ocultar en rutas secundarias**: Mostrar solo este bloque en la ruta padre
    - **Mostrar solo en rutas secundarias**: Mostrar solo este bloque en una ruta secundaria
- Elija qué grupos de usuarios pueden ver el bloque [Visible por]. Utilice CTRL + clic para seleccionar varios grupos.
- Establecer clases personalizadas para modificar la apariencia del bloque o elementos (listas, imágenes, fondo, etc.) dentro del bloque [CSS Class]
- Mostrar/ocultar el título del bloque [¿Ocultar título del bloque?]
- Seleccione la vista de bloque [Vista de bloque]. Puede seleccionar una vista de bloque por defecto cuando se agregan nuevos bloques en ACP.
    - **Predeterminado / Simple**: utiliza la clase del panel prosilver para envolver el bloque en un contenedor acolchado
    - **Basic**: el bloque no tiene ningún contenedor envolviéndolo
    - **Cajado**: utiliza la clase forabg prosilver para envolver el bloque en una caja
- Establecer / Actualizar ajustes específicos del bloque
- Si tienes el mismo bloque con la misma configuración en varias páginas, puedes actualizar todos a la vez comprobando los bloques de actualización **con configuraciones similares**

## Borrando bloques
- Mueve el bloque que quieras eliminar
- Haga clic en el icono **x** y confirme que desea eliminar el bloque
- Sube a la barra de administración y haz clic en `Guardar Cambios`
