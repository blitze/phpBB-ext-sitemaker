---
title: Özel Blok
sidebar_position: 4
---

If the available blocks do not give you the freedom you need, there is the `Custom Block` which allows you the freedom to display your own content using BBcode or HTML. Blok bir WYSIWYG editör (TİNYMCE) ve bir script yöneticisi ile birlikte gelir:

## The editor

-   You can use the editor to create HTML content
-   Bu düzeyde bir kontrole ihtiyacınız varsa, düzenleyicideki `Kaynak kodu` simgesine (`<>`) tıklayarak kaynak kodunu düzenleyebilirsiniz
-   Editör sizin görsel yüklemenize ve modifiye etmenize izin verir
    -   Ona erişimi olan her kullanıcı için phpBB/images/sitemaker_uploads/ içinde yeni bir klasör oluşturur
    -   Tüm kullanıcıların klamsrlerini görebilir/yönetebilirsiniz
-   Düzenleyici, javascript vb. gibi potansiyel olarak tehlikeli komut dosyalarını filtreler. Google reklamları gibi bir içerik eklemeniz gerekirse, javascript filtrelenir, ancak aşağıdakileri yaparak bunu aşabilirsiniz:
    -   Özel Bloğu istenen konuma ekleyin
    -   Özel Bloğu düzenleyin, `HTML` sekmesine tıklayın ve Javascript'inizi yapıştırın

## Kod Yöneticisi

Özel Blok, sayfanıza özel CSS ve Javascript dosyaları eklemenize de olanak tanır. Bunu yapmak için:

-   Herhangi bir blok pozisyonuna bir `Özel Blok` ekleyin. Blokla içerik de görüntülemiyorsanız, konum önemli değildir
-   Bloğu düzenleyin, `Scripts` sekmesine tıklayın ve CSS veya Javascript dosyalarınızı ekleyin > Yine de dikkatli olun: Sayfanıza birçok komut dosyası eklemek, yükleme sürelerini etkileyebilir
