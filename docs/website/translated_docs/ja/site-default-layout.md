---
id: site-default-layout
title: デフォルトレイアウトの設定
---

ブロックを追加すると、その特定のページに追加されます。 従って、あなたの場所のすべてのページのためのブロックをセットすることは退屈な仕事である。 特定のページに必要なすべてのブロックを設定し、そのページをデフォルトのレイアウトとして設定できます。 つまり、独自のブロックを持たないページは、このページからブロックを継承します。

デフォルトのレイアウトを設定するには * デフォルトのレイアウトとして設定したいページに移動します。 * 管理バーの `設定` をクリックします。 * `既定のレイアウトに設定する` ボタンをクリックします。

たとえば、サイドバーと最上位の位置にブロックを含むページ(phpBB/index.php)にブロックを追加し、デフォルトのレイアウトとして設定します。 他のページには以下のような効果があります: * ブロックがないページ。 は、デフォルトレイアウトからブロックを継承します。 例外については、 [ブロック継承の理解](./blocks-inheritance.md) を参照してください。 * デフォルトのレイアウト（インデックス）からブロックを継承することができます。 hp) しかし、一部のブロック位置にブロックを表示しないように選択するか、まったくブロックを表示しません。 To do this, * Go to the page that you don't want all/some blocks to display * Click on `Settings` in the admin bar * Select `Do not show blocks on this page` if you don't want to inherit/display any blocks on this page OR * Use CTRL + click to select the block positions (on the right) that you do not want to display blocks on * In `edit mode`, a page that inherits blocks from the default layout, will not show any blocks, giving you the opportunity to add blocks to the page if you want to * Any page that has its own blocks will not inherit from the default layout