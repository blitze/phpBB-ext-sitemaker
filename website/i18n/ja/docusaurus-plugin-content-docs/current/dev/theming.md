---
title: テーマ
sidebar_position: 3
---

テンプレートファイルとJS/CSSファイルがすべてのスタイルで動作しないことを理解しています。 以下に、独自のテンプレートを使用し、特定のスタイルに合わせてJS/CSSファイルを作成する方法を示します。

## 自分のテンプレートを使う

phpBB Sitemaker に付属するデフォルトテンプレートが、特定のスタイルでうまく動作しない場合。 スタイルフォルダに対応するファイルを作成することで、独自のテンプレートファイルを簡単に上書きすることができます。

例えば、 たとえば、あなたのスタイルが `Backlash` と呼ばれ、ブロックヘッダーセクションの HTML を [boxed view](/docs/user/blocks/block-views) 用に構造化する必要がある特定の方法があるとします。 以下のような名前のファイルを作成することで、特定のテンプレートを上書きすることができます: `phpBB/ext/blitz/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

言い換えれば、独自のテンプレートファイルを使用するには、次のようにする必要があります。
* 上書きする必要があるphpBBサイトマッカーファイルを特定します
* 同じ名前のファイルをSitemaker `styles` フォルダに作成します

> 注意: 独自のテンプレートファイルを作成する場合 拡張機能の更新時に、 `phpbb/ext/blitze/sitemaker` フォルダを削除しないようにしてください。カスタムファイルが削除されます。 むしろ、新しいファイルで既存のファイルを上書きするだけです。

## スタイルの JS/CSS ファイルを作成する

メモ:
* 以下の説明では、my-styleと呼ばれるスタイルがあると仮定します。

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

> この拡張機能は、タブ、ダイアログ、ボタンにjQuery UIを使用します。 デフォルトのjQueryテーマは「滑らかさ」です。 テーマに最適なjQuery UIの異なるテーマを使用できます。 jQuery UI テーマは、--jq_ui_themeフラグを使用して指定できます。 例:

    yarn build --theme my-style -jq_ui_theme ui-lightness
