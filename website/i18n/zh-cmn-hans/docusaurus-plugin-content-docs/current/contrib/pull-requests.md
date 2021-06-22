---
title: 提交拉取请求
sidebar_label: 拉取请求
---

`拉取请求让你告诉他人你已经推送到 GitHub 版本库中的分支的变更。 打开拉取请求后， 您可以与合作者讨论和审查潜在的更改，并在您的更改合并到基础分支之前添加后续提交。` [阅读更多](https://help.github.com/articles/about-pull-requests/)

## 叉/正在处理

* 如果您还没有一个 github 帐户，请创建一个
* 访问 https://github.com/blitze/phpBB-ext-sitemaker.git 并点击“Fork”

克隆你的仓库派生：

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

从命令行转到站点制作目录：

    cd phpBB/ext/blitze/sitemaker

**配置g：**

将您的用户名添加到 Git 上的系统：

    git config --global user.name "你的名字在这里"

将您的电子邮件地址添加到 Git 上的系统：

    git config --add user.email username@phpbb.com

添加上游远程(您可以将'上游'更改为您喜欢的东西)：

    git 远程添加上行 git://github.com/blitze/phpBB-ext-sitemaker.git

**安装供应商**

    作曲家安装

**安装 NPM软件包**

    npm install

或者，您可以使用 [yarn](https://yarnpkg.com):

    yarn 安装

## 拉取请求

    # 为您的功能创建一个新的分支 & 切换到它
    git checkout -b feature/my-fancy-new-feature
    
    # 为您正在处理的问题创建一个新分支* 切换到它(工单#来自github Tracker)
    git 签出-b ticket/1234

进行更改

    # 分阶段文件
    git 添加 <files> 
    
    # 提交了文件-请使用正确的提交信息
    git 提交-m "我的提交信息"

将分支推回到GitHub git 推送源功能/my-fancy-new-feature

提交一个 [拉取请求](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
