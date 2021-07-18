---
title: Utvide phpBB SiteMaker
sidebar_position: 1
---

Du kan utvide/endre phpBB SiteMaker ved hjelp av [tjeneste erstatting](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [servicedekorasjon](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), og [phpBB's hendelsessystem](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Du finner en liste over støttede hendelser [her](./events.md).

## Oppretter en SiteMaker-blokk

En phpBB SiteMaker blokk er ganske enkelt en klasse som utvider blitze\sitemaker\services\blocks\driver\block class og returnerer en array fra "display" metoden med en 'title' og 'content'. Alt annet i mellom er opp til deg. For å gjøre blokken din synlig av phpBB SiteMaker, må du gi den "sitemaker.block" -taggen.

Si at vi har en utvidelse med leverandør/utvidelse som min/eksempel. For å opprette en blokk kalt "my_block" for phpBB SiteMaker:

-   Opprett en "blocks" mappe
-   Lag filen my_block.php i blokkmappen med følgende innhold

```php
navneområde my\example\blocks;

bruk blitze\sitemaker\services\blocks\driver\block;

klasse my_block utvider blokk
{
    /**
     * {@inheritdoc}
     */
    public function display(array $settings $edit_mode = false)
    {
        returarray(
            'title' => 'min blokktittel',
            'content' => 'mitt blokkinnhold',
        );
    }
}
```

Så i din config.yml fil, legg til følgende:

```yml
Tjenester:

...

    mitt.example.block.my_block:
        klasse: mitt\example\blocks\my_block
        calls:
            - [set_name, [my.example.block.my_block]]
        koder:
            - { name: sitemaker.block }

....

```

På et bart minimum er alt du trenger. Hvis du går i redigeringsmodus, bør du se blokken listet som 'MY_EXAMPLE_BLOCK_MY_BLOCK' som kan dras og slippes på en hvilken som helst blokkposisjon. Men denne blokken gjør ikke noe spennende. Den har ingen innstillinger og har ikke oversette blokknavnet. La oss gjøre det mer interessant.

### Blokker innstillinger

La oss endre våre blokker/my_block. hp fil og legg til en "get_config" metode i å returnere en liste med tastene som blokkinnstillingene og verdiene som en liste beskriver innstillinger som:

```php
    /**
     * @inheritdoc
     */
    offentlig funksjon get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        returarray(
            'legend1' => 'TAB1',
            'checkbox' => array('lang' => 'SOME_LANG_VAR_1', 'valider' => 'streng', 'type' => 'avkrysningsboks', 'valg' => $options, 'standard' => matrise(), 'Forklarer' => false),
            'yes_no' => array('lang' => 'SOME_LANG_VAR_2', 'validere' => 'bool', 'type' => 'radio:yes_no', 'Forklarer' => false, 'default' => usann),
            'radio' => array('lang' => 'SOME_LANG_VAR_3', 'valider' => 'bool', 'type' => 'radio', 'valg' => $options, 'Forklarer' => usann, 'default' => 'emne'),
            'valg' => array('lang' => 'SOME_LANG_VAR_4', 'valider' => 'string', 'type' => 'select', 'valg' => $options, 'default' => '', 'Forklarer' => usann),
            'multi' => array('lang' => 'SOME_LANG_VAR_5', 'valider' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'Forklarer' => usann),
            'legend2' => 'TAB2',
            'nummer' => array('lang' => 'SOME_LANG_VAR_6', 'Godkjenn' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'Forklarer' => feil, 'standard' => 5),
            'textarea' => array('lang' => 'SOME_LANG_VAR_7', 'valider' => 'string', 'type' => 'tekstfelt:3:40', 'makslengde' => 2, 'Forklarer' => sann, 'standard' => ''),
            «aktiverbar» => array('lang' => 'SOME_TOGGLABLE_VAR', 'valider' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options, 'standard' => '', 'lagt til' => '<div id="toggle_key-1">Vis bare når valg 1 er valgt</div>'),

}
```

Denne er konstruert på samme måte som phpBB bygger konfigurasjonen for bordinnstillinger i ACP. Du kan se flere eksempler [her](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Dersom du ønsker en egendefinert felttype, kan du se et eksempel [her](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type'-innstillingen.

Merk 'legend1' og 'legend2': Disse blir brukt til å skille innstillingene i faner.

### Navngi blokker

Konvensjonen om blokknavn er at tjenestenavnet (f.eks my.example.block. y*blokk ovenfor) vil bli brukt som språkkode ved å erstatte prikkene (.) med understreking (*) (f.eks MY_EXAMPLE_BLOCK_MY_BLOCK).

### Oversettelse

Legg også merke til at vi har flere språknøkler som må oversettes. For å gjøre dette, må du opprette en fil som heter "blocks_admin.php" i språkmappen. Denne filen vil automatisk bli lastet når du redigerer blokker, og bør ha oversettelser for blokkene innstillingene og blokkér navn.

```
$lang = array_merge($lang, array(
    'SOME_LANG_VAR' => 'Alternativ 1',
    'OTHER_LANG_VAR' => 'Alternativ 2',
    'SOME_LANG_VAR_1' => 'Innstilling 1',
....
    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Min blokk',
);
```

Fordi 'blocks_admin.php' bare er lastet inn når du redigerer blokker, må du legge til andre oversettelser (f.eks. blokk tittel) ved å laste en språkfil i din visningsmetode så `$language->add_lang('my_lang_file', 'mitt/eksempel');`

### Gjengir blokken

Den nye blokken vises bare hvis den gjengir noe. Blokken din kan returnere en streng som innhold, men du trenger i de fleste tilfeller en mal for å gjengi innholdet. For å gjengi blokka din bruk av maler, blokken må returnere en liste med dataene du vil sende til malen, og også implementere `get_template` metoden som vist nedenfor:

```php
    /**
     * @inheritdoc
     */
    offentlig funksjon get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        returarray(
            'legend1' => 'TAB1',
            'some_setting' => array('lang' => 'SOME_LANG_VAR_1', 'valider' => 'streng', 'type' => 'avkrysningsboks', 'valg' => $options, 'standard' => matrise(), 'forklarende' => false),
        );
    }

    /**
     * {@inheritdoc}
     */
    offentlige funksjoner get_template()
    {
        return '@my_example/my_block. tml';
    }

    /**
     * {@inheritdoc}
     */
    public function display(array $data, $edit_mode = false)
    {
        hvis ($edit_mode)
        {
            // gjør noe bare i redigeringsmodus
        }

        returarray(
            'title' => 'MY_BLOCK_TITLE',
            'data' => array(
                'some_var' => $data['settings']['some_setting'],
            ),
        );
}
```

Deretter kan dine stiler/all/my_block.html eller styles/prosilver/my_block.html se omtrent slik ut:

```
<p>Du valgte: {{ some_var }}</p>
```

Kort fattet, blokken må returnere en liste med en `tittel` tast (for blokktittelen) og en `innhold` nøkkel (hvis blokken akkurat viser en streng og ikke bruker en mal) eller en `data` nøkkel (hvis blokken bruker en mal i så fall må du også implementere metoden, `get_template`).

### Blokker Eiendeler

Hvis blokken din trenger å legge til eiendeler (css/js) til siden, anbefaler jeg å bruke sitemaker [util klasse](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) for det. Siden det kan være mer enn én forekomst av samme blokk på siden, eller andre blokker kan legge til samme aktivum, util klassen sikrer at aktivumet bare blir lagt til.

```php
        $this->benytt->add_assets(array(
            'js' => array(
                '@my_example/assets/som. s',
                100 => '@my_example/assets/other. s', // sett prioritet
            ),
            'css' => array(
                '@my_example/assets/som. s',
            )
));
```

Selvsagt må util klassen dine legges til i tjenestedefinisjonene dine i config.yml: `- '@blitze.sitemaker. til'` og definert i din blokks konstruktør `\blitze\sitemaker\services\util $util`.

Og det er det. Vi er ferdig!
