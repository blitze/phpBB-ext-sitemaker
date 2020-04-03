---
id: extensiones-de-desarrollador
title: Extendiendo phpBB SiteMaker
---

Puedes extender/modificar phpBB SiteMaker usando [service replacement](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [service decoration](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration), y [phpBB's event system](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Puedes encontrar una lista de eventos soportados [aquí](./developer-events.md).

## Creando un bloque de SiteMaker

Un bloque phpBB SiteMaker es simplemente una clase que extiende el blitze\sitemaker\services\blocks\driver\block class y devuelve una matriz del método "display" con un 'title' y 'content'. Todo lo demás intermedio depende de usted. Para hacer que su bloque sea detectable por phpBB SiteMaker, necesitará darle la etiqueta "sitemaker.block".

Digamos que tenemos una extensión con el proveedor/extensión como mi/ejemplo. Para crear un bloque llamado "my_block" para phpBB SiteMaker:

* Crear una carpeta "bloques"
* Crear archivo my_block.php en la carpeta de bloques con el siguiente contenido

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

Como mínimo, eso es todo lo que necesitas. Si entras en modo de edición, deberías ver el bloque listado como 'MY_EXAMPLE_BLOCK_MY_BLOCK' que se puede arrastrar y soltar en cualquier posición de bloque. Pero este bloque no hace nada emocionante. No tiene ajustes y no traduce el nombre del bloque. Hagámoslo más interesante.

### Bloquear ajustes

Vamos a modificar nuestros bloques/my_block.php archivo y añadir un método "get_config" que devuelve una matriz con las claves siendo la configuración de bloque y los valores son una matriz que describe la configuración así:

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

La convención para los nombres de bloques es que el nombre del servicio (por ejemplo, my.example.block.my_block de arriba) será usado como clave de idioma reemplazando los puntos (.) con guión bajo (_) (por ejemplo MY_EXAMPLE_BLOCK_MY_BLOCK).

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

El nuevo bloque sólo se mostrará si está renderizando algo. Tu bloque puede devolver cualquier cadena como contenido pero en la mayoría de los casos, necesitas una plantilla para renderizar tu contenido. Para procesar su bloque usando plantillas, la clase de bloque hereda una propiedad 'ptemplate'. Así que el método de visualización puede parecer algo así:

```php
    /**
     * {@inheritdoc}
     */
    muestra la función pública (array $data, $edit_mode = false)
    {
        if ($edit_mode)
        {
            // hacer algo sólo en modo edición
        }

        $this->ptemplate->assign_vars(array(
            'SOME_VAR' => $data['settings']['checkbox'],
        ));

        return array(
            'title' => 'MY_BLOCK_TITLE',
            'content' => $this->ptemplate->render_view('mi/ejemplo', 'mi_bloque. tml', 'my_block'),
        );
}
```

### Bloquear activos

Si tu bloque necesita añadir activos (css/js) a la página, recomiendo usar el sitemaker [clase util](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) para eso. Dado que puede haber más de una instancia del mismo bloque en la página, u otros bloques podrían estar añadiendo el mismo activo, la clase util asegura que el activo sólo se añade.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/algunos. s',
                100 => '@my_example/assets/other. s', // establecer prioridad
            ),
            'css' => array(
                '@my_example/assets/somee. ss',
            )
));
```

La clase util, por supuesto, necesitará ser añadida a sus definiciones de servicio en config.yml como tal: `- '@blitze.sitemaker.util'` y definido en el constructor de su bloque `\blitze\sitemaker\services\util $util`.

Y eso es todo. ¡Hemos terminado!