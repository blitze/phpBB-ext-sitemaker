(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[847],{3905:function(e,t,n){"use strict";n.d(t,{Zo:function(){return s},kt:function(){return k}});var r=n(7294);function a(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function i(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function o(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?i(Object(n),!0).forEach((function(t){a(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):i(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function l(e,t){if(null==e)return{};var n,r,a=function(e,t){if(null==e)return{};var n,r,a={},i=Object.keys(e);for(r=0;r<i.length;r++)n=i[r],t.indexOf(n)>=0||(a[n]=e[n]);return a}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(r=0;r<i.length;r++)n=i[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(a[n]=e[n])}return a}var u=r.createContext({}),p=function(e){var t=r.useContext(u),n=t;return e&&(n="function"==typeof e?e(t):o(o({},t),e)),n},s=function(e){var t=p(e.components);return r.createElement(u.Provider,{value:t},e.children)},c={inlineCode:"code",wrapper:function(e){var t=e.children;return r.createElement(r.Fragment,{},t)}},m=r.forwardRef((function(e,t){var n=e.components,a=e.mdxType,i=e.originalType,u=e.parentName,s=l(e,["components","mdxType","originalType","parentName"]),m=p(n),k=a,g=m["".concat(u,".").concat(k)]||m[k]||c[k]||i;return n?r.createElement(g,o(o({ref:t},s),{},{components:n})):r.createElement(g,o({ref:t},s))}));function k(e,t){var n=arguments,a=t&&t.mdxType;if("string"==typeof e||a){var i=n.length,o=new Array(i);o[0]=m;var l={};for(var u in t)hasOwnProperty.call(t,u)&&(l[u]=t[u]);l.originalType=e,l.mdxType="string"==typeof e?e:a,o[1]=l;for(var p=2;p<i;p++)o[p]=n[p];return r.createElement.apply(null,o)}return r.createElement.apply(null,n)}m.displayName="MDXCreateElement"},6168:function(e,t,n){"use strict";n.r(t),n.d(t,{frontMatter:function(){return l},contentTitle:function(){return u},metadata:function(){return p},toc:function(){return s},default:function(){return m}});var r=n(2122),a=n(9756),i=(n(7294),n(3905)),o=["components"],l={title:"Een pull-aanvraag indienen",sidebar_label:"Pull Requests"},u=void 0,p={unversionedId:"contrib/pull-requests",id:"contrib/pull-requests",isDocsHomePage:!1,title:"Een pull-aanvraag indienen",description:"Pull requests laten je anderen vertellen over wijzigingen die je naar een branch in een repository op GitHub hebt gepusht. Zodra een pull-aanvraag is geopend, je kan de potenti\xeble wijzigingen bespreken en bekijken met medewerkers en follow-up commits toevoegen voordat je wijzigingen worden samengevoegd in de basis branch. Lees meer",source:"@site/i18n/nl/docusaurus-plugin-content-docs/current/contrib/pull-requests.md",sourceDirName:"contrib",slug:"/contrib/pull-requests",permalink:"/phpBB-ext-sitemaker/nl/docs/contrib/pull-requests",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/nl",version:"current",frontMatter:{title:"Een pull-aanvraag indienen",sidebar_label:"Pull Requests"},sidebar:"tutorialSidebar",previous:{title:"Vertalers",permalink:"/phpBB-ext-sitemaker/nl/docs/contrib/translators"}},s=[{value:"Toon/Klonen",id:"toonklonen",children:[]},{value:"Pull Requests",id:"pull-requests",children:[]}],c={toc:s};function m(e){var t=e.components,n=(0,a.Z)(e,o);return(0,i.kt)("wrapper",(0,r.Z)({},c,n,{components:t,mdxType:"MDXLayout"}),(0,i.kt)("p",null,(0,i.kt)("inlineCode",{parentName:"p"},"Pull requests laten je anderen vertellen over wijzigingen die je naar een branch in een repository op GitHub hebt gepusht. Zodra een pull-aanvraag is geopend, je kan de potenti\xeble wijzigingen bespreken en bekijken met medewerkers en follow-up commits toevoegen voordat je wijzigingen worden samengevoegd in de basis branch.")," ",(0,i.kt)("a",{parentName:"p",href:"https://help.github.com/articles/about-pull-requests/"},"Lees meer")),(0,i.kt)("h2",{id:"toonklonen"},"Toon/Klonen"),(0,i.kt)("ul",null,(0,i.kt)("li",{parentName:"ul"},"Maak een github account aan als je er nog geen hebt"),(0,i.kt)("li",{parentName:"ul"},"Ga naar ",(0,i.kt)("a",{parentName:"li",href:"https://github.com/blitze/phpBB-ext-sitemaker.git"},"https://github.com/blitze/phpBB-ext-sitemaker.git"),' en klik op "Fork"')),(0,i.kt)("p",null,"Kopieer uw vork van de repository:"),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre"},"git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker\n")),(0,i.kt)("p",null,"Van opdrachtregel ga naar sitemaker directory:"),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre"},"cd phpBB/ext/blitze/sitemaker\n")),(0,i.kt)("p",null,(0,i.kt)("strong",{parentName:"p"},"Git configureren:")),(0,i.kt)("p",null,"Voeg uw gebruikersnaam toe aan uw systeem:"),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre"},'git config --global user.name "Your Name Here"\n')),(0,i.kt)("p",null,"Voeg uw e-mailadres toe aan Git op uw systeem:"),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre"},"git configuratie --voeg user.email username@phpbb.com toe\n")),(0,i.kt)("p",null,"Voeg de afstandsbediening stroomopwaarts toe (je kunt \u2018upstream\u2019 veranderen naar wat je wilt):"),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre"},"git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git\n")),(0,i.kt)("p",null,(0,i.kt)("strong",{parentName:"p"},"Leveranciers installeren")),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre"},"installatie van componist\n")),(0,i.kt)("p",null,(0,i.kt)("strong",{parentName:"p"},"Installeer NPM pakketten")),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre"},"npm install\n")),(0,i.kt)("p",null,"U kunt ook ",(0,i.kt)("a",{parentName:"p",href:"https://yarnpkg.com"},"yarn")," gebruiken:"),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre"},"yarn installatie\n")),(0,i.kt)("h2",{id:"pull-requests"},"Pull Requests"),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre"},"# Maak een nieuw filiaal aan voor uw functie & schakel er naar toe\ngit checkout -b functie/my-fancy-new-feature\n\n# maak een nieuwe branch aan voor het issue waaraan u werkt * wissel (ticket # is van github tracker)\ngit checkout -b ticket/1234\n")),(0,i.kt)("p",null,"Maak uw wijzigingen"),(0,i.kt)("pre",null,(0,i.kt)("code",{parentName:"pre"},'# Fase de bestanden\ngit add <files> \n\n# Commit staged bestanden - gebruik een juist commit bericht\ngit commit -m "my commit message"\n')),(0,i.kt)("p",null,"Duw de branch terug naar GitHub git push origin functie/mijn-fancy-new-functie"),(0,i.kt)("p",null,"Verstuur een ",(0,i.kt)("a",{parentName:"p",href:"https://github.com/blitze/phpBB-ext-sitemaker/pulls"},"pull-request")))}m.isMDXComponent=!0}}]);