---
id: sitios-diseños
title: Diseños
---

Los "Layouts" determinan las posiciones de bloque disponibles y cómo se muestran.

## Posición del bloque

Las posiciones de bloques son áreas predefinidas en tu sitio donde pueden existir bloques. Las posiciones de bloque disponibles están determinadas por el estilo de plantilla que está utilizando. Para proplata, phpBB SiteMaker viene con las siguientes posiciones de bloques: * panel: ancho completo en la parte superior * sidebar: izquierda/derecha dependiendo del diseño de abajo * subcontenido: similar a sidebar sólo más grande * top_hor: bloques horizontales en la parte superior, flanking above sidebar/subcontent depending on layout * top: above main content * box: equal width, bloques horizontales debajo del contenido principal * abajo: debajo del contenido principal * bottom_hor: bloques horizontales a través de la parte inferior, flanking the sidebar/subcontent depending on layout * footer: horizontal blocks in the footer You can add more block positions in your own style templates by copying and modifying the corresponding phpBB SiteMaker templates

## Diseño del sitio

Usted puede elegir el diseño para su sitio en ACP (Extensiones > Sitemaker > Configuración): * **Blog**: subcontenido y barra lateral al lado del otro empujado a la derecha, top_hor/botom_hor subcontenido del flanco * **Santo Grial**: barra lateral y subcontenido de ancho igual en lados opuestos, subcontenido del flanco top_hor/botom_hor * **Portal**: barra lateral a la izquierda, subcontenido a la derecha, subcontenido del flanco top_hor/botom_hor * **Alt del Portal**: subcontenido a la izquierda, barra lateral a la derecha top_hor/botom_hor barra lateral del flanco * **Personalizado**: Establecer manualmente el ancho de las barras laterales como px, %, em o rem. Por defecto a 200px en cada lado

## Plantillas y estilos personalizados

En la medida de lo posible, intentamos poner archivos de plantilla y activos en la carpeta styles/all/ para que pueda sobrescribirlos creando un archivo con el mismo nombre bajo su propio tema de plantilla, por ejemplo, prosilver. Así que si desea modificar cómo se muestra un determinado bloque o si desea crear su propio diseño con sus propias posiciones de bloque, simplemente necesita crear un archivo con el mismo nombre y ruta que el original en su propio estilo.

Si necesita personalizar los archivos CSS/JS, eche un vistazo a la sección [theming](./developer-theming.md).