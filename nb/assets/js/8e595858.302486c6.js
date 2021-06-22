(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[759],{3905:function(e,r,n){"use strict";n.d(r,{Zo:function(){return p},kt:function(){return c}});var t=n(7294);function i(e,r,n){return r in e?Object.defineProperty(e,r,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[r]=n,e}function l(e,r){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var t=Object.getOwnPropertySymbols(e);r&&(t=t.filter((function(r){return Object.getOwnPropertyDescriptor(e,r).enumerable}))),n.push.apply(n,t)}return n}function o(e){for(var r=1;r<arguments.length;r++){var n=null!=arguments[r]?arguments[r]:{};r%2?l(Object(n),!0).forEach((function(r){i(e,r,n[r])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):l(Object(n)).forEach((function(r){Object.defineProperty(e,r,Object.getOwnPropertyDescriptor(n,r))}))}return e}function a(e,r){if(null==e)return{};var n,t,i=function(e,r){if(null==e)return{};var n,t,i={},l=Object.keys(e);for(t=0;t<l.length;t++)n=l[t],r.indexOf(n)>=0||(i[n]=e[n]);return i}(e,r);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);for(t=0;t<l.length;t++)n=l[t],r.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(i[n]=e[n])}return i}var s=t.createContext({}),d=function(e){var r=t.useContext(s),n=r;return e&&(n="function"==typeof e?e(r):o(o({},r),e)),n},p=function(e){var r=d(e.components);return t.createElement(s.Provider,{value:r},e.children)},u={inlineCode:"code",wrapper:function(e){var r=e.children;return t.createElement(t.Fragment,{},r)}},k=t.forwardRef((function(e,r){var n=e.components,i=e.mdxType,l=e.originalType,s=e.parentName,p=a(e,["components","mdxType","originalType","parentName"]),k=d(n),c=i,m=k["".concat(s,".").concat(c)]||k[c]||u[c]||l;return n?t.createElement(m,o(o({ref:r},p),{},{components:n})):t.createElement(m,o({ref:r},p))}));function c(e,r){var n=arguments,i=r&&r.mdxType;if("string"==typeof e||i){var l=n.length,o=new Array(l);o[0]=k;var a={};for(var s in r)hasOwnProperty.call(r,s)&&(a[s]=r[s]);a.originalType=e,a.mdxType="string"==typeof e?e:i,o[1]=a;for(var d=2;d<l;d++)o[d]=n[d];return t.createElement.apply(null,o)}return t.createElement.apply(null,n)}k.displayName="MDXCreateElement"},9868:function(e,r,n){"use strict";n.r(r),n.d(r,{frontMatter:function(){return a},contentTitle:function(){return s},metadata:function(){return d},toc:function(){return p},default:function(){return k}});var t=n(2122),i=n(9756),l=(n(7294),n(3905)),o=["components"],a={title:"Egendefinert blokk",sidebar_position:4},s=void 0,d={unversionedId:"user/blocks/custom-blocks",id:"user/blocks/custom-blocks",isDocsHomePage:!1,title:"Egendefinert blokk",description:"Hvis tilgjengelige blokker ikke gir deg den friheten du trenger, Det er Egendefinerte blokker som lar deg friheten til \xe5 vise ditt eget innhold ved hjelp av BBcode eller HTML. Blokken kommer med en WYSIWYG editor (TinyMCE) og administrerer:",source:"@site/i18n/nb/docusaurus-plugin-content-docs/current/user/blocks/custom-blocks.md",sourceDirName:"user/blocks",slug:"/user/blocks/custom-blocks",permalink:"/phpBB-ext-sitemaker/nb/docs/user/blocks/custom-blocks",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/nb",version:"current",sidebarPosition:4,frontMatter:{title:"Egendefinert blokk",sidebar_position:4},sidebar:"tutorialSidebar",previous:{title:"Mananaging Blocks",permalink:"/phpBB-ext-sitemaker/nb/docs/user/blocks/managing-blocks"},next:{title:"Administrere menyer",permalink:"/phpBB-ext-sitemaker/nb/docs/user/menus/managing-menus"}},p=[{value:"Redakt\xf8r",id:"redakt\xf8r",children:[]},{value:"Skript behandler",id:"skript-behandler",children:[]}],u={toc:p};function k(e){var r=e.components,n=(0,i.Z)(e,o);return(0,l.kt)("wrapper",(0,t.Z)({},u,n,{components:r,mdxType:"MDXLayout"}),(0,l.kt)("p",null,"Hvis tilgjengelige blokker ikke gir deg den friheten du trenger, Det er ",(0,l.kt)("inlineCode",{parentName:"p"},"Egendefinerte blokker")," som lar deg friheten til \xe5 vise ditt eget innhold ved hjelp av BBcode eller HTML. Blokken kommer med en WYSIWYG editor (TinyMCE) og administrerer:"),(0,l.kt)("h2",{id:"redakt\xf8r"},"Redakt\xf8r"),(0,l.kt)("ul",null,(0,l.kt)("li",{parentName:"ul"},"Du kan bruke redigeringsprogrammet for \xe5 lage HTML-innhold"),(0,l.kt)("li",{parentName:"ul"},"Du kan redigere kildekoden hvis du trenger det kontrollniv\xe5et ved \xe5 klikke p\xe5 ",(0,l.kt)("inlineCode",{parentName:"li"},"Kildekode")," -ikonet (",(0,l.kt)("inlineCode",{parentName:"li"},"<>"),") i editoren"),(0,l.kt)("li",{parentName:"ul"},"Redigeringsprogrammet lar deg laste opp og endre bilder",(0,l.kt)("ul",{parentName:"li"},(0,l.kt)("li",{parentName:"ul"},"Det oppretter en ny mappe i phpBB/images/sitemaker_uploads/ for alle brukere som har tilgang til den"),(0,l.kt)("li",{parentName:"ul"},"Du kan se/behandle alle brukermapper"))),(0,l.kt)("li",{parentName:"ul"},"Redigeringsprogrammet filtrerer ut potensielt farlige skripter som javascript, osv. Hvis du trenger \xe5 legge til innhold som google annonser, vil JavaScript filtreres ut, men det kan du komme deg rundt ved \xe5 gj\xf8re f\xf8lgende:",(0,l.kt)("ul",{parentName:"li"},(0,l.kt)("li",{parentName:"ul"},"Legg til den egendefinerte blokken til \xf8nsket sted"),(0,l.kt)("li",{parentName:"ul"},"Rediger egendefinert blokk, klikk p\xe5 ",(0,l.kt)("inlineCode",{parentName:"li"},"HTML")," og lim inn Javascript")))),(0,l.kt)("h2",{id:"skript-behandler"},"Skript behandler"),(0,l.kt)("p",null,"Den egendefinerte blokken lar deg ogs\xe5 legge til egendefinerte CSS-filer til siden din. \xc5 gj\xf8re dette:"),(0,l.kt)("ul",null,(0,l.kt)("li",{parentName:"ul"},"Legg til en ",(0,l.kt)("inlineCode",{parentName:"li"},"egendefinert blokk")," i hvilken som helst blokkposisjon. Denne posisjonen spiller ingen rolle med mindre du ogs\xe5 viser innhold med blokken"),(0,l.kt)("li",{parentName:"ul"},"Rediger blokken, klikk p\xe5 ",(0,l.kt)("inlineCode",{parentName:"li"},"Scripts")," fanen og legg til dine CSS eller Javascript-filer > Derfor: Legge til mange skript p\xe5 siden kan p\xe5virke innlastingstiden")))}k.isMDXComponent=!0}}]);