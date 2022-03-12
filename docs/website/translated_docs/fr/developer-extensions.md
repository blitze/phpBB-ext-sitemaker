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

Au minimum, c'est tout ce dont vous avez besoin. Si vous allez en mode édition, vous devriez voir le bloc listé comme 'MY_EXAMPLE_BLOCK_MY_BLOCK' qui peut être déplacé et déposé sur n'importe quelle position de bloc. Mais ce bloc ne fait rien d'excitant. Il n'a pas de paramètres et ne traduit pas le nom du bloc. Rendons-le plus intéressant.

### Paramètres du bloc

Modifions nos blocs/mon_block. hp file and add a "get_config" method th at return an array with the keys being the block settings and the values being an array describing the settings like so:

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

La convention pour les noms de blocs est que le nom du service (par exemple mon.exemple.block. y*bloc ci-dessus) sera utilisé comme clé de langage en remplaçant les points (.) par trait de soulignement (*) (par exemple MY_EXAMPLE_BLOCK_MY_BLOCK).

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

Le nouveau bloc ne sera affiché que s'il rend quelque chose. Votre bloc peut retourner n'importe quelle chaîne de contenu mais dans la plupart des cas, vous avez besoin d'un modèle pour rendre votre contenu. Pour afficher votre bloc en utilisant des modèles, le bloc doit retourner un tableau qui contient les données que vous voulez passer au modèle et doit également implémenter la méthode `get_template` comme démontré ci-dessous :

```php
    /**
     * @inheritdoc
     */
    fonction publique get_config(table $settings)
    {
        $options = table(1 => 'SOME_LANG_VAR', 2 => 'AUTRE_LANG_VAR');
        retour tableau(
            'legend1' => 'TAB1',
            'some_setting' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'chaîne', 'type' => 'checkbox', 'options' => $options, 'default' => tableau(), 'expliquer' => faux),
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
    public function display(tableau $data, $edit_mode = false)
    {
        if ($edit_mode)
        {
            // ne fait quelque chose qu'en mode édition
        }

        return array(
            'title' => 'MY_BLOCK_TITLE',
            'data' => array(
                'some_var' => $data['settings']['some_setting'],
            ),
        );
}
```

Ensuite, votre fichier styles/all/my_block.html ou styles/prosilver/my_block.html pourrait ressembler à ceci :

    <p>Vous avez sélectionné : {{ some_var }}</p>
    

En résumé, votre bloc doit retourner un tableau avec une clé `titre` (pour le titre du bloc) et une clé `contenu` (si le bloc affiche juste une chaîne de caractères et n'utilise pas de modèle) ou une clé `de données` (si le bloc utilise un modèle, dans ce cas, vous devrez également implémenter la méthode `get_template`).

### Bloc d'actifs

Si votre bloc doit ajouter des assets (css/js) à la page, je vous recommande d'utiliser la classe [util du sitemaker](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) pour cela. Comme il peut y avoir plus d'une instance du même bloc sur la page, ou d'autres blocs pourraient être d'ajouter le même actif, la classe utilitaire s'assure que l'actif est seulement ajouté.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@mon_exemple/assets/une. s',
                100 => '@mon_exemple/assets/autre. s', // définit la priorité
            ),
            'css' => tableau(
                '@mon_exemple/assets/unes. ss',
            )
));
```

La classe utilitaire devra bien sûr être ajoutée à vos définitions de service dans config.yml comme suit: `- '@blitze.sitemaker. til'` et défini dans le constructeur de votre bloc `\blitze\sitemaker\services\util $util`.

Et c'est tout. Nous avons terminé !