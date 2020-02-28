---
id: 网站默认布局
title: 设置默认布局
---

当您添加一个模块时，它被添加到该特定页面。 因此，为你的网站上的所有页面设置区块是一项繁重的任务。 您可以为特定页面设置所有需要的模块，然后将该页面设置为默认布局。 换言之，任何没有自己区块的页面都将继承本页面中的区块。

要设置默认布局 * 转到您想要设置为默认布局的页面 * 点击 `设置` 管理栏 * 点击 `设置为默认布局` 按钮

比如说，我们将模块添加到页面 (phpBB/index.php)，在侧边栏和顶部位置，并将其设置为我们的默认布局。 这对其他页面具有以下效果： * 任何没有自己区块的页面，都会继承默认布局中的区块。 查看 [理解方块继承](./blocks-inheritance.md) 例外。 * 您仍然可以继承默认布局 (index.php) 中的区块，但选择不在某些方块位置上显示方块，或者根本不显示任何方块。 To do this, * Go to the page that you don't want all/some blocks to display * Click on `Settings` in the admin bar * Select `Do not show blocks on this page` if you don't want to inherit/display any blocks on this page OR * Use CTRL + click to select the block positions (on the right) that you do not want to display blocks on * In `edit mode`, a page that inherits blocks from the default layout, will not show any blocks, giving you the opportunity to add blocks to the page if you want to * Any page that has its own blocks will not inherit from the default layout