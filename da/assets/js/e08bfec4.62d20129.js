(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[282],{3905:function(e,t,n){"use strict";n.d(t,{Zo:function(){return u},kt:function(){return c}});var r=n(7294);function i(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function l(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function a(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?l(Object(n),!0).forEach((function(t){i(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):l(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function o(e,t){if(null==e)return{};var n,r,i=function(e,t){if(null==e)return{};var n,r,i={},l=Object.keys(e);for(r=0;r<l.length;r++)n=l[r],t.indexOf(n)>=0||(i[n]=e[n]);return i}(e,t);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);for(r=0;r<l.length;r++)n=l[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(i[n]=e[n])}return i}var s=r.createContext({}),d=function(e){var t=r.useContext(s),n=t;return e&&(n="function"==typeof e?e(t):a(a({},t),e)),n},u=function(e){var t=d(e.components);return r.createElement(s.Provider,{value:t},e.children)},k={inlineCode:"code",wrapper:function(e){var t=e.children;return r.createElement(r.Fragment,{},t)}},p=r.forwardRef((function(e,t){var n=e.components,i=e.mdxType,l=e.originalType,s=e.parentName,u=o(e,["components","mdxType","originalType","parentName"]),p=d(n),c=i,f=p["".concat(s,".").concat(c)]||p[c]||k[c]||l;return n?r.createElement(f,a(a({ref:t},u),{},{components:n})):r.createElement(f,a({ref:t},u))}));function c(e,t){var n=arguments,i=t&&t.mdxType;if("string"==typeof e||i){var l=n.length,a=new Array(l);a[0]=p;var o={};for(var s in t)hasOwnProperty.call(t,s)&&(o[s]=t[s]);o.originalType=e,o.mdxType="string"==typeof e?e:i,a[1]=o;for(var d=2;d<l;d++)a[d]=n[d];return r.createElement.apply(null,a)}return r.createElement.apply(null,n)}p.displayName="MDXCreateElement"},8841:function(e,t,n){"use strict";n.r(t),n.d(t,{frontMatter:function(){return o},contentTitle:function(){return s},metadata:function(){return d},toc:function(){return u},default:function(){return p}});var r=n(2122),i=n(9756),l=(n(7294),n(3905)),a=["components"],o={title:"Indstilling af et standard layout",sidebar_position:4},s=void 0,d={unversionedId:"user/site/default-layout",id:"user/site/default-layout",isDocsHomePage:!1,title:"Indstilling af et standard layout",description:"N\xe5r du tilf\xf8jer en blok, tilf\xf8jes den til den specifikke side. Det ville derfor v\xe6re en kedelig opgave at s\xe6tte blokke for alle siderne p\xe5 dit websted. Du kan indstille alle \xf8nskede blokke for en bestemt side, og derefter indstille den side som standard layout. Med andre ord, enhver side, der ikke har sine egne blokke, vil arve blokke fra denne side.",source:"@site/i18n/da/docusaurus-plugin-content-docs/current/user/site/default-layout.md",sourceDirName:"user/site",slug:"/user/site/default-layout",permalink:"/phpBB-ext-sitemaker/da/docs/user/site/default-layout",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/da",version:"current",sidebarPosition:4,frontMatter:{title:"Indstilling af et standard layout",sidebar_position:4},sidebar:"tutorialSidebar",previous:{title:"Indstilling af en startside",permalink:"/phpBB-ext-sitemaker/da/docs/user/site/startpage"},next:{title:"Blokarv",permalink:"/phpBB-ext-sitemaker/da/docs/user/site/block-inheritance"}},u=[],k={toc:u};function p(e){var t=e.components,n=(0,i.Z)(e,a);return(0,l.kt)("wrapper",(0,r.Z)({},k,n,{components:t,mdxType:"MDXLayout"}),(0,l.kt)("p",null,"N\xe5r du tilf\xf8jer en blok, tilf\xf8jes den til den specifikke side. Det ville derfor v\xe6re en kedelig opgave at s\xe6tte blokke for alle siderne p\xe5 dit websted. Du kan indstille alle \xf8nskede blokke for en bestemt side, og derefter indstille den side som standard layout. Med andre ord, enhver side, der ikke har sine egne blokke, vil arve blokke fra denne side."),(0,l.kt)("p",null,"For at indstille et standardlayout"),(0,l.kt)("ul",null,(0,l.kt)("li",{parentName:"ul"},"G\xe5 til den side, du gerne vil angive som standard layout"),(0,l.kt)("li",{parentName:"ul"},"Klik p\xe5 ",(0,l.kt)("inlineCode",{parentName:"li"},"Indstillinger")," i admin bj\xe6lken"),(0,l.kt)("li",{parentName:"ul"},"Klik p\xe5 knappen ",(0,l.kt)("inlineCode",{parentName:"li"},"S\xe6t som standard layout"))),(0,l.kt)("p",null,"Sig at vi tilf\xf8jer blokke til en side (phpBB/index.php) med blokke i sidepanelet og toppositioner, for eksempel, og s\xe6t det som vores standard layout. Dette har f\xf8lgende virkninger p\xe5 andre sider:"),(0,l.kt)("ul",null,(0,l.kt)("li",{parentName:"ul"},"Enhver side, der ikke har sine egne blokke, vil arve blokkene fra standard layout. Se ",(0,l.kt)("a",{parentName:"li",href:"/docs/user/site/block-inheritance"},"Forst\xe5else blok arv")," for undtagelser."),(0,l.kt)("li",{parentName:"ul"},"Du kan stadig arve blokke fra et standard layout (indeks. hp), men v\xe6lg ikke at vise blokke p\xe5 nogle blokpositioner eller slet ikke vise nogen blokke. For at g\xf8re dette,",(0,l.kt)("ul",{parentName:"li"},(0,l.kt)("li",{parentName:"ul"},"G\xe5 til den side, du ikke \xf8nsker, at alle/nogle blokke skal vises"),(0,l.kt)("li",{parentName:"ul"},"Klik p\xe5 ",(0,l.kt)("inlineCode",{parentName:"li"},"Indstillinger")," i admin bj\xe6lken"),(0,l.kt)("li",{parentName:"ul"},"V\xe6lg ",(0,l.kt)("inlineCode",{parentName:"li"},"Vis ikke blokke p\xe5 denne side")," , hvis du ikke \xf8nsker at arve/vise nogen blokke p\xe5 denne side ELLER"),(0,l.kt)("li",{parentName:"ul"},"Brug CTRL + klik for at v\xe6lge de blok positioner (til h\xf8jre), som du ikke \xf8nsker at vise blokke p\xe5"))),(0,l.kt)("li",{parentName:"ul"},"I ",(0,l.kt)("inlineCode",{parentName:"li"},"redigeringstilstand"),", en side, der arver blokke fra standard layout, vil ikke vise blokke, hvilket giver dig mulighed for at tilf\xf8je blokke til siden, hvis du vil"),(0,l.kt)("li",{parentName:"ul"},"Enhver side, der har sine egne blokke, vil ikke arve fra standard layout")))}p.isMDXComponent=!0}}]);