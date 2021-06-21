---
id: extensiones-de-desarrollador
title: Extendiendo phpBB SiteMaker
---

Puedes extender/modificar phpBB SiteMaker usando [service replacement](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [service decoration](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), y [phpBB's event system](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Puedes encontrar una lista de eventos soportados [aquí](./developer-events.md).

## Creando un bloque de SiteMaker

Un bloque phpBB SiteMaker es simplemente una clase que extiende el blitze\sitemaker\services\blocks\driver\block class y devuelve una matriz del método "display" con un 'title' y 'content'. Todo lo demás intermedio depende de usted. Para hacer que su bloque sea detectable por phpBB SiteMaker, necesitará darle la etiqueta "sitemaker.block".

Digamos que tenemos una extensión con el proveedor/extensión como mi/ejemplo. Para crear un bloque llamado "my_block" para phpBB SiteMaker:

- Crear una carpeta "bloques"
- Crear archivo my_block.php en la carpeta de bloques con el siguiente contenido

```php
my\example\blocks;

use blitze\sitemaker\services\blocks\driver\block;

class my_block extends block
{
    /**
     * {@inheritdoc}
     */
    public function display(array $settings, $edit_mode = false)
    {
        return array(
            'title' => 'mi título de bloque',
            'content' => 'mi contenido de bloqueo',
        );
    }
}
```

Luego en tu archivo config.yml, añade lo siguiente:

```yml
servicios:

    ...

    my.example.block.my_block:
        class: my\example\blocks\my_block
        calls:
            - [set_name, [my.example.block.my_block]]
        tags:
            - { name: sitemaker.block }

    ....

```

Como mínimo, eso es todo lo que necesitas. Si entras en modo de edición, deberías ver el bloque listado como 'MY_EXAMPLE_BLOCK_MY_BLOCK' que se puede arrastrar y soltar en cualquier posición de bloque. Pero este bloque no hace nada emocionante. It has no settings and does not translate the block name. Hagámoslo más interesante.

### Bloquear ajustes

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

Esto se construye de la misma manera que phpBB construye la configuración para la configuración del tablero en ACP. Puedes ver más ejemplos [aquí](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Si desea un tipo de campo personalizado, puede ver un ejemplo [aquí](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' setting).

Aviso 'leyenda 1' y 'leyenda2': Estos se usan para separar los ajustes en pestañas.

### Nombrar bloques

The convention for block names is that the service name (e.g my.example.block.my*block above) will be used as the language key by replacing the dots (.) with underscore (*) (e.g MY_EXAMPLE_BLOCK_MY_BLOCK).

### Traducción

Tenga en cuenta que tenemos varias claves de idioma que necesitan ser traducidas. Para hacer esto, cree un archivo llamado "blocks_admin.php" en su carpeta de idioma. Este archivo se cargará automáticamente al editar bloques, y debería tener traducciones para la configuración de bloques y nombres de bloques.

    $lang = array_merge($lang, array(
        'SOME_LANG_VAR'     => 'Option 1',
        'OTHER_LANG_VAR'    => 'Option 2',
        'SOME_LANG_VAR_1'   => 'Setting 1',
        ....
        'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Mi Bloque',
    );
    

Debido a que 'blocks_admin.php' sólo se carga al editar bloques, necesitarás añadir otras traducciones (por ejemplo, título de bloque) cargando un archivo de idioma en tu método de visualización como `$language->add_lang('mi_lang_file', 'mi/ejemplo');`

### Renderizando el bloque

El nuevo bloque sólo se mostrará si está renderizando algo. Tu bloque puede devolver cualquier cadena como contenido pero en la mayoría de los casos, necesitas una plantilla para renderizar tu contenido. To render your block using templates, the block must return an array that holds the data that you want to pass to the template and must also implement the `get_template` method as demonstrated below:

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

### Bloquear activos

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