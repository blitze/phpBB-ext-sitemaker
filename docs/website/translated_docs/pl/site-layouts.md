---
id: site-layouts
title: Layouts
---
"Layouts" determine the available block positions and how they are displayed.

## Block Positions

Block positions are predefined areas on your site where blocks can exist. The available block positions are determined by the template style that you are using. For prosilver, phpBB SiteMaker comes with the following block positions: * panel: full width across the top * sidebar: left/right depending on layout below * subcontent: similar to sidebar just larger * top_hor: horizontal blocks across the top, flanking above sidebar/subcontent depending on layout * top: above main content * box: equal width, horizontal blocks below main content * bottom: below main content * bottom_hor: horizontal blocks across the bottom, flanking the sidebar/subcontent depending on layout * footer: horizontal blocks in the footer You can add more block positions in your own style templates by copying and modifying the corresponding phpBB SiteMaker templates

## Site Layout

You can choose the layout for your site in ACP (Extensions > Sitemaker > Settings): * **Blog**: subcontent and sidebar next to each other, pushed to the right, top_hor/botom_hor flank subcontent * **Holy Grail**: equal width sidebar and subcontent on opposite sides, top_hor/botom_hor flank subcontent * **Portal**: sidebar on left, subcontent on the right, top_hor/botom_hor flank subcontent * **Portal Alt**: subcontent on left, sidebar on the right, top_hor/botom_hor flank sidebar * **Custom**: Manually set the width of the sidebars as px, %, em or rem. Defaults to 200px on each side

## Custom templates/styles

As much as possible, we tried to put template files and assets in styles/all/ folder so that you can overwrite them by creating a file with same name under your own template theme e.g. prosilver. So if you want to modify how a certain block displays or if you want to create your own layout with your own block positions, you simply need to create a file with the same name and path as the original in your own style.

If you need to customize CSS/JS files, take a look at the [theming](./developer-theming.md) section.