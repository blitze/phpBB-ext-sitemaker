# Extending phpBB SiteMaker

## Events

You can extend/modify phpBB SiteMaker using phpBB's event system. You can find a list of supported events [here](./events.md).

## Creating a SiteMaker block

A phpBB SiteMaker block is simply a class that extends the blitze\sitemaker\services\blocks\driver\block class and returns an array from the "display" method with a 'title' and 'content'. Everything else inbetween is up to you.
To make your block discoverable by phpBB SiteMaker, you'll need to give it the "sitemaker.block" tag.

Say we have an extension with vendor/extension as my/example. To create a block called "my_block" for phpBB SiteMaker:

* Create a "blocks" folder
* Create my_block.php file in the blocks folder with the following content
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
			'title'		=> 'my block title',
			'content'	=> 'my block content',
		);
	}
}
```
Then in your config.yml file, add the following:
```yml
services:

    ...

    my.example.block.my_block:
        class: my\example\blocks\my_block
        calls:
            - [set_name, [my.example.block.my_block]]
        tags:
            - { name: sitemaker.block }

    ....

```
At a bare minimum, that's all you need. If you go into edit mode, you should see the block listed as 'MY_EXAMPLE_BLOCK_MY_BLOCK' that can be dragged and dropped on any block position. But this block doesn't do anything exciting. It has not settings and does not translate the block name. Let's make it more interesting.

Let's modify our blocks/my_block.php file and add a "get_config" method that returns an array with the keys being the block settings and the values being an array describing the settings like so:
```php
	/**
	 * @inheritdoc
	 */
	public function get_config(array $settings)
	{
		$options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
		return array(
			'legend1'	=> 'TAB1',
			'checkbox'	=> array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explain' => false),
			'yes_no'	=> array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
			'radio'		=> array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'explain' => false, 'default' => 'topic'),
			'select'	=> array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', 'explain' => false),
			'multi'		=> array('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'explain' => false),
			'legend2'	=> 'TAB2',
			'number'	=> array('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
			'textarea'	=> array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),
			'togglable'	=> array('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options, 'default' => '', 'append' => '<div id="toggle_key-1'>Only show when option 1 is selected</div>'),
		);
	}
```
This is constructed the same way that phpBB builds the configuration for board settings in ACP. You can see more examples [here](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

If you want a custom field type, you can see an example [here](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' setting).

Notice 'legend1' and 'legend2': These are used to separate the settings into tabs.

Also notice that we have several language keys that need to be translated. To do this, create a file named "blocks_admin.php" in your language folder. This file will be automatically loaded when editing blocks, and should have translations for your blocks settings and block names.
```
$lang = array_merge($lang, array(
	'SOME_LANG_VAR'		=> 'Option 1',
	'OTHER_LANG_VAR'	=> 'Option 2',
	'SOME_LANG_VAR_1'	=> 'Setting 1',
	....
	'MY_EXAMPLE_BLOCK_MY_BLOCK'	=> 'My Block',
);
```
The convention for block names is that the service name (e.g my.example.block.my_block above) will be used as the language key by replacing the dots (.) with underscore (_) (e.g MY_EXAMPLE_BLOCK_MY_BLOCK).

If our block has a dependency on other classes, we can add a contructor method to set those dependencies and update the service definition with the classes it depends on.

To render our block using templates, the block class inherits a 'ptemplate' property. So our display method might look something like this:
```php
	/**
	 * {@inheritdoc}
	 */
	public function display(array $data, $edit_mode = false)
	{
		if ($edit_mode)
		{
			// do something
		}

		$this->ptemplate->assign_vars(array(
			'SOME_VAR'	=> $data['settings']['checkbox'],
		));

		return array(
			'title'		=> 'MY_BLOCK_TITLE',
			'content'	=> $this->ptemplate->render_view('my/example', 'my_block.html', 'my_block'),
		);
	}
```
Because 'blocks_admin.php' is only loaded when editing blocks, you will need to add other translations by loading a language file in your display method like so `$language->add_lang('my_lang_file', 'my/example');`

If your block needs to add assets (css/js) to the page, I recommend using the sitemaker [util class](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) for that.
Since there can be more than one instance of the same block on the page, or other blocks might be adding the same asset, the util class ensures that the asset is only added ones.
```php
		$this->util->add_assets(array(
			'js'	=> array(
				'@my_example/assets/some.js',
				100 => '@my_example/assets/other.js',  // set priority
			),
			'css'   => array(
				'@my_example/assets/some.css',
			)
		));
```
The util class will, of course, need to be added to your service definition like so `- '@blitze.sitemaker.icon_picker'` and defined in your constructor `\blitze\sitemaker\services\util $util`.

And that's it. We're done!
