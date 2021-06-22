(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[664],{3905:function(e,t,r){"use strict";r.d(t,{Zo:function(){return u},kt:function(){return d}});var n=r(7294);function o(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function s(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function i(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?s(Object(r),!0).forEach((function(t){o(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):s(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function l(e,t){if(null==e)return{};var r,n,o=function(e,t){if(null==e)return{};var r,n,o={},s=Object.keys(e);for(n=0;n<s.length;n++)r=s[n],t.indexOf(r)>=0||(o[r]=e[r]);return o}(e,t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);for(n=0;n<s.length;n++)r=s[n],t.indexOf(r)>=0||Object.prototype.propertyIsEnumerable.call(e,r)&&(o[r]=e[r])}return o}var p=n.createContext({}),a=function(e){var t=n.useContext(p),r=t;return e&&(r="function"==typeof e?e(t):i(i({},t),e)),r},u=function(e){var t=a(e.components);return n.createElement(p.Provider,{value:t},e.children)},c={inlineCode:"code",wrapper:function(e){var t=e.children;return n.createElement(n.Fragment,{},t)}},m=n.forwardRef((function(e,t){var r=e.components,o=e.mdxType,s=e.originalType,p=e.parentName,u=l(e,["components","mdxType","originalType","parentName"]),m=a(r),d=o,f=m["".concat(p,".").concat(d)]||m[d]||c[d]||s;return r?n.createElement(f,i(i({ref:t},u),{},{components:r})):n.createElement(f,i({ref:t},u))}));function d(e,t){var r=arguments,o=t&&t.mdxType;if("string"==typeof e||o){var s=r.length,i=new Array(s);i[0]=m;var l={};for(var p in t)hasOwnProperty.call(t,p)&&(l[p]=t[p]);l.originalType=e,l.mdxType="string"==typeof e?e:o,i[1]=l;for(var a=2;a<s;a++)i[a]=r[a];return n.createElement.apply(null,i)}return n.createElement.apply(null,r)}m.displayName="MDXCreateElement"},3677:function(e,t,r){"use strict";r.r(t),r.d(t,{frontMatter:function(){return l},contentTitle:function(){return p},metadata:function(){return a},toc:function(){return u},default:function(){return m}});var n=r(2122),o=r(9756),s=(r(7294),r(3905)),i=["components"],l={title:"Th\xe8me",sidebar_position:3},p=void 0,a={unversionedId:"dev/theming",id:"dev/theming",isDocsHomePage:!1,title:"Th\xe8me",description:"Nous comprenons que les fichiers de mod\xe8les et les fichiers JS/CSS ne fonctionneront pas pour tous les styles, ainsi vous pouvez utiliser vos propres mod\xe8les et cr\xe9er des fichiers JS/CSS pour votre style particulier.",source:"@site/i18n/fr/docusaurus-plugin-content-docs/current/dev/theming.md",sourceDirName:"dev",slug:"/dev/theming",permalink:"/phpBB-ext-sitemaker/fr/docs/dev/theming",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/fr",version:"current",sidebarPosition:3,frontMatter:{title:"Th\xe8me",sidebar_position:3},sidebar:"tutorialSidebar",previous:{title:"\xc9v\xe9nements phpBB SiteMaker",permalink:"/phpBB-ext-sitemaker/fr/docs/dev/events"},next:{title:"Impliquez-vous",permalink:"/phpBB-ext-sitemaker/fr/docs/contrib/overview"}},u=[{value:"Utiliser votre propre mod\xe8le",id:"utiliser-votre-propre-mod\xe8le",children:[]},{value:"Cr\xe9ation de fichiers JS/CSS pour votre style",id:"cr\xe9ation-de-fichiers-jscss-pour-votre-style",children:[]}],c={toc:u};function m(e){var t=e.components,r=(0,o.Z)(e,i);return(0,s.kt)("wrapper",(0,n.Z)({},c,r,{components:t,mdxType:"MDXLayout"}),(0,s.kt)("p",null,"Nous comprenons que les fichiers de mod\xe8les et les fichiers JS/CSS ne fonctionneront pas pour tous les styles, ainsi vous pouvez utiliser vos propres mod\xe8les et cr\xe9er des fichiers JS/CSS pour votre style particulier."),(0,s.kt)("h2",{id:"utiliser-votre-propre-mod\xe8le"},"Utiliser votre propre mod\xe8le"),(0,s.kt)("p",null,"Si les mod\xe8les par d\xe9faut fournis avec phpBB Sitemaker ne fonctionnent pas correctement pour votre style particulier, vous pouvez facilement l'\xe9craser pour utiliser votre propre fichier de mod\xe8le en cr\xe9ant le fichier correspondant dans le dossier de vos styles."),(0,s.kt)("p",null,"Par exemple, disons que votre style s'appelle ",(0,s.kt)("inlineCode",{parentName:"p"},"Backlash")," et qu'il a une fa\xe7on particuli\xe8re de structurer le HTML de la section d'en-t\xeate de bloc pour la ",(0,s.kt)("a",{parentName:"p",href:"/docs/user/blocks/block-views"},"vue en bo\xeete"),". Vous pouvez \xe9craser ce mod\xe8le en cr\xe9ant un fichier sous le m\xeame nom que celui-ci : ",(0,s.kt)("inlineCode",{parentName:"p"},"phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig"),"."),(0,s.kt)("p",null,"En d'autres termes, pour utiliser votre propre fichier de mod\xe8le, vous devez :"),(0,s.kt)("ul",null,(0,s.kt)("li",{parentName:"ul"},"Identifier quel fichier phpBB Sitemaker doit \xeatre \xe9cras\xe9"),(0,s.kt)("li",{parentName:"ul"},"Cr\xe9ez un fichier avec le m\xeame nom dans le dossier ",(0,s.kt)("inlineCode",{parentName:"li"},"styles")," du Sitemaker sous votre nom de style")),(0,s.kt)("blockquote",null,(0,s.kt)("p",{parentName:"blockquote"},"Remarque : Si vous cr\xe9ez vos propres fichiers de mod\xe8les, Assurez-vous de ne pas supprimer le dossier ",(0,s.kt)("inlineCode",{parentName:"p"},"phpbb/ext/blitze/sitemaker")," lors de la mise \xe0 jour de l'extension car vos fichiers personnalis\xe9s seront supprim\xe9s. Plut\xf4t, il suffit d'\xe9craser les fichiers existants avec les nouveaux.")),(0,s.kt)("h2",{id:"cr\xe9ation-de-fichiers-jscss-pour-votre-style"},"Cr\xe9ation de fichiers JS/CSS pour votre style"),(0,s.kt)("p",null,"Note :"),(0,s.kt)("ul",null,(0,s.kt)("li",{parentName:"ul"},"Aux fins des instructions ci-dessous, nous supposerons que vous avez un style appel\xe9 mon-style.")),(0,s.kt)("p",null,"Cloner dans phpBB/ext/blitze/sitemaker:"),(0,s.kt)("pre",null,(0,s.kt)("code",{parentName:"pre"},"git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker\n")),(0,s.kt)("p",null,"\xc0 partir de la ligne de commande, allez dans le r\xe9pertoire sitemaker :"),(0,s.kt)("pre",null,(0,s.kt)("code",{parentName:"pre"},"cd phpBB/ext/blitze/sitemaker\n")),(0,s.kt)("p",null,(0,s.kt)("strong",{parentName:"p"},"Installer les vendeurs")),(0,s.kt)("pre",null,(0,s.kt)("code",{parentName:"pre"},"installation de compositeur\n")),(0,s.kt)("p",null,(0,s.kt)("strong",{parentName:"p"},"Installer des paquets")),(0,s.kt)("p",null,"Pour les commandes ci-dessous, vous pouvez utiliser npm ou ",(0,s.kt)("a",{parentName:"p",href:"https://yarnpkg.com"},"yarn")),(0,s.kt)("pre",null,(0,s.kt)("code",{parentName:"pre"},"yarn install\n")),(0,s.kt)("p",null,(0,s.kt)("strong",{parentName:"p"},"Regarder les changements")),(0,s.kt)("pre",null,(0,s.kt)("code",{parentName:"pre"},"yarn start --theme mon-style\n")),(0,s.kt)("p",null,(0,s.kt)("strong",{parentName:"p"},"Effectuer des modifications")),(0,s.kt)("ul",null,(0,s.kt)("li",{parentName:"ul"},"Effectuez vos modifications dans le dossier phpBB/ext/blitze/sitemaker/developper."),(0,s.kt)("li",{parentName:"ul"},"Regardez phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss pour les variables sass")),(0,s.kt)("p",null,(0,s.kt)("strong",{parentName:"p"},"Actifs de construction")),(0,s.kt)("pre",null,(0,s.kt)("code",{parentName:"pre"},"yarn build --theme mon-style\n")),(0,s.kt)("p",null,(0,s.kt)("strong",{parentName:"p"},"D\xe9ployer")),(0,s.kt)("p",null,"Vous pouvez maintenant copier les fichiers g\xe9n\xe9r\xe9s \xe0 partir de phpBB/ext/blitze/sitemaker/styles/mon-style et les t\xe9l\xe9charger sur votre serveur de production."),(0,s.kt)("blockquote",null,(0,s.kt)("p",{parentName:"blockquote"},"Cette extension utilise l'interface jQuery pour les onglets, les dialogues et les boutons. Le th\xe8me jQuery par d\xe9faut est 'smoothness'. Vous pouvez utiliser un th\xe8me jQuery diff\xe9rent qui correspond le mieux \xe0 votre th\xe8me. Vous pouvez sp\xe9cifier le th\xe8me jQuery en utilisant l'option --jq_ui_theme. Par exemple :")),(0,s.kt)("pre",null,(0,s.kt)("code",{parentName:"pre"},"yarn build --theme mon-style --jq_ui_theme ui-lightness\n")))}m.isMDXComponent=!0}}]);