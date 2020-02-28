---
id: Rozšíření vývojářů
title: Rozšíření phpBB SiteMaker
---

phpBB SiteMaker můžete rozšířit pomocí [nahrazení služby](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [dekorace služeb](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration)a [phpBB's event systém](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Seznam podporovaných událostí najdete zde [](./developer-events.md).

## Vytváření SiteMaker bloku

Blok phpBB SiteMaker je jednoduše třída, která rozšiřuje kategorii blitze\sitemaker\services\blocks\driver\block třídu a vrací pole z "zobrazovací" metody s "titul" a "obsah". Všechno ostatní vložení je na vás. Abyste svůj blok objevil phpBB SiteMaker, musíte mu dát štítek "sitemaker.block".

Jako příklad uveďme rozšíření s dodavatelem/rozšířením. Chcete-li vytvořit blok nazvaný "můj_block" pro phpBB SiteMaker:

* Vytvořte složku "bloků".
* Vytvořte můj_block.php soubor v bloku složky s následujícím obsahem

```php
namespace my\example\blocks;

používá blitze\sitemaker\services\blocks\driver\block;

class my_block rozšiřuje blok
{
    /**
     * {@inheritdoc}
     */
    veřejné funkce zobrazení (array $settings, $edit_mode = false)
    {
        reklamační pole (
            'title' => 'Můj název bloku',
            'content' => 'můj obsah bloku',
        );
    }
}
```

Potom ve vašem konfiguragu.yml souboru přidejte následující:

```yml
služeb:

...

    my.example.block.my_block:
        class: my\example\blocks\my_block
        calls:
            - [set_name, [my.example.block.my_block]]
        tagy:
            - { name: sitemaker.block }

....

```

To je minimum, to je vše, co potřebujete. Pokud přejdete do editačního režimu, měli byste vidět blok zapsaný jako 'MY_EXAMPLE_BLOCK_MY_BLOCK', který může být přetažen a vyřazen na jakoukoli blokovou pozici. Tento blok ale nedělá nic vzrušujícího. Nemá nastavení a nepoužívá název blokového bloku. Učiňme to zajímavějším.

### Blokové nastavení

Proměňme náš blok/můj_block.php soubor a přidejme metodu ,,get_config'', která vrátí pole s klávesami jako blokové nastavení a hodnoty jako pole popisuje nastavení:

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

To je postaveno stejně, jako phpBB buduje konfiguraci pro nastavení desky v AKT. Můžete si prohlédnout další příklady [zde](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Pokud chcete typ vlastního pole, můžete vidět příklad [zde](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) (nastavení 'content_type').

Poznámka "legend1" a "legend2": Tato nastavení se používají pro oddělená nastavení na taby.

### Název bloků

Konvent pro názvy blokových jmen je, že název služby (např. můj příklad.block.my_block above) bude použit jako jazyk klíč nahrazením dotů (.) podtrženými (_) (e.g MY_EXAMPLE_BLOCK_MY_BLOCK_BLOCK).

### Překlad

Také si všimněte, že máme několik jazykových kláves, které musí být přeloženy. Chcete-li toho dosáhnout, vytvořte soubor nazvaný "blocks_admin.php" ve vaší jazykové složce. Tento soubor bude automaticky nahrán při editaci bloků a měl by mít překlady pro nastavení bloků a bloková jména.

    $lang = array_merge($lang, array(
        'SOME_LANG_VAR' => 'Option 1',
        'JA_LANG_VAR' => 'Volba 2',
        'SOME_LANG_VAR_1' => 'Nastavení 1',
    ....
        "MY_EXAMPLE_BLOCK_MY_BLOCK' => 'My Block',
    );
    

Protože 'blocks_admin.php' je nahrán pouze při úpravách bloků, budete muset přidat další překlady (např. název bloku) nahráním jazykového souboru do zobrazovací metody, tak `$language->add_lang('my_lang_file', 'my/example');`

### Obnovení bloku

Nový blok se zobrazí pouze v případě, že něco objeví. Váš blok může vrátit libovolný řetězec jako obsah, ale ve většině případů potřebujete šablonu, aby se zobrazil obsah. Chcete-li učinit blok pomocí šablon, bloková třída zdědí 'ptemplate' majetek. Tedy zobrazovací metoda by mohla vypadat takto:

```php
    /**
     * {@inheritdoc}
     */
    zobrazení veřejné funkce (pole $data, $edit_mode = false)
    {
        , pokud ($edit_mode)
        {
            // něco dělat pouze v editačním módu
        }

        $this->ptemplate->assign_vars(array(
            'SOME_VAR' => $data['settings']['checkbox'],
        ));

        zpáteční array(
            'název' => 'MY_BLOCK_TITLE',
            'content' => $this->ptemplate->render_view('my/example', 'moje_blok. tml', 'my_block'),
        );
}
```

### Blokové aktivy

Pokud musí váš blok přidat majetek (css/js) na stránku, doporučuji používat sitemaker [util třídy](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) pro to. Protože může být více než jeden příklad stejného bloku na stránce, nebo jiné bloky mohou přidávat stejné aktivum, util třída zajišťuje, že majetek je jen další.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/some. s',
                100 => '@my_example/assets/other. s', // nastavit prioritu
            ),
            'css' => array(
                '@my_example/assets/some e. ss',
            )
));
```

Třída util bude samozřejmě třeba přidat do definice služeb v config.yml také: `- '@blitze.sitemaker. Do'` a definován v konstruktoru bloků `\blitze\sitemaker\services\util $util`.

A to je vše. Udělali jsme to!