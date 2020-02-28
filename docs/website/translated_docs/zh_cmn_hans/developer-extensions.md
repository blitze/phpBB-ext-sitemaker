---
id: 开发者扩展
title: 扩展 phpBB 站点Maker
---

你可以使用 [服务替换](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [服务装饰](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), 和 [phpBB 事件系统](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html)。 你可以在这里找到支持的事件列表 [](./developer-events.md)。

## 创建一个 SiteMaker 模块

一个 phpBB SiteMaker 模块只是一个扩展 blitze\sitemaker\services\blocks\驱动程序\block 分类，并返回“显示”方法中的“title”和“content”的数组。 所有其他收件人都是您自己的。 要使你的块可以通过 phpBB SiteMaker 发现，您需要给它“sitemaker.block”标签。

说我们有销售商/延期作为我的/示例。 要创建一个叫做“我的_block”的 phpBB SiteMaker 的方块：

* 创建一个"块"文件夹
* 在块文件夹中创建我的_block.php 文件，内容如下

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

然后在你的 config.yml 文件中添加：

```yml
服务：

    ...

    my.example.block.my_block:
        class: my\example\blocks\my_block
        calls:
            - [set_name, [my.example.block.my_block]]
        标签:
            - { name: sitemaker.block }

    ......

```

最起码，这就是你需要的。 如果你进入编辑模式，你应该看到列出的“MY_EXAMPLE_BLOK_MY_BLOCK”模块，可以拖拽到任何块位置。 但是，这个模块不会有任何激动。 它没有设置，没有翻译块名称。 让我们更感兴趣。

### 屏蔽设置

让我们修改我们的方块/我的_block.php 文件，并添加一个“get_config”方法，以键值作为方块设置，数值是一个描述像这样设置的数组：

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

这种构造方式与 phpBB 构建非加太区域的棋盘设置相同。 你可以在这里看到更多的例子。 [](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php)。

如果你想要一个自定义字段类型，你可以在这里看到一个示例 [](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type'settings)。

通知 'leginsd1' 和 'legend2': 这些选项用于将设置分隔为标签。

### 命名区块

方块名称的公约是，将服务名称 (例如，我的.示例.block.my_block) 作为语言键，用下划线 (_) (例如 MY_EXAMPLE_BLOK)取代点 (_)。

### 翻译

还注意到我们有几个需要翻译的语言键。 为此，在您的语言文件夹中创建一个名为“block_admin.php”的文件。 这个文件将在编辑块时自动加载，并且应该为您的区块设置和块名称提供翻译。

    $lang = array_merge($lang, 数组(
        'SOME_LANG_VAR' => '选项1',
        'OTHER_LANG_VAR' => '选项2',
        'SOME_LANG_VAR_1' => '设置1'，
        ......
        'MY_EXAMPLE_BLOK_MY_BLOK' => 'My Block',
    );
    

因为 'blocks_admin.php' 仅在编辑方块时加载，所以你需要添加其他翻译 (例如，块标题) 以像 `$language->add_lang('my_lang_file', 'my/example');`

### 渲染块

新区块只有在渲染内容时才会显示。 您的模块可以返回任何字符串作为内容，但在大多数情况下你需要一个模板来渲染您的内容。 要使用模板呈现您的块，块类继承 'ptemmplate' 属性。 所以显示方法可能看起来像这样：

```php
    /**
     * {@inheritdoc}
     */
    public function display(array $data, $edit_mode = false)
    {
        if ($edit_mode)
        {
            // do something only in edit mode
        }

        $this->ptemplate->assign_vars(array(
            'SOME_VAR'  => $data['settings']['checkbox'],
        ));

        return array(
            'title'     => 'MY_BLOCK_TITLE',
            'content'   => $this->ptemplate->render_view('my/example', 'my_block.html', 'my_block'),
        );
    }
```

### 屏蔽资产

如果您的块需要添加资产 (css/js) 到页面，我建议使用网站地图 [的实用类别](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php)。 由于页面上可能有多个相同区块的实例，或者其他区块可能会添加相同的资产，所以“实际类别”确保该资产仅被添加。

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

当然，实用课将需要添加到您的服务定义中 config.yml，就像这样： `-'@blitze.siteemaker.util'` 并在你的块的构造器中定义 `\blitze\sitemaker\services\util $util`。

这就是这样。 我们完成了！