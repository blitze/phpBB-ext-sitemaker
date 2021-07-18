---
title: Tema
sidebar_position: 3
---

Entendemos que los archivos de plantillas y los archivos JS/CSS no funcionarán para cada estilo, así que a continuación puedes usar tus propias plantillas y crear archivos JS/CSS para tu estilo particular.

## Usando tu propia plantilla

Si las plantillas por defecto que vienen con phpBB Sitemaker no funcionan bien para tu estilo en particular puede sobreescribirlo fácilmente para usar su propio archivo de plantilla creando el archivo correspondiente en la carpeta de sus estilos.

Por ejemplo, decir que tu estilo se llama `Backlash` y tiene una manera particular en la que el HTML para la sección de encabezado de bloques necesita ser estructurado para la [vista encadenada](/docs/user/blocks/block-views). Puede sobrescribir esa plantilla en particular creando un archivo con el mismo nombre así: `phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

En otras palabras, para utilizar tu propio archivo de plantilla, necesitas:
* Identificar qué archivo de phpBB debe ser sobrescrito
* Cree un archivo con el mismo nombre en la carpeta `estilos` del sitemaker bajo su nombre de estilo

> Nota: Si creas tus propios archivos de plantilla, Asegúrese de no eliminar la carpeta `phpbb/ext/blitze/sitemaker` al actualizar la extensión ya que sus archivos personalizados serán borrados. Más bien, sólo sobrescribe los archivos existentes con los nuevos.

## Creando archivos JS/CSS para tu estilo

Nota:
* Para el propósito de las instrucciones de abajo asumiremos que usted tiene un estilo llamado mi-estilo.

Clonar en phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Desde línea de comandos ir al directorio sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Instalar vendedores**

    instalar composer

**Instalar paquetes**

Para los comandos de abajo puedes usar npm o [yarn](https://yarnpkg.com)

    instalar yarn

**Ver cambios**

    inicio de yarn --tema mi-estilo

**Hacer Cambios**

* Haga sus cambios en archivos en la carpeta phpBB/ext/blitze/sitemaker/develop .
* Mira phpBB/ext/blitze/sitemaker/develop/_partials/_globals.sc(debate) para variables sass

**Construir activos**

    construcción yarn --tema mi-estilo

**Desplegar**

Ahora puedes copiar los archivos generados desde phpBB/ext/blitze/sitemaker/styles/my-style y subirlos a tu servidor de producción.

> Esta extensión utiliza la interfaz de usuario de jQuery para pestañas, diálogos y botones. El tema predeterminado de jQuery es 'suavidad.' Puedes usar un tema diferente de la interfaz de usuario de jQuery que se adapte mejor a tu tema. Puede especificar el tema de la interfaz de usuario de jQuery usando el parámetro --jq_ui_theme. Por ejemplo:

    yarn build --theme my-style --jq_ui_theme ui-lightness
