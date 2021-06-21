---
id: 模块自定义
title: 自定义块
---

如果可用的方块不能给予您所需的自由。 有 `个自定义块` 允许您自由使用BBcode 或 HTML显示自己的内容。 The block comes with a WYSIWYG editor (TinyMCE) and a scripts manager:

## 编辑器

- 您可以使用编辑器创建 HTML 内容
- 如果你需要通过点击编辑器中的 `源代码` 图标(`<>`)，你可以编辑源代码。
- The editor allows you to upload and modify images 
    - It creates a new folder in phpBB/images/sitemaker_uploads/ for every user who has access to it
    - You can view/manage all user folders
- 编辑器过滤任何潜在的危险脚本，例如 javascript 等。 如果您需要添加像Google广告这样的内容，Javascript将被过滤，但你可以通过以下方式绕过这一点： 
    - 添加自定义块
    - 编辑自定义方块，点击 `HTML` 标签页并粘贴您的 Javascript

## The Scripts Manager

The Custom Block also allows you to add custom CSS and Javascript files to your page. To do this:

- Add a `Custom Block` to any block position. The position does not matter unless you are also displaying content with the block
- Edit the block, click on the `Scripts` tab and add your CSS or Javascript files > Word of caution though: Adding to many scripts on your page can affect load times