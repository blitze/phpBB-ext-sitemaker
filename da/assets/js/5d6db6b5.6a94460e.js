(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[341],{3905:function(e,t,r){"use strict";r.d(t,{Zo:function(){return u},kt:function(){return m}});var n=r(7294);function o(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function i(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function a(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?i(Object(r),!0).forEach((function(t){o(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):i(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function l(e,t){if(null==e)return{};var r,n,o=function(e,t){if(null==e)return{};var r,n,o={},i=Object.keys(e);for(n=0;n<i.length;n++)r=i[n],t.indexOf(r)>=0||(o[r]=e[r]);return o}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(n=0;n<i.length;n++)r=i[n],t.indexOf(r)>=0||Object.prototype.propertyIsEnumerable.call(e,r)&&(o[r]=e[r])}return o}var s=n.createContext({}),d=function(e){var t=n.useContext(s),r=t;return e&&(r="function"==typeof e?e(t):a(a({},t),e)),r},u=function(e){var t=d(e.components);return n.createElement(s.Provider,{value:t},e.children)},p={inlineCode:"code",wrapper:function(e){var t=e.children;return n.createElement(n.Fragment,{},t)}},c=n.forwardRef((function(e,t){var r=e.components,o=e.mdxType,i=e.originalType,s=e.parentName,u=l(e,["components","mdxType","originalType","parentName"]),c=d(r),m=o,b=c["".concat(s,".").concat(m)]||c[m]||p[m]||i;return r?n.createElement(b,a(a({ref:t},u),{},{components:r})):n.createElement(b,a({ref:t},u))}));function m(e,t){var r=arguments,o=t&&t.mdxType;if("string"==typeof e||o){var i=r.length,a=new Array(i);a[0]=c;var l={};for(var s in t)hasOwnProperty.call(t,s)&&(l[s]=t[s]);l.originalType=e,l.mdxType="string"==typeof e?e:o,a[1]=l;for(var d=2;d<i;d++)a[d]=r[d];return n.createElement.apply(null,a)}return n.createElement.apply(null,r)}c.displayName="MDXCreateElement"},7269:function(e,t,r){"use strict";r.r(t),r.d(t,{frontMatter:function(){return l},contentTitle:function(){return s},metadata:function(){return d},toc:function(){return u},default:function(){return c}});var n=r(2122),o=r(9756),i=(r(7294),r(3905)),a=["components"],l={title:"Layout",sidebar_position:1},s=void 0,d={unversionedId:"user/site/layouts",id:"user/site/layouts",isDocsHomePage:!1,title:"Layout",description:'"Layouts" bestemmer de tilg\xe6ngelige blokpositioner og hvordan de vises.',source:"@site/i18n/da/docusaurus-plugin-content-docs/current/user/site/layouts.md",sourceDirName:"user/site",slug:"/user/site/layouts",permalink:"/phpBB-ext-sitemaker/da/docs/user/site/layouts",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/da",version:"current",sidebarPosition:1,frontMatter:{title:"Layout",sidebar_position:1},sidebar:"tutorialSidebar",previous:{title:"Viser Menuer",permalink:"/phpBB-ext-sitemaker/da/docs/user/menus/displaying-menus"},next:{title:"Navigationsbj\xe6lke",permalink:"/phpBB-ext-sitemaker/da/docs/user/site/navbar"}},u=[{value:"Blok Positioner",id:"blok-positioner",children:[]},{value:"Websteds Layout",id:"websteds-layout",children:[]},{value:"Brugerdefinerede skabeloner/stilarter",id:"brugerdefinerede-skabelonerstilarter",children:[]}],p={toc:u};function c(e){var t=e.components,r=(0,o.Z)(e,a);return(0,i.kt)("wrapper",(0,n.Z)({},p,r,{components:t,mdxType:"MDXLayout"}),(0,i.kt)("p",null,'"Layouts" bestemmer de tilg\xe6ngelige blokpositioner og hvordan de vises.'),(0,i.kt)("h2",{id:"blok-positioner"},"Blok Positioner"),(0,i.kt)("p",null,"Blok positioner er foruddefinerede omr\xe5der p\xe5 dit websted, hvor blokke kan eksistere. De tilg\xe6ngelige blokpositioner bestemmes af den skabelonstil, du bruger. For prosilver, phpBB SiteMaker kommer med f\xf8lgende blok positioner:"),(0,i.kt)("ul",null,(0,i.kt)("li",{parentName:"ul"},"panel: fuld bredde over toppen"),(0,i.kt)("li",{parentName:"ul"},"sidepanel: Venstre/h\xf8jre afh\xe6ngigt af layout nedenfor"),(0,i.kt)("li",{parentName:"ul"},"underindhold: ligner sidepanel lige st\xf8rre"),(0,i.kt)("li",{parentName:"ul"},"top_hor: vandrette blokke over toppen, flanking over sidebar/underindhold afh\xe6ngigt af layout"),(0,i.kt)("li",{parentName:"ul"},"top: over hovedindhold"),(0,i.kt)("li",{parentName:"ul"},"box : lige bredde, vandrette blokke under hovedindholdet"),(0,i.kt)("li",{parentName:"ul"},"bund: under hovedindhold"),(0,i.kt)("li",{parentName:"ul"},"bottom_hor: horisontale blokke over bunden, flanking sidebar/underindhold afh\xe6ngigt af layout"),(0,i.kt)("li",{parentName:"ul"},"footer: horisontale blokke i footer Du kan tilf\xf8je flere blokpositioner i dine egne stilskabeloner ved at kopiere og \xe6ndre de tilsvarende phpBB SiteMaker skabeloner")),(0,i.kt)("h2",{id:"websteds-layout"},"Websteds Layout"),(0,i.kt)("p",null,"Du kan v\xe6lge layoutet for dit websted i AVS (ekstensioner > Sitemaker > Indstillinger):"),(0,i.kt)("ul",null,(0,i.kt)("li",{parentName:"ul"},(0,i.kt)("strong",{parentName:"li"},"Blog"),": subindhold og sidebar ved siden af hinanden, skubbet til det h\xf8jre, top_hor/botom_hor flank underindhold"),(0,i.kt)("li",{parentName:"ul"},(0,i.kt)("strong",{parentName:"li"},"Holy Grail"),": lige bredde sidebar og subcontent p\xe5 modsatte sider, top_hor/botom_hor flank subcontent"),(0,i.kt)("li",{parentName:"ul"},(0,i.kt)("strong",{parentName:"li"},"Portal"),": sidebar til venstre, subcontent til h\xf8jre, top_hor/botom_hor flank subcontent"),(0,i.kt)("li",{parentName:"ul"},(0,i.kt)("strong",{parentName:"li"},"Portal Alt"),": underindhold til venstre, sidebar til h\xf8jre, top_hor/botom_hor flank sidebar"),(0,i.kt)("li",{parentName:"ul"},(0,i.kt)("strong",{parentName:"li"},"Brugerdefineret"),": Indstil bredden af sidepanelerne manuelt som px, %, em eller rem. Standard er 200px p\xe5 hver side")),(0,i.kt)("h2",{id:"brugerdefinerede-skabelonerstilarter"},"Brugerdefinerede skabeloner/stilarter"),(0,i.kt)("p",null,"S\xe5 vidt muligt vi fors\xf8gte at s\xe6tte skabelonfiler og -filer i stil/alle / mappe, s\xe5 du kan overskrive dem ved at oprette en fil med samme navn under dit eget skabelontema . . prosilver. S\xe5 hvis du \xf8nsker at \xe6ndre, hvordan en bestemt blok vises, eller hvis du \xf8nsker at oprette dit eget layout med dine egne blok positioner, du simpelthen n\xf8dt til at oprette en fil med samme navn og sti som originalen i din egen stil."),(0,i.kt)("p",null,"Hvis du har brug for at tilpasse CSS/JS-filer, s\xe5 tag et kig p\xe5 afsnittet ",(0,i.kt)("a",{parentName:"p",href:"/docs/dev/theming"},"theming"),"."))}c.isMDXComponent=!0}}]);