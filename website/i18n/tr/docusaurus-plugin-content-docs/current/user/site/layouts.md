---
title: Görünümler
sidebar_position: 1
---

"Görünümler" mevcut blok konumlarını ve bunların nasıl görüntüleneceğini belirler.

## Blok Konumları
Blok konumları, sitenizde blokların bulunabileceği önceden tanımlanmış alanlardır. Kullanılabilir blok konumları, kullandığınız şablon stiline göre belirlenir. Prosilver için phpBB SiteMaker aşağıdaki blok konumlarıyla birlikte gelir:
* panel: üst kısımda tam genişlik
* kenar çubuğu: aşağıdaki düzene bağlı olarak sol/sağ
* subcontent: similar to sidebar just larger
* top_hor: horizontal blocks across the top, flanking above sidebar/subcontent depending on layout
* top: above main content
* box: equal width, horizontal blocks below main content
* alt: ana içeriğin altında
* bottom_hor: horizontal blocks across the bottom, flanking the sidebar/subcontent depending on layout
* footer: horizontal blocks in the footer You can add more block positions in your own style templates by copying and modifying the corresponding phpBB SiteMaker templates

## Site Layout
You can choose the layout for your site in ACP (Extensions > Sitemaker > Settings):
* **Blog**: subcontent and sidebar next to each other, pushed to the right, top_hor/botom_hor flank subcontent
* **Holy Grail**: equal width sidebar and subcontent on opposite sides, top_hor/botom_hor flank subcontent
* **Portal**: sidebar on left, subcontent on the right, top_hor/botom_hor flank subcontent
* **Portal Alt**: subcontent on left, sidebar on the right, top_hor/botom_hor flank sidebar
* **Custom**: Manually set the width of the sidebars as px, %, em or rem. Defaults to 200px on each side

## Custom templates/styles
As much as possible, we tried to put template files and assets in styles/all/ folder so that you can overwrite them by creating a file with same name under your own template theme e.g. prosilver. So if you want to modify how a certain block displays or if you want to create your own layout with your own block positions, you simply need to create a file with the same name and path as the original in your own style.

If you need to customize CSS/JS files, take a look at the [theming](/docs/dev/theming) section.