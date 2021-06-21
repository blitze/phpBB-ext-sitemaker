---
id: contribution-pull 请求
title: 提交拉取请求
sidebar_label: 拉取请求
---

`Pull 请求让您告诉其他人您推送到 GitHub 仓库中的分支。 一旦启动拉取请求，您可以与合作者讨论和审查可能的变化，并在您的更改合并为基础分支之前添加后续提交。` [阅读更多](https://help.github.com/articles/about-pull-requests/)

## 禁止/克隆

* 如果您没有 github 账户，请创建
* 转到 https://github.com/blitze/phpBB-ext-sitemaker.git 并点击“Fork”

克隆仓库的叉：

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

从命令行到 sitemaker 目录：

    cd phpBB/ext/blitze/sitemaker
    

**配置git：**

在您的系统上添加您的用户名到 Git：

    git config --global user.name "Your Name Here"
    

在您的系统上添加您的电子邮件地址到 Git：

    git config --add user.email username@phpbb.com
    

添加上游远程 (你可以将'上游'更改为你喜欢的任何内容):

    git 远程添加上游 git://github.com/blitze/phpBB-ext-sitemaker.git
    

**安装供应商**

    编辑器安装
    

**安装 NPM 软件包**

    npm 安装
    

或者你可以使用 [yarn](https://yarnpkg.com)：

    yarn 安装
    

## 拉取请求

    # 为您的功能创建一个新的分支 & 切换到它
    git checkout -b feature/my-fancy-new-feature
    
    # 为您正在处理的问题创建一个新分支* 切换到它(工单#来自github Tracker)
    git 签出-b ticket/1234
    

更改

    # 阶段文件
    git 添加 <files> 
    
    # 提交分阶段文件 - 请使用正确的提交信息
    git committee -m "my 提交消息"
    

将分支推送到 GitHub git 推送源功能/my-fancy-new 功能

提交 [拉取请求](https://github.com/blitze/phpBB-ext-sitemaker/pulls)