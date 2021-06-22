---
title: Bloquear herencia
sidebar_position: 5
---

Ya lo hemos visto estableciendo un diseño por defecto, otras páginas que no tienen bloques propios heredarán los bloques del diseño predeterminado. Sin embargo, existe otro tipo de herencia de bloques.

## Rutas padres/hijas
En phpBB SiteMaker, hablamos de rutas anidadas en términos de directorios reales anidados (sub) o rutas virtualmente anidadas. Por favor, permanezca conmigo :).
* Rutas parentes/hijos: Por ejemplo, la ruta /some_directory/sub_directory/index.php es hijo de /some_directory/index.php
* Rutas parentales/infantiles: Por ejemplo, viewtopic.php es tratado como un hijo de viewforum.php.

Aquí hay algunos ejemplos de rutas padres/hijas:

| Padre              | Hijo                           |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articles/my-article   |

## Herencia de bloques padres/hijos
Para rutas padres/hijas, la ruta secundaria hereda los bloques de la ruta padre (si el padre tiene sus propios bloques) o de la disposición predeterminada (si se ha establecido una). En otras palabras, incluso si hay un diseño por defecto, la ruta hijo heredará bloques de su ruta padre si la ruta padre tiene sus propios bloques. Pero no todos los bloques de la ruta padre deben ser heredados.

## Controlar herencia de bloque
A nivel de bloques, puede controlar cuando un bloque puede ser heredado por rutas hijas. Hemos tocado esto anteriormente en [Editar configuración de bloque](/docs/user/blocks/managing-blocks#editing-block-settings).

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

A efectos de heredar bloques, decimos:
* La ruta principal de /phpBB/Movies/Comedy/index.php es /phpBB/Movies/index.php y no /phpBB/Movies/page.php
* Todas las páginas en un subdirectorio relativo a /phpBB/index.php es una ruta secundaria de /phpBB/index.php. Así que /phpBB/Movies/index.php y /phpBB/Movies/page.php son todos hijos de /phpBB/index.php y por lo tanto heredarán sus bloques si no tienen bloques propios. En este caso:
    * Cuando un bloque en /phpBB/index.php está configurado para que se muestre en **Ocultar en rutas secundarias**, el bloque se mostrará en /phpBB/index. CV (ruta principal) pero no en sus rutas secundarias
    * Cuando un bloque en /phpBB/index.php está configurado para que se muestre en **Mostrar sólo en rutas secundarias**, se mostrará en /phpBB/Movies/index. hp y /phpBB/Movies/page.php (rutas infantiles) pero no en /phpBB/index.php (parent), ni /phpBB/Movies/Comedy/index.php (sólo vamos un nivel profundo)
    * Cuando un bloque en /phpBB/index.php está configurado para mostrar **siempre** (por defecto), se mostrará en /phpBB/index. hp (parent), /phpBB/Movies/index.php y /phpBBB/page.php (ruta) pero no en /phpBB/Movies/Comedy/index.php (sólo vamos un nivel profundo). En este caso, /phpBB/Movies/Comedy/index.php heredará de la ruta por defecto (si existe)

## Estado futuro posible
Estoy realmente interesado en sus comentarios en esta área. La mayoría de los usuarios de phpBB no tendrán directorios reales como se ha descrito anteriormente. Así que estoy pensando en usar la estructura que se define en un bloque de menú como una estructura de directorios virtuales y aplicar esta herencia padre/hijo a ella. También estoy considerando ir más allá de un nivel de profundidad. Por favor, háganme saber si esto le será útil.