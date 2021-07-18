---
id: أحداث المطور
title: أحداث phpBB SiteMaker
---

يمكنك تعديل سلوك phpBB SiteMaker باستخدام نظام أحداث phpBB.

## أحداث PHP

# blitze.sitemaker.acp_add_bulk_menu_options

- الموقع: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- منذئذ: 3.1.0
- الغرض: إضافة خيارات القائمة بالجملة في قائمة الأوكب

# blitze.sitemaker.acp_display_settings_form

- الموقع: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- منذئذ: 3.1.0
- الغرض: عرض رمز إعدادات (الموقع)

# blitze.sitemaker.acp_save_إعدادات

- الموقع: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- منذئذ: 3.1.0
- الغرض: حفظ إعدادات الـ acp (الموقع)

# blitze.sitemaker.admin_bar.set_assets

- الموقع: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- منذ: 3.0.1-RC1
- الغرض: إضافة أصول للكتل المتاحة في وضع التحرير

# blitze.sitemaker.modify_block_posi_

- الموقع: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- منذ: 3.0.1-RC1
- الغرض: تعديل مواقع الكتل

# blitze.sitemaker.modify_rendered_block

- الموقع: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- منذ: 3.0.1-RC1
- الغرض: تعديل كتلة تم تحويلها

## أحداث القالب

# إعدادات_sitemaker_acp_blitze_sitemaker_acp_

- الموقع: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- منذئذ: 3.1.0
- الغرض: إضافة حقول النموذج لإعدادات الموقع

# تبليغ_الموقع_admin_bar_ملحق

- الموقع: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- منذئذ: 3.1.0
- الغرض: إضافة عناصر القائمة إلى شريط المشرف

# بلتزي_الموقع_admin_bar_templates

- الموقع: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- منذئذ: 3.1.0
- الغرض: إضافة ملفات قالب لاستخدامها في JS لعرض الكتل، إلخ

## أحداث جافا سكريبت

# بلتزي_sitemaker_layout_حفظ

- الموقع: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- بعد: 3-1-2
- الغرض: حدث للسماح للملحقات الأخرى بالقيام بشيء ما عندما يتم حفظ تغييرات التخطيط

# ضغط_الموقع_render_block_قبل

- الموقع: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- بعد: 3-1-2
- الغرض: حدث للسماح للملحقات الأخرى بالقيام بشيء ما قبل أن يتم تنفيذ الكتلة أو منع إعادة إصدارها

# ضغط_الموقع_render_block_بعد

- الموقع: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- بعد: 3-1-2
- الغرض: الحدث للسماح للملحقات الأخرى بالقيام بشيء ما بعد أن يتم تحويل الكتلة

# ضغط_الموقع_save_block_قبل

- الموقع: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- بعد: 3-1-2
- الغرض: حدث للسماح للملحقات الأخرى بتعديل بيانات الحظر قبل حفظها

# ضغط_الموقع_عرض_all_block_posi_

- الموقع: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- بعد: 3-1-2
- الغرض: حدث للسماح للملحقات الأخرى بالقيام بشيء ما عندما تظهر جميع مواقع الكتل

# ضغط_الموقع_hide_empty_block_positions

- الموقع: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- بعد: 3-1-2
- الغرض: حدث للسماح للملحقات الأخرى بالقيام بشيء ما عندما تكون المواقع الفارغة مخفية

# بلتزي_sitemaker_layout_cleared

- الموقع: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- بعد: 3-1-2
- الغرض: حدث للسماح للملحقات الأخرى بالقيام بشيء ما عندما يتم مسح التخطيط

# بلتزي_sitemaker_layout_محدَّث

- الموقع: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- بعد: 3-1-2
- الغرض: حدث للسماح للملحقات الأخرى بالقيام بشيء ما عندما يتم تحديث التخطيط

# بلعة_sitemaker_tinymce_options

- الموقع: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- منذ: 3.3.0
- الغرض: حدث للسماح للملحقات الأخرى لتعديل خيارات التعقيد