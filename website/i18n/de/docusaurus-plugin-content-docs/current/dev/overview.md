---
title: phpBB SiteMaker erweitern
sidebar_position: 1
---

Sie können phpBB SiteMaker mit [Service Ersatz](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [Service Dekoration](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration)und [phpBB Eventsystem](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html) erweitern/ändern. Eine Liste der unterstützten Events [finden Sie hier](./events.md).

## Erstellen eines SiteMaker-Blocks

Ein phpBB SiteMaker Block ist einfach eine Klasse, die den blitze\sitemaker\services\blocks\driver\block class erweitert und ein Array aus der "display"-Methode mit einem 'title' und 'content' zurückgibt. Alles andere zwischendurch liegt bei Ihnen. Um deinen Block von phpBB SiteMaker entdeckbar zu machen, musst du ihm das "sitemaker.block"-Tag geben.

Sagen wir, wir haben eine Erweiterung mit Anbieter/Erweiterung als mich/Beispiel. Um einen Block namens "my_block" für phpBB SiteMaker zu erstellen:

-   Einen "Blocks" Ordner erstellen
-   Erstelle my_block.php Datei im Blockordner mit folgendem Inhalt

```php
namespace mein\beispiel\blocks;

blitze\sitemaker\services\blocks\driver\block;

Klasse my_block erweitert Block
{
    /**
     * {@inheritdoc}
     */
    public function display(array $settings, $edit_mode = false)
    {
        return array(
            'title' => 'my block title',
            'content' => 'my block content',
        );
    }
}
```

Fügen Sie dann in Ihrer config.yml-Datei folgendes hinzu:

```yml
Dienste:

...

    my.example.block.my_block:
        Klasse: mein\example\blocks\my_block
        rufe:
            - [set_name, [my.example.block.my_block]]
        tags:
            - { name: sitemaker.block }

....

```

Auf einem absoluten Minimum ist das alles, was du brauchst. Wenn du in den Bearbeitungsmodus gehst, solltest du den Block als 'MY_EXAMPLE_BLOCK_MY_BLOCK' aufgelistet sehen, der auf jede Blockposition gezogen und geworfen werden kann. Aber dieser Block macht nichts Spannendes. Es hat keine Einstellungen und übersetzt nicht den Blocknamen. Machen wir es interessanter.

### Blockeinstellungen

Lass uns unsere Blöcke/meinen Block ändern. hp-Datei und fügen Sie eine "get_config"-Methode bei der Rückgabe eines Arrays hinzu, wobei die Schlüssel die Blockeinstellungen sind und die Werte ein Array sind, das die Einstellungen wie folgt beschreibt:

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

Dies ist genauso konstruiert wie phpBB die Konfiguration für die Board-Einstellungen in ACP. Weitere Beispiele finden Sie [hier](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

If you want a custom field type, you can see an example [here](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' setting).

Beachte 'legend1' und 'legend2': Diese werden verwendet, um die Einstellungen in Tabs zu trennen.

### Benennen von Blöcken

Die Konvention für Blocknamen ist, dass der Service-Name (z. B. my.example.block. y*-Block oben) wird als Sprachschlüssel verwendet, indem die Punkte (.) durch Unterstriche (*) ersetzt werden (z.B. MY_EXAMPLE_BLOCK_MY_BLOCK).

### Übersetzung

Beachten Sie auch, dass wir mehrere Sprachschlüssel haben, die übersetzt werden müssen. Erstellen Sie dazu eine Datei namens "blocks_admin.php" in Ihrem Sprachordner. Diese Datei wird automatisch beim Bearbeiten von Blöcken geladen und sollte Übersetzungen für Ihre Blockeinstellungen und Blocknamen enthalten.

```
$lang = array_merge($lang, array(
    'SOME_LANG_VAR' => 'Option 1',
    'ANDERER_LANG_VAR' => 'Option 2',
    'SOME_LANG_VAR_1' => 'Setzen 1',
....
    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Mein Block',
);
```

Da 'blocks_admin.php' nur beim Bearbeiten von Blöcken geladen wird, müssen Sie andere Übersetzungen (z. Block-Titel) durch Laden einer Sprachdatei in Ihrer Anzeigemethode wie so `$language->add_lang('my_lang_file', 'my/example');`

### Den Block rendern

Der neue Block wird nur angezeigt, wenn etwas dargestellt wird. Ihr Block kann jede Zeichenkette als Inhalt zurückgeben, aber in den meisten Fällen benötigen Sie eine Vorlage, um Ihren Inhalt darzustellen. Um deinen Block mit Vorlagen zu rendern der Block muss ein Array zurückgeben, das die Daten enthält, die Sie an die Vorlage übergeben möchten, und die `get_template` Methode wie unten gezeigt implementieren:

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'ANDERER_LANG_VAR');
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
            // nur im Bearbeitungsmodus
        }

        return array(
            'title' => 'MY_BLOCK_TITLE',
            'data' => array(
                'some_var' => $data['settings']['some_setting'],
            ),
        );
}
```

Dann könnte deine styles/all/my_block.html oder styles/prosilver/my_block.html Datei so aussehen:

```
<p>Sie haben ausgewählt: {{ some_var }}</p>
```

Zusammenfassend Ihr Block muss ein Array mit einer `-Titel-Taste` (für den Block-Titel) und einer `Inhalts-Taste` (wenn der Block nur einen String anzeigt und keine Vorlage verwendet) oder einer `Daten-Taste` (wenn der Block eine Vorlage verwendet, in diesem Fall müssen Sie auch die Methode `get_template` implementieren).

### Assets blockieren

Wenn Ihr Block Assets (css/js) zur Seite hinzufügen muss, empfehle ich dafür den Sitemaker [util class](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) zu verwenden. Da es mehr als eine Instanz desselben Blocks auf der Seite geben kann oder andere Blöcke das gleiche Asset hinzufügen, stellt die Util-Klasse sicher, dass das Asset nur hinzugefügt wird.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/einige. s',
                100 => '@my_example/assets/others. s', // Priorität setzen
            ),
            'css' => array(
                '@my_example/assets/some ss',
            )
));
```

Die Util-Klasse muss natürlich zu Ihren Service-Definitionen in config.yml hinzugefügt werden, wie so: `- '@blitze.sitemaker. bis` und definiert im Konstruktor Ihres Blocks `\blitze\sitemaker\services\util $util`.

Und das war's. Wir sind fertig!
