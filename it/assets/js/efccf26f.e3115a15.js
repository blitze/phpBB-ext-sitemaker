(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[572],{3905:function(e,i,n){"use strict";n.d(i,{Zo:function(){return s},kt:function(){return d}});var t=n(7294);function r(e,i,n){return i in e?Object.defineProperty(e,i,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[i]=n,e}function o(e,i){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var t=Object.getOwnPropertySymbols(e);i&&(t=t.filter((function(i){return Object.getOwnPropertyDescriptor(e,i).enumerable}))),n.push.apply(n,t)}return n}function a(e){for(var i=1;i<arguments.length;i++){var n=null!=arguments[i]?arguments[i]:{};i%2?o(Object(n),!0).forEach((function(i){r(e,i,n[i])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):o(Object(n)).forEach((function(i){Object.defineProperty(e,i,Object.getOwnPropertyDescriptor(n,i))}))}return e}function l(e,i){if(null==e)return{};var n,t,r=function(e,i){if(null==e)return{};var n,t,r={},o=Object.keys(e);for(t=0;t<o.length;t++)n=o[t],i.indexOf(n)>=0||(r[n]=e[n]);return r}(e,i);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);for(t=0;t<o.length;t++)n=o[t],i.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(r[n]=e[n])}return r}var u=t.createContext({}),c=function(e){var i=t.useContext(u),n=i;return e&&(n="function"==typeof e?e(i):a(a({},i),e)),n},s=function(e){var i=c(e.components);return t.createElement(u.Provider,{value:i},e.children)},m={inlineCode:"code",wrapper:function(e){var i=e.children;return t.createElement(t.Fragment,{},i)}},p=t.forwardRef((function(e,i){var n=e.components,r=e.mdxType,o=e.originalType,u=e.parentName,s=l(e,["components","mdxType","originalType","parentName"]),p=c(n),d=r,g=p["".concat(u,".").concat(d)]||p[d]||m[d]||o;return n?t.createElement(g,a(a({ref:i},s),{},{components:n})):t.createElement(g,a({ref:i},s))}));function d(e,i){var n=arguments,r=i&&i.mdxType;if("string"==typeof e||r){var o=n.length,a=new Array(o);a[0]=p;var l={};for(var u in i)hasOwnProperty.call(i,u)&&(l[u]=i[u]);l.originalType=e,l.mdxType="string"==typeof e?e:r,a[1]=l;for(var c=2;c<o;c++)a[c]=n[c];return t.createElement.apply(null,a)}return t.createElement.apply(null,n)}p.displayName="MDXCreateElement"},1551:function(e,i,n){"use strict";n.r(i),n.d(i,{frontMatter:function(){return l},contentTitle:function(){return u},metadata:function(){return c},toc:function(){return s},default:function(){return p}});var t=n(2122),r=n(9756),o=(n(7294),n(3905)),a=["components"],l={title:"Gestire Gli Elementi Del Menu",sidebar_position:2},u=void 0,c={unversionedId:"user/menus/managing-menu-items",id:"user/menus/managing-menu-items",isDocsHomePage:!1,title:"Gestire Gli Elementi Del Menu",description:"Il tuo menu \xe8 inutile a meno che non abbia voci di menu. \xc8 possibile aggiungere voci di menu che puntano a file locali o esterni.",source:"@site/i18n/it/docusaurus-plugin-content-docs/current/user/menus/managing-menu-items.md",sourceDirName:"user/menus",slug:"/user/menus/managing-menu-items",permalink:"/phpBB-ext-sitemaker/it/docs/user/menus/managing-menu-items",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/it",version:"current",sidebarPosition:2,frontMatter:{title:"Gestire Gli Elementi Del Menu",sidebar_position:2},sidebar:"tutorialSidebar",previous:{title:"Gestire I Menu",permalink:"/phpBB-ext-sitemaker/it/docs/user/menus/managing-menus"},next:{title:"Visualizzazione Men\xf9",permalink:"/phpBB-ext-sitemaker/it/docs/user/menus/displaying-menus"}},s=[{value:"Aggiunta elementi del menu",id:"aggiunta-elementi-del-menu",children:[{value:"Aggiunta di singole voci di menu",id:"aggiunta-di-singole-voci-di-menu",children:[]},{value:"Aggiunta di elementi multipli",id:"aggiunta-di-elementi-multipli",children:[]}]},{value:"Riordina le voci di menu",id:"riordina-le-voci-di-menu",children:[]},{value:"Ricostruire le voci di menu",id:"ricostruire-le-voci-di-menu",children:[]}],m={toc:s};function p(e){var i=e.components,n=(0,r.Z)(e,a);return(0,o.kt)("wrapper",(0,t.Z)({},m,n,{components:i,mdxType:"MDXLayout"}),(0,o.kt)("p",null,"Il tuo menu \xe8 inutile a meno che non abbia voci di menu. \xc8 possibile aggiungere voci di menu che puntano a file locali o esterni."),(0,o.kt)("blockquote",null,(0,o.kt)("p",{parentName:"blockquote"},"L'URL per i siti esterni deve iniziare con http(s)://, ftp://, //, ecc.")),(0,o.kt)("blockquote",null,(0,o.kt)("p",{parentName:"blockquote"},"Puoi creare un divisore inserendo '-' come titolo dell'elemento")),(0,o.kt)("h2",{id:"aggiunta-elementi-del-menu"},"Aggiunta elementi del menu"),(0,o.kt)("p",null,"\xc8 possibile aggiungere voci di menu una voce alla volta, o \xe8 possibile aggiungere pi\xf9 voci di menu a uno."),(0,o.kt)("h3",{id:"aggiunta-di-singole-voci-di-menu"},"Aggiunta di singole voci di menu"),(0,o.kt)("p",null,"Per aggiungere una singola voce di menu,"),(0,o.kt)("ul",null,(0,o.kt)("li",{parentName:"ul"},"clicca sul pulsante ",(0,o.kt)("inlineCode",{parentName:"li"},"Aggiungi elemento menu")),(0,o.kt)("li",{parentName:"ul"},"Compila le informazioni richieste e premi ",(0,o.kt)("inlineCode",{parentName:"li"},"Salva"))),(0,o.kt)("h3",{id:"aggiunta-di-elementi-multipli"},"Aggiunta di elementi multipli"),(0,o.kt)("p",null,"Per aggiungere pi\xf9 voci di menu contemporaneamente,"),(0,o.kt)("ul",null,(0,o.kt)("li",{parentName:"ul"},"Fare clic sull'icona della freccia verso il basso accanto a ",(0,o.kt)("inlineCode",{parentName:"li"},"Aggiungi elemento del menu")),(0,o.kt)("li",{parentName:"ul"},"\xc8 possibile aggiungere manualmente gli elementi posizionando ogni elemento su una nuova riga e utilizzando gli elementi nido del carattere della scheda o"),(0,o.kt)("li",{parentName:"ul"},"Puoi fare clic su una delle opzioni fornite in fondo all'area di testo per riempire automaticamente le voci di menu")),(0,o.kt)("h2",{id:"riordina-le-voci-di-menu"},"Riordina le voci di menu"),(0,o.kt)("p",null,"\xc8 possibile trascinare e rilasciare le voci di menu su/gi\xf9 per impostare il loro ordine di visualizzazione, o trascinarle a sinistra/destra per impostare la gerarchia desiderata."),(0,o.kt)("h2",{id:"ricostruire-le-voci-di-menu"},"Ricostruire le voci di menu"),(0,o.kt)("p",null,"Se trovi che le voci di menu non vengono visualizzate correttamente, fai clic sul pulsante ",(0,o.kt)("inlineCode",{parentName:"p"},"Ricostruisci Albero")," per ricostruire le voci di menu."))}p.isMDXComponent=!0}}]);