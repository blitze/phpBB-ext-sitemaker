---
id: 开发者扩展
title: 扩展 phpBB 站点Maker
---

你可以使用 [服务替换](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [服务装饰](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), 和 [phpBB 事件系统](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html)。 你可以在这里找到支持的事件列表 [](./developer-events.md)。

## 创建一个 SiteMaker 模块

一个 phpBB SiteMaker 模块只是一个扩展 blitze\sitemaker\services\blocks\驱动程序\block 分类，并返回“显示”方法中的“title”和“content”的数组。 所有其他收件人都是您自己的。 要使你的块可以通过 phpBB SiteMaker 发现，您需要给它“sitemaker.block”标签。

说我们有销售商/延期作为我的/示例。 要创建一个叫做“我的_block”的 phpBB SiteMaker 的方块：

- 创建一个"块"文件夹
- 在块文件夹中创建我的_block.php 文件，内容如下

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

最起码，这就是你需要的。 如果你进入编辑模式，你应该看到列出的“MY_EXAMPLE_BLOK_MY_BLOCK”模块，可以拖拽到任何块位置。 但是，这个模块不会有任何激动。 It has no settings and does not translate the block name. 让我们更感兴趣。

### 屏蔽设置

Let's modify our blocks/my_block.php file and add a "get_config" method th at returns an array with the keys being the block settings and the values being an array describing the settings like so:

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

The convention for block names is that the service name (e.g my.example.block.my*block above) will be used as the language key by replacing the dots (.) with underscore (*) (e.g MY_EXAMPLE_BLOCK_MY_BLOCK).

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

新区块只有在渲染内容时才会显示。 您的模块可以返回任何字符串作为内容，但在大多数情况下你需要一个模板来渲染您的内容。 To render your block using templates, the block must return an array that holds the data that you want to pass to the template and must also implement the `get_template` method as demonstrated below:

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

Then your styles/all/my_block.html or styles/prosilver/my_block.html file might look something like this:

    <p>You selected: {{ some_var }}</p>
    

In summary, your block must return an array with a `title` key (for the block title) and a `content` key (if the block just displays a string and does not use a template) or a `data` key (if the block uses a template, in which case, you will also need to implement the `get_template` method).

### 屏蔽资产

If your block needs to add assets (css/js) to the page, I recommend using the sitemaker [util class](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) for that. Since there can be more than one instance of the same block on the page, or other blocks might be adding the same asset, the util class ensures that the asset is only added ones.

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

And that's it. We're done!