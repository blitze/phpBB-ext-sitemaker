---
title: Estendere phpBB SiteMaker
sidebar_position: 1
---

È possibile estendere / modificare phpBB SiteMaker utilizzando [service replacement](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [service decoration](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), e [phpBB event system](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Puoi trovare una lista di eventi supportati [qui](./events.md).

## Creare un blocco SiteMaker

Un blocco phpBB SiteMaker è semplicemente una classe che estende la classe blitze\sitemaker\services\blocks\driver\block e restituisce un array dal metodo "display" con un 'title' e 'content'. Tutto il resto intra dipende da te. Per rendere il tuo blocco scopribile da phpBB SiteMaker, dovrai dargli il tag "sitemaker.block".

Diciamo che abbiamo un'estensione con vendor/extension come mio/esempio. Per creare un blocco chiamato "my_block" per phpBB SiteMaker:

-   Crea una cartella "blocchi"
-   Crea file my_block.php nella cartella dei blocchi con il seguente contenuto

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
            'title' => 'my block title',
            'contenuto' => 'contenuto del mio blocco',
        );
    }
}
```

Quindi nel tuo file config.yml, aggiungi quanto segue:

```yml
servizi:

...

    my.example.block.my_block:
        class: my\example\blocks\my_block
        calls:
            - [set_name, [my.example.block.my_block]]
        tags:
            - { name: sitemaker.block }

....

```

Al minimo nudo è tutto quello che ti serve. Se si entra in modalità modifica, si dovrebbe vedere il blocco elencato come 'MY_EXAMPLE_BLOCK_MY_BLOCK' che può essere trascinato e lasciato cadere in qualsiasi posizione di blocco. Ma questo blocco non fa nulla di eccitante. Non ha impostazioni e non traduce il nome del blocco. La rendiamo più interessante.

### Impostazioni Blocco

Modifichiamo i nostri blocchi/mio_blocco. hp file e aggiungere un metodo "get_config" th a restituisce un array con le chiavi che sono le impostazioni del blocco e i valori che sono un array che descrive le impostazioni in questo modo:

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        return array(
            'legend1' => 'TAB1',
            'checkbox' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'spiegare' => falso),
            'sì_no' => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
            'radio' => array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'spiegare' => falso, 'default' => 'topic'),
            'select' => array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', 'spiegare' => falso),
            'multi' => array('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'explain' => false),
            'legend2' => 'TAB2',
            'number' => array('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
            'textarea' => array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),
            'togglable' => array('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options, 'default' => '', 'append' => '<div id="toggle_key-1">Mostra solo quando è selezionata l'opzione 1</div>'),
        );
}
```

Questo è costruito nello stesso modo in cui phpBB costruisce la configurazione per le impostazioni della scheda in ACP. Puoi vedere altri esempi [qui](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Se si desidera un tipo di campo personalizzato, si può vedere un esempio [qui](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' impostazione).

Nota 'legend1' e 'legend2': questi sono usati per separare le impostazioni in schede.

### Blocchi Naming

La convenzione per i nomi dei blocchi è che il nome del servizio (ad esempio my.example.block. y*block above) sarà usato come chiave della lingua sostituendo i punti (.) con underscore (*) (e.g MY_EXAMPLE_BLOCK_MY_BLOCK).

### Traduzione

Notate anche che abbiamo diverse chiavi di lingua che devono essere tradotte. Per fare questo, creare un file chiamato "blocks_admin.php" nella cartella della lingua. Questo file verrà caricato automaticamente quando si modificano i blocchi, e dovrebbe avere traduzioni per le impostazioni dei blocchi e i nomi dei blocchi.

```
$lang = array_merge($lang, array(
    'SOME_LANG_VAR' => 'Opzione 1',
    'OTHER_LANG_VAR' => 'Opzione 2',
    'SOME_LANG_VAR_1' => 'Setting 1',
....
    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'My Block',
);
```

Poiché 'blocks_admin.php' è caricato solo quando si modificano i blocchi, è necessario aggiungere altre traduzioni (ad es. titolo del blocco) caricando un file di lingua nel tuo metodo di visualizzazione come `$language->add_lang('my_lang_file', 'my/example');`

### Rendering del blocco

Il nuovo blocco verrà visualizzato solo se sta rendendo qualcosa. Il tuo blocco può restituire qualsiasi stringa come contenuto, ma nella maggior parte dei casi hai bisogno di un modello per rendere i tuoi contenuti. Per rendere il tuo blocco usando i modelli, il blocco deve restituire un array che contiene i dati che si desidera passare al modello e deve anche implementare il metodo `get_template` come dimostrato di seguito:

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        return array(
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

Quindi i tuoi styles/all/my_block.html o styles/prosilver/my_block.html file potrebbero assomigliare a questo:

```
<p>Hai selezionato: {{ some_var }}</p>
```

In sintesi, il tuo blocco deve restituire un array con una chiave `title` (per il titolo del blocco) e una chiave `content` (se il blocco visualizza solo una stringa e non utilizza un modello) o una chiave `dati` (se il blocco utilizza un modello, in questo caso, dovrai anche implementare il metodo `get_template`).

### Blocca Attività

Se il tuo blocco ha bisogno di aggiungere asset (css/js) alla pagina, ti consiglio di usare la sitemaker [util class](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) per questo. Dal momento che ci può essere più di un'istanza dello stesso blocco sulla pagina, o altri blocchi potrebbero essere l'aggiunta della stessa attività, la classe util assicura che l'asset è solo aggiunto.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/some. s',
                100 => '@my_example/assets/other. s', // imposta priorità
            ),
            'css' => array(
                '@my_example/assets/some. s',
            )
));
```

La classe util dovrà, ovviamente, essere aggiunta alle definizioni del servizio in config.yml così: `- '@blitze.sitemaker. til'` e definito nel costruttore del blocco `\blitze\sitemaker\services\util $util`.

E questo è tutto. Abbiamo finito!
