---
id: eventos-de-desarrollador
title: phpBB Eventos de SiteMaker
---

Puede modificar el comportamiento de phpBB SiteMaker usando el sistema de eventos de phpBB.

## Eventos PHP

# blitze.sitemaker.acp_add_bulk_menu_options

- Ubicación: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- Desde: 3.1.0
- Propósito: Agrega opciones de menú a granel en el menú acp

# blitze.sitemaker.acp_display_settings_form

- Ubicación: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Desde: 3.1.0
- Propósito: formulario de configuración de acp (sitemaker)

# blitze.sitemaker.acp_save_settings

- Ubicación: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Desde: 3.1.0
- Propósito: Guardar ajustes de acp (sitemaker)

# blitze.sitemaker.admin_bar.set_assets

- Ubicación: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- Desde: 3.0.1-RC1
- Propósito: Agregar activos para bloques disponibles en modo edición

# blitze.sitemaker.modify_block_positions

- Ubicación: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Desde: 3.0.1-RC1
- Propósito: Modificar posiciones de bloque

# blitze.sitemaker.modify_rendered_block

- Ubicación: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Desde: 3.0.1-RC1
- Propósito: Modifica un bloque procesado

## Eventos de Plantilla

# propiedades

- Ubicación: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- Desde: 3.1.0
- Propósito: Agregar campos de formulario para la configuración del sitemaker

# añadir

- Ubicación: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Desde: 3.1.0
- Propósito: Añadir elementos de menú a la barra de administración

# plantillas de la barra de administración

- Ubicación: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Desde: 3.1.0
- Propósito: Añadir archivos de plantilla a ser usados en JS para vistas de bloques, etc

## Eventos Javascript

# mapa de sitio guardado

- Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- Desde: 3.1.2
- Propósito: Evento para permitir que otras extensiones hagan algo cuando se guardan los cambios de diseño

# blitze_sitemaker_render_block_before

- Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Desde: 3.1.2
- Propósito: Evento para permitir que otras extensiones hagan algo antes de que el bloque sea procesado o para evitar que se vuelva a procesar

# %s

- Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Desde: 3.1.2
- Propósito: Evento para permitir que otras extensiones hagan algo después de que el bloque sea procesado

# guardar bloque antes

- Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- Desde: 3.1.2
- Propósito: Evento para permitir que otras extensiones modifiquen los datos del bloque antes de ser guardado

# mostrar todas las posiciones de bloque

- Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Desde: 3.1.2
- Propósito: Evento para permitir que otras extensiones hagan algo cuando se muestren todas las posiciones de bloque

# ocultar posiciones de bloque vacías

- Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Desde: 3.1.2
- Propósito: Evento para permitir que otras extensiones hagan algo cuando las posiciones vacías estén ocultas

# borrado

- Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Desde: 3.1.2
- Propósito: Evento para permitir que otras extensiones hagan algo cuando el diseño sea borrado

# blitze_sitemaker_layout_updated

- Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Desde: 3.1.2
- Propósito: Evento para permitir que otras extensiones hagan algo cuando se actualiza el diseño

# opciones de creación de sitios

- Ubicación: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- Desde: 3.3.0
- Propósito: Evento para permitir que otras extensiones modifiquen las opciones de tinymce