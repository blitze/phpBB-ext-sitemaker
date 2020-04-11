---
id: наследование блоков
title: Понимание наследства блока
---

Мы уже видели, что, установив макет по умолчанию, другие страницы, у которых нет собственных блоков, унаследуют блоки из макета по умолчанию. Однако существует еще один тип наследования блоков.

## Родительские/дочерние маршруты

В phpBB SiteMaker мы говорим о вложенных маршрутах с точки зрения реальных вложенных (вложенных) каталогов или фактически вложенных путей/маршрутов. Пожалуйста, оставайтесь со мной :). * Real Parent/Child маршруты: Например, путь /some_directory/sub_directory/index.php является ребенком /some_directory/index.php * Virtual Parent/Child маршруты: Например, viewtopic.php рассматривается как потомок viewforum.php.

Вот некоторые примеры родительских/дочерних маршрутов:

| Родитель           | Дочерний                       |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articles/my-article   |

## Наследование родительского/детского блока

Для родительских/дочерних маршрутов дочерний маршрут наследует блоки родительского маршрута (если родитель имеет свои собственные блоки) или из макета по умолчанию (если он был установлен). Другими словами, даже если есть макет по умолчанию, дочерний маршрут унаследует блоки из родительского маршрута, если родительский маршрут имеет свои блоки. Но не все блоки родительского маршрута должны быть унаследованы.

## Управление наследием блока

На уровне блоков можно контролировать, когда блок может быть унаследован дочерними маршрутами. Мы коснулись этого ранее в [Редактирование настроек блока](./blocks-managing#editing-block-settings).

Рассмотрим следующую реальную структуру каталогов:

```text
phpBB
├── index.php
└── Movies/
    ├── index.php
    ├── page.php
    └── Comedy/
        └── index.php
```

Для целей наследования блоков мы говорим: * Родительский маршрут /phpBB/Movies/Comedy/index.php является /phpBB/Movies/index.php и не /phpBB/Movies/page.php * Все страницы в подкаталоге относительно /phpBB/index.php является дочерним маршрутом /phpBB/index.php. Так /phpBB/Movies/index.php и /phpBB/Movies/page.php - все дети /phpBB/index.php и поэтому наследуют блоки, если у них нет собственных блоков. В этом случае: * Когда блок на /phpBB/index. hp будет отображаться на **Скрыть на дочерних маршрутах**, блок будет отображаться на /phpBB/index. hp (parent route), но не на дочерних маршрутах * Когда блок на /phpBB/index. hp для отображения на **Показать только на детских маршрутах**, он будет отображаться на /phpBB/Movies/index.php и /phpBB/Movies/page. hp (дочерние маршруты), но не на /phpBB/index.php (parent), ни /phpBB/Movies/Comedy/index. hp (мы выходим только на один уровень) * Когда блок на /phpBB/index. hp используется для отображения **всегда** (по умолчанию), он будет отображаться на /phpBB/index.php (parent), /phpBB/Movies/index. hp и /phpBB/page.php (дочерние маршруты), но не на /phpBB/Movies/Comedy/index.php (мы идем только на один уровень). В этом случае /phpBB/Movies/Comedy/index.php будет наследовать маршрут по умолчанию (если он существует)

## Возможное будущее состояние

Я очень заинтересован в ваших отзывах в этой области. Большинство пользователей phpBB не будут иметь реальных каталогов, как описано выше. Поэтому я задумываюсь использовать структуру, которая определена в блоке меню в качестве структуры виртуального каталога, и применить к ней это родительское/детское наследование. Я также рассматриваю возможность перехода за пределы одного уровня в глубину. Пожалуйста, дайте мне знать, будет ли это вам полезно.