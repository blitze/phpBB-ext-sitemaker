---
title: Udvidelse af phpBB SiteMaker
sidebar_position: 1
---

Du kan udvide/ændre phpBB SiteMaker ved hjælp af [service udskiftning](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [service dekoration](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration)og [phpBB's event system](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Du kan finde en liste over understøttede begivenheder [her](./events.md).

## Opretter en SiteMaker blok

En phpBB SiteMaker blok er blot en klasse, der udvider blitze\sitemaker\services\blocks\driver\block class og returnerer et array fra "display" metoden med en 'titel' og 'indhold'. Alt andet mellem er op til jer. For at gøre din blok synlig af phpBB SiteMaker, skal du give det "sitemaker.block" tag.

Sig at vi har en forlængelse med sælger/udvidelse som min/eksempel. For at oprette en blok kaldet "my_block" til phpBB SiteMaker:

-   Opret en "blokke" mappe
-   Opret my_block.php-fil i blokmappen med følgende indhold

```php
namespace min\example\blocks;

brug blitze\sitemaker\services\blocks\driver\block;

klasse my_block udvider blok
{
    /**
     * {@inheritdoc}
     */
    public function display(array $settings, $edit_mode = false)
    {
        return array(
            'titel' => 'min blok titel',
            'indhold' => 'mit blokindhold',
        );
    }
}
```

Derefter i din config.yml fil, tilføje følgende:

```yml
tjenesteydelser:

...

    my.example.block.my_block:
        class: my\example\blocks\my_block
        calls:
            - [set_name, [my.example.block.my_block]]
        tags:
            - { name: sitemaker.block }

....

```

På et minimum, det er alt hvad du behøver. Hvis du går ind i redigeringstilstand, skal du se blokken opført som 'MY_EXAMPLE_BLOCK_MY_BLOCK', der kan trækkes og slippes på en hvilken som helst blokposition. Men denne blok gør ikke noget spændende. Det har ingen indstillinger og oversætter ikke blokkens navn. Lad os gøre det mere interessant.

### Bloker Indstillinger

Lad os ændre vores blokke/my_block. hp fil og tilføje en "get_config" metode th på returnerer et array med tasterne er blokken indstillinger og værdierne er et array der beskriver indstillingerne som så:

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        returarray(
            'legend1' => 'TAB1',
            'checkbox' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'streng', 'type' => 'checkbox', 'indstillinger' => $options, 'default' => array(), 'explain' => false)
            'yes_no' => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false)
            'radio' => array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'explain' => false, 'default' => 'emne'),
            'select' => array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'streng', 'type' => 'select', 'options' => $options, 'default' => '', 'explain' => false)
            'multi' => array('lang' => 'SOME_LANG_VAR_5', 'validate' => 'streng', 'type' => 'multi_select', 'indstillinger' => $options, 'default' => array(), 'explain' => false),
            'legend2' => 'TAB2',
            'tal' => array('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
            'textarea' => array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'streng', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true 'default' => ''),
            'togglable' => array('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'streng', 'type' => 'select:1:0:toggle_key', 'options' => $options, 'default' => '', 'append' => '<div id="toggle_key-1">Vis kun, når indstilling 1 er valgt</div>'),
        );
}
```

Dette er konstrueret på samme måde, som phpBB bygger konfiguration for board indstillinger i ACP. Du kan se flere eksempler [her](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Hvis du vil have en brugerdefineret felttype, kan du se et eksempel [her](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' indstilling).

Bemærk 'legend1' og 'legend2': Disse bruges til at adskille indstillingerne i faneblade.

### Navnende Blokke

Konventionen for bloknavne er, at tjenestenavnet (f.eks. my.example.block. y*blok ovenfor) vil blive brugt som sprognøglen ved at erstatte prikker (.) med understregning (*) (f.eks MY_EXAMPLE_BLOCK_MY_BLOCK).

### Oversættelse

Bemærk også, at vi har flere sprognøgler, der skal oversættes. For at gøre dette skal du oprette en fil med navnet "blocks_admin.php" i din sprogmappe. Denne fil vil automatisk blive indlæst, når du redigerer blokke, og bør have oversættelser til dine blokindstillinger og blokere navne.

```
$lang = array_merge($lang, array(
    'SOME_LANG_VAR' => 'Option 1',
    'OTHER_LANG_VAR' => 'Option 2',
    'SOME_LANG_VAR_1' => 'Indstilling 1',
....
    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Min Block',
);
```

Da 'blocks_admin.php' kun indlæses ved redigering af blokke, skal du tilføje andre oversættelser (f.eks. blok titel) ved at indlæse en sprogfil i din visningsmetode som `$language->add_lang('my_lang_file', 'my/example');`

### Gengiver blokken

Den nye blok vil kun blive vist, hvis den gengiver noget. Din blok kan returnere enhver streng som indhold, men i de fleste tilfælde har du brug for en skabelon for at gengive dit indhold. For at vise din blok ved hjælp af skabeloner, blokken skal returnere et array, der indeholder de data, du ønsker at videregive til skabelonen, og skal også implementere `get_template` -metoden som vist nedenfor:

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        returarray(
            'legend1' => 'TAB1',
            'some_setting' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'streng', 'type' => 'checkbox', 'indstillinger' => $options, 'default' => array(), 'explain' => false),
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
            // gør noget kun i redigeringstilstand
        }

        returarray(
            'title' => 'MY_BLOCK_TITLE',
            'data' => array(
                'some_var' => $data['settings']['some_setting'],
            ),
        );
}
```

Så kan din stil/all/my_block.html eller stil/prosilver/my_block.html fil se sådan ud:

```
<p>Du valgte: {{ some_var }}</p>
```

Sammenfattende din blok skal returnere et array med en `titel` -nøgle (for blokkens titel) og en `indholds` -nøgle (hvis blokken bare viser en streng og ikke bruger en skabelon) eller en `-data-` -nøgle (hvis blokken bruger en skabelon, i hvilket tilfælde skal du også implementere `get_template` metoden).

### Aktiver Blok

Hvis din blok har brug for at tilføje aktiver (css/js) til siden, anbefaler jeg at bruge sitemaker [util class](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) for at. Da der kan være mere end en instans af den samme blok på siden, eller andre blokke kan være at tilføje det samme aktiv, util klassen sikrer, at aktivet kun er tilføjet.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/some. s',
                100 => '@my_example/assets/other. s', // fastsat prioritet
            ),
            'css' => array(
                '@my_example/assets/some. ss',
            )
));
```

Den util klasse vil naturligvis skal føjes til din service definitioner i config.yml som så: `- '@blitze.sitemaker. til'` og defineret i din bloks konstruktør `\blitze\sitemaker\services\util $util`.

Og det er det. Vi er færdig!
