---
title: phpBB Eventos SiteMaker
sidebar_position: 2
---

Puede modificar el comportamiento de phpBB SiteMaker usando el sistema de eventos de phpBB.

## Eventos PHP

### añadir opciones de menú

-   Ubicación: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
-   Desde: 3.1.0
-   Propósito: Añadir opciones de menú masivo en el menú de acp

### configuración de la página web

-   Ubicación: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Desde: 3.1.0
-   Propósito: mostrar configuración de acp (sitemaker)

### blitze.sitemaker.acp_save_settings

-   Ubicación: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Desde: 3.1.0
-   Propósito: Guardar configuración de acp (sitemaker)

### establecer.set_activos

-   Ubicación: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
-   Desde: 3.0.1-RC1
-   Propósito: Añadir recursos para los bloques disponibles en modo edición

### blitze.sitemaker.modify_block_positions

-   Ubicación: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Desde: 3.0.1-RC1
-   Propósito: Modificar posiciones de bloque

### bloque.sitemaker.modify_rendered_bloque

-   Ubicación: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Desde: 3.0.1-RC1
-   Propósito: Modificar un bloque renderizado

## Eventos de Plantilla

### configuración de blitze_sitemaker_acp

-   Ubicación: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
-   Desde: 3.1.0
-   Propósito: Añadir campos de formulario para la configuración del sitemaker

### admin_bar_admin_admin

-   Ubicación: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Desde: 3.1.0
-   Propósito: Añadir elementos de menú a la barra de administración

### plantillas de barra blitze_sitemaker_admin

-   Ubicación: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Desde: 3.1.0
-   Propósito: Añadir archivos de plantillas para ser usados en JS para vistas de bloque, etc

## Eventos Javascript

### blitze_sitemaker_layout guardado

-   Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
-   Desde: 3.1.2
-   Propósito: Evento para permitir que otras extensiones hagan algo cuando se guardan los cambios de diseño

### bloque_sitemaker_render_bloqueo_antes

-   Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Desde: 3.1.2
-   Propósito: Evento para permitir que otras extensiones hagan algo antes de que el bloque sea renderizado o evite que se vuelva a procesar

### blitze_sitemaker_render_block_después

-   Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Desde: 3.1.2
-   Propósito: Evento para permitir que otras extensiones hagan algo después de que se procese el bloque

### blitze_sitemaker_save_block_antes

-   Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
-   Desde: 3.1.2
-   Propósito: Evento para permitir que otras extensiones modifiquen los datos del bloque antes de guardarlos

### mostrar todas las posiciones de bloqueo

-   Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Desde: 3.1.2
-   Propósito: Evento para permitir que otras extensiones hagan algo cuando se muestran todas las posiciones de bloque

### escondite de posiciones de bloque de sitio

-   Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Desde: 3.1.2
-   Propósito: Evento para permitir que otras extensiones hagan algo cuando se ocultan posiciones vacías

### blitze_sitemaker limpiado

-   Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Desde: 3.1.2
-   Propósito: Evento para permitir que otras extensiones hagan algo cuando se borre el diseño

### blitze_sitemaker_layout_actualizado

-   Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Desde: 3.1.2
-   Propósito: Evento para permitir que otras extensiones hagan algo cuando se actualiza el diseño

### opciones de creación de sitios

-   Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
-   Desde: 3.3.0
-   Propósito: Evento para permitir que otras extensiones modifiquen las opciones de tinymce
