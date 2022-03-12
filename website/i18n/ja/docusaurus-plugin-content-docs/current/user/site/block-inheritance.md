---
title: ブロックの継承
sidebar_position: 5
---

既定のレイアウトを設定することによって、既にそれを見ています。 独自のブロックを持たない他のページは、既定のレイアウトからブロックを継承します。 しかし、別のタイプのブロック継承があります。

## 親/子ルート
phpBB SiteMakerでは、ネストされたルートについて、実際のネストされた(サブ)ディレクトリ、または事実上ネストされたパス/ルートについて述べています。 私と一緒にいてください :).
* Real Parent/Child routes: 例えば、/some_directory/sub_directory/index.phpパスは/some_directory/index.phpの子です。
* 仮想親/子ルート: たとえば、viewtopic.phpはviewforum.phpの子として扱われます。

以下に、親/子ルートの例を示します。

| 親                  | 子要素                            |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articles/my-article   |

## 親/子ブロックの継承
親/子ルートの場合 子ルートは、親ルート(親が独自のブロックを持っている場合)またはデフォルトレイアウト(設定されている場合)から親ルートのブロックを継承します。 つまり、デフォルトのレイアウトがあっても。 親ルートに独自のブロックがある場合、子ルートはその親ルートからブロックを継承します。 しかし、親ルートからのすべてのブロックが継承されるわけではありません。

## ブロック継承の制御
ブロックレベルでは、ブロックを子ルートに継承できるタイミングを制御できます。 これについては、 [ブロック設定](/docs/user/blocks/managing-blocks#editing-block-settings) を編集しています。

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

ブロックを継承するために、次のように言います。
* /phpBB/Movies/Comedy/index.phpの親ルートは/phpBB/Movies/index.phpで、/phpBB/Movies/page.phpではありません。
* /phpBB/index.phpに対するサブディレクトリ内のすべてのページは、/phpBB/index.phpの子ルートです。 ですから、/phpBB/Movies/index.phpと/phpBB/Movies/page.phpはすべて/phpBB/index.phpの子であり、自分のブロックがない場合はブロックを継承します。 この場合:
    * /phpBB/index.phpのブロックを **子ルートで非表示**に設定すると、/phpBB/indexにブロックが表示されます。 HP(親ルート)ではありませんが、その子ルートではありません
    * /phpBB/index.phpのブロックを **子ルートのみで表示**に設定すると、/phpBB/Movies/indexに表示されます。 hpと/phpBB/Movies/page.php（子ルート）ではなく/phpBB/index.php（親ルート）でも/phpBB/Movies/Comedy/index.php（私たちは1つのレベルだけ深く行く）
    * /phpBB/index.phpのブロックを **always** (デフォルト)に設定すると、/phpBB/indexに表示されます。 hp (親), /phpBB/Movies/index.php, /phpBB/page.php (子ルート) ではありませんが、 /phpBB/Movies/Comedy/index.php (私たちは 1 つのレベルを深く行く). この場合、/phpBB/Movies/Comedy/index.phpはデフォルトのルート(存在する場合)から継承されます。

## Posible Future State
私はこの分野であなたのフィードバックに本当に興味があります。 ほとんどのphpBBユーザーは、上記のような実際のディレクトリを持っていません。 そこで、メニューブロックで定義されている構造を仮想ディレクトリ構造として使用し、この親/子継承を適用しようと考えています。 私はまた、1つのレベルの深さを超えることを検討しています. これが役に立つかどうか教えてください。