---
title: Mananaging Blocks
sidebar_position: 3
---

phpBB SiteMaker'da blokları yönetmek için [Düzenleme Modu](./overview#edit-mode)nda olmalısınız.

> Bir blok herhangi bir içerik göstermediğinde, düzenleme modu dışında görüntülenmez. Bu şekilde, ona içerik verebilir (Özel blok durumunda) veya ayarlarını değiştirebilirsiniz.

> Düzenleme modunda, şeffaf bloklar yalnızca düzenleme modunda olduğumuz için görüntülenen bloklardır, aksi takdirde görüntülenmeyeceklerdir

## Blok Ekleme
Kullanıcı Kontrol Paneli ve Moderatör Kontrol Paneli sayfaları dışında, ön yüz herhangi bir sayfaya blok ekleyebilirsiniz. Blok eklemek için şu gereklidir:
* Yönetici Çubuğundaki **Blocklar** yazısına tıklayın. Bu, mevcut blokların bir listesini görüntüler
* İstediğiniz bloğu herhangi bir blok konumuna sürükleyip bırakın

## Blokları Düzenleme
### Bir Blok Simgesi Ekleme
Blok başlığının (prosilver) solunda blok simgesi için bir kutu vardır. Click on this box to get the icon picker. You can select the icon size, color, float, rotation, etc.

### Editing the Block Title
phpBB SiteMaker blocks will have a default, translated title but if the title does not meet your needs, you can change it. To edit the block title,
* Click on the block title to get an inline edit form
* Change the title to whatever you want
* Remove focus from the field or hit enter to submit changes

> Değiştirilen blok başlığınız tercüme edilmedi

> To revert to the default title, simple delete the title and hit enter

### Editing block settings
When you hover over a block, a cog icon will appear to the right of the block that can be used to edit the block. In the edit block dialog, you can:
- Enable/disable a block [Status]
- Choose when the block should/should not be displayed [Display]. This only applies in cases where you have nested pages (see [Understanding Block Inheritance](/docs/user/site/block-inheritance)):
    - **Her zaman**: Bloğu her zaman göster
    - **Hide on child routes**: Only show this block on the parent route
    - **Show on child routes only**: Only show this block on a child route
- Choose which groups of users can view the block [Viewable by]. Use CTRL + click to select multiple groups.
- Set custom classes to modify the appearance of the block or items (lists, images, background, etc) within the block [CSS Class]
- Show/hide the block title [Hide block title?]
- Select the block view [Block view]. You can select a default block view when new blocks are added in ACP.
    - **Default / Simple**: uses the prosilver panel class to wrap the block in a padded container
    - **Basic**: block does not have any container wrapping it
    - **Boxed**: uses the prosilver forabg class to wrap the block in a box
- Set / Update block specific settings
- If you have the same block with same settings across multiple pages, you can update all of them at once by checking the **Update blocks with similar settings**

## Blokları Silme
- Silmek istediğiniz bloğun üstüne gelin
- **x** simgesine tıklayın ve bloğu silmek istediğinizi onaylayın
- Yönetici çubuğuna gidin ve `Değişiklikleri Kaydet`'i tıklayın
