(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[877],{3905:function(e,t,n){"use strict";n.d(t,{Zo:function(){return c},kt:function(){return m}});var a=n(7294);function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function o(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function l(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?o(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):o(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function i(e,t){if(null==e)return{};var n,a,r=function(e,t){if(null==e)return{};var n,a,r={},o=Object.keys(e);for(a=0;a<o.length;a++)n=o[a],t.indexOf(n)>=0||(r[n]=e[n]);return r}(e,t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);for(a=0;a<o.length;a++)n=o[a],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(r[n]=e[n])}return r}var s=a.createContext({}),u=function(e){var t=a.useContext(s),n=t;return e&&(n="function"==typeof e?e(t):l(l({},t),e)),n},c=function(e){var t=u(e.components);return a.createElement(s.Provider,{value:t},e.children)},p={inlineCode:"code",wrapper:function(e){var t=e.children;return a.createElement(a.Fragment,{},t)}},d=a.forwardRef((function(e,t){var n=e.components,r=e.mdxType,o=e.originalType,s=e.parentName,c=i(e,["components","mdxType","originalType","parentName"]),d=u(n),m=r,b=d["".concat(s,".").concat(m)]||d[m]||p[m]||o;return n?a.createElement(b,l(l({ref:t},c),{},{components:n})):a.createElement(b,l({ref:t},c))}));function m(e,t){var n=arguments,r=t&&t.mdxType;if("string"==typeof e||r){var o=n.length,l=new Array(o);l[0]=d;var i={};for(var s in t)hasOwnProperty.call(t,s)&&(i[s]=t[s]);i.originalType=e,i.mdxType="string"==typeof e?e:r,l[1]=i;for(var u=2;u<o;u++)l[u]=n[u];return a.createElement.apply(null,l)}return a.createElement.apply(null,n)}d.displayName="MDXCreateElement"},783:function(e,t,n){"use strict";n.r(t),n.d(t,{frontMatter:function(){return i},contentTitle:function(){return s},metadata:function(){return u},toc:function(){return c},default:function(){return d}});var a=n(2122),r=n(9756),o=(n(7294),n(3905)),l=["components"],i={title:"Extension de phpBB SiteMaker",sidebar_position:1},s=void 0,u={unversionedId:"dev/overview",id:"dev/overview",isDocsHomePage:!1,title:"Extension de phpBB SiteMaker",description:"Vous pouvez \xe9tendre/modifier phpBB SiteMaker en utilisant le remplacement de service, la d\xe9coration de service, et le syst\xe8me d'\xe9v\xe9nements de phpBB. Vous pouvez trouver une liste des \xe9v\xe9nements pris en charge ici.",source:"@site/i18n/fr/docusaurus-plugin-content-docs/current/dev/overview.md",sourceDirName:"dev",slug:"/dev/overview",permalink:"/phpBB-ext-sitemaker/fr/docs/dev/overview",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/fr",version:"current",sidebarPosition:1,frontMatter:{title:"Extension de phpBB SiteMaker",sidebar_position:1},sidebar:"tutorialSidebar",previous:{title:"Personnalisation de l'affichage des blocs",permalink:"/phpBB-ext-sitemaker/fr/docs/user/site/block-modifiers"},next:{title:"\xc9v\xe9nements phpBB SiteMaker",permalink:"/phpBB-ext-sitemaker/fr/docs/dev/events"}},c=[{value:"Cr\xe9ation d&#39;un bloc SiteMaker",id:"cr\xe9ation-dun-bloc-sitemaker",children:[{value:"Param\xe8tres du bloc",id:"param\xe8tres-du-bloc",children:[]},{value:"Blocs de nommage",id:"blocs-de-nommage",children:[]},{value:"Traduction",id:"traduction",children:[]},{value:"Rendu du bloc",id:"rendu-du-bloc",children:[]},{value:"Actifs de bloc",id:"actifs-de-bloc",children:[]}]}],p={toc:c};function d(e){var t=e.components,n=(0,r.Z)(e,l);return(0,o.kt)("wrapper",(0,a.Z)({},p,n,{components:t,mdxType:"MDXLayout"}),(0,o.kt)("p",null,"Vous pouvez \xe9tendre/modifier phpBB SiteMaker en utilisant ",(0,o.kt)("a",{parentName:"p",href:"https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement"},"le remplacement de service"),", ",(0,o.kt)("a",{parentName:"p",href:"https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration"},"la d\xe9coration de service"),", et ",(0,o.kt)("a",{parentName:"p",href:"https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html"},"le syst\xe8me d'\xe9v\xe9nements de phpBB"),". Vous pouvez trouver une liste des \xe9v\xe9nements pris en charge ",(0,o.kt)("a",{parentName:"p",href:"/phpBB-ext-sitemaker/fr/docs/dev/events"},"ici"),"."),(0,o.kt)("h2",{id:"cr\xe9ation-dun-bloc-sitemaker"},"Cr\xe9ation d'un bloc SiteMaker"),(0,o.kt)("p",null,"Un bloc phpBB SiteMaker est simplement une classe qui \xe9tend la classe blitze\\sitemaker\\services\\blocks\\driver\\block et retourne un tableau de la m\xe9thode \"display\" avec un 'title' et 'content'. Tout le reste entre les deux est \xe0 vous. Pour que votre bloc puisse \xeatre d\xe9couvert par phpBB SiteMaker, tu devras lui donner la balise \"sitemaker.block\"."),(0,o.kt)("p",null,'Dire que nous avons une extension avec vendor/extension comme mon/exemple. Pour cr\xe9er un bloc appel\xe9 "my_block" pour phpBB SiteMaker:'),(0,o.kt)("ul",null,(0,o.kt)("li",{parentName:"ul"},'Cr\xe9er un dossier "blocs"'),(0,o.kt)("li",{parentName:"ul"},"Cr\xe9ez mon_block.php dans le dossier des blocs avec le contenu suivant")),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre",className:"language-php"},"espace de noms my\\example\\blocks;\n\nutilisez blitze\\sitemaker\\services\\blocks\\driver\\block;\n\nla classe my_block \xe9tend le bloc\n{\n    /**\n     * {@inheritdoc}\n     */\n    public function display(tableau $settings, $edit_mode = false)\n    {\n        Retourne le tableau (\n            'title' => 'mon titre de bloc',\n            'content' => 'mon contenu de bloc',\n        );\n    }\n}\n")),(0,o.kt)("p",null,"Ensuite, dans votre fichier config.yml, ajoutez ce qui suit :"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre",className:"language-yml"},"services :\n\n...\n\n    my.example.block.my_block:\n        class: mon\\example\\blocks\\my_block\n        appels:\n            - [set_name, [my.example.block.my_block]]\n        balises :\n            - { name: sitemaker.block }\n\n....\n\n")),(0,o.kt)("p",null,"Au minimum, c'est tout ce dont vous avez besoin. Si vous passez en mode \xe9dition, vous devriez voir le bloc list\xe9 comme 'MY_EXAMPLE_BLOCK_MY_BLOCK' qui peut \xeatre d\xe9plac\xe9 et d\xe9pos\xe9 sur n'importe quelle position de bloc. Mais ce bloc ne fait rien de passionnant. Il n'a pas de param\xe8tres et ne traduit pas le nom du bloc. Rendons cela plus int\xe9ressant."),(0,o.kt)("h3",{id:"param\xe8tres-du-bloc"},"Param\xe8tres du bloc"),(0,o.kt)("p",null,'Modifions nos blocs/mon_block. hp file and add a "get_config" method th at return an array with the keys being the block settings and the values being an array describing the settings like so:'),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre",className:"language-php"},"    /**\n     * @inheritdoc\n     */\n    public function get_config(array $settings)\n    {\n        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');\n        return array(\n            'legend1'   => 'TAB1',\n            'checkbox'  => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explain' => false),\n            'yes_no'    => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),\n            'radio'     => array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'explain' => false, 'default' => 'topic'),\n            'select'    => array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', 'explain' => false),\n            'multi'     => array('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'explain' => false),\n            'legend2'   => 'TAB2',\n            'number'    => array('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),\n            'textarea'  => array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),\n            'togglable' => array('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options, 'default' => '', 'append' => '<div id=\"toggle_key-1\">Only show when option 1 is selected</div>'),\n        );\n    }\n")),(0,o.kt)("p",null,"Ceci est construit de la m\xeame mani\xe8re que phpBB construit la configuration pour les param\xe8tres de la carte en ACP. Vous pouvez voir plus d'exemples ",(0,o.kt)("a",{parentName:"p",href:"https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php"},"ici"),"."),(0,o.kt)("p",null,"Si vous voulez un type de champ personnalis\xe9, vous pouvez voir un exemple ",(0,o.kt)("a",{parentName:"p",href:"https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php"},"ici")," ('content_type' setting)."),(0,o.kt)("p",null,"Note 'legend1' et 'legend2' : Ils sont utilis\xe9s pour s\xe9parer les param\xe8tres en onglets."),(0,o.kt)("h3",{id:"blocs-de-nommage"},"Blocs de nommage"),(0,o.kt)("p",null,"La convention pour les noms de blocs est que le nom du service (par exemple mon.exemple.block. y",(0,o.kt)("em",{parentName:"p"},"bloc ci-dessus) sera utilis\xe9 comme cl\xe9 de langage en rempla\xe7ant les points (.) par trait de soulignement ("),") (par exemple MY_EXAMPLE_BLOCK_MY_BLOCK)."),(0,o.kt)("h3",{id:"traduction"},"Traduction"),(0,o.kt)("p",null,'Notez \xe9galement que nous avons plusieurs cl\xe9s de langue qui doivent \xeatre traduites. Pour cela, cr\xe9ez un fichier nomm\xe9 "blocks_admin.php" dans votre dossier de langue. Ce fichier sera automatiquement charg\xe9 lors de l\'\xe9dition de blocs, et devrait avoir des traductions pour les param\xe8tres de vos blocs et les noms de blocs.'),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"$lang = array_merge($lang, tableau(\n    'SOME_LANG_VAR' => 'Option 1',\n    'OTHER_LANG_VAR' => 'Option 2',\n    'SOME_LANG_VAR_1' => 'R\xe9glage 1',\n....\n    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Mon bloc',\n);\n")),(0,o.kt)("p",null,"Parce que 'blocks_admin.php' n'est charg\xe9 que lors de l'\xe9dition de blocs, vous devrez ajouter d'autres traductions (par ex. en chargeant un fichier de langue dans votre m\xe9thode d'affichage comme ",(0,o.kt)("inlineCode",{parentName:"p"},"$language->add_lang('my_lang_file', 'my/exemple');")),(0,o.kt)("h3",{id:"rendu-du-bloc"},"Rendu du bloc"),(0,o.kt)("p",null,"Le nouveau bloc ne sera affich\xe9 que s'il affiche quelque chose. Votre bloc peut renvoyer n'importe quelle cha\xeene de caract\xe8res en tant que contenu, mais dans la plupart des cas, vous avez besoin d'un mod\xe8le pour afficher votre contenu. Pour afficher votre bloc en utilisant des mod\xe8les, le bloc doit retourner un tableau qui contient les donn\xe9es que vous voulez passer au mod\xe8le et doit \xe9galement impl\xe9menter la m\xe9thode ",(0,o.kt)("inlineCode",{parentName:"p"},"get_template")," comme d\xe9montr\xe9 ci-dessous :"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre",className:"language-php"},"    /**\n     * @inheritdoc\n     */\n    fonction publique get_config(table $settings)\n    {\n        $options = table(1 => 'SOME_LANG_VAR', 2 => 'AUTRE_LANG_VAR');\n        retour tableau(\n            'legend1' => 'TAB1',\n            'some_setting' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'cha\xeene', 'type' => 'checkbox', 'options' => $options, 'default' => tableau(), 'expliquer' => faux),\n        );\n    }\n\n    /**\n     * {@inheritdoc}\n     */\n    public function get_template()\n    {\n        return '@my_example/my_block. tml';\n    }\n\n    /**\n     * {@inheritdoc}\n     */\n    public function display(tableau $data, $edit_mode = false)\n    {\n        if ($edit_mode)\n        {\n            // ne fait quelque chose qu'en mode \xe9dition\n        }\n\n        return array(\n            'title' => 'MY_BLOCK_TITLE',\n            'data' => array(\n                'some_var' => $data['settings']['some_setting'],\n            ),\n        );\n}\n")),(0,o.kt)("p",null,"Ensuite, votre fichier styles/all/my_block.html ou styles/prosilver/my_block.html pourrait ressembler \xe0 ceci :"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"<p>Vous avez s\xe9lectionn\xe9 : {{ some_var }}</p>\n")),(0,o.kt)("p",null,"En r\xe9sum\xe9, votre bloc doit retourner un tableau avec une cl\xe9 ",(0,o.kt)("inlineCode",{parentName:"p"},"titre")," (pour le titre du bloc) et une cl\xe9 ",(0,o.kt)("inlineCode",{parentName:"p"},"contenu")," (si le bloc affiche juste une cha\xeene de caract\xe8res et n'utilise pas de mod\xe8le) ou une cl\xe9 ",(0,o.kt)("inlineCode",{parentName:"p"},"de donn\xe9es")," (si le bloc utilise un mod\xe8le, dans ce cas, vous devrez \xe9galement impl\xe9menter la m\xe9thode ",(0,o.kt)("inlineCode",{parentName:"p"},"get_template"),")."),(0,o.kt)("h3",{id:"actifs-de-bloc"},"Actifs de bloc"),(0,o.kt)("p",null,"Si votre bloc doit ajouter des assets (css/js) \xe0 la page, je vous recommande d'utiliser la classe ",(0,o.kt)("a",{parentName:"p",href:"https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php"},"util du sitemaker")," pour cela. Comme il peut y avoir plus d'une instance du m\xeame bloc sur la page, ou d'autres blocs pourraient \xeatre d'ajouter le m\xeame actif, la classe utilitaire s'assure que l'actif est seulement ajout\xe9."),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre",className:"language-php"},"        $this->util->add_assets(array(\n            'js' => array(\n                '@mon_exemple/assets/une. s',\n                100 => '@mon_exemple/assets/autre. s', // d\xe9finit la priorit\xe9\n            ),\n            'css' => tableau(\n                '@mon_exemple/assets/unes. ss',\n            )\n));\n")),(0,o.kt)("p",null,"La classe utilitaire devra bien s\xfbr \xeatre ajout\xe9e \xe0 vos d\xe9finitions de service dans config.yml comme suit: ",(0,o.kt)("inlineCode",{parentName:"p"},"- '@blitze.sitemaker. til'")," et d\xe9fini dans le constructeur de votre bloc ",(0,o.kt)("inlineCode",{parentName:"p"},"\\blitze\\sitemaker\\services\\util $util"),"."),(0,o.kt)("p",null,"Et c'est tout. Nous avons termin\xe9 !"))}d.isMDXComponent=!0}}]);