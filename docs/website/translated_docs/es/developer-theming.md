---
id: tema-de-desarrollador
title: Tema
---

phpBB SiteMaker viene con estilos y colores hechos para prosilver. Puede sobrescribir archivos CSS, JS y HTML creando el archivo correspondiente en la carpeta de su estilo.

# Creando archivos JS/CSS para tu estilo

Nota: * Para el propósito de las siguientes instrucciones asumiremos que tiene un estilo llamado mi-estilo.

Clonar en phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Desde la línea de comandos ir al directorio sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Instalar vendedores**

    instalación del compositor
    

**Instalar paquetes**

Para los siguientes comandos puedes usar npm o [yarn](https://yarnpkg.com)

    instalación de yarn
    

**Ver cambios**

    inicio de yarn --theme my-style
    

**Hacer cambios**

* Haga sus cambios a los archivos en la carpeta phpBB/ext/blitze/sitemaker/develop.
* Mira phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss para las variables de savss

**Construir Equipos**

    yarn build --theme my-style
    

**Desplegar**

Ahora puede copiar los archivos generados desde phpBB/ext/blitze/sitemaker/styles/my-style y subirlos a su servidor de producción.

> Esta extensión usa la interfaz de usuario jQuery para pestañas, diálogos y botones. El tema jQuery por defecto es 'suavidad.' Puedes usar un tema diferente de la interfaz de usuario jQuery que mejor se adapte a tu tema. Puede especificar el tema de la interfaz de usuario jQuery usando el parámetro --jq_ui_theme. Por ejemplo:

    yarn build --theme my-style --jq_ui_theme ui-lightness