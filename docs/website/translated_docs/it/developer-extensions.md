---
id: estensioni-sviluppatore
title: Estendi phpBB SiteMaker
---

Puoi estendere/modificare phpBB SiteMaker utilizzando [sostituzione del servizio](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [decorazione del servizio](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), e [phpBB's event system](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Puoi trovare una lista di eventi supportati [qui](./developer-events.md).

## Creazione di un blocco SiteMaker

Un blocco phpBB SiteMaker è semplicemente una classe che estende il blitze\sitemaker\services\blocks\driver\block class e restituisce un array dal metodo "display" con un 'title' e 'content'. Tocca a te tutto il resto. Per rendere il tuo blocco rilevabile da phpBB SiteMaker, dovrai dargli il tag "sitemaker.block".

Dire che abbiamo un'estensione con vendor/extension come mio/esempio. Per creare un blocco chiamato "my_block" per phpBB SiteMaker:

* Crea una cartella "blocchi"
* Crea il file my_block.php nella cartella dei blocchi con il seguente contenuto

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

Modifichiamo il nostro file blocchi/my_block.php e aggiungiamo un metodo "get_config" che restituisce un array con le chiavi che sono le impostazioni del blocco e i valori sono un array che descrive le impostazioni come così:

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

Questo è costruito nello stesso modo in cui phpBB costruisce la configurazione delle impostazioni di bordo in ACP. Puoi vedere altri esempi [qui](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Se vuoi un tipo di campo personalizzato, puoi vedere un esempio [qui](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type').

Avviso 'legend1' e 'legend2': sono usati per separare le impostazioni in schede.

### Blocchi associati

La convenzione per i nomi dei blocchi è che il nome del servizio (es. my.esempio.block.my_block sopra) verrà utilizzato come chiave linguistica sostituendo i punti (.) con underscore (_) (es. MY_EXAMPLE_BLOCK_MY_BLOCK).

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

Il nuovo blocco verrà visualizzato solo se sta producendo qualcosa. Il tuo blocco può restituire qualsiasi stringa come contenuto, ma nella maggior parte dei casi hai bisogno di un modello per visualizzare il tuo contenuto. Per visualizzare il tuo blocco utilizzando i modelli, la classe di blocco eredita una proprietà 'ptemplate'. Quindi il metodo di visualizzazione potrebbe assomigliare a questo:

```php
    /**
     * {@inheritdoc}
     * /
    public function display(array $data, $edit_mode = false)
    {
        if ($edit_mode)
        {
            // fai qualcosa solo in modalità di modifica
        }

        $this->ptemplate->assign_vars(array(
            'SOME_VAR' => $data['settings']['checkbox']
        ));

        array di restituzione(
            'titolo' => 'MY_BLOCK_TITLE',
            'contenuto' => $this->template->render_view('io/esempio', 'my_block. tml', 'mi_block'),
        );
}
```

### Blocca Asset

Se il tuo blocco deve aggiungere risorse (css/js) alla pagina, raccomando di utilizzare la sitemaker [utilizza la classe](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) per questo. Poiché ci possono essere più di un'istanza dello stesso blocco nella pagina, o altri blocchi potrebbero aggiungere lo stesso asset, la classe di utilizzo garantisce che l'asset sia solo aggiunto.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/alcuni. s',
                100 => '@my_example/assets/altro. s', // imposta priorità
            ),
            'css' => array(
                '@my_example/assets/alcuni. ss',
            )
));
```

La classe di utilizzo, ovviamente, dovrà essere aggiunta alle definizioni di servizio nel config.yml così: `- '@blitze.sitemaker.util'` e definita nel costruttore del tuo blocco `\blitze\sitemaker\services\util $util`.

Ed è tutto. Abbiamo finito!