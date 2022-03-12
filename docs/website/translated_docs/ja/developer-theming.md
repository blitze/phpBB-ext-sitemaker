---
id: 開発者のテーマ
title: テーマ
---

phpBB SiteMakerはプロシルバー用に作られたスタイルと色が付属しています。 スタイルフォルダに対応するファイルを作成することで、CSS、JS、およびHTMLファイルを上書きできます。

# スタイルの JS/CSS ファイルを作成する

注: * 以下の手順では、my-styleと呼ばれるスタイルがあると仮定します。

phpBB/ext/blitze/sitemakerにクローン:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

コマンドラインから sitemaker ディレクトリに移動します:

    cd phpBB/ext/blitze/sitemaker
    

**ベンダのインストール**

    composer install
    

**パッケージのインストール**

以下のコマンドでは、npm または [yarn](https://yarnpkg.com) を使用できます。

    yarn install
    

**ウォッチの変更**

    yarn start --theme my-style
    

**変更する**

* phpBB/ext/blitze/sitemaker/developmentフォルダ内のファイルに変更を加えます。
* sass 変数の phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss を参照してください。

**資産を構築**

    yarn build --theme my-style
    

**デプロイ**

phpBB/ext/blitze/sitemaker/styles/my-styleから生成されたファイルをコピーして、本番サーバーにアップロードできるようになりました。

> この拡張機能は、タブ、ダイアログ、ボタンにjQuery UIを使用します。 デフォルトのjQueryテーマは「滑らかさ」です。テーマに最適な別のjQuery UIテーマを使用できます。 jQuery UI テーマは、--jq_ui_themeフラグを使用して指定できます。 例:

    yarn build --theme my-style -jq_ui_theme ui-lightness