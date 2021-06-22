(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[520],{3905:function(e,t,n){"use strict";n.d(t,{Zo:function(){return c},kt:function(){return k}});var a=n(7294);function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function l(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function i(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?l(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):l(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function s(e,t){if(null==e)return{};var n,a,r=function(e,t){if(null==e)return{};var n,a,r={},l=Object.keys(e);for(a=0;a<l.length;a++)n=l[a],t.indexOf(n)>=0||(r[n]=e[n]);return r}(e,t);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);for(a=0;a<l.length;a++)n=l[a],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(r[n]=e[n])}return r}var o=a.createContext({}),p=function(e){var t=a.useContext(o),n=t;return e&&(n="function"==typeof e?e(t):i(i({},t),e)),n},c=function(e){var t=p(e.components);return a.createElement(o.Provider,{value:t},e.children)},m={inlineCode:"code",wrapper:function(e){var t=e.children;return a.createElement(a.Fragment,{},t)}},d=a.forwardRef((function(e,t){var n=e.components,r=e.mdxType,l=e.originalType,o=e.parentName,c=s(e,["components","mdxType","originalType","parentName"]),d=p(n),k=r,u=d["".concat(o,".").concat(k)]||d[k]||m[k]||l;return n?a.createElement(u,i(i({ref:t},c),{},{components:n})):a.createElement(u,i({ref:t},c))}));function k(e,t){var n=arguments,r=t&&t.mdxType;if("string"==typeof e||r){var l=n.length,i=new Array(l);i[0]=d;var s={};for(var o in t)hasOwnProperty.call(t,o)&&(s[o]=t[o]);s.originalType=e,s.mdxType="string"==typeof e?e:r,i[1]=s;for(var p=2;p<l;p++)i[p]=n[p];return a.createElement.apply(null,i)}return a.createElement.apply(null,n)}d.displayName="MDXCreateElement"},8675:function(e,t,n){"use strict";n.r(t),n.d(t,{frontMatter:function(){return s},contentTitle:function(){return o},metadata:function(){return p},toc:function(){return c},default:function(){return d}});var a=n(2122),r=n(9756),l=(n(7294),n(3905)),i=["components"],s={title:"Ut\xf6ka phpBB SiteMaker",sidebar_position:1},o=void 0,p={unversionedId:"dev/overview",id:"dev/overview",isDocsHomePage:!1,title:"Ut\xf6ka phpBB SiteMaker",description:"Du kan f\xf6rl\xe4nga/\xe4ndra phpBB SiteMaker genom att anv\xe4nda service replacement, service decoration, och phpBB's event system. Du kan hitta en lista \xf6ver h\xe4ndelser som st\xf6ds h\xe4r.",source:"@site/i18n/sv/docusaurus-plugin-content-docs/current/dev/overview.md",sourceDirName:"dev",slug:"/dev/overview",permalink:"/phpBB-ext-sitemaker/sv/docs/dev/overview",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/sv",version:"current",sidebarPosition:1,frontMatter:{title:"Ut\xf6ka phpBB SiteMaker",sidebar_position:1},sidebar:"tutorialSidebar",previous:{title:"Anpassa Blocks Display",permalink:"/phpBB-ext-sitemaker/sv/docs/user/site/block-modifiers"},next:{title:"SiteMaker Evenemang f\xf6r phpBB",permalink:"/phpBB-ext-sitemaker/sv/docs/dev/events"}},c=[{value:"Skapa ett SiteMaker-block",id:"skapa-ett-sitemaker-block",children:[{value:"Blockera inst\xe4llningar",id:"blockera-inst\xe4llningar",children:[]},{value:"Namnge block",id:"namnge-block",children:[]},{value:"\xd6vers\xe4ttning",id:"\xf6vers\xe4ttning",children:[]},{value:"Renderar blocket",id:"renderar-blocket",children:[]},{value:"Blockera tillg\xe5ngar",id:"blockera-tillg\xe5ngar",children:[]}]}],m={toc:c};function d(e){var t=e.components,n=(0,r.Z)(e,i);return(0,l.kt)("wrapper",(0,a.Z)({},m,n,{components:t,mdxType:"MDXLayout"}),(0,l.kt)("p",null,"Du kan f\xf6rl\xe4nga/\xe4ndra phpBB SiteMaker genom att anv\xe4nda ",(0,l.kt)("a",{parentName:"p",href:"https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement"},"service replacement"),", ",(0,l.kt)("a",{parentName:"p",href:"https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration"},"service decoration"),", och ",(0,l.kt)("a",{parentName:"p",href:"https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html"},"phpBB's event system"),". Du kan hitta en lista \xf6ver h\xe4ndelser som st\xf6ds ",(0,l.kt)("a",{parentName:"p",href:"/phpBB-ext-sitemaker/sv/docs/dev/events"},"h\xe4r"),"."),(0,l.kt)("h2",{id:"skapa-ett-sitemaker-block"},"Skapa ett SiteMaker-block"),(0,l.kt)("p",null,'En phpBB SiteMaker block \xe4r helt enkelt en klass som ut\xf6kar blitze\\sitemaker\\services\\blocks\\driver\\block klass och returnerar en array fr\xe5n "visa" metod med en "titel" och "inneh\xe5ll". Allt annat mellan er \xe4r upp till er. F\xf6r att g\xf6ra ditt block uppt\xe4ckbart av phpBB SiteMaker, m\xe5ste du ge det "sitemaker.block" taggen.'),(0,l.kt)("p",null,'S\xe4g att vi har en f\xf6rl\xe4ngning med leverant\xf6r/f\xf6rl\xe4ngning som min/exempel. F\xf6r att skapa ett block som heter "my_block" f\xf6r phpBB SiteMaker:'),(0,l.kt)("ul",null,(0,l.kt)("li",{parentName:"ul"},'Skapa en "block"-mapp'),(0,l.kt)("li",{parentName:"ul"},"Skapa my_block.php fil i blockmappen med f\xf6ljande inneh\xe5ll")),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre",className:"language-php"},"namespace my\\example\\blocks;\n\nanv\xe4nd blitze\\sitemaker\\services\\blocks\\driver\\block;\n\nclass my_block extends block\n{\n    /**\n     * {@inheritdoc}\n     */\n    public function display (array $settings, $edit_mode = false)\n    {\n        returnera array(\n            'title' => 'min blocktitel',\n            'inneh\xe5ll' => 'mitt blockinneh\xe5ll',\n        )\n    }\n}\n")),(0,l.kt)("p",null,"Sedan i din config.yml fil, l\xe4gg till f\xf6ljande:"),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre",className:"language-yml"},"tj\xe4nster:\n\n...\n\n    my.example.block.my_block:\n        class: my\\exempel\\blocks\\my_block\n        ringer:\n            - [set_name, [my.example.block.my_block]]\n        taggar:\n            - { name: sitemaker.block }\n\n....\n\n")),(0,l.kt)("p",null,"P\xe5 ett minimum, det \xe4r allt du beh\xf6ver. Om du g\xe5r in i redigeringsl\xe4ge b\xf6r du se blocket listat som 'MY_EXAMPLE_BLOCK_MY_BLOCK' som kan dras och sl\xe4ppas p\xe5 alla blockpositioner. Men detta block g\xf6r ingenting sp\xe4nnande. Den har inga inst\xe4llningar och \xf6vers\xe4tter inte blockets namn. L\xe5t oss g\xf6ra det mer intressant."),(0,l.kt)("h3",{id:"blockera-inst\xe4llningar"},"Blockera inst\xe4llningar"),(0,l.kt)("p",null,'L\xe5t oss \xe4ndra v\xe5ra block/my_block. HK fil och l\xe4gg till en "get_config" metod th vid returnerar en array med tangenterna \xe4r blockinst\xe4llningar och v\xe4rdena \xe4r en array som beskriver inst\xe4llningar som s\xe5:'),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre",className:"language-php"},"    /**\n     * @inheritdoc\n     */\n    public function get_config(array $settings)\n    {\n        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');\n        returarray(\n            'legend1' => 'TAB1',\n            'kryssruta' => array('lang' => 'SOME_LANG_VAR_1', 'validera' => 'str\xe4ng', 'typ' => 'kryssruta', 'alternativ' => $options, 'default' => array(), 'f\xf6rklara' => false),\n            'yes_no' => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'typ' => 'radio:yes_no', 'f\xf6rklara' => false, 'default' => false),\n            'radio' => array('lang' => 'SOME_LANG_VAR_3', 'validera' => 'bool', 'typ' => 'radio', 'alternativ' => $options, 'f\xf6rklara' => falskt, 'standard' => 'topic'),\n            'select' => array('lang' => 'SOME_LANG_VAR_4', 'validera' => 'str\xe4ng', 'typ' => 'select', 'alternativ' => $options, 'standard' => '', 'f\xf6rklara' => falskt),\n            'multi' => array('lang' => 'SOME_LANG_VAR_5', 'validerad' => 'str\xe4ng', 'typ' => 'multi_select', 'alternativ' => $options, 'standard' => array(), 'f\xf6rklara' => falskt),\n            'legend2' => 'TAB2',\n            'nummer' => array('lang' => 'SOME_LANG_VAR_6', 'validera' => 'int:0:20', 'typ' => 'nummer:0:20', 'maxlength' => 2, 'f\xf6rklara' => false, 'standard' => 5),\n            'textarea' => array('lang' => 'SOME_LANG_VAR_7', 'validera' => 'str\xe4ng', 'typ' => 'textarea:3:40', 'maxlength' => 2, 'f\xf6rklara' => sant, 'standard' => '),\n            'v\xe4xla' => array('lang' => 'SOME_TOGGLABLE_VAR', 'validera' => 'str\xe4ng', 'typ' => 'select:1:0:toggle_key', 'alternativ' => $options, 'standard' => '', 'append' => '<div id=\"toggle_key-1\">Visa endast n\xe4r alternativ 1 \xe4r markerat</div>'),\n        );\n}\n")),(0,l.kt)("p",null,"Detta \xe4r konstruerat p\xe5 samma s\xe4tt som phpBB bygger konfigurationen f\xf6r kortinst\xe4llningar i ACP. Du kan se fler exempel ",(0,l.kt)("a",{parentName:"p",href:"https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php"},"h\xe4r"),"."),(0,l.kt)("p",null,"Om du vill ha en anpassad f\xe4lttyp, kan du se ett exempel ",(0,l.kt)("a",{parentName:"p",href:"https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php"},"h\xe4r")," ('content_type' inst\xe4llning)."),(0,l.kt)("p",null,"L\xe4gg m\xe4rke till 'legend1' och 'legend2': Dessa anv\xe4nds f\xf6r att separera inst\xe4llningarna i flikar."),(0,l.kt)("h3",{id:"namnge-block"},"Namnge block"),(0,l.kt)("p",null,"Konventionen f\xf6r blocknamn \xe4r att tj\xe4nstens namn (t.ex. my.example.block. y",(0,l.kt)("em",{parentName:"p"},"block ovan) kommer att anv\xe4ndas som spr\xe5klyckel genom att ers\xe4tta prickarna (.) med understreck ("),") (t.ex. MY_EXAMPLE_BLOCK_MY_BLOCK)."),(0,l.kt)("h3",{id:"\xf6vers\xe4ttning"},"\xd6vers\xe4ttning"),(0,l.kt)("p",null,'Notera ocks\xe5 att vi har flera spr\xe5knycklar som beh\xf6ver \xf6vers\xe4ttas. F\xf6r att g\xf6ra detta, skapa en fil som heter "blocks_admin.php" i din spr\xe5kmapp. Den h\xe4r filen kommer att laddas automatiskt vid redigering av block, och b\xf6r ha \xf6vers\xe4ttningar f\xf6r dina blockinst\xe4llningar och blocknamn.'),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre"},"$lang = array_merge($lang, array(\n    'SOME_LANG_VAR' => 'Option 1',\n    'OTHER_LANG_VAR' => 'Alternativ 2',\n    'SOME_LANG_VAR_1' => 'St\xe4lla in 1',\n....\n    'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Mitt Block',\n);\n")),(0,l.kt)("p",null,"Eftersom 'blocks_admin.php' endast laddas vid redigering av block, m\xe5ste du l\xe4gga till andra \xf6vers\xe4ttningar (t.ex. blockera titel) genom att l\xe4sa in en spr\xe5kfil i din visningsmetod som s\xe5 ",(0,l.kt)("inlineCode",{parentName:"p"},"$language->add_lang('my_lang_file', 'my/exempel');")),(0,l.kt)("h3",{id:"renderar-blocket"},"Renderar blocket"),(0,l.kt)("p",null,"Det nya blocket kommer endast att visas om det renderar n\xe5got. Ditt block kan returnera vilken str\xe4ng som helst som inneh\xe5ll, men i de flesta fall beh\xf6ver du en mall f\xf6r att \xe5terge ditt inneh\xe5ll. F\xf6r att rendera ditt block med hj\xe4lp av mallar, blocket m\xe5ste returnera en array som inneh\xe5ller data som du vill skicka till mallen och m\xe5ste \xe4ven implementera metoden ",(0,l.kt)("inlineCode",{parentName:"p"},"get_template")," som visas nedan:"),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre",className:"language-php"},"    /**\n     * @inheritdoc\n     */\n    public function get_config(array $settings)\n    {\n        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');\n        returarray(\n            'legend1' => 'TAB1',\n            'some_setting' => array('lang' => 'SOME_LANG_VAR_1', 'validera' => 'str\xe4ng', 'typ' => 'kryssruta', 'alternativ' => $options, 'default' => array(), 'f\xf6rklara' => false),\n        );\n    }\n\n    /**\n     * {@inheritdoc}\n     */\n    public function get_template()\n    {\n        returnera '@my_exempel/my_block. tml';\n    }\n\n    /**\n     * {@inheritdoc}\n     */\n    public function display(array $data, $edit_mode = false)\n    {\n        if ($edit_mode)\n        {\n            // do something only in edit mode\n        }\n\n        return array(\n            'title' => 'MY_BLOCK_TITLE',\n            'data' => array(\n                'some_var' => $data['settings']['some_setting'],\n            ),\n        );\n}\n")),(0,l.kt)("p",null,"D\xe5 kan din styles/all/my_block.html eller styles/prosilver/my_block.html fil se ut ungef\xe4r s\xe5 h\xe4r:"),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre"},"<p>Du valde: {{ some_var }}</p>\n")),(0,l.kt)("p",null,"Sammanfattningsvis blocket m\xe5ste returnera en array med en ",(0,l.kt)("inlineCode",{parentName:"p"},"titel")," nyckel (f\xf6r blockets titel) och en ",(0,l.kt)("inlineCode",{parentName:"p"},"inneh\xe5ll")," nyckel (om blocket bara visar en str\xe4ng och inte anv\xe4nder en mall) eller en ",(0,l.kt)("inlineCode",{parentName:"p"},"data")," nyckel (om blocket anv\xe4nder en mall, I vilket fall m\xe5ste du ocks\xe5 implementera ",(0,l.kt)("inlineCode",{parentName:"p"},"get_template")," metoden)."),(0,l.kt)("h3",{id:"blockera-tillg\xe5ngar"},"Blockera tillg\xe5ngar"),(0,l.kt)("p",null,"Om ditt block beh\xf6ver l\xe4gga till tillg\xe5ngar (css/js) p\xe5 sidan, rekommenderar jag att du anv\xe4nder sitemaker ",(0,l.kt)("a",{parentName:"p",href:"https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php"},"util class")," f\xf6r det. Eftersom det kan finnas mer \xe4n en instans av samma block p\xe5 sidan, eller andra block kan l\xe4gga till samma tillg\xe5ng, s\xe4kerst\xe4ller util-klassen att tillg\xe5ngen bara l\xe4ggs till."),(0,l.kt)("pre",null,(0,l.kt)("code",{parentName:"pre",className:"language-php"},"        $this->util->add_assets(array(\n            'js' => array(\n                '@my_exempel/assets/vissa. s',\n                100 => '@my_exempel/tillg\xe5ngar/annat. s', // ange prioritet\n            ),\n            'css' => array(\n                '@my_exempel/assets/vissa. ss',\n            )\n)\n")),(0,l.kt)("p",null,"Den util-klassen kommer naturligtvis att beh\xf6va l\xe4ggas till dina tj\xe4nstedefinitioner i config.yml som s\xe5: ",(0,l.kt)("inlineCode",{parentName:"p"},"- '@blitze.sitemaker. til'")," och definieras i blockets konstrukt\xf6r ",(0,l.kt)("inlineCode",{parentName:"p"},"\\blitze\\sitemaker\\services\\util $util"),"."),(0,l.kt)("p",null,"Och det \xe4r det. Vi \xe4r klara!"))}d.isMDXComponent=!0}}]);