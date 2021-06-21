---
id: deweloperskie rozszerzenia
title: Rozszerzenie phpBB SiteMaker
---

Możesz rozszerzyć/zmodyfikować phpBB SiteMaker używając [zastępczej usługi](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [dekoracji usługi](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), i [systemu zdarzeń phpBB](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Lista obsługiwanych wydarzeń [znajduje się tutaj](./developer-events.md).

## Tworzenie bloku SiteMakera

Blok phpBB SiteMaker to po prostu klasa, która rozszerza blitze\sitemaker\services\blocks\blockks\block i zwraca tablicę z metody "display" z 'tytułem' i 'zawartości'. Wszystko inne zależy od Ciebie. Aby blok mógł zostać odkryty przez phpBB SiteMaker, musisz nadać mu znacznik "sitemaker.block".

Powiedzmy, że mamy rozszerzenie z dostawcą/rozszerzeniem jako moj/przykład. Aby utworzyć blok o nazwie "my_block" dla phpBB SiteMaker:

- Utwórz folder "bloków"
- Utwórz plik my_block.php w folderze bloków z następującą zawartością

```php
moje\przykład\blocks;

użyj blitze\sitemaker\services\blocks\block;

klasa my_block rozszerza blok
{
    /**
     * {@inheritdoc}
     */
    wyświetlacz funkcji publicznej (tablica $settings, $edit_mode = fałsz)
    {
        zwraca tablicę (
            'title' => 'mój tytuł bloku',
            'zawartość' => 'moja zawartość bloku',
        );
    }
}
```

Następnie w pliku config.yml dodaj następujące elementy:

```yml
usługi:

...

    moj.example.block.my_block:
        klasa: moj\example\blocks\my_block
        wywołania:
            - [set_name, [my.example.block.my_block]]
        tagi:
            - { name: sitemaker.block }

....

```

To wszystko, czego potrzebujesz. Jeśli przejdziesz do trybu edycji, powinieneś zobaczyć blok wymieniony jako 'MY_EXAMPLE_BLOCK_MY_BLOCK', który może być przeciągany i upuszczony na dowolną pozycję bloku. Ale ten blok nie robi nic ekscytującego. It has no settings and does not translate the block name. Zróbmy to bardziej interesujące.

### Ustawienia bloku

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

Jest to skonstruowane w taki sam sposób, w jaki phpBB buduje konfigurację ustawień płyt w ACP. Więcej przykładów [tutaj](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Jeśli chcesz niestandardowy typ pola, możesz zobaczyć przykład [tutaj](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) (ustawienie 'content_type').

Wpis 'legenda1' i 'legenda2': Są one używane do oddzielania ustawień na karty.

### Bloki nazewnictwa

The convention for block names is that the service name (e.g my.example.block.my*block above) will be used as the language key by replacing the dots (.) with underscore (*) (e.g MY_EXAMPLE_BLOCK_MY_BLOCK).

### Tłumaczenie

Zwróć uwagę, że mamy kilka kluczy językowych, które należy przetłumaczyć. Aby to zrobić, utwórz plik o nazwie "blocks_admin.php" w folderze językowym. Ten plik zostanie automatycznie załadowany podczas edycji bloków i powinien mieć tłumaczenia dla ustawień bloków i nazw bloków.

    $lang = array_merge($lang, array(
        'SOME_LANG_VAR' => 'Opcja 1',
        'OTHER_LANG_VAR' => 'Opcja 2',
        'SOME_LANG_VAR_1' => 'Ustawienie 1',
    ....
        'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Mój blok',
    );
    

Ponieważ 'blocks_admin.php' jest załadowany tylko podczas edycji bloków, będziesz musiał dodać inne tłumaczenia (np. tytuł bloku) wczytywając plik językowy w twojej metodzie wyświetlania, tak jak `$language->add_lang('my_lang_file', 'moj/przykład');`

### Renderowanie bloku

Nowy blok będzie wyświetlany tylko wtedy, gdy coś renderowuje. Twój blok może zwrócić dowolny ciąg jako zawartość, ale w większości przypadków potrzebujesz szablonu, aby wyrenderować zawartość. To render your block using templates, the block must return an array that holds the data that you want to pass to the template and must also implement the `get_template` method as demonstrated below:

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

### Blokuj aktywa

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