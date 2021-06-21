---
id: サイトレイアウト
title: レイアウト
---

"レイアウト" は、使用可能なブロックの位置と表示方法を決定します。

## ブロックの位置

ブロック位置は、ブロックが存在できるサイト上の事前定義された領域です。 使用可能なブロックの位置は、使用しているテンプレートスタイルによって決まります。 For prosilver, phpBB SiteMaker comes with the following block positions: * panel: full width across the top * sidebar: left/right depending on layout below * subcontent: similar to sidebar just larger * top_hor: horizontal blocks across the top, flanking above sidebar/subcontent depending on layout * top: above main content * box: equal width, horizontal blocks below main content * bottom: below main content * bottom_hor: horizontal blocks across the bottom, flanking the sidebar/subcontent depending on layout * footer: horizontal blocks in the footer You can add more block positions in your own style templates by copying and modifying the corresponding phpBB SiteMaker templates

## サイトレイアウト

You can choose the layout for your site in ACP (Extensions > Sitemaker > Settings): * **Blog**: subcontent and sidebar next to each other, pushed to the right, top_hor/botom_hor flank subcontent * **Holy Grail**: equal width sidebar and subcontent on opposite sides, top_hor/botom_hor flank subcontent * **Portal**: sidebar on left, subcontent on the right, top_hor/botom_hor flank subcontent * **Portal Alt**: subcontent on left, sidebar on the right, top_hor/botom_hor flank sidebar * **Custom**: Manually set the width of the sidebars as px, %, em or rem. デフォルトは、各側面で 200px です。

## カスタムテンプレート/スタイル

できるだけ多くの テンプレートファイルとアセットをstyles/all/フォルダに入れて、自分のテンプレートテーマeの下に同じ名前のファイルを作成することで上書きできるようにしました。 プロシルバーだ そのため、特定のブロックの表示方法を変更したい場合や、独自のブロックの位置を使用して独自のレイアウトを作成したい場合に使用します。 オリジナルと同じ名前とパスを持つファイルを独自のスタイルで作成する必要があります

CSS/JS ファイルをカスタマイズする必要がある場合は、 [テーマ](./developer-theming.md) セクションを参照してください。