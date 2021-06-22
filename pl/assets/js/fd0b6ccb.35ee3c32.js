(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[488],{3905:function(e,t,n){"use strict";n.d(t,{Zo:function(){return u},kt:function(){return m}});var a=n(7294);function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function o(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function i(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?o(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):o(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function l(e,t){if(null==e)return{};var n,a,r=function(e,t){if(null==e)return{};var n,a,r={},o=Object.keys(e);for(a=0;a<o.length;a++)n=o[a],t.indexOf(n)>=0||(r[n]=e[n]);return r}(e,t);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);for(a=0;a<o.length;a++)n=o[a],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(r[n]=e[n])}return r}var p=a.createContext({}),s=function(e){var t=a.useContext(p),n=t;return e&&(n="function"==typeof e?e(t):i(i({},t),e)),n},u=function(e){var t=s(e.components);return a.createElement(p.Provider,{value:t},e.children)},k={inlineCode:"code",wrapper:function(e){var t=e.children;return a.createElement(a.Fragment,{},t)}},c=a.forwardRef((function(e,t){var n=e.components,r=e.mdxType,o=e.originalType,p=e.parentName,u=l(e,["components","mdxType","originalType","parentName"]),c=s(n),m=r,y=c["".concat(p,".").concat(m)]||c[m]||k[m]||o;return n?a.createElement(y,i(i({ref:t},u),{},{components:n})):a.createElement(y,i({ref:t},u))}));function m(e,t){var n=arguments,r=t&&t.mdxType;if("string"==typeof e||r){var o=n.length,i=new Array(o);i[0]=c;var l={};for(var p in t)hasOwnProperty.call(t,p)&&(l[p]=t[p]);l.originalType=e,l.mdxType="string"==typeof e?e:r,i[1]=l;for(var s=2;s<o;s++)i[s]=n[s];return a.createElement.apply(null,i)}return a.createElement.apply(null,n)}c.displayName="MDXCreateElement"},1831:function(e,t,n){"use strict";n.r(t),n.d(t,{frontMatter:function(){return l},contentTitle:function(){return p},metadata:function(){return s},toc:function(){return u},default:function(){return c}});var a=n(2122),r=n(9756),o=(n(7294),n(3905)),i=["components"],l={title:"Motyw",sidebar_position:3},p=void 0,s={unversionedId:"dev/theming",id:"dev/theming",isDocsHomePage:!1,title:"Motyw",description:"Rozumiemy, \u017ce pliki szablon\xf3w i pliki JS/CSS nie b\u0119d\u0105 dzia\u0142a\u0107 dla ka\u017cdego stylu, wi\u0119c poni\u017cej mo\u017cesz u\u017cy\u0107 w\u0142asnych szablon\xf3w i utworzy\u0107 pliki JS/CSS dla Twojego konkretnego stylu.",source:"@site/i18n/pl/docusaurus-plugin-content-docs/current/dev/theming.md",sourceDirName:"dev",slug:"/dev/theming",permalink:"/phpBB-ext-sitemaker/pl/docs/dev/theming",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/pl",version:"current",sidebarPosition:3,frontMatter:{title:"Motyw",sidebar_position:3},sidebar:"tutorialSidebar",previous:{title:"Wydarzenia phpBB SiteMaker",permalink:"/phpBB-ext-sitemaker/pl/docs/dev/events"},next:{title:"Zaanga\u017cuj si\u0119",permalink:"/phpBB-ext-sitemaker/pl/docs/contrib/overview"}},u=[{value:"U\u017cywanie w\u0142asnego szablonu",id:"u\u017cywanie-w\u0142asnego-szablonu",children:[]},{value:"Tworzenie plik\xf3w JS/CSS dla twojego stylu",id:"tworzenie-plik\xf3w-jscss-dla-twojego-stylu",children:[]}],k={toc:u};function c(e){var t=e.components,n=(0,r.Z)(e,i);return(0,o.kt)("wrapper",(0,a.Z)({},k,n,{components:t,mdxType:"MDXLayout"}),(0,o.kt)("p",null,"Rozumiemy, \u017ce pliki szablon\xf3w i pliki JS/CSS nie b\u0119d\u0105 dzia\u0142a\u0107 dla ka\u017cdego stylu, wi\u0119c poni\u017cej mo\u017cesz u\u017cy\u0107 w\u0142asnych szablon\xf3w i utworzy\u0107 pliki JS/CSS dla Twojego konkretnego stylu."),(0,o.kt)("h2",{id:"u\u017cywanie-w\u0142asnego-szablonu"},"U\u017cywanie w\u0142asnego szablonu"),(0,o.kt)("p",null,"Je\u015bli domy\u015blne szablony z phpBB Sitemaker nie dzia\u0142aj\u0105 dobrze dla Twojego konkretnego stylu, mo\u017cesz \u0142atwo nadpisa\u0107 plik, aby u\u017cy\u0107 w\u0142asnego pliku szablonu, tworz\u0105c odpowiedni plik w folderze styl\xf3w."),(0,o.kt)("p",null,"Na przyk\u0142ad powiedz \u017ce tw\xf3j styl jest nazywany ",(0,o.kt)("inlineCode",{parentName:"p"},"Backlash")," i ma on szczeg\xf3lny spos\xf3b, w jaki HTML dla sekcji nag\u0142\xf3wka bloku musi by\u0107 ustrukturyzowany dla ",(0,o.kt)("a",{parentName:"p",href:"/docs/user/blocks/block-views"},"widoku p\xf3l"),". Mo\u017cesz nadpisa\u0107 ten konkretny szablon tworz\u0105c plik o tej samej nazwie jak tak: ",(0,o.kt)("inlineCode",{parentName:"p"},"phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig"),"."),(0,o.kt)("p",null,"Innymi s\u0142owy, aby u\u017cy\u0107 w\u0142asnego pliku szablonu, musisz:"),(0,o.kt)("ul",null,(0,o.kt)("li",{parentName:"ul"},"Okre\u015bl kt\xf3ry plik phpBB Sitemaker musi by\u0107 nadpisany"),(0,o.kt)("li",{parentName:"ul"},"Utw\xf3rz plik o tej samej nazwie w folderze Sitemaker ",(0,o.kt)("inlineCode",{parentName:"li"},"style")," pod nazw\u0105 Twojego stylu")),(0,o.kt)("blockquote",null,(0,o.kt)("p",{parentName:"blockquote"},"Uwaga: Je\u015bli utworzysz w\u0142asne pliki szablonu, upewnij si\u0119, \u017ce nie usu\u0144 folderu ",(0,o.kt)("inlineCode",{parentName:"p"},"phpbb/ext/blitze/sitemaker")," podczas aktualizacji rozszerzenia, poniewa\u017c twoje niestandardowe pliki zostan\u0105 usuni\u0119te. Zamiast tego po prostu nadpisz istniej\u0105ce pliki nowymi plikami.")),(0,o.kt)("h2",{id:"tworzenie-plik\xf3w-jscss-dla-twojego-stylu"},"Tworzenie plik\xf3w JS/CSS dla twojego stylu"),(0,o.kt)("p",null,"Uwaga:"),(0,o.kt)("ul",null,(0,o.kt)("li",{parentName:"ul"},"Do cel\xf3w poni\u017cszych instrukcji zak\u0142adamy, \u017ce masz styl zwany my-stylem.")),(0,o.kt)("p",null,"Sklonuj do phpBB/ext/blitze/sitemaker:"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"Klon git https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker\n")),(0,o.kt)("p",null,"Z wiersza polece\u0144 przejd\u017a do katalogu sitemaker:"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"cd phpBB/ext/blitze/sitemaker\n")),(0,o.kt)("p",null,(0,o.kt)("strong",{parentName:"p"},"Zainstaluj dostawc\xf3w")),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"instalacja kompozytora\n")),(0,o.kt)("p",null,(0,o.kt)("strong",{parentName:"p"},"Instaluj pakiety")),(0,o.kt)("p",null,"Dla poni\u017cszych polece\u0144 mo\u017cesz u\u017cy\u0107 npm lub ",(0,o.kt)("a",{parentName:"p",href:"https://yarnpkg.com"},"yarn")),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"yarn instalacja\n")),(0,o.kt)("p",null,(0,o.kt)("strong",{parentName:"p"},"Obejrzyj zmiany")),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"yarn start --theme my-style\n")),(0,o.kt)("p",null,(0,o.kt)("strong",{parentName:"p"},"Dokonaj zmian")),(0,o.kt)("ul",null,(0,o.kt)("li",{parentName:"ul"},"Dokonaj zmian w plikach w folderze phpBB/ext/blitze/sitemaker/rozwi\u0144 folder."),(0,o.kt)("li",{parentName:"ul"},"Sp\xf3jrz na phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss dla zmiennych sass")),(0,o.kt)("p",null,(0,o.kt)("strong",{parentName:"p"},"Zbuduj zasoby")),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"yarn kompilacja --theme my-style\n")),(0,o.kt)("p",null,(0,o.kt)("strong",{parentName:"p"},"Wdro\u017cenie")),(0,o.kt)("p",null,"Teraz mo\u017cesz skopiowa\u0107 wygenerowane pliki z phpBB/ext/blitze/sitemaker/styles/my-style i przes\u0142a\u0107 je na serwer produkcyjny."),(0,o.kt)("blockquote",null,(0,o.kt)("p",{parentName:"blockquote"},"To rozszerzenie u\u017cywa jQuery UI dla kart, dialog\xf3w i przycisk\xf3w. Domy\u015blny motyw jQuery to 'g\u0142adko\u015b\u0107'. Mo\u017cesz u\u017cy\u0107 innego szablonu jQuery UI, kt\xf3ry najlepiej pasuje do twojego motywu. Mo\u017cesz okre\u015bli\u0107 motyw jQuery UI za pomoc\u0105 flagi --jq_ui_theme. Na przyk\u0142ad:")),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"yarn build --theme my-style --jq_ui_theme ui-lightness\n")))}c.isMDXComponent=!0}}]);