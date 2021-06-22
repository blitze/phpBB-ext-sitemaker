(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[997],{3905:function(e,t,i){"use strict";i.d(t,{Zo:function(){return p},kt:function(){return m}});var a=i(7294);function n(e,t,i){return t in e?Object.defineProperty(e,t,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[t]=i,e}function r(e,t){var i=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),i.push.apply(i,a)}return i}function l(e){for(var t=1;t<arguments.length;t++){var i=null!=arguments[t]?arguments[t]:{};t%2?r(Object(i),!0).forEach((function(t){n(e,t,i[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):r(Object(i)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(i,t))}))}return e}function o(e,t){if(null==e)return{};var i,a,n=function(e,t){if(null==e)return{};var i,a,n={},r=Object.keys(e);for(a=0;a<r.length;a++)i=r[a],t.indexOf(i)>=0||(n[i]=e[i]);return n}(e,t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);for(a=0;a<r.length;a++)i=r[a],t.indexOf(i)>=0||Object.prototype.propertyIsEnumerable.call(e,i)&&(n[i]=e[i])}return n}var s=a.createContext({}),d=function(e){var t=a.useContext(s),i=t;return e&&(i="function"==typeof e?e(t):l(l({},t),e)),i},p=function(e){var t=d(e.components);return a.createElement(s.Provider,{value:t},e.children)},c={inlineCode:"code",wrapper:function(e){var t=e.children;return a.createElement(a.Fragment,{},t)}},u=a.forwardRef((function(e,t){var i=e.components,n=e.mdxType,r=e.originalType,s=e.parentName,p=o(e,["components","mdxType","originalType","parentName"]),u=d(i),m=n,k=u["".concat(s,".").concat(m)]||u[m]||c[m]||r;return i?a.createElement(k,l(l({ref:t},p),{},{components:i})):a.createElement(k,l({ref:t},p))}));function m(e,t){var i=arguments,n=t&&t.mdxType;if("string"==typeof e||n){var r=i.length,l=new Array(r);l[0]=u;var o={};for(var s in t)hasOwnProperty.call(t,s)&&(o[s]=t[s]);o.originalType=e,o.mdxType="string"==typeof e?e:n,l[1]=o;for(var d=2;d<r;d++)l[d]=i[d];return a.createElement.apply(null,l)}return a.createElement.apply(null,i)}u.displayName="MDXCreateElement"},390:function(e,t,i){"use strict";i.r(t),i.d(t,{frontMatter:function(){return o},contentTitle:function(){return s},metadata:function(){return d},toc:function(){return p},default:function(){return u}});var a=i(2122),n=i(9756),r=(i(7294),i(3905)),l=["components"],o={title:"phpBB Eventos SiteMaker",sidebar_position:2},s=void 0,d={unversionedId:"dev/events",id:"dev/events",isDocsHomePage:!1,title:"phpBB Eventos SiteMaker",description:"Puede modificar el comportamiento de phpBB SiteMaker usando el sistema de eventos de phpBB.",source:"@site/i18n/es/docusaurus-plugin-content-docs/current/dev/events.md",sourceDirName:"dev",slug:"/dev/events",permalink:"/phpBB-ext-sitemaker/es/docs/dev/events",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/es",version:"current",sidebarPosition:2,frontMatter:{title:"phpBB Eventos SiteMaker",sidebar_position:2},sidebar:"tutorialSidebar",previous:{title:"Extendiendo phpBB SiteMaker",permalink:"/phpBB-ext-sitemaker/es/docs/dev/overview"},next:{title:"Tema",permalink:"/phpBB-ext-sitemaker/es/docs/dev/theming"}},p=[{value:"Eventos PHP",id:"eventos-php",children:[{value:"a\xf1adir opciones de men\xfa",id:"a\xf1adir-opciones-de-men\xfa",children:[]},{value:"configuraci\xf3n de la p\xe1gina web",id:"configuraci\xf3n-de-la-p\xe1gina-web",children:[]},{value:"blitze.sitemaker.acp_save_settings",id:"blitzesitemakeracp_save_settings",children:[]},{value:"establecer.set_activos",id:"establecerset_activos",children:[]},{value:"blitze.sitemaker.modify_block_positions",id:"blitzesitemakermodify_block_positions",children:[]},{value:"bloque.sitemaker.modify_rendered_bloque",id:"bloquesitemakermodify_rendered_bloque",children:[]}]},{value:"Eventos de Plantilla",id:"eventos-de-plantilla",children:[{value:"configuraci\xf3n de blitze_sitemaker_acp",id:"configuraci\xf3n-de-blitze_sitemaker_acp",children:[]},{value:"admin_bar_admin_admin",id:"admin_bar_admin_admin",children:[]},{value:"plantillas de barra blitze_sitemaker_admin",id:"plantillas-de-barra-blitze_sitemaker_admin",children:[]}]},{value:"Eventos Javascript",id:"eventos-javascript",children:[{value:"blitze_sitemaker_layout guardado",id:"blitze_sitemaker_layout-guardado",children:[]},{value:"bloque_sitemaker_render_bloqueo_antes",id:"bloque_sitemaker_render_bloqueo_antes",children:[]},{value:"blitze_sitemaker_render_block_despu\xe9s",id:"blitze_sitemaker_render_block_despu\xe9s",children:[]},{value:"blitze_sitemaker_save_block_antes",id:"blitze_sitemaker_save_block_antes",children:[]},{value:"mostrar todas las posiciones de bloqueo",id:"mostrar-todas-las-posiciones-de-bloqueo",children:[]},{value:"escondite de posiciones de bloque de sitio",id:"escondite-de-posiciones-de-bloque-de-sitio",children:[]},{value:"blitze_sitemaker limpiado",id:"blitze_sitemaker-limpiado",children:[]},{value:"blitze_sitemaker_layout_actualizado",id:"blitze_sitemaker_layout_actualizado",children:[]},{value:"opciones de creaci\xf3n de sitios",id:"opciones-de-creaci\xf3n-de-sitios",children:[]}]}],c={toc:p};function u(e){var t=e.components,i=(0,n.Z)(e,l);return(0,r.kt)("wrapper",(0,a.Z)({},c,i,{components:t,mdxType:"MDXLayout"}),(0,r.kt)("p",null,"Puede modificar el comportamiento de phpBB SiteMaker usando el sistema de eventos de phpBB."),(0,r.kt)("h2",{id:"eventos-php"},"Eventos PHP"),(0,r.kt)("h3",{id:"a\xf1adir-opciones-de-men\xfa"},"a\xf1adir opciones de men\xfa"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/acp/menu_module.php"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.0"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: A\xf1adir opciones de men\xfa masivo en el men\xfa de acp")),(0,r.kt)("h3",{id:"configuraci\xf3n-de-la-p\xe1gina-web"},"configuraci\xf3n de la p\xe1gina web"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/acp/settings_module.php"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.0"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: mostrar configuraci\xf3n de acp (sitemaker)")),(0,r.kt)("h3",{id:"blitzesitemakeracp_save_settings"},"blitze.sitemaker.acp_save_settings"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/acp/settings_module.php"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.0"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: Guardar configuraci\xf3n de acp (sitemaker)")),(0,r.kt)("h3",{id:"establecerset_activos"},"establecer.set_activos"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.0.1-RC1"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: A\xf1adir recursos para los bloques disponibles en modo edici\xf3n")),(0,r.kt)("h3",{id:"blitzesitemakermodify_block_positions"},"blitze.sitemaker.modify_block_positions"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.0.1-RC1"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: Modificar posiciones de bloque")),(0,r.kt)("h3",{id:"bloquesitemakermodify_rendered_bloque"},"bloque.sitemaker.modify_rendered_bloque"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.0.1-RC1"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: Modificar un bloque renderizado")),(0,r.kt)("h2",{id:"eventos-de-plantilla"},"Eventos de Plantilla"),(0,r.kt)("h3",{id:"configuraci\xf3n-de-blitze_sitemaker_acp"},"configuraci\xf3n de blitze_sitemaker_acp"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.0"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: A\xf1adir campos de formulario para la configuraci\xf3n del sitemaker")),(0,r.kt)("h3",{id:"admin_bar_admin_admin"},"admin_bar_admin_admin"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.0"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: A\xf1adir elementos de men\xfa a la barra de administraci\xf3n")),(0,r.kt)("h3",{id:"plantillas-de-barra-blitze_sitemaker_admin"},"plantillas de barra blitze_sitemaker_admin"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.0"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: A\xf1adir archivos de plantillas para ser usados en JS para vistas de bloque, etc")),(0,r.kt)("h2",{id:"eventos-javascript"},"Eventos Javascript"),(0,r.kt)("h3",{id:"blitze_sitemaker_layout-guardado"},"blitze_sitemaker_layout guardado"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.2"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: Evento para permitir que otras extensiones hagan algo cuando se guardan los cambios de dise\xf1o")),(0,r.kt)("h3",{id:"bloque_sitemaker_render_bloqueo_antes"},"bloque_sitemaker_render_bloqueo_antes"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.2"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: Evento para permitir que otras extensiones hagan algo antes de que el bloque sea renderizado o evite que se vuelva a procesar")),(0,r.kt)("h3",{id:"blitze_sitemaker_render_block_despu\xe9s"},"blitze_sitemaker_render_block_despu\xe9s"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.2"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: Evento para permitir que otras extensiones hagan algo despu\xe9s de que se procese el bloque")),(0,r.kt)("h3",{id:"blitze_sitemaker_save_block_antes"},"blitze_sitemaker_save_block_antes"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.2"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: Evento para permitir que otras extensiones modifiquen los datos del bloque antes de guardarlos")),(0,r.kt)("h3",{id:"mostrar-todas-las-posiciones-de-bloqueo"},"mostrar todas las posiciones de bloqueo"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.2"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: Evento para permitir que otras extensiones hagan algo cuando se muestran todas las posiciones de bloque")),(0,r.kt)("h3",{id:"escondite-de-posiciones-de-bloque-de-sitio"},"escondite de posiciones de bloque de sitio"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.2"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: Evento para permitir que otras extensiones hagan algo cuando se ocultan posiciones vac\xedas")),(0,r.kt)("h3",{id:"blitze_sitemaker-limpiado"},"blitze_sitemaker limpiado"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.2"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: Evento para permitir que otras extensiones hagan algo cuando se borre el dise\xf1o")),(0,r.kt)("h3",{id:"blitze_sitemaker_layout_actualizado"},"blitze_sitemaker_layout_actualizado"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.1.2"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: Evento para permitir que otras extensiones hagan algo cuando se actualiza el dise\xf1o")),(0,r.kt)("h3",{id:"opciones-de-creaci\xf3n-de-sitios"},"opciones de creaci\xf3n de sitios"),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"Ubicaci\xf3n: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js"),(0,r.kt)("li",{parentName:"ul"},"Desde: 3.3.0"),(0,r.kt)("li",{parentName:"ul"},"Prop\xf3sito: Evento para permitir que otras extensiones modifiquen las opciones de tinymce")))}u.isMDXComponent=!0}}]);