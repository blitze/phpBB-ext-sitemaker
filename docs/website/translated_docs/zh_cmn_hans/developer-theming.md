---
id: 开发者主题
title: 主题
---

phpBB SiteMaker提供了prosilver的样式和颜色。 您可以通过在您的样式文件夹中创建相应的文件来覆盖 CSS、JS 和 HTML 文件。

# 为您的样式创建 JS/CSS 文件

注意： * 为了以下说明的目的，我们将假定你有一个样式叫我的风格。

克隆到 phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

从命令行到 sitemaker 目录：

    cd phpBB/ext/blitze/sitemaker
    

**安装供应商**

    编辑器安装
    

**安装软件包**

对于下面的命令，你可以使用 npm 或 [yarn](https://yarnpkg.com)

    yarn 安装
    

**观看更改**

    yarn 启动 --theme my-style
    

**进行更改**

* 更改 phpBB/ext/blitze/sitemaker/development 文件夹。
* 查看 phpBB/ext/blitze/sitemaker/development/_partials/_globals.scss 了解 sass 变量

**构建资产**

    yarn 构建 --theme my-style
    

**部署**

您现在可以复制 phpBB/ext/blitze/sitemaker/style/my 风格生成的文件，并上传到您的生产服务器。

> 此扩展使用 jQuery UI 用于标签、对话框和按键。 默认的 jQuery 主题是“平滑”。 你可以使用最适合你的主题的不同的 jQuery UI 主题。 您可以使用国旗 --jq_ui_theme 指定 jQuery UI 主题。 例如：

    yarn 构建 --theme my-style --jq_ui_theme ui-light