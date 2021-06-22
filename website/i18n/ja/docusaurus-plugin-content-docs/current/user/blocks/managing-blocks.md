---
title: ブロックの管理
sidebar_position: 3
---

phpBB SiteMakerでブロックを管理するには、 [編集モード](./overview#edit-mode)にする必要があります。

> ブロックがコンテンツを表示しない場合、編集モード以外は表示されません。 これにより、(format@@0ブロックの場合)コンテンツを与えるか、設定を変更することができます。

> 編集モード やや透明なブロックは、表示されないブロックですが、編集モードになっているためにのみ表示されます

## ブロックを追加中
ユーザーコントロールパネルとモデレーターコントロールパネルページを除き、フロントページにブロックを追加できます。 ブロックを追加するには、次のようにします。
* 管理者バーの **ブロック** をクリックします。 利用可能なブロックの一覧が表示されます
* 任意のブロック位置にドラッグ&ドロップします

## ブロックの編集
### ブロックアイコンを追加する
ブロックタイトルの左側には、ブロックアイコンのボックスがあります。 アイコンピッカーを取得するには、このボックスをクリックしてください。 アイコンのサイズ、色、フロート、回転などを選択できます。

### ブロックタイトルの編集
phpBB SiteMakerブロックにはデフォルトで翻訳されたタイトルがありますが、タイトルがニーズを満たしていない場合は変更できます。 ブロックのタイトルを編集する
* ブロックのタイトルをクリックしてインライン編集フォームを取得します
* タイトルを好きなものに変更する
* フィールドからフォーカスを削除するか、Enterキーを押して変更を送信します

> 変更されたブロックのタイトルは翻訳されていません

> デフォルトのタイトルに戻すには、単純にタイトルを削除してEnterキーを押します。

### ブロック設定の編集
ブロックにカーソルを合わせると、コグアイコンがブロックの右側に表示され、ブロックを編集できます。 format@@0 ダイアログで、次のことができます:
- ブロックを有効/無効にする [Status]
- ブロックを表示すべき/非表示にするタイミングを選択します [Display]。 これは、ネストされたページがある場合にのみ適用されます( [ブロック継承についての理解](/docs/user/site/block-inheritance) を参照してください):
    - **Always**: 常にブロックを表示
    - **子ルートで隠す**: 親ルートでこのブロックのみ表示
    - **子ルートのみに表示**: 子ルート上にこのブロックのみ表示
- format@@0ブロックを表示できるグループを選択します。 複数のグループを選択するには、Ctrl + クリックを使用します。
- カスタムクラスを設定して、ブロック内のブロックまたはアイテム（リスト、画像、背景など）の外観を変更します [CSS クラス]
- ブロックタイトルを表示/非表示 format@@0
- ブロックビューformat@@0を選択します。 ACPに新しいブロックが追加されると、デフォルトのブロックビューを選択できます。
    - **デフォルト / Simple**: プロシルバーパネルクラスを使用して、ブロックをパッド入り容器にラップする
    - **Basic**: ブロックにはコンテナがありません。
    - **Boxed**: prosilver forabg クラスを使用してブロックをボックスにラップする
- ブロック固有の設定の設定 / 更新
- 同じブロックが複数のページで同じ設定をしている場合。 **同様の設定で**ブロックを更新することで、すべてを一度に更新できます。

## ブロックを削除中
- 削除したいブロックにカーソルを合わせます
- **x** アイコンをクリックし、ブロックを削除することを確認します
- 管理者バーに移動し、 `変更を保存` をクリックします