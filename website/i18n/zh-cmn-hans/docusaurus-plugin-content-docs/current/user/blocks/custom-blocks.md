---
title: 自定义块
sidebar_position: 4
---

如果可用的方块不能给予您所需的自由。 有 `个自定义块` 允许您自由使用BBcode 或 HTML显示自己的内容。 方块有一个WYSIWYG 编辑器 (TinyMCE) 和脚本管理器：

## 编辑器

-   您可以使用编辑器创建 HTML 内容
-   如果你需要通过点击编辑器中的 `源代码` 图标(`<>`)，你可以编辑源代码。
-   编辑器允许您上传和修改图像
    -   它在 phpBB/images/sitemaker_uploads/中为每个用户创建一个新文件夹
    -   您可以查看/管理所有用户文件夹
-   编辑器过滤任何可能危险的脚本，如javascript等。 如果您需要添加像谷歌广告这样的内容，javascript将被过滤出来，但您可以通过以下方式来做到这一点：
    -   添加自定义方块到所需位置
    -   编辑自定义方块，点击 `HTML` 标签页并粘贴您的 Javascript

## 脚本管理器

自定义方块还允许您将自定义的 CSS 和 Javascript 文件添加到您的页面。 要这样做：

-   将 `个自定义块` 添加到任何方块位置。 位置不重要，除非您也在该方块中显示内容
-   编辑区块， 点击 `脚本` 标签，添加您的 CSS 或 Javascript 文件 > 警告词：添加到您页面上的许多脚本可能会影响加载时间