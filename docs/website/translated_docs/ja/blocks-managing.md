---
id: ブロック管理
title: ブロックの管理
---

phpBB SiteMakerでブロックを管理するには、 [編集モード](./blocks-overview#edit-mode)にする必要があります。

> ブロックがコンテンツを表示しない場合、編集モード以外は表示されません。 これにより、(format@@0ブロックの場合)コンテンツを与えるか、設定を変更することができます。
> 
> 編集モード やや透明なブロックは、表示されないブロックですが、編集モードになっているためにのみ表示されます

## ブロックを追加中

ユーザーコントロールパネルとモデレーターコントロールパネルページを除き、フロントページにブロックを追加できます。 ブロックを追加するには、以下を行う必要があります: * Admin バーの **Blocks** をクリックします。 利用可能なブロックのリストが表示されます * 任意のブロック位置にドラッグ&ドロップします

## ブロックの編集

### ブロックアイコンを追加する

ブロックタイトルの左側には、ブロックアイコンのボックスがあります。 アイコンピッカーを取得するには、このボックスをクリックしてください。 アイコンのサイズ、色、フロート、回転などを選択できます。

### ブロックタイトルの編集

phpBB SiteMakerブロックにはデフォルトで翻訳されたタイトルがありますが、タイトルがニーズを満たしていない場合は変更できます。 ブロックのタイトルを編集する * ブロックのタイトルをクリックしてインライン編集フォームを取得する * タイトルを希望するものに変更する * フィールドからフォーカスを取り除くか、Enter キーを押して変更を送信する

> 変更されたブロックのタイトルは翻訳されていません
> 
> デフォルトのタイトルに戻すには、単純にタイトルを削除してEnterキーを押します。

### ブロック設定の編集

ブロックにカーソルを合わせると、コグアイコンがブロックの右側に表示され、ブロックを編集できます。 - ブロックを有効/無効にする [Status] - ブロックを表示/非表示にするタイミングを選択する [Display]. This only applies in cases where you have nested pages (see [Understanding Block Inheritance](./blocks-inheritance.md)): - **Always**: Always display the block - **Hide on child routes**: Only show this block on the parent route - **Show on child routes only**: Only show this block on a child route - Choose which groups of users can view the block [Viewable by]. 複数のグループを選択するには、Ctrl + クリックを使用します。 - ブロックまたはアイテム（リスト、画像、背景）の外観を変更するカスタムクラスを設定します etc) ブロック内の [CSS クラス] - ブロックタイトルを表示・非表示にします。 - ブロックビュー を選択します。 ACPに新しいブロックが追加されると、デフォルトのブロックビューを選択できます。 - **Default / Simple**: uses the prosilver panel class to wrap the block in a padded container - **Basic**: block does not have any container wrapping it - **Boxed**: uses the prosilver forabg class to wrap the block in a box - Set / Update block specific settings - If you have the same block with same settings across multiple pages, you can update all of them at once by checking the **Update blocks with similar settings**

## ブロックを削除中

- 削除したいブロックにカーソルを合わせます
- **x** アイコンをクリックし、ブロックを削除することを確認します
- 管理者バーに移動し、 `変更を保存` をクリックします