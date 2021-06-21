---
id: utvecklartillägg
title: Utöka phpBB SiteMaker
---

Du kan förlänga/ändra phpBB SiteMaker genom att använda [service replacement](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [service decoration](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), och [phpBB's event system](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Du kan hitta en lista över händelser som stöds [här](./developer-events.md).

## Skapa ett SiteMaker-block

En phpBB SiteMaker block är helt enkelt en klass som utökar blitze\sitemaker\services\blocks\driver\block klass och returnerar en array från "visa" metod med en "titel" och "innehåll". Allt annat mellan er är upp till er. För att göra ditt block upptäckbart av phpBB SiteMaker, måste du ge det "sitemaker.block" taggen.

Säg att vi har en förlängning med leverantör/förlängning som min/exempel. För att skapa ett block som heter "my_block" för phpBB SiteMaker:

- Skapa en "block"-mapp
- Skapa my_block.php fil i blockmappen med följande innehåll

```php
namespace my\example\blocks;

använd blitze\sitemaker\services\blocks\driver\block;

class my_block extends block
{
    /**
     * {@inheritdoc}
     */
    public function display (array $settings, $edit_mode = false)
    {
        returnera array(
            'title' => 'min blocktitel',
            'innehåll' => 'mitt blockinnehåll',
        )
    }
}
```

Sedan i din config.yml fil, lägg till följande:

```yml
tjänster:

...

    my.example.block.my_block:
        class: my\exempel\blocks\my_block
        ringer:
            - [set_name, [my.example.block.my_block]]
        taggar:
            - { name: sitemaker.block }

....

```

På ett minimum, det är allt du behöver. Om du går in i redigeringsläge bör du se blocket listat som 'MY_EXAMPLE_BLOCK_MY_BLOCK' som kan dras och släppas på alla blockpositioner. Men detta block gör ingenting spännande. Den har inga inställningar och översätter inte blockets namn. Låt oss göra det mer intressant.

### Blockera inställningar

Låt oss ändra våra block/my_block. HK fil och lägg till en "get_config" metod th vid returnerar en array med tangenterna är blockinställningar och värdena är en array som beskriver inställningar som så:

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        returarray(
            'legend1' => 'TAB1',
            'kryssruta' => array('lang' => 'SOME_LANG_VAR_1', 'validera' => 'sträng', 'typ' => 'kryssruta', 'alternativ' => $options, 'default' => array(), 'förklara' => false),
            'yes_no' => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'typ' => 'radio:yes_no', 'förklara' => false, 'default' => false),
            'radio' => array('lang' => 'SOME_LANG_VAR_3', 'validera' => 'bool', 'typ' => 'radio', 'alternativ' => $options, 'förklara' => falskt, 'standard' => 'topic'),
            'select' => array('lang' => 'SOME_LANG_VAR_4', 'validera' => 'sträng', 'typ' => 'select', 'alternativ' => $options, 'standard' => '', 'förklara' => falskt),
            'multi' => array('lang' => 'SOME_LANG_VAR_5', 'validerad' => 'sträng', 'typ' => 'multi_select', 'alternativ' => $options, 'standard' => array(), 'förklara' => falskt),
            'legend2' => 'TAB2',
            'nummer' => array('lang' => 'SOME_LANG_VAR_6', 'validera' => 'int:0:20', 'typ' => 'nummer:0:20', 'maxlength' => 2, 'förklara' => false, 'standard' => 5),
            'textarea' => array('lang' => 'SOME_LANG_VAR_7', 'validera' => 'sträng', 'typ' => 'textarea:3:40', 'maxlength' => 2, 'förklara' => sant, 'standard' => '),
            'växla' => array('lang' => 'SOME_TOGGLABLE_VAR', 'validera' => 'sträng', 'typ' => 'select:1:0:toggle_key', 'alternativ' => $options, 'standard' => '', 'append' => '<div id="toggle_key-1">Visa endast när alternativ 1 är markerat</div>'),
        );
}
```

Detta är konstruerat på samma sätt som phpBB bygger konfigurationen för kortinställningar i ACP. Du kan se fler exempel [här](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Om du vill ha en anpassad fälttyp, kan du se ett exempel [här](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' inställning).

Lägg märke till 'legend1' och 'legend2': Dessa används för att separera inställningarna i flikar.

### Namnge block

Konventionen för blocknamn är att tjänstens namn (t.ex. my.example.block. y*block ovan) kommer att användas som språklyckel genom att ersätta prickarna (.) med understreck (*) (t.ex. MY_EXAMPLE_BLOCK_MY_BLOCK).

### Översättning

Notera också att vi har flera språknycklar som behöver översättas. För att göra detta, skapa en fil som heter "blocks_admin.php" i din språkmapp. Den här filen kommer att laddas automatiskt vid redigering av block, och bör ha översättningar för dina blockinställningar och blocknamn.

    $lang = array_merge($lang, array(
        'SOME_LANG_VAR' => 'Option 1',
        'OTHER_LANG_VAR' => 'Alternativ 2',
        'SOME_LANG_VAR_1' => 'Ställa in 1',
    ....
        'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Mitt Block',
    );
    

Eftersom 'blocks_admin.php' endast laddas vid redigering av block, måste du lägga till andra översättningar (t.ex. blockera titel) genom att läsa in en språkfil i din visningsmetod som så `$language->add_lang('my_lang_file', 'my/exempel');`

### Renderar blocket

Det nya blocket kommer endast att visas om det renderar något. Ditt block kan returnera vilken sträng som helst som innehåll, men i de flesta fall behöver du en mall för att återge ditt innehåll. För att rendera ditt block med hjälp av mallar, blocket måste returnera en array som innehåller data som du vill skicka till mallen och måste även implementera metoden `get_template` som visas nedan:

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        returarray(
            'legend1' => 'TAB1',
            'some_setting' => array('lang' => 'SOME_LANG_VAR_1', 'validera' => 'sträng', 'typ' => 'kryssruta', 'alternativ' => $options, 'default' => array(), 'förklara' => false),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function get_template()
    {
        returnera '@my_exempel/my_block. tml';
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
            'title' => 'MY_BLOCK_TITLE',
            'data' => array(
                'some_var' => $data['settings']['some_setting'],
            ),
        );
}
```

Då kan din styles/all/my_block.html eller styles/prosilver/my_block.html fil se ut ungefär så här:

    <p>Du valde: {{ some_var }}</p>
    

Sammanfattningsvis blocket måste returnera en array med en `titel` nyckel (för blockets titel) och en `innehåll` nyckel (om blocket bara visar en sträng och inte använder en mall) eller en `data` nyckel (om blocket använder en mall, I vilket fall måste du också implementera `get_template` metoden).

### Blockera tillgångar

Om ditt block behöver lägga till tillgångar (css/js) på sidan, rekommenderar jag att du använder sitemaker [util class](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) för det. Eftersom det kan finnas mer än en instans av samma block på sidan, eller andra block kan lägga till samma tillgång, säkerställer util-klassen att tillgången bara läggs till.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_exempel/assets/vissa. s',
                100 => '@my_exempel/tillgångar/annat. s', // ange prioritet
            ),
            'css' => array(
                '@my_exempel/assets/vissa. ss',
            )
)
```

Den util-klassen kommer naturligtvis att behöva läggas till dina tjänstedefinitioner i config.yml som så: `- '@blitze.sitemaker. til'` och definieras i blockets konstruktör `\blitze\sitemaker\services\util $util`.

Och det är det. Vi är klara!