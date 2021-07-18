---
title: Uitbreiding phpBB SiteMaker
sidebar_position: 1
---

U kunt phpBB SiteMaker uitbreiden/wijzigen met behulp van [service vervanging](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [service decoration](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), en [phpBB's event systeem](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Je vindt een lijst van ondersteunde gebeurtenissen [hier](./events.md).

## SiteMaker blok maken

Een phpBB SiteMaker blok is gewoon een klasse die de blitze\sitemaker\services\blocks\driver\block klasse uitbreidt en een array geeft van de "weergave" methode met een 'titel' en 'inhoud'. Al het andere onderling hangt van u af. Om je blok via phpBB SiteMaker te laten ontdekken, moet je hem de tag "sitemaker.block" geven.

Zeg dat we een extensie hebben met verkoper/extensie als mij/voorbeeld. Om een blok te maken genaamd "my_block" voor phpBB SiteMaker:

-   Maak een map "blokken"
-   Maak my_block.php bestand aan in de blokken map met de volgende inhoud

```php
namespace my\example\blocks;

gebruik blitze\sitemaker\services\blocks\driver\block;

class my_block breidt blok
{
    /**
     * {@inheritdoc}
     */
    openbare functie display(array $settings, $edit_mode = onwaar)
    {
        return array(
            'title' => 'mijn blok titel',
            'inhoud' => 'mijn blokinhoud',
        );
    }
}
```

Voeg dan in uw config.yml bestand het volgende toe:

```yml
Diensten:

...

    my.example.block.my_block:
        class: mijn\blocks\blocks\my_block
        roept:
            - [set_name, [my.example.block.my_block]]
        tags:
            - { name: sitemaker.block }

....

```

Op een absoluut minimum niveau is alles wat je nodig hebt. Als je in de bewerkingsmodus gaat, zie je het blok opgesomd als 'MY_EXAMPLE_BLOCK_MY_BLOCK' dat kan worden gesleept en geplaatst op elke block positie. Maar dit blok doet niets spannends. Het heeft geen instellingen en vertaalt de naam van het blok niet. Laten we het interessanter maken.

### Blok instellingen

Laten we ons blokken/my_block aanpassen. hp bestand en voeg een "get_config" methode toe op een array waarvan de sleutels de blok-instellingen zijn en de waarden een array zijn die de instellingen als volgt beschrijven:

```php
    /**
     * @inheritdoc
     */
    openbare functie get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        retourarray(
            'legend1' => 'TAB1',
            'checkbox' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'standaard' => array(), 'verklaren' => false),
            'ja' => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'leg uit' => false, 'standaard' => false),
            'radio' => array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'explain' => onwaar, 'default' => 'topic'),
            'select' => array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'standaard' => '', 'uitleggen' => false),
            'multi' => array('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'opties' => $options, 'standaard' => array(), 'explain' => false),
            'legend2' => 'TAB2',
            'number' => array('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'toelichten' => false, 'standaard' => 5),
            'textarea' => array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'toelichten' => waar, 'standaard' => ''),
            'schakellable' => array('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options, 'standaard' => '', 'append' => '<div id="toggle_key-1">Toon alleen wanneer optie 1 is geselecteerd</div>'),
        );
}
```

Dit is dezelfde manier waarop phpBB de configuratie voor boardinstellingen in ACP opbouwt. Je kunt meer voorbeelden [hier](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php) zien.

Als je een aangepast veld type wilt, kan je een voorbeeld [hier](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' instelling zien).

Let op 'legend1' en 'legend2': Deze worden gebruikt om instellingen te scheiden in tabbladen.

### Naamgeving Blokken

De conventie voor bloknamen is dat de servicenaam (bijv. mijn.example.blok. y*blok hierboven) zal worden gebruikt als de taalsleutel door de stippen (.) te vervangen door de underscore (*) (e.g MY_EXAMPLE_BLOCK_MY_BLOCK).

### Vertaling

Merk ook op dat we meerdere taalsleutels hebben die moeten worden vertaald. Maak hiervoor een bestand aan met de naam "blocks_admin.php" in je taalmap. Dit bestand wordt automatisch geladen bij het bewerken van blokken, en moet vertalingen hebben voor uw blokinstellingen en bloknamen.

```
$lang = array_merge($lang, array(
    'SOME_LANG_VAR' => 'Optie 1',
    'OTHER_LANG_VAR' => 'Optie 2',
    'SOME_LANG_VAR_1' => 'Instelling 1',
....
    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Mijn blok',
);
```

Omdat 'blocks_admin.php' alleen geladen is bij het bewerken van blokken, moet je andere vertalingen toevoegen (bijv. blok titel) door het laden van een taalbestand in je weergavemethode zoals `$language->add_lang('my_lang_file', 'my/example');`

### Blok renderen

Het nieuwe blok wordt alleen weergegeven als het iets weergeeft. Je blok kan tekenreeksen als inhoud teruggeven, maar in de meeste gevallen heb je een sjabloon nodig om de inhoud te renderen. Om je blok te tonen met behulp van sjablonen, het blok moet een array retourneren dat de gegevens die je wilt doorgeven aan de template bevat en moet ook de `get_template` methode implementeren, zoals hieronder getoond:

```php
    /**
     * @inheritdoc
     */
    openbare functie get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        retourarray(
            'legend1' => 'TAB1',
            'some_setting' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'standaard' => array(), 'verklaren' => false),
        );
    }

    /**
     * {@inheritdoc}
     */
    openbare functie get_template()
    {
        return '@my_example/my_blok. tml';
    }

    /**
     * {@inheritdoc}
     */
    openbare functie weergave (array $data, $edit_mode = false)
    {
        als ($edit_mode)
        {
            // doe iets alleen in bewerkingsmodus
        }

        retourarray(
            'title' => 'MY_BLOCK_TITLE',
            'gegevens' => array(
                'some_var' => $data['settings']['some_setting'],
            ),
        );
}
```

Dan zou je stijl/alle/my_block.html of styles/prosilver/my_block.html bestand er ongeveer zo uit kunnen zien:

```
<p>Je hebt geselecteerd: {{ some_var }}</p>
```

Samenvattend je blok moet een array retourneren met een `titel` sleutel (voor de bloktitel) en een `content` toets (als het blok gewoon een string weergeeft en geen sjabloon gebruikt) of `data` sleutel (als het blok een template gebruikt, in dat geval moet u ook de `get_template` methode implementeren.

### Blokkeer Activa

Als je blok content (css/js) aan de pagina moet toevoegen, raad ik aan om de sitemaker [util class](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) daarvoor te gebruiken. Omdat er meer dan één exemplaar van hetzelfde blok op de pagina kan zijn of andere blokken kunnen hetzelfde materiaal toevoegen, de util klasse zorgt ervoor dat de activa alleen toegevoegde zijn.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/some. s',
                100 => '@my_example/assets/other. s', // stel prioriteit
            in ),
            'css' => array(
                '@my_example/assets/some. ss',
            )
));
```

De util class zal natuurlijk moeten worden toegevoegd aan uw servicedefinities in config.yml zoals so: `- '@blitze.sitemaker. tot'` en gedefinieerd in de constructor van uw blok `\blitze\sitemaker\services\util $util`.

En dat is het. We zijn klaar!
