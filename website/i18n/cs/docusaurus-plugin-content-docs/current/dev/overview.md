---
title: Rozšiřování phpBB SiteMaker
sidebar_position: 1
---

Můžete rozšiřovat/modifikovat phpBB SiteMaker pomocí [servisu](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [dekorace služeb](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration)a [phpBB systému událostí](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Seznam podporovaných událostí [naleznete zde](./events.md).

## Vytváření bloku SiteMaker

Blok phpBB SiteMaker je prostě třída, která rozšiřuje blitze\sitemaker\services\blocks\driver\block class a vrací pole z metody "display" s 'title' a 'content'. Všechno ostatní mezi námi záleží na vás. Aby byl blok rozpoznatelný phpBB SiteMaker, musíte mu dát štítek "sitemaker.block".

Řekněte nám rozšíření s prodejcem/rozšířením jako například. Chcete-li vytvořit blok nazvaný "my_block" pro phpBB SiteMaker:

-   Vytvořit složku "bloky"
-   Vytvořit soubor my_block.php ve složce bloků s následujícím obsahem

```php
namespace my\example\blocks;

použijte blitze\sitemaker\services\blocks\driver\block;

třída my_block rozšiřuje blok
{
    /**
     * {@inheritdoc}
     */
    displej veřejné funkce (pole $settings, $edit_mode = false)
    {
        return array(
            'title' => 'my block title',
            'obsah' => 'obsah mého bloku',
        );
    }
}
```

Poté v souboru config.yml přidejte následující:

```yml
služby:

...

    my.example.block.my_block:
        class: my\example\blocks\my_block
        hovory:
            - [set_name, [my.example.block.my_block]]
        tagy:
            - { name: sitemaker.block }

....

```

Na minimum, to je vše, co potřebujete. Pokud přejdete do režimu úprav, měli byste vidět blok uvedený jako 'MY_EXAMPLE_BLOCK_MY_BLOCK', který může být přetažen a přetažen na libovolnou pozici bloku. Ale tento blok nedělá nic vzrušujícího. Nemá žádné nastavení a nepřeloží název bloku. Udělejme to zajímavější.

### Nastavení bloku

Pojďme upravit naše bloky/my_block. hp soubor a přidat metodu "get_config" na vrací pole s tím, že klíče jsou nastavení bloků, a hodnoty popisující nastavení, jako je toto:

```php
    /**
     * @inheritdoc
     */
    veřejná funkce get_config(pole $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => „OTHER_LANG_VAR“);
        zpáteční pole
            'legend1' => 'TAB1',
            'checkbox' => pole ('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options„výchozí“ => pole(), „vysvětlit“ => false),
            'yes_no' => pole ('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
            'rád' => pole ('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'vysvětlit' => false, 'default' => 'topic'),
            'select' => pole ('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', „vysvětlit“ => nepravda),
            'multi' => pole ('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'možnosti' => $options, 'default' => pole(), 'vysvětlit' => false),
            'legend2' => 'TAB2',
            'číslo' => pole ('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false; „výchozí“ => 5),
            'textarea' => pole ('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'výchozí' => ''),
            'togglable' => pole ('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options'výchozí' => '', 'append' => '<div id="toggle_key-1">Zobrazit pouze když je zvolena možnost 1</div>'),
        );
}
```

Toto je konstruováno stejným způsobem, jako phpBB sestavuje konfiguraci pro nastavení desky v ACP. Více příkladů [můžete vidět zde](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Pokud chcete typ vlastního pole, uvidíte příklad [zde](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type').

Oznámení 'legend1' a 'legend2': Používají se k oddělení nastavení do záložek.

### Názevní bloky

Konventem názvů bloků je název služby (např. my.example.block. y*blok výše) bude použit jako jazykový klíč nahrazením teček (.) podtržítkem (*) (např. MY_EXAMPLE_BLOCK_MY_BLOCK).

### Překlad

Všimněte si také, že máme několik jazykových klíčů, které musí být přeloženy. Chcete-li to provést, vytvořte soubor s názvem "blocks_admin.php" ve vaší jazykové složce. Tento soubor bude automaticky načten při úpravách bloků a měl by mít překlady pro nastavení bloků a jména bloků.

```
$lang = array_merge($lang, pole
    'SOME_LANG_VAR' => 'Možnost 1',
    'OTHER_LANG_VAR' => 'Možnost 2',
    'SOME_LANG_VAR_1' => 'Nastavuji 1',
....
    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Můj blok',
);
```

Protože se 'blocks_admin.php' načítá pouze při úpravách bloků, budete muset přidat další překlady (např. název bloku) nahráním jazykového souboru do metody zobrazení, jako je tomu tak `$language->add_lang('my_lang_file', 'my/example');`

### Vykreslování bloku

Nový blok se zobrazí pouze v případě, že něco vykresluje. Blok může vrátit jakýkoli řetězec jako obsah, ale ve většině případů potřebujete šablonu k vykreslení obsahu. Pro vykreslení bloku pomocí šablon, blok musí vrátit pole, které obsahuje data, která chcete předat do šablony, a musí také implementovat metodu `get_template` , jak je uvedeno níže:

```php
    /**
     * @inheritdoc
     */
    veřejná funkce get_config(pole $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => „OTHER_LANG_VAR“);
        zpáteční pole
            'legend1' => 'TAB1',
            'some_setting' => pole('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options„výchozí“ => pole(), „vysvětlit“ => false),
        );
    }

    /**
     * {@inheritdoc}
     */
    Veřejná funkce get_template()
    {
        return '@my_example/my_block. tml';
    }

    /**
     * {@inheritdoc}
     */
    zobrazení veřejné funkce (pole $data, $edit_mode = false)
    {
        if ($edit_mode)
        {
            // do něco pouze v editačním módu
        }

        return ary(
            'title' => 'MY_BLOCK_TITLE',
            'data' => pole
                'some_var' => $data['settings']['some_setting']
            ),
        );
}
```

Pak vaše styles/all/my_block.html nebo styles/prosilver/my_block.html soubor může vypadat takto:

```
<p>Vybrali jste: {{ some_var }}</p>
```

In summary, your block must return an array with a `title` key (for the block title) and a `content` key (if the block just displays a string and does not use a template) or a `data` key (if the block uses a template, in which case, you will also need to implement the `get_template` method).

### Blokovat aktiva

Pokud váš blok potřebuje přidat aktiva (css/js) na stránku, doporučuji pro to použít sitemaker [util třídu](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php). Protože na stránce může být více než jedna instance téhož bloku, nebo jiné bloky mohou přidávat stejné aktivum, třída utilu zajišťuje, že aktivum je pouze přidáno.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/některé. s',
                100 => '@my_example/assets/other. s', // nastavit prioritu
            ),
            'css' => pole(
                '@my_example/assets/některé. ss',
            )
));
```

Do definic vašich služeb bude samozřejmě muset být přidána utilová třída v config.yml jako je toto: `- '@blitze.sitemaker. til'` a definováno v konstruktoru vašeho bloku `\blitze\sitemaker\services\util $util`.

A je to. Jsme hotovi!
