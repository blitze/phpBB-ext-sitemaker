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

To wszystko, czego potrzebujesz. Jeśli przejdziesz do trybu edycji, powinieneś zobaczyć blok wymieniony jako 'MY_EXAMPLE_BLOCK_MY_BLOCK', który może być przeciągany i upuszczony na dowolną pozycję bloku. Ale ten blok nie robi nic ekscytującego. Nie ma żadnych ustawień i nie tłumaczy nazwy bloku. Zróbmy to bardziej interesujące.

### Ustawienia bloku

Zmodyfikuj nasze bloki/my_block. plik hp i dodaj metodę "get_config" zwracając tablicę z kluczami będącymi ustawieniami bloku, a wartościami będącymi tablicą opisującą ustawienia takie jak tak:

```php
    /**
     * @inheritdoc
     */
    funkcja publiczna get_config(tablica $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        zwróć tablicę (
            'legend1' => 'TAB1',
            'pole wyboru' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explain' => false),
            'yes_no' => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
            'radio' => array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'explain' => false, 'default' => 'temat'),
            'select' => array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', 'explain' => false),
            'multi' => tablica ('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'explain' => false),
            'legend2' => 'TAB2',
            'number' => array('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
            'textarea' => array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),
            'włączalny' => tablica ('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options'default' => '', 'append' => '<div id="toggle_key-1">Pokaż tylko, gdy wybrano opcję 1</div>'),
        );
}
```

Jest to skonstruowane w taki sam sposób, w jaki phpBB buduje konfigurację ustawień płyt w ACP. Więcej przykładów [tutaj](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Jeśli chcesz niestandardowy typ pola, możesz zobaczyć przykład [tutaj](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) (ustawienie 'content_type').

Wpis 'legenda1' i 'legenda2': Są one używane do oddzielania ustawień na karty.

### Bloki nazewnictwa

Konwencja dla nazw bloków jest taka, że nazwa usługi (np. my.example.block. y*blok powyżej) będzie używany jako klucz językowy, zastępując kropki (.) podkreśleniem (*) (np. MY_EXAMPLE_BLOCK_MY_BLOCK).

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

Nowy blok będzie wyświetlany tylko wtedy, gdy coś renderowuje. Twój blok może zwrócić dowolny ciąg jako zawartość, ale w większości przypadków potrzebujesz szablonu, aby wyrenderować zawartość. Aby wyrenderować swój blok za pomocą szablonów, blok musi zwracać tablicę zawierającą dane, które chcesz przekazać do szablonu i musi również zaimplementować metodę `get_template` , jak pokazano poniżej:

```php
    /**
     * @inheritdoc
     */
    funkcja publiczna get_config(tablica $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        zwróć tablicę (
            'legend1' => 'TAB1',
            'some_setting' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explain' => false),
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
    wyświetlacz funkcji publicznych (tablica $data, $edit_mode = false)
    {
        if ($edit_mode)
        {
            // zrób coś tylko w trybie edycji
        }

        zwraca tablicę (
            'title' => 'MY_BLOCK_TITLE',
            'data' => tablica (
                'some_var' => $data['settings']['some_setting'],
            ),
        );
}
```

Następnie plik styles/all/my_block.html lub styles/prosilver/my_block.html może wyglądać tak:

    <p>Wybrałeś: {{ some_var }}</p>
    

Podsumowując, twój blok musi zwracać tablicę z kluczem `tytuł` (dla tytułu bloku) i kluczem `treści` (jeśli blok wyświetla tylko ciąg znaków i nie używa szablonu) lub kluczem `data` (jeśli blok używa szablonu, W takim przypadku musisz również wdrożyć metodę `get_template`.

### Blokuj aktywa

Jeśli twój blok musi dodać aktywa (css/js) do strony, zalecam użycie do tego narzędzia [util class](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php). Ponieważ na stronie może być więcej niż jedna instancja tego samego bloku, lub inne bloki mogą dodawać ten sam składnik aktywów, klasa util zapewnia, że składnik jest dodany tylko do niego.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/some. s',
                100 => '@my_example/assets/other. s', // ustaw priorytet
            ),
            'css' => tablica(
                '@my_example/assets/some. ss',
            )
));
```

Klasa util będzie oczywiście musiała zostać dodana do definicji usług w pliku config.yml jak tak: `- '@blitze.sitemaker. do` i zdefiniowane w konstruktorze twojego bloku `\blitze\sitemaker\services\util $util`.

I tak jest. Udało się!