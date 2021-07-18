---
id: ontwikkelaar-extensies
title: Extensie phpBB SiteMaker
---

U kunt phpBB SiteMaker verlengen/wijzigen door [service vervangen](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [service decoratie](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration)en [phpBB's event system](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). U kunt hier een lijst van ondersteunde gebeurtenissen vinden [hier](./developer-events.md).

## Een SiteMaker blok maken

Een phpBB SiteMaker blok is simpelweg een klasse die de blitze\sitemaker\services\blocks\driver\block class en geeft een array terug van de "display" methode met een 'titel' en 'inhoud'. Al het andere inbetween is aan u. Om je blok te laten ontdekken door phpBB SiteMaker, moet je het de "sitemaker.block" tag geven.

Zeg dat we een extensie hebben met vendor/extension als mijn/voorbeeld. Om een blok te maken genaamd "mijn_blok" voor phpBB SiteMaker:

- Maak een "blokken" map
- Maak mijn_block.php bestand aan in de blokken map met de volgende inhoud

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

Vervolgens in uw config.yml bestand, voeg het volgende toe:

```yml
services:

...

    mijn.example.block.my_block:
        klasse: mijn\voorbeeld\blokken\my_block
        oproepen:
            - [set_name, [my.example.block.my_block]]
        tags:
 { name: sitemaker.block }

....

```

Op een absoluut minimum, dat is alles wat je nodig hebt. Als je in de bewerkmodus gaat, moet je het blok zien dat wordt weergegeven als 'MY_EXAMPLE_BLOCK_MY_BLOCK' die kan worden gesleept en laten vallen op een blokpositie. Maar dit blok doet niets opwindends. Het heeft geen instellingen en vertaalt de naam van het blok niet. Laten we het interessanter maken.

### Blokkeer instellingen

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

Dit wordt op dezelfde manier opgebouwd als phpBB de configuratie voor de bord-instellingen in de ACS-landen. U kunt meer voorbeelden zien hier [](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Als je een aangepast veldtype wilt, zie je hier een voorbeeld [](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' instelling).

Let op 'legend1' en 'legend2': Deze worden gebruikt om de instellingen te scheiden in tabbladen.

### Namaakblokken

De conventie voor bloknamen is dat de servicenaam (bijv. mijn.example.blok. y*blok hierboven) zal worden gebruikt als de taalsleutel door de stippen (.) te vervangen door de underscore (*) (e.g MY_EXAMPLE_BLOCK_MY_BLOCK).

### Vertaling

Ook merken we dat we verschillende taalsleutels hebben die vertaald moeten worden. Om dit te doen, maak een bestand genaamd "blokken_admin.php" in uw taalmap. Dit bestand zal automatisch worden geladen bij het bewerken van blokken, en moet vertalingen hebben voor uw blokinstellingen en bloknamen.

    $lang = array_merge($lang, array(
        'SOME_LANG_VAR'   => 'Option 1',
        'OTHER_LANG_VAR'    => 'Optie 2',
        'SOME_LANG_VAR_1' => 'Instelling 1',
    ....
        'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Mijn Blok',
    )
    

Omdat 'blokken_admin.php' alleen geladen is bij het bewerken van blokken, moet je andere vertalingen toevoegen (bijvoorbeeld block title) door het laden van een taalbestand in je weergavemethode zoals `$language->add_lang('lang_file', 'my/example');`

### Het blok renderen

Het nieuwe blok zal alleen worden weergegeven als het iets rendert. Je blok kan een tekenreeks als inhoud retourneren, maar in de meeste gevallen heb je een sjabloon nodig om je inhoud te tonen. Om je blok te tonen met behulp van sjablonen, het blok moet een array retourneren dat de gegevens die je wilt doorgeven aan de template bevat en moet ook de `get_template` methode implementeren, zoals hieronder getoond:

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

    <p>Je hebt geselecteerd: {{ some_var }}</p>
    

Samenvattend je blok moet een array retourneren met een `titel` sleutel (voor de bloktitel) en een `content` toets (als het blok gewoon een string weergeeft en geen sjabloon gebruikt) of `data` sleutel (als het blok een template gebruikt, in dat geval moet u ook de `get_template` methode implementeren.

### Blokkeer Assets

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