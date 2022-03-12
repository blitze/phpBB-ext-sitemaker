---
title: Diseños
sidebar_position: 1
---

Los "Diseños" determinan las posiciones de bloque disponibles y cómo se muestran.

## Bloquear posiciones
Las posiciones del bloque son áreas predefinidas en su sitio donde pueden existir bloques. Las posiciones de bloque disponibles están determinadas por el estilo de plantilla que está utilizando. Para prosilver, phpBB SiteMaker viene con las siguientes posiciones de bloque:
* panel: ancho completo en la parte superior
* barra lateral: izquierda / derecha dependiendo del diseño de abajo
* subcontenido: similar a la barra lateral más grande
* top_hor: bloques horizontales sobre la parte superior, flanqueando sobre la barra lateral/subcontenido dependiendo del diseño
* arriba: sobre contenido principal
* caja: ancho igual, bloques horizontales debajo del contenido principal
* abajo: debajo del contenido principal
* bottom_hor: bloques horizontales a través de la parte inferior, flickear la barra lateral/subcontenido dependiendo del diseño
* pie de página: bloques horizontales en el pie de página Puedes añadir más posiciones en tus propias plantillas de estilo copiando y modificando las plantillas phpBB SiteMaker correspondientes

## Diseño del sitio
Puede elegir el diseño para su sitio en ACP (Extensiones > Sitemaker > Configuración):
* **Blog**: subcontenido y barra lateral al lado del otro, empujado a la derecha, top_hor/botom_hor flanquea subcontenido
* **Santo Grial**: Barra lateral de ancho igual y subcontenido en lados opuestos, top_hor/botom_hor flanquea subcontenido
* **Portal**: barra lateral a la izquierda, subcontenido a la derecha, top_hor/botom_hor flanquea subcontenido
* **Portal Alt**: subcontenido a la izquierda, barra lateral a la derecha, barra lateral superior / botom_hor flanco
* **Personalizado**: Establecer manualmente el ancho de las barras laterales como px, %, em o rem. Por defecto 200px en cada lado

## Plantillas/estilos personalizados
Tanto como sea posible, tratamos de poner los archivos de plantillas y los recursos en los estilos/todos/carpeta para que pueda sobreescribirlos creando un archivo con el mismo nombre bajo su propio tema de plantilla. . prosilver. Así que si quieres modificar cómo se muestra un bloque determinado o si quieres crear tu propio diseño con tus propias posiciones de bloques, simplemente necesita crear un archivo con el mismo nombre y ruta que el original en su propio estilo.

Si necesita personalizar archivos CSS/JS, eche un vistazo a la sección [temática](/docs/dev/theming).