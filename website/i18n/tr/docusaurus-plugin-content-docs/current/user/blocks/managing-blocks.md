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

### Blok ayarlarını düzenlemek
Bir bloğun üzerine geldiğinizde, bloğu düzenlemek için kullanılabilecek bloğun sağında bir dişli simgesi görünecektir. Blok düzenleme iletişim kutusunda şunları yapabilirsiniz:
- Bir bloğu etkinleştir/devre dışı bırak [Status]
- Bloğun ne zaman görüntüleneceğini/gösterilmeyeceğini seçin [Display]. Bu, yalnızca iç içe sayfalarınız olduğunda geçerlidir (bkz. [Blok Devralmasını Anlama](/docs/user/site/block-inheritance)):
    - **Her zaman**: Bloğu her zaman göster
    - **Alt rotalarda gizle**: Bu bloğu yalnızca üst rotada göster
    - **Yalnızca alt rotalarda göster**: Bu bloğu yalnızca bir alt rotada göster
- Bloğunu hangi kullanıcı gruplarının görüntüleyebileceğini seçin [Görüntülenebilir]. Birden çok grup seçmek için CTRL + tıklama tuşlarını kullanın.
- Blok veya blok içindeki öğelerin (listeler, resimler, arka plan, vb.) görünümünü değiştirmek için özel sınıflar ayarlayın [CSS Sınıfı]
- Blok başlığını göster/gizle [Blok başlığını gizle?]
- Blok görünümünü seçin [Blok görünümü]. YKP'de yeni bloklar eklendiğinde varsayılan bir blok görünümü seçebilirsiniz.
    - **Varsayılan / Basit**: bloğu dolgulu bir kapta sarmak için prosilver panel sınıfını kullanır
    - **Temel**: bloğu saran herhangi bir kapsayıcı yok
    - **Kutulu**: bloğu bir kutuya sarmak için prosilver forabg sınıfını kullanır
- Set / Update block specific settings
- Birden fazla sayfada aynı ayarlara sahip aynı bloğa sahipseniz, **Blokları benzer ayarlarla güncelle** seçeneğini işaretleyerek hepsini bir kerede güncelleyebilirsiniz

## Blokları Silme
- Silmek istediğiniz bloğun üstüne gelin
- **x** simgesine tıklayın ve bloğu silmek istediğinizi onaylayın
- Yönetici çubuğuna gidin ve `Değişiklikleri Kaydet`'i tıklayın
