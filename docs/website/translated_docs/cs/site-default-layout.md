---
id: výchozí rozvržení na webu
title: Nastavení platební neschopnosti
---

Když přidáte blok, je přidán na tuto konkrétní stránku. Bylo by proto únavným úkolem vymezit bloky všech stránek na vašich stránkách. Můžete nastavit všechny požadované bloky pro konkrétní stránku, pak nastavit tuto stránku jako výchozí rozložení. Jinými slovy, každá stránka, která nemá své vlastní bloky, zdědí bloky z této stránky.

Chcete-li nastavit výchozí rozložení * Přejděte na stránku, kterou chcete nastavit jako výchozí rozložení * Klikněte na `Nastavení` v administračním panelu * Klikněte na `Nastavit jako výchozí rozložení`

Say we add blocks to a page (phpBB/index.php) with blocks in the sidebar and top positions, such as, and set it as our default layout. To má následující účinky na ostatní stránky: * Jakákoliv stránka, která nemá své vlastní bloky, zdědí bloky z výchozího rozložení. See [Understanding Block Inheritance](./blocks-inheritance.md) pro výjimky. * You may still inherit blocks from a default layout (index.php), but choose to not display blocks on some block positions or not display any blocks at all. To do this, * Go to the page that you don't want all/some blocks to display * Click on `Settings` in the admin bar * Select `Do not show blocks on this page` if you don't want to inherit/display any blocks on this page OR * Use CTRL + click to select the block positions (on the right) that you do not want to display blocks on * In `edit mode`, a page that inherits blocks from the default layout, will not show any blocks, giving you the opportunity to add blocks to the page if you want to * Any page that has its own blocks will not inherit from the default layout