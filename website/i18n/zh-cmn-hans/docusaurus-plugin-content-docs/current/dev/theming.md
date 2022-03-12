---
title: 主题
sidebar_position: 3
---

我们理解模板文件和 JS/CSS 文件对每个样式都不起作用。 以下是您可以使用自己的模板并为您的特定样式创建 JS/CSS 文件的方式。

## 使用您自己的模板

如果使用 phpBB 站点制作器的默认模板不适合您的特定风格， 您可以通过在样式文件夹中创建相应的文件，轻松地覆盖它来使用您自己的模板文件。

例如， 说您的样式叫做 `反向` 并且它有一种特殊的方式，用于块标题部分的 HTML 需要根据 [盒式视图](/docs/user/blocks/block-views) 来构造。 您可以通过创建相同名称的文件覆盖特定模板： `phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig`。

换言之，要使用您自己的模板文件，您需要：
* 识别需要覆盖的phpBB 站点文件
* 在网站 `样式名称` 文件夹中用相同名称创建一个文件

> 注意：如果您创建了自己的模板文件， 更新扩展时不会删除 `phpbb/ext/blitze/sitemaker` 文件夹，因为您的自定义文件将被删除。 相反，只要用新的文件覆盖现有的文件。

## 为您的样式创建 JS/CSS 文件

注：
* 为了下面的说明，我们将假设你有一种风格，称为我样式。

克隆到 phpBB/ext/blitze/sitemaker：

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

从命令行转到站点制作目录：

    cd phpBB/ext/blitze/sitemaker

**安装供应商**

    作曲家安装

**安装软件包**

对于下面的命令，您可以使用 npm 或 [yarn](https://yarnpkg.com)

    yarn 安装

**监视更改**

    yarn 开始 --theme my-style

**进行更改**

* 在 phpBB/ext/blitze/sitemaker/development文件夹中更改文件。
* 查看 phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss

**构建资源**

    yarn build--theme my-style

**部署**

您现在可以复制从 phpBB/ext/blitze/sitemaker/styles/my-style 生成的文件并上传到您的生产服务器。

> 此扩展使用 jQuery 界面作为标签、对话框和按钮。 默认的 jQuery 主题是“顺畅的”。 您可以使用不同的 jQuery 界面主题，最适合您的主题。 您可以使用标志 --jq_ui_theme来指定 jQuery UI 主题。 例如：

    yarn building --theme my-style --jq_ui_theme ui-lightness
