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

Op een absoluut minimum, dat is alles wat je nodig hebt. Als je in de bewerkmodus gaat, moet je het blok zien dat wordt weergegeven als 'MY_EXAMPLE_BLOCK_MY_BLOCK' die kan worden gesleept en laten vallen op een blokpositie. Maar dit blok doet niets opwindends. It has no settings and does not translate the block name. Laten we het interessanter maken.

### Blokkeer instellingen

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

Dit wordt op dezelfde manier opgebouwd als phpBB de configuratie voor de bord-instellingen in de ACS-landen. U kunt meer voorbeelden zien hier [](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Als je een aangepast veldtype wilt, zie je hier een voorbeeld [](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' instelling).

Let op 'legend1' en 'legend2': Deze worden gebruikt om de instellingen te scheiden in tabbladen.

### Namaakblokken

The convention for block names is that the service name (e.g my.example.block.my*block above) will be used as the language key by replacing the dots (.) with underscore (*) (e.g MY_EXAMPLE_BLOCK_MY_BLOCK).

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

Het nieuwe blok zal alleen worden weergegeven als het iets rendert. Je blok kan een tekenreeks als inhoud retourneren, maar in de meeste gevallen heb je een sjabloon nodig om je inhoud te tonen. To render your block using templates, the block must return an array that holds the data that you want to pass to the template and must also implement the `get_template` method as demonstrated below:

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

### Blokkeer Assets

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