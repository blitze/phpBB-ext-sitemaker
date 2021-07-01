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
* Kendi blokları olmayan herhangi bir sayfa, blokları varsayılan düzenden devralır. See [Understanding Block Inheritance](/docs/user/site/block-inheritance) for exceptions.
* You may still inherit blocks from a default layout (index.php) but choose to not display blocks on some block positions or not display any blocks at all. Bunu yapmak için,
    * Go to the page that you don't want all/some blocks to display
    * Yönetici çubuğundaki `Ayarlar`a tıklayın
    * Select `Do not show blocks on this page` if you don't want to inherit/display any blocks on this page OR
    * Use CTRL + click to select the block positions (on the right) that you do not want to display blocks on
* In `edit mode`, a page that inherits blocks from the default layout, will not show any blocks, giving you the opportunity to add blocks to the page if you want to
* Any page that has its own blocks will not inherit from the default layout
