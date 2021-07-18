---
title: Varsayılan Bir Düzen Ayarla
sidebar_position: 4
---

Bir blok eklediğinizde, o belirli sayfaya eklenir. Bu nedenle, sitenizdeki tüm sayfalar için bloklar ayarlamak sıkıcı bir iş olacaktır. Belirli bir sayfa için istediğiniz tüm blokları ayarlayabilir, ardından o sayfayı varsayılan düzen olarak ayarlayabilirsiniz. Başka bir deyişle, kendi blokları olmayan herhangi bir sayfa, bu sayfadan blokları devralır.

Varsayılan bir düzen ayarlamak için
* Varsayılan düzen olarak ayarlamak istediğiniz sayfaya gidin
* Yönetici çubuğundaki `Ayarlar`'ı tıklayın
* `Varsayılan düzen olarak ayarla` düğmesini tıklayın

Örneğin, kenar çubuğunda ve üst konumlarda bloklar bulunan bir sayfaya (phpBB/index.php) bloklar eklediğimizi ve bunu varsayılan düzenimiz olarak ayarladığımızı varsayalım. Bunun diğer sayfalar için aşağıdaki etkileri vardır:
* Kendi blokları olmayan herhangi bir sayfa, blokları varsayılan düzenden devralır. İstisnalar için [Blok Aktrımı'nı Anlama](/docs/user/site/block-inheritance) konusuna bakın.
* Yine de varsayılan bir düzenden (index.php) blokları devralabilirsiniz, ancak bazı blok konumlarında blokları görüntülememeyi veya hiç blok görüntülememeyi seçebilirsiniz. Bunu yapmak için,
    * Tüm/bazı blokların görüntülenmesini istemediğiniz sayfaya gidin
    * Yönetici çubuğundaki `Ayarlar`a tıklayın
    * Bu sayfadaki herhangi bir bloğu devralmak/görüntülemek istemiyorsanız `Bu sayfada blokları gösterme`'yi seçin VEYA
    * Blokları görüntülemek istemediğiniz blok konumlarını (sağda) seçmek için CTRL + tıklama tuşlarını kullanın
* `Düzenleme modunda`, varsayılan düzenden blokları devralan bir sayfa herhangi bir blok göstermez ve isterseniz sayfaya blok ekleme fırsatı verir
* Kendi bloklarına sahip hiçbir sayfa, varsayılan düzenden miras almaz
