---
id: bloques-herencia
title: Entender Herencia de Bloques
---

Ya hemos visto que al establecer un diseño predeterminado, otras páginas que no tienen bloques propios heredarán los bloques del diseño predeterminado. Sin embargo, existe otro tipo de herencia de bloques.

## Rutas padre/hijo

En phpBB SiteMaker, hablamos de rutas anidadas en términos de directorios anidados reales (sub) o rutas/rutas virtualmente anidadas. Por favor, manténgase conmigo :). * Rutas padres/hijos reales: Por ejemplo, la ruta /some_directory/sub_directory/index.php es un hijo de /some_directory/index.php * Rutas padres/hijos virtuales: Por ejemplo, viewtopic.php es tratado como un hijo de viewforum.php.

Aquí hay algunos ejemplos de rutas padre/hijo:

| Padre              | Niño                           |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/artículos | /app.php/articles/my-article   |

## Herencia del bloque padre/hijo

Para las rutas padre/hijo, la ruta hijo hereda los bloques de la ruta padre (si el padre tiene sus propios bloques) o del diseño predeterminado (si se ha establecido uno). En otras palabras, incluso si hay un diseño predeterminado, la ruta hijo heredará bloques de su ruta padre si la ruta padre tiene sus propios bloques. Pero no todos los bloques de la ruta padre deben ser heredados.

## Controlando Herencia de Bloques

A nivel de bloque, puede controlar cuándo un bloque puede ser heredado por rutas hijo. Hemos tocado esto antes en [Editando ajustes de bloques](./blocks-managing#editing-block-settings).

Considere la siguiente estructura real de directorios:

```text
phpBB
► index.php
✫ :/★ Movies/
    ► 4b4bindex.php
    ► page.php
    → Comedy/
        → → index.php
```

Para los propósitos de heredar bloques, decimos: * La ruta padre de /phpBB/Movies/Comedy/index.php es /phpBB/Movies/index.php y no /phpBB/Movies/page.php * Todas las páginas en un subdirectorio relativo a /phpBB/index.php es una ruta hijo de /phpBB/index.php. Así que /phpBB/Movies/index.php y /phpBB/Movies/page.php son todos hijos de /phpBB/index.php y por lo tanto heredarán sus bloques si no tienen bloques propios. En este caso: * Cuando un bloque en /phpBB/index. hp está configurado para mostrar en **Ocultar en rutas secundarias**, el bloque se mostrará en /phpBB/index. hp (ruta padre) pero no en sus rutas hijo * Cuando un bloque en /phpBB/index. hp está configurado para mostrar en **Mostrar en rutas secundarias sólo**, se mostrará en /phpBB/Movies/index.php y /phpBB/Movies/page. hp (rutas hijas) pero no en /phpBB/index.php (padre), ni /phpBB/Movies/Comedy/index. hp (sólo vamos un nivel de profundidad) * Cuando un bloque en /phpBB/index. hp está configurado para mostrar **siempre** (por defecto), se mostrará en /phpBB/index.php (padre), /phpBB/Movies/index. hp y /phpBB/page.php (rutas hijas) pero no en /phpBB/Movies/Comedy/index.php (sólo vamos un nivel de profundidad). En este caso, /phpBB/Movies/Comedy/index.php heredará de la ruta predeterminada (si existe)

## Posible Estado futuro

Estoy muy interesado en sus comentarios en este área. La mayoría de los usuarios de phpBB no tendrán directorios reales como se describe anteriormente. Así que estoy pensando en usar la estructura que se define en un bloque de menú como una estructura de directorios virtual y aplicar esta herencia padre/hijo a ella. También estoy considerando ir más allá de un nivel profundo. Por favor, háganme saber si esto le será útil.