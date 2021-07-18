---
title: Rozszerzanie phpBB SiteMaker
sidebar_position: 1
---

Możesz rozszerzyć/zmodyfikować phpBB SiteMaker używając [wymiany usług](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [dekoracji usług](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration)i [systemu wydarzeń phpBB](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Tutaj znajdziesz listę obsługiwanych wydarzeń [](./events.md).

## Tworzenie bloku SiteMaker

Blok phpBB SiteMaker jest po prostu klasą, która rozszerza blitze\sitemaker\services\blocks\driver\block class i zwraca tablicę z metody "display" z 'title' i 'content'. Wszystko inne między sobą należy do Ciebie. Aby twój blok mógł zostać odkryty przez phpBB SiteMaker, musisz nadać mu znacznik "sitemaker.block".

Powiedz nam, że mamy rozszerzenie z vendor/extension jako moje/przykład. Aby utworzyć blok o nazwie "my_block" dla phpBB SiteMaker:

-   Utwórz folder "blocks"
-   Utwórz plik my_block.php w folderze bloków z następującą zawartością

```php
przestrzeń nazw my\example\blocks;

użyj blitze\sitemaker\services\blocks\driver\block;

class my_block extends block
{
    /**
     * {@inheritdoc}
     */
    public function display(tablica $settings, $edit_mode = false)
    {
        zwraca tablicę (
            'title' => 'mój tytuł bloku',
            'content' => 'moja zawartość bloku',
        );
    }
}
```

Następnie w pliku config.yml dodaj następujące dane:

```yml
usługi:

...

    my.example.block.my_block:
        klasa: my\example\blocks\my_block
        wywołania:
            - [set_name, [my.example.block.my_block]]
        tagi:
            - { name: sitemaker.block }

....

```

Na pustym minimum, to wszystko, czego potrzebujesz. Jeśli przejdziesz do trybu edycji, powinieneś zobaczyć blok wymieniony jako 'MY_EXAMPLE_BLOCK_MY_BLOCK', który może być ciągnięty i upuszczony na dowolnej pozycji bloku. Ale ten blok nie robi nic ekscytującego. Nie ma żadnych ustawień i nie tłumaczy nazwy bloku. Zróbmy to bardziej interesująco.

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

Jest to zbudowane w taki sam sposób, jak phpBB buduje konfigurację ustawień płyt w ACP. Możesz zobaczyć więcej przykładów [tutaj](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Jeśli chcesz typ pola niestandardowego, możesz zobaczyć przykład [tutaj](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) (ustawienie 'content_type').

Zgłoś 'legenda1' i 'legend2': Są one używane do oddzielania ustawień na karty.

### Nazewnictwo bloków

Konwencja dla nazw bloków jest taka, że nazwa usługi (np. my.example.block. y*blok powyżej) będzie używany jako klucz językowy, zastępując kropki (.) podkreśleniem (*) (np. MY_EXAMPLE_BLOCK_MY_BLOCK).

### Tłumaczenie

Zauważ, że mamy kilka kluczy językowych, które trzeba przetłumaczyć. Aby to zrobić, utwórz plik o nazwie "blocks_admin.php" w folderze językowym. Ten plik zostanie automatycznie załadowany podczas edycji bloków i powinien mieć tłumaczenia dla ustawień bloków i nazw bloków.

```
$lang = array_merge($lang, tablica(
    'SOME_LANG_VAR' => 'Opcja 1',
    'OTHER_LANG_VAR' => 'Wariant 2',
    'SOME_LANG_VAR_1' => 'Ustawienie 1',
....
    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Mój blok',
);
```

Ponieważ 'blocks_admin.php' jest ładowany tylko podczas edycji bloków, musisz dodać inne tłumaczenia (np. blokuj tytuł) wczytywając plik językowy w metodzie wyświetlania, tak jak `$language->add_lang('my_lang_file', 'my/example');`

### Renderowanie bloku

Nowy blok będzie wyświetlany tylko wtedy, gdy coś renderowuje. Twój blok może zwrócić dowolny ciąg znaków jako treść, ale w większości przypadków potrzebujesz szablonu, aby renderować zawartość. Aby wyrenderować swój blok za pomocą szablonów, blok musi zwracać tablicę zawierającą dane, które chcesz przekazać do szablonu i musi również zaimplementować metodę `get_template` , jak pokazano poniżej:

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

```
<p>Wybrałeś: {{ some_var }}</p>
```

Podsumowując, twój blok musi zwracać tablicę z kluczem `tytuł` (dla tytułu bloku) i kluczem `treści` (jeśli blok wyświetla tylko ciąg znaków i nie używa szablonu) lub kluczem `data` (jeśli blok używa szablonu, W takim przypadku musisz również wdrożyć metodę `get_template`.

### Blokuj zasoby

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
