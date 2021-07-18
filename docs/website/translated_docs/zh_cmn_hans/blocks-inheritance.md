---
id: 区块继承
title: 理解方块继承
---

我们已经看到，通过设置默认布局，没有自己模块的其他页面将从默认布局继承区块。 然而，还有另一种块继承方式。

## 父/子路由

在 phpBB SiteMaker 中，我们从真正嵌套的 (子目录) 或者几乎嵌套的路径/路线的角度讲嵌套路线。 请跟我保持 :)。 * 真实的父/子路径：例如，路径 /some_directory/sub_directory/index.php 是 /some_directory/index.php 的子路径： * Virtual 父/子路径：例如， viewtopic.php 被视为视野论坛的子路径.php。

下面是父子路径的一些例子：

| 父级                 | 儿童                             |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articles/my-article   |

## 父级/子模块继承

对于父路径/子路径，子路径继承父路径的方块(如果父方块有自己的方块)或者从默认布局(如果已经设置)。 换句话说，即使有默认布局，如果父路径有自己的模块，子路由也会继承父路径中的区块。 但是，并非所有来自父路径的方块都必须继承。

## 控制方块继承

在区块一级，你可以控制一个块可以由子路径继承。 我们早些时候在 [编辑块设置中触动了](./blocks-managing#editing-block-settings)。

考虑以下真实目录结构：

```text
phpBB
├── index.php
└── Movies/
    ├── index.php
    ├── page.php
    └── Comedy/
        └── index.php
```

为继承方块，我们要说： * /phpBB/Movies/Comedy/index.php的父路径是/phpBB/Movies/index。 hp 而不是 /phpB/Movies/page.php * 子目录中相对于/phpBB/index.php的所有页面都是一个子路径的 /phpBB/index.php。 所以 /phpBB/Movies/index.php 和 /phpBB/Movies/page.php 都是 /phpBB/index.php 的儿童，因此如果他们没有自己的区块，他们将继承其区块。 在这种情况下： * 当块在 /phpBB/index. hp 设置为 **在子路上隐藏**, 该方块将在 /phpBB/index中显示。 hp (父路由)，但不在子路上 * 当块在 /phpBB/index时. hp 被设置为显示在 **只显示在子路上**, 它将显示在 /php/BB/Movies/index.php和 /phpBB/Movies/page. hp (子路由)，但不在 /phpBB/index.php(父) 上，也不在 phpB/Movies/Comedy/index。 hp (我们只深入一层) * 当一个块在 /phpBB/index时。 hp 设置为始终显示 **** (默认)，它将在 /phpBB/index.php(父)、/phpBB/Movies/index上显示。 hp 和 /php/page.php(儿童路由器)，但不在 /phpBB/Movies/Comedy/index.php(我们只能深入一层)。 在这种情况下/phpBB/Movies/Comedy/index.php将从默认路径继承(如果存在的话)

## 可爱的未来状态

我对你在这方面的反馈真正感兴趣。 大多数phpBB用户不会有上面概述的真实目录。 因此，我想使用菜单项中定义的结构作为一个虚拟目录结构，并将这种父子继承权应用于该目录。 我还在考虑超越一个层次。 请让我知道，这对你是有益的。