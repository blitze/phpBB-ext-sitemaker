---
title: 扩展 phpBB 站点插件
sidebar_position: 1
---

您可以使用 [服务替换](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement)。 [服务装饰](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration)和 [phpBB 的事件系统](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html) 来延长/修改 phpBB SiteMaker。 You can find a list of supported events [here](./events.md).

## 创建站点Maker块

一个 phpBB 站点Maker 块只是一个可以扩展闪烁\sitemaker\services\blocks\driver\blockclass 并返回一个 "显示" 方法中的 "title" 和 "content" 的数组。 所有其他东西都取决于你。 要让你的 phpBB 站点Maker 发现你的方块，你需要给予它"sitemaker.block" 标签。

说我们可以用供应商/扩展作为我的例子。 为 phpBB 站点决策者创建一个名为 "my_block" 的块：

-   创建"块"文件夹
-   在方块文件夹中创建带有以下内容的 my_block.php文件

```php
命名空间我\示例\blocks；

使用blitze\sitemaker\services\blocks\driver\block;

class my_blockexts block

    /**
     * {@inheritdoc}
     */
    公共函数显示(array $settings, $edit_mode = false)
    *
        return array(
            'title' => '我的块标题',
            'content' => '我的块内容',
        ;
    }
}
```

然后在您的 config.yml 文件中添加以下内容：

```yml
服务:

...

    my.example.block.my_block:
        class: my\example\blocks\my_block
        calls:
            - [set_name, [my.example.block.my_block]]
        标签:
            - { name: sitemaker.block }

    ......

```

最起码，这是你所需要的。 如果您进入编辑模式，您应该看到列表中的方块“MY_EXAMPER_BLOCK_MY_BLOCK”可以拖放到任何方块位置上。 但这个块没有任何诱惑力。 它没有设置，不会翻译方块名称。 让我们让它更加有趣。

### 方块设置

让我们修改我们的块/my_block。 hp 文件并添加一个“get_config”方法返回一个数组，键是方块设置，值是一个描述类似设置的数组：

```php
    /**
     * @heritdoc
     */
    public function get_config(array $settings)
    *
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        返回 数组(
            'legend1' => 'TAB1',
            '复选框' => 数组('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'exerin' => false),
            'yes_no' => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explanin' => false, 'default' => false),
            'radio' => array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options'explorin' => false, 'default' => 'topic'),
            '选择' => 数组('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => ', 'explorin' => false),
            'multi' => array('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'exerin' => false),
            '传说2' => 'TAB2',
            'number' => array('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'exerin' => false, '默认' => 5，
            'textarea' => array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'exerin' => true 'default' => '),
            'togglable' => 数组('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options, '默认' => ', 'append' => '<div id="toggle_key-1">仅在选择选项1 时显示</div>'),
        ;
}
```

这与phpBB构建ACP棋盘设置的配置相同。 You can see more examples [here](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

If you want a custom field type, you can see an example [here](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' setting).

注意“legend1”和“legend2”：用来将设置分隔成标签。

### 命名块

区块名称的惯例是服务名称(eg my.example.block)。 y*以上方块将被用作语言键，将点(.) 替换为下划线 (*) (e.g.g MY_EXAMPER_BLOCK_MY_BLOCK)。

### 翻译

还注意到我们有几个需要翻译的语言键。 要做到这一点，请在您的语言文件夹中创建一个名为“blocks_admin.php”的文件。 此文件将在编辑块时自动加载，并且应该有你的块设置和块名的翻译。

```
$lang = array_merge($lang, 数组(
    'SOME_LANG_VAR' => '选项1',
    'OTHER_LANG_VAR' => '选项2',
    'SOME_LANG_VAR_1' => '设置1'，
    ......
    'MY_EXAMPEL_BLOCK_MY_BLOCK' => '我的方块',
);
```

因为“blocks_admin.php”只在编辑模块时加载，您需要添加其他翻译 (例如) 通过在您的显示方法中加载语言文件来阻止标题，所以 `$language->add_lang('my_lang_file', 'my/example');`

### 渲染块

新方块只会在呈现某些东西时显示。 您的方块可以返回任何字符串，但在大多数情况下，您需要一个模板来渲染您的内容。 使用模板渲染您的块， 方块必须返回一个拥有您想要传递到模板的数据的数组，并且还必须实现下面展示的 `get_template` 方法：

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

然后您的样式/all/my_block.html或样式/prosilver/my_block.html文件看起来像这样：

```
<p>您选择了: {{ some_var }}</p>
```

概括而言， 您的方块必须返回一个包含 `标题` 密钥(对于方块标题) 和 `内容` 密钥(如果方块只显示字符串而不使用模板) 或 `数据` 键(如果方块使用模板) 在这种情况下，您还需要实现 `get_template` 方法)。

### 屏蔽资产

如果您的方块需要将素材 (css/js) 添加到页面中，我建议使用站点制造商 [util class](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) 类。 因为页面上可能有一个以上的同一个块的实例， 或其他模块可能添加相同的资产。升级类可以确保该资产只是添加的。

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/some). s',
                100 => '@my_example/assets/other s', // 设置优先级
            ),
            'css' => 数组(
                '@my_example/assets/some. ss',
            )
);
```

当然，需要将 util 类添加到您在 config.yml 中的服务定义中： `- '@blicze.sitemaker。 直到` 并在你的方块的构造函数 `\blitze\sitemaker\services\util $util` 中定义.

就是这样。 我们已完成！
