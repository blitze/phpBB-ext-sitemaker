---
id: موضوع المطور
title: القالب
---

يأتي phpBB SiteMaker مع أنماط وألوان مصنوعة للفضة. يمكنك الكتابة فوق ملفات CSS و JS و HTML عن طريق إنشاء الملف المقابل في مجلد النمط الخاص بك.

# إنشاء ملفات JS/CSS للنمط الخاص بك

ملاحظة: * لغرض التعليمات أدناه سوف نفترض أن لديك أسلوبا يسمى النمط my.

استنسخ إلى phpBB/ext/blitze/sitemaker:

    استنساخ git https://github.com/blitze/phpBB-ext-sitemaker.git phpBBB/ext/blitze/sitemaker
    

من سطر الأوامر انتقل إلى دليل الموقع:

    cd phpBB/ext/blitze/sitemaker
    

**تثبيت البائعين**

    تثبيت المؤلف
    

**تثبيت الحزم**

للأوامر أدناه يمكنك استخدام npm أو [yarn](https://yarnpkg.com)

    تثبيت yarn
    

**مشاهدة التغييرات**

    بدء yarn - نمط السمة
    

**إجراء تغييرات**

* قم بإجراء التغييرات الخاصة بك على الملفات في مجلد phpBBB/ext/blitze/sitemaker/develop.
* انظر إلى phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss للمتغيرات الزجاجية

**بناء الأصول**

    ابن يارن - نمط السمة
    

**نشر**

يمكنك الآن نسخ الملفات التي تم إنشاؤها من phpBB/ext/blitze/sitemaker/styles/my-style ورفعتها إلى خادم الإنتاج الخاص بك.

> يستخدم هذا الملحق واجهة المستخدم jQuery للتبويبات، مربعات الحوار والأزر. موضوع jQuery الافتراضي هو 'سلسة.' يمكنك استخدام سمة واجهة مستخدم jQuery مختلفة تناسب الموضوع الخاص بك. يمكنك تحديد سمة واجهة المستخدم jQuery باستخدام العلم --jq_ui_theme. وعلى سبيل المثال:

    ابن yarn يبني - موضوع النمط -jq_ui_Them-ui-lightness