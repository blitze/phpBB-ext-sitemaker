---
title: Görünümler
sidebar_position: 1
---

"Görünümler" mevcut blok konumlarını ve bunların nasıl görüntüleneceğini belirler.

## Blok Konumları
Blok konumları, sitenizde blokların bulunabileceği önceden tanımlanmış alanlardır. Kullanılabilir blok konumları, kullandığınız şablon stiline göre belirlenir. Prosilver için phpBB SiteMaker aşağıdaki blok konumlarıyla birlikte gelir:
* panel: üst kısımda tam genişlik
* kenar çubuğu: aşağıdaki düzene bağlı olarak sol/sağ
* subcontent: kenar çubuğuna benzer sadece daha büyük
* top_hor: üstte yatay bloklar, yerleşime bağlı olarak kenar çubuğunun/alt içeriğin üzerinde yan yana
* top: ana içeriğin üstünde
* box: eşit genişlikte, ana içeriğin altında yatay bloklar
* bottom: ana içeriğin altında
* bottom_hor: düzene bağlı olarak kenar çubuğunu/alt içeriği çevreleyen alt kısımdaki yatay bloklar
* footer: altbilgideki yatay bloklar İlgili phpBB SiteMaker şablonlarını kopyalayıp değiştirerek kendi stil şablonlarınıza daha fazla blok konumu ekleyebilirsiniz

## Site Düzeni
YKP'de sitenizin düzenini seçebilirsiniz (Uzantılar > Sitemaker > Ayarlar):
* **Blog**: subcontent and sidebar next to each other, pushed to the right, top_hor/botom_hor flank subcontent
* **Holy Grail**: equal width sidebar and subcontent on opposite sides, top_hor/botom_hor flank subcontent
* **Portal**: sidebar on left, subcontent on the right, top_hor/botom_hor flank subcontent
* **Portal Alt**: subcontent on left, sidebar on the right, top_hor/botom_hor flank sidebar
* **Custom**: Manually set the width of the sidebars as px, %, em or rem. Defaults to 200px on each side

## Özel şablonlar/stiller
As much as possible, we tried to put template files and assets in styles/all/ folder so that you can overwrite them by creating a file with same name under your own template theme e.g. prosilver. So if you want to modify how a certain block displays or if you want to create your own layout with your own block positions, you simply need to create a file with the same name and path as the original in your own style.

If you need to customize CSS/JS files, take a look at the [theming](/docs/dev/theming) section.