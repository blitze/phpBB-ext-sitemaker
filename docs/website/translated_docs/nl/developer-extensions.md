---
id: ontwikkelaar-extensies
title: Extensie phpBB SiteMaker
---

U kunt phpBB SiteMaker verlengen/wijzigen door [service vervangen](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [service decoratie](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration)en [phpBB's event system](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). U kunt hier een lijst van ondersteunde gebeurtenissen vinden [hier](./developer-events.md).

## Een SiteMaker blok maken

Een phpBB SiteMaker blok is simpelweg een klasse die de blitze\sitemaker\services\blocks\driver\block class en geeft een array terug van de "display" methode met een 'titel' en 'inhoud'. Al het andere inbetween is aan u. Om je blok te laten ontdekken door phpBB SiteMaker, moet je het de "sitemaker.block" tag geven.

Zeg dat we een extensie hebben met vendor/extension als mijn/voorbeeld. Om een blok te maken genaamd "mijn_blok" voor phpBB SiteMaker:

* Maak een "blokken" map
* Maak mijn_block.php bestand aan in de blokken map met de volgende inhoud

```php
namespace my\example\blocks;

use blitze\sitemaker\services\blocks\driver\block;

class my_block extends block
{
    /**
     * {@inheritdoc}
     */
    public function display(array $settings, $edit_mode = false)
    {
        return array(
            'title'     => 'my block title',
            'content'   => 'my block content',
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

Op een absoluut minimum, dat is alles wat je nodig hebt. Als je in de bewerkmodus gaat, moet je het blok zien dat wordt weergegeven als 'MY_EXAMPLE_BLOCK_MY_BLOCK' die kan worden gesleept en laten vallen op een blokpositie. Maar dit blok doet niets opwindends. Het heeft geen instellingen en vertaalt de bloknaam niet. Laten we het interessanter maken.

### Blokkeer instellingen

Laten we onze blokken/my_block.php bestand wijzigen en een "get_config" methode toevoegen die een array retourneert met de sleutels als de blokinstellingen en de waarden zijn een array die de instellingen beschrijft zoals:

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

Dit wordt op dezelfde manier opgebouwd als phpBB de configuratie voor de bord-instellingen in de ACS-landen. U kunt meer voorbeelden zien hier [](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Als je een aangepast veldtype wilt, zie je hier een voorbeeld [](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' instelling).

Let op 'legend1' en 'legend2': Deze worden gebruikt om de instellingen te scheiden in tabbladen.

### Namaakblokken

De conventie voor bloknamen is dat de servicenaam (bijv. mijn.voorbeeld.block.my_block hierboven) zal worden gebruikt als taalsleutel door de punten (.) te vervangen door een underscore (_) (bijv. MY_EXAMPLE_BLOCK_MY_BLOCK).

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

Het nieuwe blok zal alleen worden weergegeven als het iets rendert. Je blok kan een tekenreeks als inhoud retourneren, maar in de meeste gevallen heb je een sjabloon nodig om je inhoud te tonen. Om je blok te maken met sjablonen, erft de block class een 'aangenomen mplaat' eigenschap. De weergavemethode kan er dus zo uitzien:

```php
    /**
     * {@inheritdoc}
     */
    public function display(array $data, $edit_mode = false)
    {
        if ($edit_mode)
        {
            // do something only in edit mode
        }

        $this->ptemplate->assign_vars(array(
            'SOME_VAR'  => $data['settings']['checkbox'],
        ));

        return array(
            'title'     => 'MY_BLOCK_TITLE',
            'content'   => $this->ptemplate->render_view('my/example', 'my_block.html', 'my_block'),
        );
    }
```

### Blokkeer Assets

Als je blok assets (css/js) aan de pagina moet toevoegen, raad ik aan de sitemaker [util class](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) daarvoor te gebruiken. Aangezien er meer dan één exemplaar van hetzelfde blok op de pagina kan zijn, of andere blokken mogelijk dezelfde asset toevoegen, zorgt de util class ervoor dat het bestand alleen maar toegevoegd wordt.

```php
        $this->gebruiks->add_assets(array(
            'js' => array(
                'my_example/assets/sommen. s',
                100 => '@my_voorbeeld/assets/anderen. s', // stel prioriteit
            in,
            'css' => array(
                '@my_voorbeeld/assets/sommen. ss',
            )
;
```

De util class zal natuurlijk moeten worden toegevoegd aan uw service definities in config.yml zoals zo: `- '@blitze.sitemaker.util'` en gedefinieerd in uw blok constructor `\blitze\sitemaker\services\util $util`.

En dat is het. We zijn klaar!