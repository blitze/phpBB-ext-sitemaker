---
title: Establecer un diseño predeterminado
sidebar_position: 4
---

Cuando se agrega un bloque, se añade a esa página específica. Por lo tanto, sería una tarea tediosa establecer bloques para todas las páginas de su sitio. Puede establecer todos los bloques deseados para una página en particular, luego establecer esa página como el diseño predeterminado. En otras palabras, cualquier página que no tenga sus propios bloques, heredará bloques de esta página.

Para establecer un diseño predeterminado
* Ve a la página que quieras establecer como diseño predeterminado
* Haga clic en `Configuración` en la barra de administración
* Haga clic en el botón `Establecer como diseño predeterminado`

Digamos que añadimos bloques a una página (phpBB/index.php) con bloques en la barra lateral y posiciones superiores, por ejemplo, y establecerla como nuestro diseño predeterminado. Esto tiene los siguientes efectos para otras páginas:
* Cualquier página que no tenga sus propios bloques, heredará los bloques del diseño predeterminado. Ver [Herencia de Bloques Enteros](/docs/user/site/block-inheritance) para excepciones.
* Todavía puede heredar bloques de un diseño predeterminado (índice. hp) pero elija no mostrar bloques en algunas posiciones de bloques o no mostrar ningún bloque en absoluto. Para hacer esto,
    * Ir a la página que no quieres que se muestren todos/algunos bloques
    * Haga clic en `Configuración` en la barra de administración
    * Seleccione `No mostrar bloques en esta página` si no desea heredar/mostrar ningún bloque en esta página O
    * Usa CTRL + clic para seleccionar las posiciones de bloque (a la derecha) en las que no quieres mostrar los bloques
* En `modo de edición`, una página que hereda bloques del diseño predeterminado, no mostrará ningún bloque, dándote la oportunidad de añadir bloques a la página si quieres
* Cualquier página que tenga sus propios bloques no heredará del diseño predeterminado
