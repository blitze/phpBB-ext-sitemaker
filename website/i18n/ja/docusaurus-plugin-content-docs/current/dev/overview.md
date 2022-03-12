---
title: phpBBサイトメーカーを拡張
sidebar_position: 1
---

phpBB SiteMakerは、 [サービス交換](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement)、 [サービスデコレーション](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration)、および [phpBBのイベントシステム](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html)を使用して拡張/変更できます。 サポートされているイベントのリストは [](./events.md) をご覧ください。

## SiteMaker ブロックの作成

phpBB SiteMaker ブロックは、blitze\sitemaker\services\blocks\driver\block クラスを拡張し、「display」メソッドから 'title' と 'content' の配列を返す単なるクラスです。 他のすべてはあなた次第です。 phpBB SiteMakerでブロックを検出できるようにするには、「sitemaker.block」タグを指定する必要があります。

例えば、vendor/extension を my/example とする拡張子があるとします。 phpBB SiteMakerの「my_block」というブロックを作成するには:

-   "blocks" フォルダを作成
-   以下の内容のmy_block.phpファイルをblockフォルダに作成します

```php
namespace my\example\blocks;

use blitze\sitemaker\services\blocks\driver\block;

class my_block extends block
{
    /**
     * {@inheritdoc}
     */
    public function display(array $settings, $edit_mode = false)
    {
        return array(
            'title'     => 'my block title',
            'content'   => 'my block content',
        );
    }
}
```

次に、config.yml ファイルに以下を追加します。

```yml
サービス:

...

    my.example.block.my_block:
        class: my\example\blocks\my_block
        calls:
            - [set_name, [my.example.block.my_block]]
        tags:
            - { name: sitemaker.block }

....

```

最低限必要なのはそれだけです 編集モードに入ると、任意のブロック位置にドラッグ&ドロップできる「MY_EXAMPLE_BLOCK_MY_BLOCK」と表示されているブロックが表示されます。 しかし、このブロックはエキサイティングではありません。 これは設定を持たず、ブロック名を変換しません。 もっと面白くしましょう。

### ブロック設定

ブロック/my_blockを修正しましょう。 hpファイルと追加「get_config」メソッドでは、ブロック設定とそのような設定を説明する配列であるキーを持つ配列を返します。

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        return array(
            'legend1'   => 'TAB1',
            'checkbox'  => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explain' => false),
            'yes_no'    => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
            'radio'     => array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'explain' => false, 'default' => 'topic'),
            'select'    => array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', 'explain' => false),
            'multi'     => array('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'explain' => false),
            'legend2'   => 'TAB2',
            'number'    => array('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
            'textarea'  => array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),
            'togglable' => array('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options, 'default' => '', 'append' => '<div id="toggle_key-1">Only show when option 1 is selected</div>'),
        );
    }
```

これは、phpBBがACPのボード設定用の構成を構築するのと同じ方法で構成されています。 さらに多くの例 [はこちら](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php) をご覧ください。

カスタムフィールドタイプが必要な場合は、 [の例](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' の設定) を参照できます。

'legend1' と 'legend2' に注意してください: これらは設定をタブに分割するために使用されます。

### 名前を付けるブロック

ブロック名の規則は、サービス名 (e.g my.example.block) というものです。 y*block above)は、ドット(.)をアンダースコア(*)に置き換えることで言語キーとして使用されます(例:MY_EXAMPLE_BLOCK_MY_BLOCK)。

### 翻訳

また、翻訳が必要な言語キーがいくつかあります。 これを行うには、言語フォルダに「blocks_admin.php」という名前のファイルを作成します。 このファイルは、ブロックを編集するときに自動的に読み込まれます。あなたのブロックの設定とブロック名の翻訳が必要です。

```
$lang = array_merge($lang, array(
    'SOME_LANG_VAR'     => 'Option 1',
    'OTHER_LANG_VAR'    => 'Option 2',
    'SOME_LANG_VAR_1'   => 'Setting 1',
    ....
    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'マイブロック',
);
```

'blocks_admin.php' はブロックを編集するときにのみ読み込まれるので、他の翻訳を追加する必要があります(例: `$language->add_lang('my_lang_file', 'my/example'); のようにdisplayメソッドに言語ファイルを読み込んでください。`

### ブロックのレンダリング

新しいブロックは、何かをレンダリングしている場合にのみ表示されます。 ブロックは任意の文字列をコンテンツとして返すことができますが、ほとんどの場合、コンテンツをレンダリングするためのテンプレートが必要です。 テンプレートを使用してブロックをレンダリングするには、 ブロックは、テンプレートに渡すデータを保持する配列を返し、 `get_template` メソッドを以下に示すように実装する必要があります。

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        return array(
            'legend1'   => 'TAB1',
            'some_setting'  => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explain' => false),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function get_template()
    {
        return '@my_example/my_block.html';
    }

    /**
     * {@inheritdoc}
     */
    public function display(array $data, $edit_mode = false)
    {
        if ($edit_mode)
        {
            // do something only in edit mode
        }

        return array(
            'title'     => 'MY_BLOCK_TITLE',
            'data'      => array(
                'some_var'  => $data['settings']['some_setting'],
            ),
        );
    }
```

styles/all/my_block.htmlまたはstyles/prosilver/my_block.htmlファイルは次のようになります:

```
<p>選択済: {{ some_var }}</p>
```

In summary, your block must return an array with a `title` key (for the block title) and a `content` key (if the block just displays a string and does not use a template) or a `data` key (if the block uses a template, in which case, you will also need to implement the `get_template` method).

### 資産をブロック

ページにアセット(css/js)を追加する必要がある場合は、サイトメーカー [util class](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) を使用することをお勧めします。 ページ上に同じブロックのインスタンスが複数ある場合があるので、 または他のブロックが同じ資産を追加している可能性がありますutilクラスは、資産が追加されたもののみを保証します。

```php
        $this->util->add_assets(array(
            'js'    => array(
                '@my_example/assets/some.js',
                100 => '@my_example/assets/other.js',  // set priority
            ),
            'css'   => array(
                '@my_example/assets/some.css',
            )
        ));
```

The util class will, of course, need to be added to your service definitions in config.yml like so: `- '@blitze.sitemaker.util'` and defined in your block's constructor `\blitze\sitemaker\services\util $util`.

以上です 完了！
