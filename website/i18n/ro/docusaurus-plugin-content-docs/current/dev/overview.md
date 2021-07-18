---
title: Extindere fpBB SiteMaker
sidebar_position: 1
---

Puteți extinde/modifica phpBB SiteMaker folosind [înlocuirea serviciului](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [decor serviciu](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), și [sistemul de evenimente phpBB](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Poți găsi o listă de evenimente acceptate [aici](./events.md).

## Crearea unui bloc SiteMaker

Un bloc phpBB SiteMaker este pur și simplu o clasă care extinde blitze\sitemaker\services\blocks\driver\block class și returnează un array din metoda "display" cu 'title' și 'content'. Orice altceva între tine depinde de tine. Pentru a face blocul tău să poată fi descoperit de către phpBB SiteMaker, va trebui să-i dai eticheta "sitemaker.block".

Spune că avem o extensie cu vânzător/extensie ca exemplu/exemplu. Pentru a crea un bloc numit "my_block" pentru phpBB SiteMaker:

-   Creați un dosar "blocuri"
-   Creaza fisierul my_block.php in folderul blocurilor cu urmatorul continut

```php
namespace me\exemplu\blocks;

folosește blitze\sitemaker\services\blocks\driver\block;

clasa my_block extinde blocul
{
    /**
     * {@inheritdoc}
     */
    functie publica display(array $settings, $edit_mode = false)
    {
        return array(
            'title' => 'titlul blocului meu',
            'conținut' => 'Conținutul meu de bloc',
        );
    }
}
```

Apoi in fisierul config.yml, adauga urmatoarele:

```yml
servicii:

...

    my.example.block.my_block:
        class: my\example\blocks\my_block
        apeluri:
            - [set_name, [my.example.block.my_block]]
        etichete:
            - { name: sitemaker.block }

....

```

La un nivel minim, asta e tot ce ai nevoie. Dacă mergeți în modul de editare, trebuie să vedeți blocul listat ca 'MY_EXAMPLE_BLOCK_MY_BLOCK' care poate fi mutat și scăpat pe orice poziție de bloc. Dar acest bloc nu face nimic captivant. Nu are setări și nu traduce numele blocului. Hai să-l facem mai interesant.

### Setări Bloc

Hai să ne modificăm blocurile/blocurile. hp fişier şi adaugă o metodă "get_config" la returnează un array cu tastele fiind setările blocului şi valorile fiind un array care descrie setările astfel:

```php
    /**
     * @inheritdoc
     */
    funcție publică get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        return array(
            'legend1' => 'TAB1',
            'casetă' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'implicit' => array(, 'explain' => false),
            'yes_no' => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
            'radio' => array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'explică' => false, 'implicit' => 'subiect'),
            'select' => array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', 'explică' => false),
            'multi' => array('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'opțiuni' => $options, 'implicit' => array(), 'explicați' => false),
            'legendă2' => 'TAB2',
            'număr' => array('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'implicit' => 5),
            'zona text' => array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'implicit' => ''),
            'togglable' => array('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options, 'implicit' => '', 'append' => '<div id="toggle_key-1">Arată numai când opțiunea 1 este selectată</div>'),
        );
}
```

Aceasta este construită în acelaşi mod în care phpBB construieşte configuraţia pentru setările de secţiune în ACP. Mai multe exemple [aici](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Dacă doriţi un tip de câmp personalizat, puteţi vedea un exemplu [aici](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) (setarea ('content_type').

Observați 'legend1' și 'legend2': Acestea sunt folosite pentru a separa setările în file.

### Blocuri de nume

Convenţia pentru numele blocului este că numele serviciului (de ex. my.example.block. y*blocul de mai sus) va fi folosit ca tasta de limbă prin înlocuirea punctelor (.) cu underscore (*(ex. MY_EXAMPLE_BLOCK_MY_BLOCK).

### Traducere

Observați de asemenea că avem mai multe chei lingvistice care trebuie traduse. Pentru a face acest lucru, creați un fișier numit "blocks_admin.php" în folderul de limbă. Acest fisier va fi incarcat automat la editarea blocurilor, si ar trebui sa aiba traduceri pentru setarile blocurilor si numele blocurilor.

```
$lang = array_merge($lang, array(
    'SOME_LANG_VAR' => 'Opțiunea 1',
    'OTHER_LANG_VAR' => 'Opțiunea 2',
    'SOME_LANG_VAR_1' => 'Setting 1',
....
    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Blocul meu',
);
```

Deoarece 'blocks_admin.php' este încărcat doar când editezi blocuri, va trebui să adaugi alte traduceri (de ex. blochează titlul) prin încărcarea unui fișier de limbă în metoda afișată ca `$language->add_lang('my_lang_file', 'my/exemplu');`

### Redare bloc

Noul bloc va fi afișat doar în cazul în care randează ceva. Blocul tău poate returna orice șir de caractere ca conținut, dar în majoritatea cazurilor, ai nevoie de un șablon pentru a reda conținutul tău. Pentru a reda blocul tău folosind șabloane, blocul trebuie să returneze un array care conține datele pe care doriți să le transmiteți la șablon și trebuie, de asemenea, să implementeze metoda `get_template` după cum se arată mai jos:

```php
    /**
     * @inheritdoc
     */
    funcție publică get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        return array(
            'legend1' => 'TAB1',
            'setting' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explain' => false),
        );
    }

    /**
     * {@inheritdoc}
     */
    funcție publică get_template()
    {
        return '@my_example/my_block. tml';
    }

    /**
     * {@inheritdoc}
     */
    display(array $data, $edit_mode = false)
    {
        if ($edit_mode)
        {
            // face ceva numai în modul de editare
        }

        return array(
            'title' => 'MY_BLOCK_TITLE',
            'data' => array(
                'some_var' => $data['settings']['some_setting'],
            ),
        );
}
```

Apoi fişierul styles/all/my_block.html sau styles/prosilver/my_block.html ar putea arăta astfel:

```
<p>Ai selectat: {{ some_var }}</p>
```

Pe scurt, blocul tău trebuie să returneze un array cu o cheie `titlu` (pentru titlul blocului) și o tastă `conținut` (dacă blocul doar afișează un șir de caractere și nu folosește un șablon) sau o cheie `de date` (dacă blocul folosește un șablon, caz în care va trebui de asemenea să implementați metoda `get_template`).

### Blochează active

În cazul în care blocul dvs. trebuie să adauge active (css/js) la pagină, vă recomand să folosiți sitemaker [util clasa](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) pentru asta. Deoarece pot exista mai multe instanțe ale aceluiași bloc pe pagină, sau alte blocuri ar putea adăuga același activ, clasa util asigură că activul este adăugat doar unu.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/unele. s',
                100 => '@my_example/assets/other. s', // setează prioritatea
            ),
            'css' => array(
                '@my_example/assets/unele. ss',
            )
));
```

Clasa util va trebui, desigur, să fie adăugată la definițiile serviciului în config.yml astfel: `- '@blitze.sitemaker. til'` și definit în constructorul blocului `\blitze\sitemaker\services\util $util`.

Şi asta e tot. Am terminat!
