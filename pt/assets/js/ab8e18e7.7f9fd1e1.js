(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[877],{3905:function(e,t,n){"use strict";n.d(t,{Zo:function(){return c},kt:function(){return m}});var a=n(7294);function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function o(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function i(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?o(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):o(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function l(e,t){if(null==e)return{};var n,a,r=function(e,t){if(null==e)return{};var n,a,r={},o=Object.keys(e);for(a=0;a<o.length;a++)n=o[a],t.indexOf(n)>=0||(r[n]=e[n]);return r}(e,t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);for(a=0;a<o.length;a++)n=o[a],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(r[n]=e[n])}return r}var s=a.createContext({}),p=function(e){var t=a.useContext(s),n=t;return e&&(n="function"==typeof e?e(t):i(i({},t),e)),n},c=function(e){var t=p(e.components);return a.createElement(s.Provider,{value:t},e.children)},d={inlineCode:"code",wrapper:function(e){var t=e.children;return a.createElement(a.Fragment,{},t)}},u=a.forwardRef((function(e,t){var n=e.components,r=e.mdxType,o=e.originalType,s=e.parentName,c=l(e,["components","mdxType","originalType","parentName"]),u=p(n),m=r,h=u["".concat(s,".").concat(m)]||u[m]||d[m]||o;return n?a.createElement(h,i(i({ref:t},c),{},{components:n})):a.createElement(h,i({ref:t},c))}));function m(e,t){var n=arguments,r=t&&t.mdxType;if("string"==typeof e||r){var o=n.length,i=new Array(o);i[0]=u;var l={};for(var s in t)hasOwnProperty.call(t,s)&&(l[s]=t[s]);l.originalType=e,l.mdxType="string"==typeof e?e:r,i[1]=l;for(var p=2;p<o;p++)i[p]=n[p];return a.createElement.apply(null,i)}return a.createElement.apply(null,n)}u.displayName="MDXCreateElement"},8791:function(e,t,n){"use strict";n.r(t),n.d(t,{frontMatter:function(){return l},contentTitle:function(){return s},metadata:function(){return p},toc:function(){return c},default:function(){return u}});var a=n(2122),r=n(9756),o=(n(7294),n(3905)),i=["components"],l={title:"Extending phpBB SiteMaker",sidebar_position:1},s=void 0,p={unversionedId:"dev/overview",id:"dev/overview",isDocsHomePage:!1,title:"Extending phpBB SiteMaker",description:"You can extend/modify phpBB SiteMaker using service replacement, service decoration, and phpBB's event system. You can find a list of supported events here.",source:"@site/docs/dev/overview.md",sourceDirName:"dev",slug:"/dev/overview",permalink:"/phpBB-ext-sitemaker/pt/docs/dev/overview",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/pt",version:"current",sidebarPosition:1,frontMatter:{title:"Extending phpBB SiteMaker",sidebar_position:1},sidebar:"tutorialSidebar",previous:{title:"Customizing Blocks Display",permalink:"/phpBB-ext-sitemaker/pt/docs/user/site/block-modifiers"},next:{title:"phpBB SiteMaker Events",permalink:"/phpBB-ext-sitemaker/pt/docs/dev/events"}},c=[{value:"Creating a SiteMaker block",id:"creating-a-sitemaker-block",children:[{value:"Block Settings",id:"block-settings",children:[]},{value:"Naming Blocks",id:"naming-blocks",children:[]},{value:"Translation",id:"translation",children:[]},{value:"Rendering the block",id:"rendering-the-block",children:[]},{value:"Block Assets",id:"block-assets",children:[]}]}],d={toc:c};function u(e){var t=e.components,n=(0,r.Z)(e,i);return(0,o.kt)("wrapper",(0,a.Z)({},d,n,{components:t,mdxType:"MDXLayout"}),(0,o.kt)("p",null,"You can extend/modify phpBB SiteMaker using ",(0,o.kt)("a",{parentName:"p",href:"https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement"},"service replacement"),", ",(0,o.kt)("a",{parentName:"p",href:"https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration"},"service decoration"),", and ",(0,o.kt)("a",{parentName:"p",href:"https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html"},"phpBB's event system"),". You can find a list of supported events ",(0,o.kt)("a",{parentName:"p",href:"/phpBB-ext-sitemaker/pt/docs/dev/events"},"here"),"."),(0,o.kt)("h2",{id:"creating-a-sitemaker-block"},"Creating a SiteMaker block"),(0,o.kt)("p",null,"A phpBB SiteMaker block is simply a class that extends the blitze\\sitemaker\\services\\blocks\\driver\\block class and returns an array from the \"display\" method with a 'title' and 'content'. Everything else inbetween is up to you.\nTo make your block discoverable by phpBB SiteMaker, you'll need to give it the \"sitemaker.block\" tag."),(0,o.kt)("p",null,'Say we have an extension with vendor/extension as my/example. To create a block called "my_block" for phpBB SiteMaker:'),(0,o.kt)("ul",null,(0,o.kt)("li",{parentName:"ul"},'Create a "blocks" folder'),(0,o.kt)("li",{parentName:"ul"},"Create my_block.php file in the blocks folder with the following content")),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre",className:"language-php"},"namespace my\\example\\blocks;\n\nuse blitze\\sitemaker\\services\\blocks\\driver\\block;\n\nclass my_block extends block\n{\n    /**\n     * {@inheritdoc}\n     */\n    public function display(array $settings, $edit_mode = false)\n    {\n        return array(\n            'title'     => 'my block title',\n            'content'   => 'my block content',\n        );\n    }\n}\n")),(0,o.kt)("p",null,"Then in your config.yml file, add the following:"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre",className:"language-yml"},"services:\n\n    ...\n\n    my.example.block.my_block:\n        class: my\\example\\blocks\\my_block\n        calls:\n            - [set_name, [my.example.block.my_block]]\n        tags:\n            - { name: sitemaker.block }\n\n    ....\n\n")),(0,o.kt)("p",null,"At a bare minimum, that's all you need. If you go into edit mode, you should see the block listed as 'MY_EXAMPLE_BLOCK_MY_BLOCK' that can be dragged and dropped on any block position. But this block doesn't do anything exciting. It has no settings and does not translate the block name. Let's make it more interesting."),(0,o.kt)("h3",{id:"block-settings"},"Block Settings"),(0,o.kt)("p",null,'Let\'s modify our blocks/my_block.php file and add a "get_config" method th at returns an array with the keys being the block settings and the values being an array describing the settings like so:'),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre",className:"language-php"},"    /**\n     * @inheritdoc\n     */\n    public function get_config(array $settings)\n    {\n        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');\n        return array(\n            'legend1'   => 'TAB1',\n            'checkbox'  => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explain' => false),\n            'yes_no'    => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),\n            'radio'     => array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'explain' => false, 'default' => 'topic'),\n            'select'    => array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', 'explain' => false),\n            'multi'     => array('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'explain' => false),\n            'legend2'   => 'TAB2',\n            'number'    => array('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),\n            'textarea'  => array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),\n            'togglable' => array('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options, 'default' => '', 'append' => '<div id=\"toggle_key-1\">Only show when option 1 is selected</div>'),\n        );\n    }\n")),(0,o.kt)("p",null,"This is constructed the same way that phpBB builds the configuration for board settings in ACP. You can see more examples ",(0,o.kt)("a",{parentName:"p",href:"https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php"},"here"),"."),(0,o.kt)("p",null,"If you want a custom field type, you can see an example ",(0,o.kt)("a",{parentName:"p",href:"https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php"},"here")," ('content_type' setting)."),(0,o.kt)("p",null,"Notice 'legend1' and 'legend2': These are used to separate the settings into tabs."),(0,o.kt)("h3",{id:"naming-blocks"},"Naming Blocks"),(0,o.kt)("p",null,"The convention for block names is that the service name (e.g my.example.block.my",(0,o.kt)("em",{parentName:"p"},"block above) will be used as the language key by replacing the dots (.) with underscore ("),") (e.g MY_EXAMPLE_BLOCK_MY_BLOCK)."),(0,o.kt)("h3",{id:"translation"},"Translation"),(0,o.kt)("p",null,'Also notice that we have several language keys that need to be translated.\nTo do this, create a file named "blocks_admin.php" in your language folder.\nThis file will be automatically loaded when editing blocks, and should have translations for your blocks settings and block names.'),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"$lang = array_merge($lang, array(\n    'SOME_LANG_VAR'     => 'Option 1',\n    'OTHER_LANG_VAR'    => 'Option 2',\n    'SOME_LANG_VAR_1'   => 'Setting 1',\n    ....\n    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'My Block',\n);\n")),(0,o.kt)("p",null,"Because 'blocks_admin.php' is only loaded when editing blocks, you will need to add other translations (e.g. block title) by loading a language file in your display method like so ",(0,o.kt)("inlineCode",{parentName:"p"},"$language->add_lang('my_lang_file', 'my/example');")),(0,o.kt)("h3",{id:"rendering-the-block"},"Rendering the block"),(0,o.kt)("p",null,"The new block will only be displayed if it is rendering something.\nYour block can return any string as content but in most cases, you need a template to render your content.\nTo render your block using templates, the block must return an array that holds the data that you want to pass to the template and must also implement the ",(0,o.kt)("inlineCode",{parentName:"p"},"get_template")," method as demonstrated below:"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre",className:"language-php"},"    /**\n     * @inheritdoc\n     */\n    public function get_config(array $settings)\n    {\n        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');\n        return array(\n            'legend1'   => 'TAB1',\n            'some_setting'  => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explain' => false),\n        );\n    }\n\n    /**\n     * {@inheritdoc}\n     */\n    public function get_template()\n    {\n        return '@my_example/my_block.html';\n    }\n\n    /**\n     * {@inheritdoc}\n     */\n    public function display(array $data, $edit_mode = false)\n    {\n        if ($edit_mode)\n        {\n            // do something only in edit mode\n        }\n\n        return array(\n            'title'     => 'MY_BLOCK_TITLE',\n            'data'      => array(\n                'some_var'  => $data['settings']['some_setting'],\n            ),\n        );\n    }\n")),(0,o.kt)("p",null,"Then your styles/all/my_block.html or styles/prosilver/my_block.html file might look something like this:"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"<p>You selected: {{ some_var }}</p>\n")),(0,o.kt)("p",null,"In summary, your block must return an array with a ",(0,o.kt)("inlineCode",{parentName:"p"},"title")," key (for the block title) and a ",(0,o.kt)("inlineCode",{parentName:"p"},"content")," key (if the block just displays a string and does not use a template) or a ",(0,o.kt)("inlineCode",{parentName:"p"},"data")," key (if the block uses a template, in which case, you will also need to implement the ",(0,o.kt)("inlineCode",{parentName:"p"},"get_template")," method)."),(0,o.kt)("h3",{id:"block-assets"},"Block Assets"),(0,o.kt)("p",null,"If your block needs to add assets (css/js) to the page, I recommend using the sitemaker ",(0,o.kt)("a",{parentName:"p",href:"https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php"},"util class")," for that.\nSince there can be more than one instance of the same block on the page, or other blocks might be adding the same asset, the util class ensures that the asset is only added ones."),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre",className:"language-php"},"        $this->util->add_assets(array(\n            'js'    => array(\n                '@my_example/assets/some.js',\n                100 => '@my_example/assets/other.js',  // set priority\n            ),\n            'css'   => array(\n                '@my_example/assets/some.css',\n            )\n        ));\n")),(0,o.kt)("p",null,"The util class will, of course, need to be added to your service definitions in config.yml like so: ",(0,o.kt)("inlineCode",{parentName:"p"},"- '@blitze.sitemaker.util'")," and defined in your block's constructor ",(0,o.kt)("inlineCode",{parentName:"p"},"\\blitze\\sitemaker\\services\\util $util"),"."),(0,o.kt)("p",null,"And that's it. We're done!"))}u.isMDXComponent=!0}}]);