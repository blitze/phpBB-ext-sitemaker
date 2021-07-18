---
id: 模块管理
title: 管理块
---

要管理 phpBB SiteMaker 中的方块，您必须是 [编辑模式](./blocks-overview#edit-mode)。

> 当块不显示任何内容时，它将不会显示，除非是在编辑模式。 这样，您可以赋予它的内容 (对于自定义块) 或更改其设置。
> 
> 在编辑模式中，有些透明方块将不会显示，而只是因为我们处于编辑模式时才显示

## 添加模块

您可以将模块添加到任何正面页面，但用户控制面板和版主控制面板页面除外。 要添加一个块，您需要： * 点击 **区块** 在管理栏内。 这将显示可用区块列表 * 拖拽想要的区块到任何区域位置

## 编辑模块

### 添加块图标

对于块标题 (prosilver) 的左侧，有一个方块图标。 点击此框以获取图标选择器。 您可以选择图标大小、颜色、浮点、旋转等。

### 编辑块标题

phpBB SiteMaker块将会有默认，已翻译的标题，但如果标题不符合您的需要，您可以更改它。 若要编辑块标题， * 点击块标题以获得内联编辑表单 * 将标题更改为你想要的 * 从字段中删除焦点，或者点击以提交更改

> 您的修改块标题未翻译
> 
> 要恢复到默认标题，请简单删除标题并点击进入

### 编辑块设置

当您在方块上悬停时，焦炭图标将显示在可用于编辑块的区块右侧。 在编辑块对话框中，你可以： - 启用/禁用块 [Status] - 选择模块应该/不应显示 [Display]。 这仅适用于您有嵌套页面的情况(见 [Understanding Block Inheritance](./blocks-inheritance.md)): - **始终**: 总是显示方块 - **隐藏在子路由上级路上**: 仅在上级路上显示此方块 - **仅在子路由上显示**: 仅在子路由上显示此方块 - 选择哪些用户组可以查看方块[可查看]。 使用 CTRL + 点击选择多个组。 - 设置自定义类别来修改块或项目 (列表、图像、背景等) 在块 [CSS 类] 中的外观 - 显示/隐藏方块标题 [隐藏方块标题？] - 选择方块视图 [方块视图]。 当添加新的区块时，您可以选择一个默认的区块视图。 - **Default / Simple**: uses the prosilver panel class to wrap the block in a padded container - **Basic**: block does not have any container wrapping it - **Boxed**: uses the prosilver forabg class to wrap the block in a box - Set / Update block specific settings - If you have the same block with same settings across multiple pages, you can update all of them at once by checking the **Update blocks with similar settings**

## 删除块

- 悬停你想要删除的方块
- 点击 **x** 图标并确认您想要删除区块
- 转到管理栏并点击 `保存更改`