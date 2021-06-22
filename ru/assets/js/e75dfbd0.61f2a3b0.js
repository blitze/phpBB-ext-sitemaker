(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[963],{3905:function(e,t,r){"use strict";r.d(t,{Zo:function(){return c},kt:function(){return k}});var n=r(7294);function l(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function u(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function p(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?u(Object(r),!0).forEach((function(t){l(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):u(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function a(e,t){if(null==e)return{};var r,n,l=function(e,t){if(null==e)return{};var r,n,l={},u=Object.keys(e);for(n=0;n<u.length;n++)r=u[n],t.indexOf(r)>=0||(l[r]=e[r]);return l}(e,t);if(Object.getOwnPropertySymbols){var u=Object.getOwnPropertySymbols(e);for(n=0;n<u.length;n++)r=u[n],t.indexOf(r)>=0||Object.prototype.propertyIsEnumerable.call(e,r)&&(l[r]=e[r])}return l}var i=n.createContext({}),o=function(e){var t=n.useContext(i),r=t;return e&&(r="function"==typeof e?e(t):p(p({},t),e)),r},c=function(e){var t=o(e.components);return n.createElement(i.Provider,{value:t},e.children)},s={inlineCode:"code",wrapper:function(e){var t=e.children;return n.createElement(n.Fragment,{},t)}},m=n.forwardRef((function(e,t){var r=e.components,l=e.mdxType,u=e.originalType,i=e.parentName,c=a(e,["components","mdxType","originalType","parentName"]),m=o(r),k=l,f=m["".concat(i,".").concat(k)]||m[k]||s[k]||u;return r?n.createElement(f,p(p({ref:t},c),{},{components:r})):n.createElement(f,p({ref:t},c))}));function k(e,t){var r=arguments,l=t&&t.mdxType;if("string"==typeof e||l){var u=r.length,p=new Array(u);p[0]=m;var a={};for(var i in t)hasOwnProperty.call(t,i)&&(a[i]=t[i]);a.originalType=e,a.mdxType="string"==typeof e?e:l,p[1]=a;for(var o=2;o<u;o++)p[o]=r[o];return n.createElement.apply(null,p)}return n.createElement.apply(null,r)}m.displayName="MDXCreateElement"},5461:function(e,t,r){"use strict";r.r(t),r.d(t,{frontMatter:function(){return a},contentTitle:function(){return i},metadata:function(){return o},toc:function(){return c},default:function(){return m}});var n=r(2122),l=r(9756),u=(r(7294),r(3905)),p=["components"],a={title:"\u041e\u0442\u043f\u0440\u0430\u0432\u043a\u0430 Pull Request",sidebar_label:"\u0417\u0430\u043f\u0440\u043e\u0441\u044b \u043d\u0430 \u0441\u043b\u0438\u044f\u043d\u0438\u0435"},i=void 0,o={unversionedId:"contrib/pull-requests",id:"contrib/pull-requests",isDocsHomePage:!1,title:"\u041e\u0442\u043f\u0440\u0430\u0432\u043a\u0430 Pull Request",description:"Pull requests \u043f\u043e\u0437\u0432\u043e\u043b\u044f\u044e\u0442 \u0440\u0430\u0441\u0441\u043a\u0430\u0437\u0430\u0442\u044c \u0434\u0440\u0443\u0433\u0438\u043c \u043e \u0438\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f\u0445, \u0432\u043d\u0435\u0441\u0435\u043d\u043d\u044b\u0445 \u0432\u0430\u043c\u0438 \u0432 \u0432\u0435\u0442\u043a\u0443 \u0432 \u0440\u0435\u043f\u043e\u0437\u0438\u0442\u043e\u0440\u0438\u0439 \u043d\u0430 GitHub. \u041f\u043e\u0441\u043b\u0435 \u043e\u0442\u043a\u0440\u044b\u0442\u0438\u044f Pull Request \u0432\u044b \u043c\u043e\u0436\u0435\u0442\u0435 \u043e\u0431\u0441\u0443\u0434\u0438\u0442\u044c \u0438 \u043f\u0440\u043e\u0441\u043c\u043e\u0442\u0440\u0435\u0442\u044c \u043f\u043e\u0442\u0435\u043d\u0446\u0438\u0430\u043b\u044c\u043d\u044b\u0435 \u0438\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u0441 \u0441\u043e\u0430\u0432\u0442\u043e\u0440\u0430\u043c\u0438 \u0438 \u0434\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u043a\u043e\u043c\u043c\u0438\u0442\u044b, \u043f\u0440\u0435\u0436\u0434\u0435 \u0447\u0435\u043c \u0432\u0430\u0448\u0438 \u0438\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u0431\u0443\u0434\u0443\u0442 \u043e\u0431\u044a\u0435\u0434\u0438\u043d\u0435\u043d\u044b \u0432 \u0431\u0430\u0437\u043e\u0432\u0443\u044e \u0432\u0435\u0442\u043a\u0443. \u0427\u0438\u0442\u0430\u0442\u044c \u0431\u043e\u043b\u044c\u0448\u0435",source:"@site/i18n/ru/docusaurus-plugin-content-docs/current/contrib/pull-requests.md",sourceDirName:"contrib",slug:"/contrib/pull-requests",permalink:"/phpBB-ext-sitemaker/ru/docs/contrib/pull-requests",editUrl:"https://crowdin.com/project/phpbb-ext-sitemaker/ru",version:"current",frontMatter:{title:"\u041e\u0442\u043f\u0440\u0430\u0432\u043a\u0430 Pull Request",sidebar_label:"\u0417\u0430\u043f\u0440\u043e\u0441\u044b \u043d\u0430 \u0441\u043b\u0438\u044f\u043d\u0438\u0435"},sidebar:"tutorialSidebar",previous:{title:"\u041f\u0435\u0440\u0435\u0432\u043e\u0434\u0438\u0442\u0435\u043b\u0438",permalink:"/phpBB-ext-sitemaker/ru/docs/contrib/translators"}},c=[{value:"\u0424\u043e\u0440\u043a\u0438\u043d\u0433/\u041a\u043b\u043e\u043d\u0438\u0440\u043e\u0432\u0430\u043d\u0438\u0435",id:"\u0444\u043e\u0440\u043a\u0438\u043d\u0433\u043a\u043b\u043e\u043d\u0438\u0440\u043e\u0432\u0430\u043d\u0438\u0435",children:[]},{value:"\u0417\u0430\u043f\u0440\u043e\u0441\u044b \u043d\u0430 \u0441\u043b\u0438\u044f\u043d\u0438\u0435",id:"\u0437\u0430\u043f\u0440\u043e\u0441\u044b-\u043d\u0430-\u0441\u043b\u0438\u044f\u043d\u0438\u0435",children:[]}],s={toc:c};function m(e){var t=e.components,r=(0,l.Z)(e,p);return(0,u.kt)("wrapper",(0,n.Z)({},s,r,{components:t,mdxType:"MDXLayout"}),(0,u.kt)("p",null,(0,u.kt)("inlineCode",{parentName:"p"},"Pull requests \u043f\u043e\u0437\u0432\u043e\u043b\u044f\u044e\u0442 \u0440\u0430\u0441\u0441\u043a\u0430\u0437\u0430\u0442\u044c \u0434\u0440\u0443\u0433\u0438\u043c \u043e \u0438\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f\u0445, \u0432\u043d\u0435\u0441\u0435\u043d\u043d\u044b\u0445 \u0432\u0430\u043c\u0438 \u0432 \u0432\u0435\u0442\u043a\u0443 \u0432 \u0440\u0435\u043f\u043e\u0437\u0438\u0442\u043e\u0440\u0438\u0439 \u043d\u0430 GitHub. \u041f\u043e\u0441\u043b\u0435 \u043e\u0442\u043a\u0440\u044b\u0442\u0438\u044f Pull Request \u0432\u044b \u043c\u043e\u0436\u0435\u0442\u0435 \u043e\u0431\u0441\u0443\u0434\u0438\u0442\u044c \u0438 \u043f\u0440\u043e\u0441\u043c\u043e\u0442\u0440\u0435\u0442\u044c \u043f\u043e\u0442\u0435\u043d\u0446\u0438\u0430\u043b\u044c\u043d\u044b\u0435 \u0438\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u0441 \u0441\u043e\u0430\u0432\u0442\u043e\u0440\u0430\u043c\u0438 \u0438 \u0434\u043e\u0431\u0430\u0432\u0438\u0442\u044c \u043a\u043e\u043c\u043c\u0438\u0442\u044b, \u043f\u0440\u0435\u0436\u0434\u0435 \u0447\u0435\u043c \u0432\u0430\u0448\u0438 \u0438\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f \u0431\u0443\u0434\u0443\u0442 \u043e\u0431\u044a\u0435\u0434\u0438\u043d\u0435\u043d\u044b \u0432 \u0431\u0430\u0437\u043e\u0432\u0443\u044e \u0432\u0435\u0442\u043a\u0443.")," ",(0,u.kt)("a",{parentName:"p",href:"https://help.github.com/articles/about-pull-requests/"},"\u0427\u0438\u0442\u0430\u0442\u044c \u0431\u043e\u043b\u044c\u0448\u0435")),(0,u.kt)("h2",{id:"\u0444\u043e\u0440\u043a\u0438\u043d\u0433\u043a\u043b\u043e\u043d\u0438\u0440\u043e\u0432\u0430\u043d\u0438\u0435"},"\u0424\u043e\u0440\u043a\u0438\u043d\u0433/\u041a\u043b\u043e\u043d\u0438\u0440\u043e\u0432\u0430\u043d\u0438\u0435"),(0,u.kt)("ul",null,(0,u.kt)("li",{parentName:"ul"},"\u0421\u043e\u0437\u0434\u0430\u0439\u0442\u0435 \u0430\u043a\u043a\u0430\u0443\u043d\u0442 github, \u0435\u0441\u043b\u0438 \u0443 \u0432\u0430\u0441 \u0435\u0449\u0435 \u043d\u0435\u0442 \u0435\u0433\u043e"),(0,u.kt)("li",{parentName:"ul"},"\u041f\u0435\u0440\u0435\u0439\u0434\u0438\u0442\u0435 \u043d\u0430 ",(0,u.kt)("a",{parentName:"li",href:"https://github.com/blitze/phpBB-ext-sitemaker.git"},"https://github.com/blitze/phpBB-ext-sitemaker.git"),' \u0438 \u043d\u0430\u0436\u043c\u0438\u0442\u0435 \u043d\u0430 "Fork"')),(0,u.kt)("p",null,"\u041a\u043b\u043e\u043d\u0438\u0440\u043e\u0432\u0430\u0442\u044c \u0432\u0430\u0448 \u0444\u043e\u0440\u043a \u0440\u0435\u043f\u043e\u0437\u0438\u0442\u043e\u0440\u0438\u044f:"),(0,u.kt)("pre",null,(0,u.kt)("code",{parentName:"pre"},"git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker\n")),(0,u.kt)("p",null,"\u0418\u0437 \u043a\u043e\u043c\u0430\u043d\u0434\u043d\u043e\u0439 \u0441\u0442\u0440\u043e\u043a\u0438 \u043f\u0435\u0440\u0435\u0439\u0434\u0438\u0442\u0435 \u0432 \u0434\u0438\u0440\u0435\u043a\u0442\u043e\u0440\u0438\u044e sitemaker:"),(0,u.kt)("pre",null,(0,u.kt)("code",{parentName:"pre"},"cd phpBB/ext/blitze/sitemaker\n")),(0,u.kt)("p",null,(0,u.kt)("strong",{parentName:"p"},"\u041d\u0430\u0441\u0442\u0440\u043e\u0438\u0442\u044c git:")),(0,u.kt)("p",null,"\u0414\u043e\u0431\u0430\u0432\u044c\u0442\u0435 \u0432\u0430\u0448\u0435 \u0438\u043c\u044f \u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u0442\u0435\u043b\u044f \u0432 Git \u0432 \u0432\u0430\u0448\u0443 \u0441\u0438\u0441\u0442\u0435\u043c\u0443:"),(0,u.kt)("pre",null,(0,u.kt)("code",{parentName:"pre"},'git config --global user.name "\u0412\u0430\u0448\u0435 \u0438\u043c\u044f \u0437\u0434\u0435\u0441\u044c"\n')),(0,u.kt)("p",null,"\u0414\u043e\u0431\u0430\u0432\u044c\u0442\u0435 \u0432\u0430\u0448 \u0430\u0434\u0440\u0435\u0441 \u044d\u043b\u0435\u043a\u0442\u0440\u043e\u043d\u043d\u043e\u0439 \u043f\u043e\u0447\u0442\u044b \u0432 Git \u0432 \u0441\u0438\u0441\u0442\u0435\u043c\u0435:"),(0,u.kt)("pre",null,(0,u.kt)("code",{parentName:"pre"},"git config --add user.email username@phpbb.com\n")),(0,u.kt)("p",null,"\u0414\u043e\u0431\u0430\u0432\u044c\u0442\u0435 \u0432\u0432\u0435\u0440\u0445 (\u0432\u044b \u043c\u043e\u0436\u0435\u0442\u0435 \u0438\u0437\u043c\u0435\u043d\u0438\u0442\u044c \xab\u0432\u0432\u0435\u0440\u0445\xbb \u043d\u0430 \u0442\u043e, \u0447\u0442\u043e \u0432\u0430\u043c \u043d\u0440\u0430\u0432\u0438\u0442\u0441\u044f):"),(0,u.kt)("pre",null,(0,u.kt)("code",{parentName:"pre"},"git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git\n")),(0,u.kt)("p",null,(0,u.kt)("strong",{parentName:"p"},"\u0423\u0441\u0442\u0430\u043d\u043e\u0432\u0438\u0442\u044c \u043f\u043e\u0441\u0442\u0430\u0432\u0449\u0438\u043a\u043e\u0432")),(0,u.kt)("pre",null,(0,u.kt)("code",{parentName:"pre"},"\u0443\u0441\u0442\u0430\u043d\u043e\u0432\u043a\u0430 \u0438\u0441\u043f\u043e\u043b\u043d\u0438\u0442\u0435\u043b\u044f\n")),(0,u.kt)("p",null,(0,u.kt)("strong",{parentName:"p"},"\u0423\u0441\u0442\u0430\u043d\u043e\u0432\u0438\u0442\u044c \u043f\u0430\u043a\u0435\u0442\u044b NPM")),(0,u.kt)("pre",null,(0,u.kt)("code",{parentName:"pre"},"npm install\n")),(0,u.kt)("p",null,"\u041a\u0440\u043e\u043c\u0435 \u0442\u043e\u0433\u043e, \u0432\u044b \u043c\u043e\u0436\u0435\u0442\u0435 \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u043e\u0432\u0430\u0442\u044c ",(0,u.kt)("a",{parentName:"p",href:"https://yarnpkg.com"},"yarn"),":"),(0,u.kt)("pre",null,(0,u.kt)("code",{parentName:"pre"},"\u0423\u0441\u0442\u0430\u043d\u043e\u0432\u043a\u0430 yarn\n")),(0,u.kt)("h2",{id:"\u0437\u0430\u043f\u0440\u043e\u0441\u044b-\u043d\u0430-\u0441\u043b\u0438\u044f\u043d\u0438\u0435"},"\u0417\u0430\u043f\u0440\u043e\u0441\u044b \u043d\u0430 \u0441\u043b\u0438\u044f\u043d\u0438\u0435"),(0,u.kt)("pre",null,(0,u.kt)("code",{parentName:"pre"},"# \u0421\u043e\u0437\u0434\u0430\u0439\u0442\u0435 \u043d\u043e\u0432\u0443\u044e \u0432\u0435\u0442\u043a\u0443 \u0434\u043b\u044f \u0432\u0430\u0448\u0435\u0439 \u0444\u0443\u043d\u043a\u0446\u0438\u0438 & \u043f\u0435\u0440\u0435\u043a\u043b\u044e\u0447\u0438\u0442\u0435\u0441\u044c \u043d\u0430 \u043d\u0435\u0435\ngit checkout -b feature/my-fancy-new-feature\n\n# \u0441\u043e\u0437\u0434\u0430\u0442\u044c \u043d\u043e\u0432\u0443\u044e \u0432\u0435\u0442\u043a\u0443 \u0434\u043b\u044f \u043f\u0440\u043e\u0431\u043b\u0435\u043c\u044b, \u043d\u0430\u0434 \u043a\u043e\u0442\u043e\u0440\u043e\u0439 \u0432\u044b \u0440\u0430\u0431\u043e\u0442\u0430\u0435\u0442\u0435 * \u043f\u0435\u0440\u0435\u043a\u043b\u044e\u0447\u0430\u0442\u0435\u043b\u044c (\u0442\u0438\u043a\u0435\u0442 # \u0438\u0437 github tracker)\ngit checkout -b ticket/1234\n")),(0,u.kt)("p",null,"\u0412\u043d\u0435\u0441\u0442\u0438 \u0438\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u044f"),(0,u.kt)("pre",null,(0,u.kt)("code",{parentName:"pre"},'# \u042d\u0442\u0430\u043f \u0444\u0430\u0439\u043b\u043e\u0432\ngit add <files> \n\n# \u0417\u0430\u0444\u0438\u043a\u0441\u0438\u0440\u043e\u0432\u0430\u0442\u044c staged \u0444\u0430\u0439\u043b\u044b - \u043f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0438\u0441\u043f\u043e\u043b\u044c\u0437\u0443\u0439\u0442\u0435 \u0441\u043e\u043e\u0431\u0449\u0435\u043d\u0438\u0435 \u043e \u043f\u043e\u0434\u0442\u0432\u0435\u0440\u0436\u0434\u0435\u043d\u0438\u0438\ngit commit -m "\u043c\u043e\u0435 \u0441\u043e\u043e\u0431\u0449\u0435\u043d\u0438\u0435 \u043e \u043f\u043e\u0434\u0442\u0432\u0435\u0440\u0436\u0434\u0435\u043d\u0438\u0438"\n')),(0,u.kt)("p",null,"\u041e\u0442\u043f\u0440\u0430\u0432\u043a\u0430 \u0432\u0435\u0442\u043a\u0438 \u043e\u0431\u0440\u0430\u0442\u043d\u043e \u0432 GitHub git push origin feature/my-fancy-new-feature"),(0,u.kt)("p",null,"\u041e\u0442\u043f\u0440\u0430\u0432\u0438\u0442\u044c ",(0,u.kt)("a",{parentName:"p",href:"https://github.com/blitze/phpBB-ext-sitemaker/pulls"},"pull-request")))}m.isMDXComponent=!0}}]);