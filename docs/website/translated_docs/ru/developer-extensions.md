---
id: расширения для разработчиков
title: Расширение phpBB SiteMaker
---

Вы можете расширить/изменить phpBB SiteMaker, воспользовавшись заменой сервиса [](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [украшением сервиса](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration)и системой событий [phpBB](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Вы можете найти список поддерживаемых событий [здесь](./developer-events.md).

## Создание блока SiteMaker

Блок SiteMaker phpBB это просто класс, который расширяет класс blitze\sitemaker\services\blocks\driver\block класс и возвращает массив из метода отображения с «title» и «content». Все остальное inbetween зависит от вас. Чтобы сделать ваш блок доступным для поиска через phpBB SiteMaker, вам нужно дать ему тег "sitemaker.block".

Скажем, у нас есть расширение с поставщиком/расширением в качестве моего/примера. Чтобы создать блок под названием "my_block" для phpBB SiteMaker:

- Создать папку «блоки»
- Создать файл my_block.php в папке блоков со следующим содержимым

```php
пространство имен my\example\blocks;

используйте blitze\sitemaker\services\blocks\driver\block;

class my_block extends block
{
    /**
     * {@inheritdoc}
     */
    public function display(array $settings, $edit_mode = false)
    {
        return array(
            'title' => 'My block title',
            'содержимое' => 'содержимое моего блока',
        );
    }
}
```

Затем в файле config.yml добавьте следующее:

```yml
услуги:

    ...

    my.example.block.my_block:
        класс: my\example\blocks\my_block
        вызовы:
            - [set_name, [my.example.block.my_block]]
        теги:
            - { name: sitemaker.block }

    ....

```

Как минимум, это все, что вам нужно. Если вы перейдете в режим редактирования, вы увидите блок, перечисленный как 'MY_EXAMPLE_BLOCK_MY_BLOCK', который можно перетащить и перетащить на любую позицию блока. Но этот блок ничего не волнует. Он не имеет настроек и не переводит название блока. Давайте сделаем это более интересным.

### Настройки блока

Давайте изменим наши блоки/my_block. hp файл и добавьте метод "get_config" на возвращает массив с ключами настроек блока и значениями, представляющими собой массив, описывающий такие параметры, как

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        возвращаемый массив(
            'legend1' => 'TAB1',
            'checkbox' => массив('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'По умолчанию' => массив(), 'объяснять' => ложь),
            'yes_no' => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
            'radio' => массив('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'объяснить' => false, 'default' => 'тема'),
            'select' => array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', 'объяснить' => false),
            'multi' => массив('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'explain' => false),
            'legend2' => 'TAB2',
            'number' => массив('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'по умолчанию' => 5),
            'textarea' => массив('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'по умолчанию' => ''),
            'Переключатель' => массив('lang' => 'SOME_TOGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options, 'по умолчанию' => '', 'append' => '<div id="toggle_key-1">показывать только при выборе варианта 1</div>'),
        );
}
```

Она построена так же, как и phpBB, строит конфигурацию для настроек платы в АШП. Вы можете увидеть больше примеров [здесь](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Если вы хотите, чтобы пользовательский тип поля, вы можете увидеть пример [здесь](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' параметр).

Обратите внимание 'legend1' и 'legend2': используются для разделения настроек на вкладки.

### Наименование блоков

Конвенция о именах блоков заключается в том, что сервис имени (например my.example.block. y*блок выше) будет использоваться в качестве ключа языка, заменив точки (.) на подчеркивание (*) (например, MY_EXAMPLE_BLOCK_MY_BLOCK).

### Перевод

Также обратите внимание, что у нас есть несколько языковых ключей, которые необходимо перевести. Для этого создайте файл с именем "blocks_admin.php" в папке вашего языка. Этот файл будет автоматически загружен при редактировании блоков и должен иметь переводы для настроек блоков и имена блоков.

    $lang = array_merge($lang, array(
        'SOME_LANG_VAR'     => 'Option 1',
        'OTHER_LANG_VAR'    => 'Option 2',
        'SOME_LANG_VAR_1'   => 'Setting 1',
        ....
        'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Мой блок',
    );
    

Потому что 'blocks_admin.php' загружается только при редактировании блоков, вам нужно добавить другие переводы (например, название блока) загрузив языковой файл в вашем методе отображения, например, так `$language->add_lang('my_lang_file', 'my/example');`

### Отображение блока

Новый блок будет отображаться только если он что-то сделает. Ваш блок может возвращать любую строку как содержимое, но в большинстве случаев вам нужен шаблон для отображения содержимого. Чтобы отобразить ваш блок с помощью шаблонов, блок должен возвращать массив, содержащий данные, которые вы хотите передать в шаблон, и должен также использовать метод `get_template` , как показано ниже:

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        возвращаемый массив(
            'legend1' => 'TAB1',
            'some_setting' => массив('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'По умолчанию' => массив(), 'объяснять' => ложь),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function get_template()
    {
        return '@my_example/my_block. tml';
    }

    /**
     * {@inheritdoc}
     */
    public function display(array $data, $edit_mode = false)
    {
        if ($edit_mode)
        {
            // делаем что-то только в режиме редактирования
        }

        return array(
            'title' => 'MY_BLOCK_TITLE',
            'data' => массив(
                'some_var' => $data['settings']['some_setting'],
            ),
        );
}
```

Затем файл styles/all/my_block.html или styles/prosilver/my_block.html может выглядеть следующим образом:

    <p>Вы выбрали: {{ some_var }}</p>
    

In summary, your block must return an array with a `title` key (for the block title) and a `content` key (if the block just displays a string and does not use a template) or a `data` key (if the block uses a template, in which case, you will also need to implement the `get_template` method).

### Блокировать активы

Если вашему блоку нужно добавить на страницу ресурсы (css/js), я рекомендую использовать для этого инструмент [утилита класса](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php). Поскольку на странице может быть несколько экземпляров одного и того же блока, или другие блоки могут добавить один и тот же актив, утилита класса гарантирует, что актив добавляется только только.

```php
        $this->утилита>add_assets(array(
            'js' => array(
                '@my_example/assets/some. s',
                100 => '@my_example/assets/other. s', // установить приоритет
            ),
            'css' => array(
                '@my_example/assets/some. ss',
            )
));
```

Класс util должен, конечно, быть добавлен в ваши служебные определения в config.yml, как так: `- '@blitze.sitemaker. til'` и определено конструктором вашего блока `\blitze\sitemaker\services\util $util`.

Вот и всё. Мы закончили!