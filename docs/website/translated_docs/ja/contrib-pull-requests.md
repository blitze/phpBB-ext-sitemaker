---
id: contrib-pull-requests
title: プルリクエストを送信中
sidebar_label: 取得リクエスト
---

`プルリクエストを使用すると、GitHub 上のリポジトリのブランチにプッシュした変更を他の人に知らせることができます。 プルリクエストが開かれると、 コラボレーターとの潜在的な変化について議論したり確認したりできますし、変更がベースブランチにマージされる前にフォローアップコミットを追加できます。` [続きを読む](https://help.github.com/articles/about-pull-requests/)

## フォーク/複製

* Github アカウントをまだお持ちでない場合は作成してください
* https://github.com/blitze/phpBB-ext-sitemaker.git に移動し、"Fork" をクリックしてください。

リポジトリのフォークをクローン:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

コマンドラインから sitemaker ディレクトリに移動します:

    cd phpBB/ext/blitze/sitemaker
    

**gitを設定:**

システムの Git にユーザー名を追加します。

    git config --global user.name "Your Name Here"
    

システムの Git にメールアドレスを追加します。

    git config --add user.email username@phpbb.com
    

上流のリモートを追加します（「upstream」を好きなように変更できます）：

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git
    

**ベンダのインストール**

    composer install
    

**NPMパッケージのインストール**

    npm install
    

あるいは、 [yarn](https://yarnpkg.com) を使用することもできます。

    yarn install
    

## 取得リクエスト

    # あなたの機能 & に切り替えるための新しいブランチを作成します。
    git checkout -b feature/my-fancy-new-feature
    
    # あなたが取り組んでいる課題の新しいブランチを作成します（チケット # github trackerからのものです）。
    git checkout -b ticket/1234
    

変更を加えてください

    # Stage the files
    git add <files> 
    
    # Commit steded files - Please use a correct commit message
    git commit -m "my commit message"
    

ブランチをGitHub に押し戻します git push origin feature/my-fancy-new-feature

[プルリクエスト](https://github.com/blitze/phpBB-ext-sitemaker/pulls)を送信