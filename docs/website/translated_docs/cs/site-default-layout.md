---
id: výchozí rozvržení na webu
title: Nastavení platební neschopnosti
---

Když přidáte blok, je přidán na tuto konkrétní stránku. Bylo by proto únavným úkolem vymezit bloky všech stránek na vašich stránkách. Můžete nastavit všechny požadované bloky pro konkrétní stránku, pak nastavit tuto stránku jako výchozí rozložení. Jinými slovy, každá stránka, která nemá své vlastní bloky, zdědí bloky z této stránky.

Chcete-li nastavit výchozí rozložení * Přejděte na stránku, kterou chcete nastavit jako výchozí rozložení * Klikněte na `Nastavení` v administračním panelu * Klikněte na `Nastavit jako výchozí rozložení`

Say we add blocks to a page (phpBB/index.php) with blocks in the sidebar and top positions, such as, and set it as our default layout. To má následující účinky na ostatní stránky: * Jakákoliv stránka, která nemá své vlastní bloky, zdědí bloky z výchozího rozložení. See [Understanding Block Inheritance](./blocks-inheritance.md) pro výjimky. * You may still inherit blocks from a default layout (index.php), but choose to not display blocks on some block positions or not display any blocks at all. Za tímto účelem * Přejděte na stránku, kterou nechcete zobrazit všechny/některé bloky * Klikněte na `Nastavení` v admin liště * Vyberte `Nezobrazovat bloky na této stránce` , pokud nechcete zdědit/zobrazovat žádné bloky na této stránce NEBO * Použijte CTRL + klikněte pro výběr blokových pozic (v pravé straně) které nechcete zobrazovat bloky na * V `editačním módu`, stránka, která zdědí bloky z výchozího rozložení, nezobrazí žádné bloky, dáváte možnost přidat bloky na stránku, pokud chcete * Každá stránka, která má své vlastní bloky, nebude zděděna z výchozího rozložení