---
id: gestión de bloques
title: Gestión de Bloques
---

Para administrar bloques en phpBB SiteMaker, debes estar en [Edit Mode](./blocks-overview#edit-mode).

> Cuando un bloque no muestre ningún contenido, no se mostrará, excepto en modo edición. De esta forma, puede darle contenido (en el caso del bloque personalizado) o cambiar sus ajustes.
> 
> En modo de edición, los bloques algo transparentes son bloques que de lo contrario no se mostrarán, pero sólo se mostrarán porque estamos en modo edición

## Agregando bloques

Puede agregar bloques a cualquier página de cara frontal, excepto las páginas del Panel de Control del Usuario y del Panel de Control del Moderador. Para añadir un bloque, necesitarás: * hacer clic en **Bloques** en la barra de administración. Esto mostrará una lista de bloques disponibles * Arrastra y suelta el bloque deseado a cualquier posición de bloque

## Editando bloques

### Agregando un icono de bloque

A la izquierda del título del bloque (prosilver), hay una caja para el icono del bloque. Haga clic en este cuadro para obtener el selector de iconos. Puede seleccionar el tamaño del icono, color, flotante, rotación, etc.

### Editando el título del bloque

Los bloques phpBB SiteMaker tendrán un título por defecto, traducido pero si el título no satisface sus necesidades, puede cambiarlo. Para editar el título del bloque, * Haz clic en el título del bloque para obtener un formulario de edición en línea * Cambia el título a lo que quieras * Quitar el foco del campo o pulsa Intro para enviar cambios

> El título del bloque modificado no está traducido
> 
> Para volver al título por defecto, basta con borrar el título y pulsar enter

### Editando ajustes de bloque

Cuando se pasa sobre un bloque, un icono de cog aparecerá a la derecha del bloque que se puede utilizar para editar el bloque. En el diálogo de edición de bloque, puede: - Activar/desactivar un bloque [Status] - Elegir cuándo el bloque debe o no ser mostrado [Display]. Esto sólo se aplica en los casos en los que ha anidado páginas (véase [Entendiendo herencia del bloque](./blocks-inheritance.md)): - **Siempre**: Mostrar siempre el bloque - **Ocultar en las rutas secundarias**: Mostrar sólo este bloque en la ruta padre - **Mostrar en las rutas secundarias sólo**: Mostrar este bloque en una ruta secundaria - Elegir qué grupos de usuarios pueden ver el bloque [Visible por]. Utilice CTRL + clic para seleccionar varios grupos. - Establecer clases personalizadas para modificar la apariencia del bloque o elementos (listas, imágenes, fondo, etc) dentro del bloque [Clase CSS] - Mostrar/ocultar el título del bloque [Ocultar título del bloque?] - Seleccione la vista de bloque [Vista de bloque]. Puede seleccionar una vista de bloque por defecto cuando se agregan nuevos bloques en ACP. - **Predeterminado / Simple**: utiliza la clase del panel de prosilver para envolver el bloque en un contenedor acolchado - **Basic**: el bloque no tiene ningún contenedor envuelto - **Boxed**: utiliza la clase forabg de prosilver para envolver el bloque en una caja - Establecer / Actualizar configuración específica - Si tienes el mismo bloque con la misma configuración a través de múltiples páginas, puedes actualizarlos todos a la vez revisando los bloques de actualización **con configuraciones similares**

## Eliminando bloques

- Pasa por encima del bloque que te gustaría eliminar
- Haga clic en el icono **x** y confirme que desea eliminar el bloque
- Sube a la barra de administración y haz clic en `Guardar Cambios`