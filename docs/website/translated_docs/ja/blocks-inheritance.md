---
id: blocks-inherited from
title: ブロック継承を理解する
---

既定のレイアウトを設定することによって、既にそれを見ています。 独自のブロックを持たない他のページは、既定のレイアウトからブロックを継承します。 しかし、別のタイプのブロック継承があります。

## 親/子ルート

phpBB SiteMakerでは、ネストされたルートについて、実際のネストされた(サブ)ディレクトリ、または事実上ネストされたパス/ルートについて述べています。 私と一緒にいてください :). * 実親/子ルート: 例えば、/some_directory/sub_directory/index.phpは/some_directory/index.phpの子です。 hp * 仮想親/子ルート: 例えば、viewtopic.phpはviewforum.phpの子として扱われます。

以下に、親/子ルートの例を示します。

| 親                  | 子要素                            |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articles/my-article   |

## 親/子ブロックの継承

親/子ルートの場合 子ルートは、親ルート(親が独自のブロックを持っている場合)またはデフォルトレイアウト(設定されている場合)から親ルートのブロックを継承します。 つまり、デフォルトのレイアウトがあっても。 親ルートに独自のブロックがある場合、子ルートはその親ルートからブロックを継承します。 しかし、親ルートからのすべてのブロックが継承されるわけではありません。

## ブロック継承の制御

ブロックレベルでは、ブロックを子ルートに継承できるタイミングを制御できます。 これについては、 [ブロック設定](./blocks-managing#editing-block-settings) を編集しています。

次の実際のディレクトリ構造を考えてみましょう。

```text
phpBB
├── index.php
├── Movies/
    ├── index.php
    ├── page.php
    ├── Comedy/
        ├── index.php
```

For the purposes of inheriting blocks, we say: * The parent route of /phpBB/Movies/Comedy/index.php is /phpBB/Movies/index.php and not /phpBB/Movies/page.php * All pages in a sub directory relative to /phpBB/index.php is a child route of /phpBB/index.php. ですから、/phpBB/Movies/index.phpと/phpBB/Movies/page.phpはすべて/phpBB/index.phpの子であり、自分のブロックがない場合はブロックを継承します。 In this case: * When a block on /phpBB/index.php is set to display on **Hide on child routes**, the block will show on /phpBB/index.php (parent route) but not on its child routes * When a block on /phpBB/index.php is set to display on **Show on child routes only**, it will display on /phpBB/Movies/index.php and /phpBB/Movies/page.php (child routes) but not on /phpBB/index.php (parent), nor /phpBB/Movies/Comedy/index.php (we only go one level deep) * When a block on /phpBB/index.php is set to display **always** (default), it will display on /phpBB/index.php (parent), /phpBB/Movies/index.php and /phpBB/page.php (child routes) but not on /phpBB/Movies/Comedy/index.php (we only go one level deep). この場合、/phpBB/Movies/Comedy/index.phpはデフォルトのルート(存在する場合)から継承されます。

## Posible Future State

私はこの分野であなたのフィードバックに本当に興味があります。 ほとんどのphpBBユーザーは、上記のような実際のディレクトリを持っていません。 そこで、メニューブロックで定義されている構造を仮想ディレクトリ構造として使用し、この親/子継承を適用しようと考えています。 私はまた、1つのレベルの深さを超えることを検討しています. これが役に立つかどうか教えてください。