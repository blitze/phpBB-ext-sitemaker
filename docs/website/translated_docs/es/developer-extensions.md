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

Como mínimo, eso es todo lo que necesitas. Si entras en modo de edición, deberías ver el bloque listado como 'MY_EXAMPLE_BLOCK_MY_BLOCK' que se puede arrastrar y soltar en cualquier posición de bloque. Pero este bloque no hace nada emocionante. No tiene ajustes y no traduce el nombre del bloque. Hagámoslo más interesante.

### Bloquear ajustes

Vamos a modificar nuestros bloques/my_block. archivo hp y añadir un método "get_config" devuelve una matriz en la que las claves son la configuración de bloque y los valores son una matriz que describe la configuración así:

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        array de retorno(
            'legend1' => 'TAB1',
            'checkbox' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explicar' => false),
            'yes_no' => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
            'radio' => array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'explicar' => false, 'predeterminado' => 'tema'),
            'select' => array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', 'explicar' => falso),
            'multi' => array('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'explicar' => false),
            'legend2' => 'TAB2',
            'número' => array('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explicar' => false, 'default' => 5),
            'textarea' => array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'tipo' => 'textarea:3:40', 'maxlength' => 2, 'explicar' => true, 'default' => ''),
            'activar' => array('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options, 'default' => '', 'append' => '<div id="toggle_key-1">Mostrar sólo cuando la opción 1 está seleccionada</div>'),
        );
}
```

Esto se construye de la misma manera que phpBB construye la configuración para la configuración del tablero en ACP. Puedes ver más ejemplos [aquí](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Si desea un tipo de campo personalizado, puede ver un ejemplo [aquí](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' setting).

Aviso 'leyenda 1' y 'leyenda2': Estos se usan para separar los ajustes en pestañas.

### Nombrar bloques

La convención para nombres de bloque es que el nombre del servicio (por ejemplo, my.example.block. y el bloque*de arriba) se utilizará como la clave de idioma reemplazando los puntos (.) con guión bajo (*) (por ejemplo, MY_EXAMPLE_BLOCK_MY_BLOCK).

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

El nuevo bloque sólo se mostrará si está renderizando algo. Tu bloque puede devolver cualquier cadena como contenido pero en la mayoría de los casos, necesitas una plantilla para renderizar tu contenido. Para renderizar tu bloque usando plantillas, el bloque debe retornar un array que contenga los datos que desea pasar a la plantilla y también debe implementar el método `get_template` como se demuestra a continuación:

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        array de retorno(
            'legend1' => 'TAB1',
            'some_setting' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explicar' => false),
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
            // hacer algo sólo en modo edición
        }

        return array(
            'title' => 'MY_BLOCK_TITLE',
            'data' => array(
                'some_var' => $data['settings']['some_setting'],
            ),
        );
}
```

Entonces tu archivo styles/all/my_block.html o styles/prosilver/my_block.html podría verse algo así:

    <p>Has seleccionado: {{ some_var }}</p>
    

En resumen, tu bloque debe devolver un array con una clave de `título` (para el título del bloque) y una clave de `contenido` (si el bloque solo muestra una cadena y no utiliza una plantilla) o una clave de `datos` (si el bloque usa una plantilla, en tal caso, también necesitará implementar el método `get_template`.

### Bloquear activos

Si tu bloque necesita añadir recursos (css/js) a la página, recomiendo usar la clase utilitario [del sitemaker](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) para eso. Ya que puede haber más de una instancia del mismo bloque en la página, u otros bloques podrían estar añadiendo el mismo activo, la clase util asegura que el activo sólo se añade uno.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/algunos. s',
                100 => '@mi_ejemplo/activos/otro. s', // establecer prioridad
            ),
            'css' => array(
                '@my_example/assets/algunos. ss',
            )
));
```

Por supuesto, la clase util tendrá que ser añadida a sus definiciones de servicio en config.yml así: `- '@blitze.sitemaker. til'` y definido en el constructor de tu bloque `\blitze\sitemaker\services\util $util`.

Y eso es todo. ¡Hemos terminado!