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
Blok başlığının (prosilver) solunda blok simgesi için bir kutu vardır. Simge seçiciyi almak için bu kutuya tıklayın. Simge boyutunu, rengini, kayan noktayı, dönüşü vb. seçebilirsiniz.

### Blok Başlığını Düzenleme
phpBB SiteMaker bloklarının varsayılan, çevrilmiş bir başlığı olacaktır, ancak başlık ihtiyaçlarınızı karşılamıyorsa değiştirebilirsiniz. Blok başlığını düzenlemek için,
* Satır içi düzenleme formu almak için blok başlığına tıklayın
* Başlığı istediğiniz gibi değiştirin
* Odağı alandan kaldırın veya değişiklikleri göndermek için enter tuşuna basın

> Değiştirilen blok başlığınız tercüme edilmedi

> Varsayılan başlığa dönmek için başlığı silin ve enter tuşuna basın

### Editing block settings
When you hover over a block, a cog icon will appear to the right of the block that can be used to edit the block. In the edit block dialog, you can:
- Enable/disable a block [Status]
- Choose when the block should/should not be displayed [Display]. This only applies in cases where you have nested pages (see [Understanding Block Inheritance](/docs/user/site/block-inheritance)):
    - **Her zaman**: Bloğu her zaman göster
    - **Alt rotalarda gizle**: Bu bloğu yalnızca üst rotada göster
    - **Yalnızca alt rotalarda göster**: Bu bloğu yalnızca bir alt rotada göster
- Bloğunu hangi kullanıcı gruplarının görüntüleyebileceğini seçin [Görüntülenebilir]. Birden çok grup seçmek için CTRL + tıklama tuşlarını kullanın.
- Blok veya blok içindeki öğelerin (listeler, resimler, arka plan, vb.) görünümünü değiştirmek için özel sınıflar ayarlayın [CSS Sınıfı]
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
