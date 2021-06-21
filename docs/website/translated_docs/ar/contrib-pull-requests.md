---
id: طلبات سحب contrib-سحب-
title: تقديم طلب سحب
sidebar_label: طلبات السحب
---

`طلبات السحب تتيح لك إخبار الآخرين عن التغييرات التي دفعتها إلى فرع في مستودع GitHub. بمجرد فتح طلب سحب، يمكنك مناقشة ومراجعة التغييرات المحتملة مع المتعاونين وإضافة التزامات المتابعة قبل دمج التغييرات الخاصة بك في فرع القاعدة.` [اقرأ المزيد](https://help.github.com/articles/about-pull-requests/)

## التصنيع/الاستنساخ

* إنشاء حساب github إذا لم يكن لديك بالفعل حساب
* انتقل إلى https://github.com/blitze/phpBB-ext-sitemaker.git وانقر على "Fork"

استنسخ شوكك من المستودع:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

من سطر الأوامر انتقل إلى دليل الموقع:

    cd phpBB/ext/blitze/sitemaker
    

**تكوين الحدث:**

إضافة اسم المستخدم الخاص بك إلى Git على النظام الخاص بك:

    git config --المستخدم العالمي.name "اسمك هنا"
    

أضف عنوان بريدك الإلكتروني إلى Git على النظام الخاص بك:

    git config --إضافة user.email username@phpbb.com
    

أضف جهاز التحكم عن بعد (يمكنك تغيير "التمهيد" إلى أي شيء تريد):

    git عن بعد إضافة أعلى مسار git://github.com/blitze/phpBB-ext-sitemaker.git
    

**تثبيت البائعين**

    تثبيت المؤلف
    

**تثبيت حزم NPM**

    npm install
    

بدلاً من ذلك، يمكنك استخدام [yarn](https://yarnpkg.com):

    تثبيت yarn
    

## طلبات السحب

    # قم بإنشاء فرع جديد للميزة الخاصة بك & قم بالتبديل إليه
    git Checout -b feature/my-fancy-new-feat
    
    # قم بإنشاء فرع جديد للمشكلة التي تعمل عليها * قم بالتبديل إليها (التذكرة # من github tracker)
    git Checout - b ticket/1234
    

إجراء التغييرات الخاصة بك

    # المرحلة
    git إضافة الملفات <files> 
    
    # إرسال الملفات - الرجاء استخدام رسالة الالتزام الصحيحة
    git الالتزام -m "رسالة الالتزام الخاصة بي"
    

ارجع الفرع إلى خاصية GitHub git push Originure/my-fancy-new-الميزة الجديدة

تقديم [طلب سحب](https://github.com/blitze/phpBB-ext-sitemaker/pulls)