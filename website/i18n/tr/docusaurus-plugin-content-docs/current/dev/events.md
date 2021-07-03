---
title: phpBB SiteMaker Olayları
sidebar_position: 2
---

phpBB'nin olay sistemini kullanarak phpBB SiteMaker'ın davranışını düzenleyebilirsiniz.

## PHP Olayları

### blitze.sitemaker.acp_add_bulk_menu_options

-   Konum: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
-   Şu sürümden beri: 3.1.0
-   Amaç: ykp menüsüne toplu menü seçenekleri eklemek

### blitze.sitemaker.acp_display_settings_form

-   Konum: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Şu sürümden beri: 3.1.0
-   Amaç: ykp (sitemaker) ayarları formunu görüntüle

### blitze.sitemaker.acp_save_settings

-   Konum: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
-   Şu sürümden beri: 3.1.0
-   Amaç: ykp (sitemaker) ayarlarını kaydet

### blitze.sitemaker.admin_bar.set_assets

-   Konum: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
-   Şu sürümden beri: 3.0.1-RC1
-   Amaç: Düzenleme modunda mevcut bloklar için varlıklar ekleyin

### blitze.sitemaker.modify_block_positions

-   Konum: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Şu sürümden beri: 3.0.1-RC1
-   Amaç: Blok konumlarını düzenle

### blitze.sitemaker.modify_rendered_block

-   Konum: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
-   Şu sürümden beri: 3.0.1-RC1
-   Amaç: İşlenmiş bir bloğu değiştirin

## Şablon Olayları

### blitze_sitemaker_acp_settings

-   Konum: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
-   Şu sürümden beri: 3.1.0
-   Amaç: Site oluşturucu ayarları için form alanları ekleyin

### blitze_sitemaker_admin_bar_append

-   Konum: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Şu sürümden beri: 3.1.0
-   Amaç: Yönetici çubuğuna menü öğeleri eklemek

### blitze_sitemaker_admin_bar_templates

-   Konum: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
-   Şu sürümden beri: 3.1.0
-   Amaç: JS'de blok görünümler vb. için kullanılacak şablon dosyaları ekleyin

## Javascript Olayları

### blitze_sitemaker_layout_saved

-   Konum: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
-   Şu sürümden beri: 3.1.2
-   Amaç: Düzen değişiklikleri kaydedildiğinde diğer uzantıların bir şeyler yapmasına izin veren olay

### blitze_sitemaker_render_block_before

-   Konum: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Şu sürümden beri: 3.1.2
-   Amaç: Blok oluşturulmadan önce diğer uzantıların bir şeyler yapmasına izin veren veya yeniden oluşturulmasını engelleyen olay

### blitze_sitemaker_render_block_after

-   Konum: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
-   Şu sürümden beri: 3.1.2
-   Amaç: Blok oluşturulduktan sonra diğer uzantıların bir şeyler yapmasına izin verme olayı

### blitze_sitemaker_save_block_before

-   Konum: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
-   Şu sürümden beri: 3.1.2
-   Amaç: Diğer uzantıların kaydedilmeden önce blok verilerini değiştirmesine izin veren olay

### blitze_sitemaker_show_all_block_positions

-   Konum: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Şu sürümden beri: 3.1.2
-   Amaç: Tüm blok pozisyonları gösterildiğinde diğer uzantıların bir şeyler yapmasına izin veren olay

### blitze_sitemaker_hide_empty_block_positions

-   Konum: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Şu sürümden beri: 3.1.2
-   Amaç: Boş pozisyonlar gizlendiğinde diğer uzantıların bir şeyler yapmasına izin veren olay

### blitze_sitemaker_layout_cleared

-   Konum: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Şu sürümden beri: 3.1.2
-   Amaç: Düzen temizlendiğinde diğer uzantıların bir şeyler yapmasına izin veren olay

### blitze_sitemaker_layout_updated

-   Konum: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
-   Şu sürümden beri: 3.1.2
-   Amaç: Düzen güncellendiğinde diğer uzantıların bir şeyler yapmasına izin veren olay

### blitze_sitemaker_tinymce_options

-   Konum: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
-   Şu sürümden beri: 3.3.0
-   Amaç: Diğer uzantıların tinymce seçeneklerini değiştirmesine izin vermek için olay
