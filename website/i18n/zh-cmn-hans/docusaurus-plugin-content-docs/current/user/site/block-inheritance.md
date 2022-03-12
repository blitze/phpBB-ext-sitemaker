---
title: 方块继承权
sidebar_position: 5
---

我们已经通过设置默认布局来看到， 其他没有自己的模块的页面将继承默认布局中的模块。 然而，还有另一种类型的区块继承。

## 父/子路由
在phpBB SiteMaker中，我们用真正嵌套(子)目录或几乎嵌套的路径/路线来谈论嵌套路线。 请留在我 :)。
* 真正的父母/儿童路由：例如，路径/some_directory/sub_directory/index.php是/some_directory/index.php的子节点
* 虚拟父母/儿童路由：例如，viewtopop.php 被视为视图forum.php 的下属。

以下是父母/子女路径的一些例子：

| 父级                 | 儿童                            |
| ------------------ | ----------------------------- |
| /index.php         | /viewforum.php /dir/index.php |
| /viewforum.php?f=2 | /viewtop.php?f=2&t=1          |
| /app.php/文章        | /app.php/articles/my-article  |

## 父母/子女方块继承权
对于父/子路由， 子路由继承父路由的方块(如果父路由有自己的方块)，或从默认布局(如果设置了一个方块)。 换句话说，即使有默认布局， 如果父路由有自己的路由，子路由将从父路由继承方块。 但并非所有上级路线的区块都必须继承。

## 控制方块的继承权
在一个区块级别，你可以控制一个区块可以由子路由继承。 我们早些时候在 [编辑块设置](/docs/user/blocks/managing-blocks#editing-block-settings) 中触及了这个问题。

请考虑以下真实目录结构：
```text
phpBB
├── index.php
└── Movies/
    ├── index.php
    ├── page.php
    └── Comedy/
        └── index.php
```

为了继承这些块，我们说：
* /phpBB/Movies/Comedy/index.php的父路径是/phpBB/Movies/index.php，而不是/phpBB/Movies/page.php。
* 相对于/php/phpBB/index.php的子目录中的所有页面都是一个子路径的 /phpBB/index.php。 所以/php/phpB/Movies/index.php和phpBB/Movies/page.php都是/php的子女，如果他们没有自己的区块，则将继承其区块。 在这种情况下：
    * 当一个在 /phpBB/index.php上的方块被设置为 **在子路上隐藏**时，方块将在 /phpBB/index上显示。 hp (父路由)，但不在子路上
    * 当一个在 /phpBB/index.php 上的方块被设置为 **只能在子路上显示**时，它将在 /phpBB/Movies/index上显示。 hp and /php/phpBB/Movies/page.php（儿童路由），但不是在 /phpBB/index.php（父），也不是/phpBB/Movies/Comedy/index.php（我们只能深入一层）
    * 当一个在 /phpBB/index.php 上的方块设置为始终显示 **** (默认)，它将在 /phpBB/index上显示。 hp (parent), /phpBB/Movies/index.php和 phpBB/page.php(儿童路由器)，但不在 /phpBB/Movies/Comedy/index.php(我们只能深入一层)。 在这种情况下，/phpBB/Movies/Comedy/index.php将继承默认路径(如果存在)

## 有毒的未来状态
我真的对您在这个领域的反馈很感兴趣。 大多数phpBB用户将不会有上文概述的真正目录。 所以我想使用菜单块中定义的结构作为虚拟目录结构，并将此父/子继承权应用到它。 我也正在考虑超越一层深度。 请让我知道这对你是否有用。