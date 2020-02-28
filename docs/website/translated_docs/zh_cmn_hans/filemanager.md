---
id: 文件管理器
title: 响应文件管理器
---

从 3.1.0 版本，phpBB SiteMaker 支持 [响应文件管理器](http://responsivefilemanager.com)

* 在编辑自定义块时，文件管理器被用作TinyMCE 插件(WYSIWYG 编辑器)
* 它目前被配置为每个用户创建单独的文件夹，但拥有_sm_filemanager 权限的用户除外 (可以查看/管理其他用户的文件夹)，允许他们访问/管理所有的上传文件夹。

## 安装

* 下载 [响应式文件管理器](http://responsivefilemanager.com/index.php#sthash.5UrnhjX2.dpbs)
* 提取并上传文件到您的 phpBB 根目录。 文件结构应该如下：

```text
phpBB
| - images/
- - - include /
learm - ...
└── ResponsiveFilemanager/
    └── filemanager/
        └── config/
            ├── .htaccess
            └── config.php
```

## 激活

* 转到 ACP > 扩展 > SiteMaker > 设置
* 启用文件管理器功能
* 保存更改
* 更新用户权限 (Misctab) 以确定谁可以使用此功能 [可以使用文件管理器]
* 更新管理员权限 (Misctab) 以确定谁可以管理用户文件夹 [可以在文件管理器中查看/管理其他用户文件夹]