(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[106],{3905:function(e,t,n){"use strict";n.d(t,{Zo:function(){return u},kt:function(){return d}});var o=n(7294);function a(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function l(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,o)}return n}function r(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?l(Object(n),!0).forEach((function(t){a(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):l(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function i(e,t){if(null==e)return{};var n,o,a=function(e,t){if(null==e)return{};var n,o,a={},l=Object.keys(e);for(o=0;o<l.length;o++)n=l[o],t.indexOf(n)>=0||(a[n]=e[n]);return a}(e,t);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);for(o=0;o<l.length;o++)n=l[o],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(a[n]=e[n])}return a}var p=o.createContext({}),s=function(e){var t=o.useContext(p),n=t;return e&&(n="function"==typeof e?e(t):r(r({},t),e)),n},u=function(e){var t=s(e.components);return o.createElement(p.Provider,{value:t},e.children)},k={inlineCode:"code",wrapper:function(e){var t=e.children;return o.createElement(o.Fragment,{},t)}},c=o.forwardRef((function(e,t){var n=e.components,a=e.mdxType,l=e.originalType,p=e.parentName,u=i(e,["components","mdxType","originalType","parentName"]),c=s(n),d=a,m=c["".concat(p,".").concat(d)]||c[d]||k[d]||l;return n?o.createElement(m,r(r({ref:t},u),{},{components:n})):o.createElement(m,r({ref:t},u))}));function d(e,t){var n=arguments,a=t&&t.mdxType;if("string"==typeof e||a){var l=n.length,r=new Array(l);r[0]=c;var i={};for(var p in t)hasOwnProperty.call(t,p)&&(i[p]=t[p]);i.originalType=e,i.mdxType="string"==typeof e?e:a,r[1]=i;for(var s=2;s<l;s++)r[s]=n[s];return o.createElement.apply(null,r)}return o.createElement.apply(null,n)}c.displayName="MDXCreateElement"},7862:function(e,t,n){"use strict";n.r(t),n.d(t,{frontMatter:function(){return i},contentTitle:function(){return p},metadata:function(){return s},toc:function(){return u},default:function(){return c}});var o=n(2122),a=n(9756),l=(n(7294),n(3905)),r=["components"],i={title:"Roz\u0161i\u0159ov\xe1n\xed phpBB SiteMaker",sidebar_position:1},p=void 0,s={unversionedId:"dev/overview",id:"dev/overview",isDocsHomePage:!1,title:"Roz\u0161i\u0159ov\xe1n\xed phpBB SiteMaker",description:"M\u016f\u017eete roz\u0161i\u0159ovat/modifikovat phpBB SiteMaker pomoc\xed servisu, dekorace slu\u017eeba phpBB syst\xe9mu ud\xe1lost\xed. Seznam podporovan\xfdch ud\xe1lost\xed naleznete zde.",source:"@site/i18n/cs/docusaurus-plugin-content-docs/current/dev/overview.md",sourceDirName:"dev",slug:"/dev/overview",permalink:"/phpBB-ext-sitemaker/cs/docs/dev/overview",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/cs",version:"current",sidebarPosition:1,frontMatter:{title:"Roz\u0161i\u0159ov\xe1n\xed phpBB SiteMaker",sidebar_position:1},sidebar:"tutorialSidebar",previous:{title:"P\u0159izp\u016fsoben\xed zobrazen\xed blok\u016f",permalink:"/phpBB-ext-sitemaker/cs/docs/user/site/block-modifiers"},next:{title:"phpBB ud\xe1losti SiteMaker",permalink:"/phpBB-ext-sitemaker/cs/docs/dev/events"}},u=[{value:"Vytv\xe1\u0159en\xed bloku SiteMaker",id:"vytv\xe1\u0159en\xed-bloku-sitemaker",children:[{value:"Nastaven\xed bloku",id:"nastaven\xed-bloku",children:[]},{value:"N\xe1zevn\xed bloky",id:"n\xe1zevn\xed-bloky",children:[]},{value:"P\u0159eklad",id:"p\u0159eklad",children:[]},{value:"Vykreslov\xe1n\xed bloku",id:"vykreslov\xe1n\xed-bloku",children:[]},{value:"Blokovat aktiva",id:"blokovat-aktiva",children:[]}]}],k={toc:u};function c(e){var t=e.components,n=(0,a.Z)(e,r);return(0,l.kt)("wrapper",(0,o.Z)({},k,n,{components:t,mdxType:"MDXLayout"}),(0,l.kt)("p",null,"M\u016f\u017eete roz\u0161i\u0159ovat/modifikovat phpBB SiteMaker pomoc\xed ",(0,l.kt)("a",{parentName:"p",href:"https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement"},"servisu"),", ",(0,l.kt)("a",{parentName:"p",href:"https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration"},"dekorace slu\u017eeb"),"a ",(0,l.kt)("a",{parentName:"p",href:"https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html"},"phpBB syst\xe9mu ud\xe1lost\xed"),". Seznam podporovan\xfdch ud\xe1lost\xed ",(0,l.kt)("a",{parentName:"p",href:"/phpBB-ext-sitemaker/cs/docs/dev/events"},"naleznete zde"),"."),(0,l.kt)("h2",{id:"vytv\xe1\u0159en\xed-bloku-sitemaker"},"Vytv\xe1\u0159en\xed bloku SiteMaker"),(0,l.kt)("p",null,"Blok phpBB SiteMaker je prost\u011b t\u0159\xedda, kter\xe1 roz\u0161i\u0159uje blitze\\sitemaker\\services\\blocks\\driver\\block class a vrac\xed pole z metody \"display\" s 'title' a 'content'. V\u0161echno ostatn\xed mezi n\xe1mi z\xe1le\u017e\xed na v\xe1s. Aby byl blok rozpoznateln\xfd phpBB SiteMaker, mus\xedte mu d\xe1t \u0161t\xedtek \"sitemaker.block\"."),(0,l.kt)("p",null,'\u0158ekn\u011bte n\xe1m roz\u0161\xed\u0159en\xed s prodejcem/roz\u0161\xed\u0159en\xedm jako nap\u0159\xedklad. Chcete-li vytvo\u0159it blok nazvan\xfd "my_block" pro phpBB SiteMaker:'),(0,l.kt)("ul",null,(0,l.kt)("li",{parentName:"ul"},'Vytvo\u0159it slo\u017eku "bloky"'),(0,l.kt)("li",{parentName:"ul"},"Vytvo\u0159it soubor my_block.php ve slo\u017ece blok\u016f s n\xe1sleduj\xedc\xedm obsahem")),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre",className:"language-php"},"namespace my\\example\\blocks;\n\npou\u017eijte blitze\\sitemaker\\services\\blocks\\driver\\block;\n\nt\u0159\xedda my_block roz\u0161i\u0159uje blok\n{\n    /**\n     * {@inheritdoc}\n     */\n    displej ve\u0159ejn\xe9 funkce (pole $settings, $edit_mode = false)\n    {\n        return array(\n            'title' => 'my block title',\n            'obsah' => 'obsah m\xe9ho bloku',\n        );\n    }\n}\n")),(0,l.kt)("p",null,"Pot\xe9 v souboru config.yml p\u0159idejte n\xe1sleduj\xedc\xed:"),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre",className:"language-yml"},"slu\u017eby:\n\n...\n\n    my.example.block.my_block:\n        class: my\\example\\blocks\\my_block\n        hovory:\n            - [set_name, [my.example.block.my_block]]\n        tagy:\n            - { name: sitemaker.block }\n\n....\n\n")),(0,l.kt)("p",null,"Na minimum, to je v\u0161e, co pot\u0159ebujete. Pokud p\u0159ejdete do re\u017eimu \xfaprav, m\u011bli byste vid\u011bt blok uveden\xfd jako 'MY_EXAMPLE_BLOCK_MY_BLOCK', kter\xfd m\u016f\u017ee b\xfdt p\u0159eta\u017een a p\u0159eta\u017een na libovolnou pozici bloku. Ale tento blok ned\u011bl\xe1 nic vzru\u0161uj\xedc\xedho. Nem\xe1 \u017e\xe1dn\xe9 nastaven\xed a nep\u0159elo\u017e\xed n\xe1zev bloku. Ud\u011blejme to zaj\xedmav\u011bj\u0161\xed."),(0,l.kt)("h3",{id:"nastaven\xed-bloku"},"Nastaven\xed bloku"),(0,l.kt)("p",null,'Poj\u010fme upravit na\u0161e bloky/my_block. hp soubor a p\u0159idat metodu "get_config" na vrac\xed pole s t\xedm, \u017ee kl\xed\u010de jsou nastaven\xed blok\u016f, a hodnoty popisuj\xedc\xed nastaven\xed, jako je toto:'),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre",className:"language-php"},"    /**\n     * @inheritdoc\n     */\n    ve\u0159ejn\xe1 funkce get_config(pole $settings)\n    {\n        $options = array(1 => 'SOME_LANG_VAR', 2 => \u201eOTHER_LANG_VAR\u201c);\n        zp\xe1te\u010dn\xed pole\n            'legend1' => 'TAB1',\n            'checkbox' => pole ('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options\u201ev\xfdchoz\xed\u201c => pole(), \u201evysv\u011btlit\u201c => false),\n            'yes_no' => pole ('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),\n            'r\xe1d' => pole ('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'vysv\u011btlit' => false, 'default' => 'topic'),\n            'select' => pole ('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', \u201evysv\u011btlit\u201c => nepravda),\n            'multi' => pole ('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'mo\u017enosti' => $options, 'default' => pole(), 'vysv\u011btlit' => false),\n            'legend2' => 'TAB2',\n            '\u010d\xedslo' => pole ('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false; \u201ev\xfdchoz\xed\u201c => 5),\n            'textarea' => pole ('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'v\xfdchoz\xed' => ''),\n            'togglable' => pole ('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options'v\xfdchoz\xed' => '', 'append' => '<div id=\"toggle_key-1\">Zobrazit pouze kdy\u017e je zvolena mo\u017enost 1</div>'),\n        );\n}\n")),(0,l.kt)("p",null,"Toto je konstruov\xe1no stejn\xfdm zp\u016fsobem, jako phpBB sestavuje konfiguraci pro nastaven\xed desky v ACP. V\xedce p\u0159\xedklad\u016f ",(0,l.kt)("a",{parentName:"p",href:"https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php"},"m\u016f\u017eete vid\u011bt zde"),"."),(0,l.kt)("p",null,"Pokud chcete typ vlastn\xedho pole, uvid\xedte p\u0159\xedklad ",(0,l.kt)("a",{parentName:"p",href:"https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php"},"zde")," ('content_type')."),(0,l.kt)("p",null,"Ozn\xe1men\xed 'legend1' a 'legend2': Pou\u017e\xedvaj\xed se k odd\u011blen\xed nastaven\xed do z\xe1lo\u017eek."),(0,l.kt)("h3",{id:"n\xe1zevn\xed-bloky"},"N\xe1zevn\xed bloky"),(0,l.kt)("p",null,"Konventem n\xe1zv\u016f blok\u016f je n\xe1zev slu\u017eby (nap\u0159. my.example.block. y",(0,l.kt)("em",{parentName:"p"},"blok v\xfd\u0161e) bude pou\u017eit jako jazykov\xfd kl\xed\u010d nahrazen\xedm te\u010dek (.) podtr\u017e\xedtkem ("),") (nap\u0159. MY_EXAMPLE_BLOCK_MY_BLOCK)."),(0,l.kt)("h3",{id:"p\u0159eklad"},"P\u0159eklad"),(0,l.kt)("p",null,'V\u0161imn\u011bte si tak\xe9, \u017ee m\xe1me n\u011bkolik jazykov\xfdch kl\xed\u010d\u016f, kter\xe9 mus\xed b\xfdt p\u0159elo\u017eeny. Chcete-li to prov\xe9st, vytvo\u0159te soubor s n\xe1zvem "blocks_admin.php" ve va\u0161\xed jazykov\xe9 slo\u017ece. Tento soubor bude automaticky na\u010dten p\u0159i \xfaprav\xe1ch blok\u016f a m\u011bl by m\xedt p\u0159eklady pro nastaven\xed blok\u016f a jm\xe9na blok\u016f.'),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre"},"$lang = array_merge($lang, pole\n    'SOME_LANG_VAR' => 'Mo\u017enost 1',\n    'OTHER_LANG_VAR' => 'Mo\u017enost 2',\n    'SOME_LANG_VAR_1' => 'Nastavuji 1',\n....\n    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'M\u016fj blok',\n);\n")),(0,l.kt)("p",null,"Proto\u017ee se 'blocks_admin.php' na\u010d\xedt\xe1 pouze p\u0159i \xfaprav\xe1ch blok\u016f, budete muset p\u0159idat dal\u0161\xed p\u0159eklady (nap\u0159. n\xe1zev bloku) nahr\xe1n\xedm jazykov\xe9ho souboru do metody zobrazen\xed, jako je tomu tak ",(0,l.kt)("inlineCode",{parentName:"p"},"$language->add_lang('my_lang_file', 'my/example');")),(0,l.kt)("h3",{id:"vykreslov\xe1n\xed-bloku"},"Vykreslov\xe1n\xed bloku"),(0,l.kt)("p",null,"Nov\xfd blok se zobraz\xed pouze v p\u0159\xedpad\u011b, \u017ee n\u011bco vykresluje. Blok m\u016f\u017ee vr\xe1tit jak\xfdkoli \u0159et\u011bzec jako obsah, ale ve v\u011bt\u0161in\u011b p\u0159\xedpad\u016f pot\u0159ebujete \u0161ablonu k vykreslen\xed obsahu. Pro vykreslen\xed bloku pomoc\xed \u0161ablon, blok mus\xed vr\xe1tit pole, kter\xe9 obsahuje data, kter\xe1 chcete p\u0159edat do \u0161ablony, a mus\xed tak\xe9 implementovat metodu ",(0,l.kt)("inlineCode",{parentName:"p"},"get_template")," , jak je uvedeno n\xed\u017ee:"),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre",className:"language-php"},"    /**\n     * @inheritdoc\n     */\n    ve\u0159ejn\xe1 funkce get_config(pole $settings)\n    {\n        $options = array(1 => 'SOME_LANG_VAR', 2 => \u201eOTHER_LANG_VAR\u201c);\n        zp\xe1te\u010dn\xed pole\n            'legend1' => 'TAB1',\n            'some_setting' => pole('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options\u201ev\xfdchoz\xed\u201c => pole(), \u201evysv\u011btlit\u201c => false),\n        );\n    }\n\n    /**\n     * {@inheritdoc}\n     */\n    Ve\u0159ejn\xe1 funkce get_template()\n    {\n        return '@my_example/my_block. tml';\n    }\n\n    /**\n     * {@inheritdoc}\n     */\n    zobrazen\xed ve\u0159ejn\xe9 funkce (pole $data, $edit_mode = false)\n    {\n        if ($edit_mode)\n        {\n            // do n\u011bco pouze v edita\u010dn\xedm m\xf3du\n        }\n\n        return ary(\n            'title' => 'MY_BLOCK_TITLE',\n            'data' => pole\n                'some_var' => $data['settings']['some_setting']\n            ),\n        );\n}\n")),(0,l.kt)("p",null,"Pak va\u0161e styles/all/my_block.html nebo styles/prosilver/my_block.html soubor m\u016f\u017ee vypadat takto:"),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre"},"<p>Vybrali jste: {{ some_var }}</p>\n")),(0,l.kt)("p",null,"In summary, your block must return an array with a ",(0,l.kt)("inlineCode",{parentName:"p"},"title")," key (for the block title) and a ",(0,l.kt)("inlineCode",{parentName:"p"},"content")," key (if the block just displays a string and does not use a template) or a ",(0,l.kt)("inlineCode",{parentName:"p"},"data")," key (if the block uses a template, in which case, you will also need to implement the ",(0,l.kt)("inlineCode",{parentName:"p"},"get_template")," method)."),(0,l.kt)("h3",{id:"blokovat-aktiva"},"Blokovat aktiva"),(0,l.kt)("p",null,"Pokud v\xe1\u0161 blok pot\u0159ebuje p\u0159idat aktiva (css/js) na str\xe1nku, doporu\u010duji pro to pou\u017e\xedt sitemaker ",(0,l.kt)("a",{parentName:"p",href:"https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php"},"util t\u0159\xeddu"),". Proto\u017ee na str\xe1nce m\u016f\u017ee b\xfdt v\xedce ne\u017e jedna instance t\xe9ho\u017e bloku, nebo jin\xe9 bloky mohou p\u0159id\xe1vat stejn\xe9 aktivum, t\u0159\xedda utilu zaji\u0161\u0165uje, \u017ee aktivum je pouze p\u0159id\xe1no."),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre",className:"language-php"},"        $this->util->add_assets(array(\n            'js' => array(\n                '@my_example/assets/n\u011bkter\xe9. s',\n                100 => '@my_example/assets/other. s', // nastavit prioritu\n            ),\n            'css' => pole(\n                '@my_example/assets/n\u011bkter\xe9. ss',\n            )\n));\n")),(0,l.kt)("p",null,"Do definic va\u0161ich slu\u017eeb bude samoz\u0159ejm\u011b muset b\xfdt p\u0159id\xe1na utilov\xe1 t\u0159\xedda v config.yml jako je toto: ",(0,l.kt)("inlineCode",{parentName:"p"},"- '@blitze.sitemaker. til'")," a definov\xe1no v konstruktoru va\u0161eho bloku ",(0,l.kt)("inlineCode",{parentName:"p"},"\\blitze\\sitemaker\\services\\util $util"),"."),(0,l.kt)("p",null,"A je to. Jsme hotovi!"))}c.isMDXComponent=!0}}]);