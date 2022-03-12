---
id: estensioni-sviluppatore
title: Estendi phpBB SiteMaker
---

Puoi estendere/modificare phpBB SiteMaker utilizzando [sostituzione del servizio](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [decorazione del servizio](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), e [phpBB's event system](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Puoi trovare una lista di eventi supportati [qui](./developer-events.md).

## Creazione di un blocco SiteMaker

Un blocco phpBB SiteMaker è semplicemente una classe che estende il blitze\sitemaker\services\blocks\driver\block class e restituisce un array dal metodo "display" con un 'title' e 'content'. Tocca a te tutto il resto. Per rendere il tuo blocco rilevabile da phpBB SiteMaker, dovrai dargli il tag "sitemaker.block".

Dire che abbiamo un'estensione con vendor/extension come mio/esempio. Per creare un blocco chiamato "my_block" per phpBB SiteMaker:

- Crea una cartella "blocchi"
- Crea il file my_block.php nella cartella dei blocchi con il seguente contenuto

```php
namespace mio\esempio\blocks;

usa blitze\sitemaker\services\blocks\driver\block;

classe my_block extends block
{
    /**
     * {@inheritdoc}
     */
    public function display(array $settings, $edit_mode = falso)
    {
        return array(
            'titolo' => 'mio titolo di blocco',
            'contenuto' => 'contenuto del mio blocco'
        );
    }
}
```

Quindi nel tuo file config.yml, aggiungi quanto segue:

```yml
servizi:

...

    mio.esempio.block.my_block:
        classe: my\example\blocks\my_block
        chiamate:
            - [set_name, [my.example.block.my_block]]
        tags:
            - { name: sitemaker.block }

    ....

```

Al minimo, è tutto quello che ti serve. Se vai in modalità modifica, dovresti vedere il blocco elencato come 'MY_EXAMPLE_BLOCK_MY_BLOCK' che può essere trascinato e trascinato in qualsiasi posizione di blocco. Ma questo blocco non fa nulla di eccitante. Non ha impostazioni e non traduce il nome del blocco. Rendiamolo più interessante.

### Impostazioni blocco

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

Questo è costruito nello stesso modo in cui phpBB costruisce la configurazione delle impostazioni di bordo in ACP. Puoi vedere altri esempi [qui](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Se vuoi un tipo di campo personalizzato, puoi vedere un esempio [qui](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type').

Avviso 'legend1' e 'legend2': sono usati per separare le impostazioni in schede.

### Blocchi associati

La convenzione per i nomi dei blocchi è che il nome del servizio (ad esempio my.example.block. y*block above) sarà usato come chiave della lingua sostituendo i punti (.) con underscore (*) (e.g MY_EXAMPLE_BLOCK_MY_BLOCK).

### Traduzione

Notiamo inoltre che abbiamo diverse chiavi linguistiche che devono essere tradotte. Per fare questo, crea un file denominato "blocks_admin.php" nella cartella della lingua. Questo file verrà caricato automaticamente quando modifichi i blocchi, e dovrebbe avere traduzioni per le impostazioni dei blocchi e i nomi dei blocchi.

    $lang = array_merge($lang, array(
        'SOME_LANG_VAR'     => 'Option 1',
        'OTHER_LANG_VAR'    => 'Option 2',
        'SOME_LANG_VAR_VAR_1'   => 'Setting 1',
        ....
        'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Mio blocco',
    );
    

Poiché 'blocks_admin.php' è caricato solo quando si modificano i blocchi, è necessario aggiungere altre traduzioni (es. titolo del blocco) caricando un file di lingua nel metodo di visualizzazione così `$language->add_lang('my_lang_file', 'my/example');`

### Rendering del blocco

Il nuovo blocco verrà visualizzato solo se sta producendo qualcosa. Il tuo blocco può restituire qualsiasi stringa come contenuto, ma nella maggior parte dei casi hai bisogno di un modello per visualizzare il tuo contenuto. Per rendere il tuo blocco usando i modelli, il blocco deve restituire un array che contiene i dati che si desidera passare al modello e deve anche implementare il metodo `get_template` come dimostrato di seguito:

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

    <p>Hai selezionato: {{ some_var }}</p>
    

In sintesi, il tuo blocco deve restituire un array con una chiave `title` (per il titolo del blocco) e una chiave `content` (se il blocco visualizza solo una stringa e non utilizza un modello) o una chiave `dati` (se il blocco utilizza un modello, in questo caso, dovrai anche implementare il metodo `get_template`).

### Blocca Asset

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