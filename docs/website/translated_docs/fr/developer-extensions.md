---
id: développeurs-extensions
title: Extension du siteMaker phpBB
---

Vous pouvez étendre/modifier phpBB SiteMaker en utilisant [remplacement de service](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [décoration de service](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), et [système d'événement phpBB](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Vous pouvez trouver une liste des événements supportés ici [](./developer-events.md).

## Création d'un bloc SiteMaker

Un bloc SiteMaker phpBB est simplement une classe qui étend la classe blitze\sitemaker\services\blocks\driver\block class et retourne un tableau de la méthode "display" avec un "title" et "content". Tout le reste inbetween est à vous. Pour rendre votre bloc accessible par phpBB SiteMaker, vous devrez lui donner la balise "sitemaker.block".

Dites que nous avons une extension avec vendor/extension comme mon/exemple. Pour créer un bloc appelé "my_block" pour phpBB SiteMaker :

- Créer un dossier "blocs"
- Créer mon fichier_block.php dans le dossier blocks avec le contenu suivant

```php
espace de noms mon\example\blocks;

utilisez blitze\sitemaker\services\blocks\driver\block;

classe my_block extends bloc
{
    /**
     * {@inheritdoc}
     */
    public function display(table $settings, $edit_mode = false)
    {
        return array(
            'title' => 'my block title',
            'content' => 'mon contenu bloc',
        );
    }
}
```

Ensuite, dans votre fichier config.yml, ajoutez les éléments suivants :

```yml
services :

    ...

    mon.exemple.block.my_block :
        classe : mon\exemple\blocs\my_block
        appelle :
            - [set_name, [my.example.block.my_block]]
        tags :
            - { name: sitemaker.block }

    ....

```

Au minimum, c'est tout ce dont vous avez besoin. Si vous allez en mode édition, vous devriez voir le bloc listé comme 'MY_EXAMPLE_BLOCK_MY_BLOCK' qui peut être déplacé et déposé sur n'importe quelle position de bloc. Mais ce bloc ne fait rien d'excitant. It has no settings and does not translate the block name. Rendons-le plus intéressant.

### Paramètres du bloc

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

Cela est construit de la même manière que phpBB construit la configuration pour les réglages de conseil en ACP. Vous pouvez voir d'autres exemples [ici](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Si vous voulez un type de champ personnalisé, vous pouvez voir un exemple [ici](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' paramètre).

Notice 'legend1' and 'legend2' : These are used to separate the settings into tabs.

### Nommer les blocs

The convention for block names is that the service name (e.g my.example.block.my*block above) will be used as the language key by replacing the dots (.) with underscore (*) (e.g MY_EXAMPLE_BLOCK_MY_BLOCK).

### Traduction

Notez également que nous avons plusieurs clés de langue qui doivent être traduites. Pour cela, créez un fichier nommé "blocks_admin.php" dans votre dossier de langue. Ce fichier sera automatiquement chargé lors de l'édition de blocs, et devrait avoir des traductions pour les paramètres de blocs et les noms de blocs.

    $lang = array_merge($lang, array(
        'SOME_LANG_VAR'     => 'Option 1',
        'OTHER_LANG_VAR'    => 'Option 2',
        'SOME_LANG_VAR_1'  => 'Réglage 1',
        ....
        'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Mon bloc',
    );
    

Comme 'blocks_admin.php' n'est chargé que lors de l'édition de blocs, vous devrez ajouter d'autres traductions (par exemple le titre du bloc) en chargeant un fichier de langue dans votre méthode d'affichage comme ainsi ' `$language->add_lang('my_lang_file', 'my/example');`

### Rendre le bloc

Le nouveau bloc ne sera affiché que s'il rend quelque chose. Votre bloc peut retourner n'importe quelle chaîne de contenu mais dans la plupart des cas, vous avez besoin d'un modèle pour rendre votre contenu. To render your block using templates, the block must return an array that holds the data that you want to pass to the template and must also implement the `get_template` method as demonstrated below:

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

### Bloc d'actifs

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