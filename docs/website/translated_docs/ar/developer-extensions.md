---
id: إضافات المطور
title: تمديد phpBB SiteMaker
---

يمكنك تمديد / تعديل phpBB SiteMaker باستخدام [استبدال الخدمة](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement)و [ديكور الخدمة](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration)و [نظام أحداث phpBBB](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). يمكنك العثور على قائمة بالأحداث المدعومة [هنا](./developer-events.md).

## إنشاء كتلة SiteMaker

كتلة phpBB SiteMaker هي ببساطة فئة تمدد فئة blitze\sitemaker\services\blocks\driver\block وتعيد صفيفة من طريقة "Display" مع 'title' و 'content'. كل شيء آخر فيما بين هذه الأمور يعود لك. لجعل الكتلة الخاصة بك قابلة للاكتشاف بواسطة SiteMaker، ستحتاج إلى إعطائها علامة "sitemaker.block".

قل أن لدينا تمديد مع البائع/التمديد كمثال/مثال. لإنشاء كتلة تسمى "my_block" لـ phpBB SiteMaker:

- إنشاء مجلد "القطع"
- إنشاء ملف my_block.php في مجلد الكتل مع المحتوى التالي

```php
اسم الفضاء my\example\block;

استخدم blitze\sitemaker\services\blocks\driver\block;

class my_block يمدد كتلة
{
    /**
     * {@inheritdoc}
     */
    عرض الدالة العامة (صفيف $settings, $edit_mode = خطأ)
    {
        مرجع المصفوف(
            'title' => 'بلدي بلوك'،
            'المحتوى' => 'محتوى الكتلة',
        )؛
    }
}
```

ثم في ملف config.yml الخاص بك، أضف ما يلي:

```yml
الخدمات:

...

    my.example.block.my_block:
        class: my\example\blocks\my_block
        مكالمات:
            - [set_name, [my.example.block.my_block]]
        العلامات:
            - { name: sitemaker.block }

....

```

على أقل تقدير، هذا كل ما تحتاجين. إذا ذهبت إلى وضع التحرير، يجب أن ترى الكتلة المدرجة كـ 'MY_EXAMPLE_BLOCK_MY_BLOCK' التي يمكن سحبها وإسقاطها في أي وضع كتل. لكن هذه الكتلة لا تفعل أي شيء مثير. ليس لديه إعدادات ولا يترجم اسم الكتلة. دعونا نجعلها أكثر إثارة للاهتمام.

### إعدادات حظر

دعونا نعدل كتلنا/my_block. اضف ملف وأضف طريقة "get_config" عند إرجاع مصفوفة مع المفاتيح هي إعدادات الكتلة والقيم هي مصفوفة تصف الإعدادات مثل:

```php
    /**
     * @inheritdoc
     */
    وظيفة عامة get_config(صفيف $settings)
    {
        $options = المصفوفة (1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR')؛
        مصفوفة العودة (
            'اسطورية1' => 'TAB1',
            'مربع الاختيار' => المصفوفة('lang' => 'SOME_LANG_VAR_1', 'صلاحية' => 'سلسلة'، 'نوع' => 'مربع الاختيار'، 'خيارات' => $options، 'الافتراضي' => الصفيفة (), 'فسر ' => false),
            'yes_no' => Array('lang' => 'SOME_LANG_VAR_2', 'صحيح' => 'bool', 'type' => 'radio:yes_no', 'فسر ' => false, 'ault' => false),
            'radio' => Array('lang' => 'SOME_LANG_VAR_3', 'صلاحية' => 'bool', 'type' => 'radio', 'خيارات' => $options, 'فسر ' => false, 'الافتراضي' => 'الموضوع')،
            'إختيار' => المصفوف('lang' => 'SOME_LANG_VAR_4', 'صواب' => 'سلسلة'، 'نوع' => 'إختيار'، 'خيارات' => $options، 'افتراضي' => '، 'شرح' => false)،
            'عدة' => صفيفة ('lang' => 'SOME_LANG_VAR_5', 'صحيح' => 'سلسلة', 'نوع' => 'multi_select', 'خيارات' => $options، 'الافتراضي' => المصفوفة (), 'فسر ' => false)،
            'اسطورية2' => 'TAB2',
            'العدد' => الصفيف('lang' => 'SOME_LANG_VAR_6', 'صحيح' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'الافتراضي' => 5)،
            'textarea' => Array('lang' => 'SOME_LANG_VAR_7', 'صحيح' => 'سلسلة', 'نوع' => 'textarea:3:40', 'maxlength' => 2, 'فسر ' => صحيح, 'الافتراضي' => ')،
            'تبديل العمل' => مصفوفة ('lang' => 'SOME_TOGLABLE_VAR', 'صحيح' => 'سلسلة'، 'نوع' => 'إختيار:1:0:toggle_key', 'خيارات' => $options، 'الافتراضي' => '، 'تذييل' => '<div id="toggle_key-1">فقط عندما يتم اختيار الخيار 1</div>')،
        )؛
}
```

تم بناء هذا بنفس الطريقة التي يبني بها phpBB التكوين لإعدادات اللوحة في ACP. يمكنك رؤية المزيد من الأمثلة [هنا](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

إذا كنت تريد نوع حقل مخصص، يمكنك مشاهدة مثال [هنا](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) (إعدادات 'content_type'.

لاحظ 'legend1' و 'legend2': يتم استخدام هذه الإعدادات لفصل الإعدادات إلى علامات التبويب.

### كتل التسمية

اتفاقية أسماء الكتل هي أن اسم الخدمة (مثل my.example.block). و*أعلاه) سوف تستخدم كمفتاح اللغة عن طريق استبدال النقاط (.) بسطر (*مثلاً: MY_EXAMPLE_BLOCK_MY_BLOCK).

### الترجمة

لاحظ أيضا أن لدينا عدة مفاتيح لغوية تحتاج للترجمة. للقيام بذلك، قم بإنشاء ملف يسمى "blocks_admin.php" في مجلد لغتك. سيتم تحميل هذا الملف تلقائياً عند تحرير المربعات البرمجية، ويجب أن يحتوي على ترجمات لإعدادات المربعات البرمجية الخاصة بك وأسماء الحظر.

    $lang = المصفوفة_دمج($lang، المصفوفة(
        'SOME_LANG_VAR' => 'الخيار 1',
        'OTHER_LANG_VAR' => 'الخيار 2',
        'SOME_LANG_VAR_1' => 'إعداد 1',
    ....
        'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'بلدي بلوك'،
    )؛
    

لأنه يتم تحميل "blocks_admin.php" فقط عند تحرير المربعات البرمجية، سوف تحتاج إلى إضافة ترجمات أخرى (على سبيل المثال. حظر العنوان عن طريق تحميل ملف لغة في طريقة العرض الخاصة بك مثل `$language->add_lang('my_lang_file', 'my/example');`

### تقديم الكتلة

سيتم عرض الكتلة الجديدة فقط إذا كانت تقدم شيئاً. يمكن لكتلة التحكم الخاصة بك إرجاع أي سلسلة كمحتوى ولكن في معظم الحالات، تحتاج إلى قالب لتقديم المحتوى الخاص بك. لعرض كتلة استخدام قوالب، يجب أن تعيد الكتلة مصفوفة تحتوي على البيانات التي تريد تمريرها إلى القالب ويجب أيضا تنفيذ طريقة `get_template` كما هو موضح أدناه:

```php
    /**
     * @inheritdoc
     */
    وظيفة عامة get_config(صفيف $settings)
    {
        $options = المصفوفة (1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR')؛
        مصفوفة العودة (
            'اسطورية1' => 'TAB1',
            'some_setting' => ary('lang' => 'SOME_LANG_VAR_1', 'صلاحية' => 'سلسلة'، 'نوع' => 'مربع الاختيار'، 'خيارات' => $options، 'الافتراضي' => المصفوفة (), 'فسر ' => false),
        );
    }

    /**
     * {@inheritdoc}
     */
    وظيفة عامة get_template()
    {
        return '@my_example/my_block. tml';
    }

    /**
     * {@inheritdoc}
     */
    عرض الوظيفة العامة (الصفيفة $data, $edit_mode = خطأ)
    {
        اذا ($edit_mode)
        {
            // افعل شيئا فقط في وضع التحرير
        }

        مصفوفة العودة (
            'title' => 'MY_BLOCK_TITLE',
            'البيانات' => صفيفة(
                'some_var' => $data['settings']['some_setting']،
            )،
        )؛
}
```

ثم قد يبدو ملف الأنماط/all/my_block.html أو styles/prosilver/my_block.html شيئًا كهذا:

    <p>لقد اخترت: {{ some_var }}</p>
    

وباختصار، يجب أن تعيد الكتلة المصفوفة التي تحتوي على مفتاح `عنوان` (لعنوان الكتلة) ومفتاح `محتوى` (إذا كانت الكتلة تعرض سلسلة فقط ولا تستخدم قالب) أو مفتاح `بيانات` (إذا كانت الكتلة تستخدم قالب، في هذه الحالة، ستحتاج أيضًا إلى تنفيذ طريقة `get_template`).

### حظر الأصول

إذا كان الكتلة الخاصة بك تحتاج إلى إضافة الأصول (ss/js) إلى الصفحة، فأنا أوصي باستخدام صنف الموقع [util](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) لذلك. بما أنه يمكن أن يكون هناك أكثر من مثال واحد من نفس الكتلة على الصفحة، أو قد تكون الكتل الأخرى إضافة نفس الأصل، حتى تضمن الفئة أن الأصل مضاف فقط.

```php
        $this->util->add_assets(array(
            'js' => ary(
                '@my_example/assets/some. s',
                100 => '@my_example/assets/other. s', // تعيين الأولوية
            )،
            'css' => المصفوفة(
                '@my_example/assets/some. ع ،
            )
)؛
```

سيلزم بالطبع إضافة الصف إلى تعاريف الخدمة الخاصة بك في config.yml مثل ذلك: `- '@blitze.sitemaker. حتى` ومعرّف في منشئ الكتلة `\blitze\sitemaker\services\util $util`.

وهذا كل شيء. لقد انتهينا منها!