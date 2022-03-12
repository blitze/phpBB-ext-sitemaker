---
title: Nastavení výchozího rozvržení
sidebar_position: 4
---

Přidáte-li blok, bude přidán na tuto konkrétní stránku. Proto by bylo únavné nastavit bloky pro všechny stránky na vašich stránkách. Můžete nastavit všechny požadované bloky pro určitou stránku a pak nastavit tuto stránku jako výchozí rozložení. Jinými slovy, každá stránka, která nemá vlastní bloky, zdědí bloky z této stránky.

Pro nastavení výchozího rozložení
* Přejděte na stránku, kterou chcete nastavit jako výchozí rozložení
* Klikněte na `Nastavení` v admin panelu
* Klikněte na tlačítko `Nastavit jako výchozí rozložení`

Řekněte nám přidat bloky na stránku (phpBB/index.php) s bloky například v postranním panelu a na vrchních pozicích a nastavit je jako výchozí rozložení. Toto má následující efekty pro ostatní stránky:
* Každá stránka, která nemá vlastní bloky, zdědí bloky z výchozího rozložení. Pro výjimky viz [Porozumění blokovému dědictví](/docs/user/site/block-inheritance).
* Stále můžete zdědit bloky z výchozího rozložení (index). hp), ale zvolte nezobrazovat bloky na některých pozicích bloku nebo vůbec nezobrazovat žádné bloky. Za tímto účelem
    * Přejděte na stránku, kterou nechcete zobrazit všechny/některé bloky
    * Klikněte na `Nastavení` v admin panelu
    * Vyberte `Nezobrazovat bloky na této stránce` , pokud nechcete zdědit/zobrazit bloky na této stránce NEBO
    * Použijte CTRL + kliknutím vyberte pozice bloku (na pravé straně), na kterých nechcete zobrazit bloky
* V `režimu úprav`stránka, která zdědí bloky z výchozího rozvržení, nezobrazí žádné bloky, které vám dají možnost přidat bloky na stránku, pokud chcete
* Žádná stránka, která má své vlastní bloky, nebude dědit z výchozího rozložení
