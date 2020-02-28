---
id: lokalizace
title: Mládež
---

"Layouts" určuje dostupné blokové pozice a způsob jejich zobrazení.

## Blokové pozice

Blokové pozice jsou predefinované oblasti na vašich stránkách, kde mohou existovat bloky. Dostupné blokové pozice jsou určovány šablonským stylem, který používáte. Pro prosilver, phpBB SiteMaker přichází s následujícími pozicemi bloku: * panel: plná šířka nahoře * postranní panel: left/vpravo v závislosti na rozložení níže * subobsah: podobně jako postranní panel jen větší * top_hor: vodorovné bloky nahoře, přehrání nad postranním panelu/podobsahem v závislosti na rozložení * Nahoře: nad hlavním obsahem * box: stejná šířka, vodorovné bloky pod hlavním obsahem * dolů: pod hlavním obsahem * dole _hor: horizontální bloky přes dolní část, flanuji postranník/podobsah v závislosti na rozložení * patičky: vodorovné bloky v zápatí Můžete přidat více pozic bloků ve vašem vlastním stylu kopírováním a úpravou odpovídajících phpBB SiteMaker šablon

## Site Layout

Můžete si vybrat vzhled pro své stránky v AKT. (Rozšíření > Sitemaker > Nastavení): * **Blog**: subcontent and postranní panel vedle sebe posunuto na pravou stranu, horní část _hor/botom_hor subobsah * **Svatý Grail**: stejný šířkový postranní panel a subobsah na opačných stranách. top _hor/botom_hor subobsah flank * **Portál**: postranní panel vlevo, podobsah napravo top _hor/botom_hor subobsah objektu * **Alt**: subobsah vlevo, postranní panel napravo top_hor/botom_hor boční boční panel * **Vlastní**: Ručně nastavte šířku postranních panelů jako px, %, em nebo rem. Chyby pro 200 px na obou stranách

## Zákazné šablony/styly

Pokud je to možné, snažili jsme se vložit šablony souborů a aktiv do stylů/all/ složky, takže je můžete přepsat vytvořením souboru se stejným jménem pod vlastní šablonu téma, např. prosilver. Pokud tedy chcete změnit způsob zobrazování určitého bloku nebo chcete-li vytvořit vlastní rozložení s vlastními blokovými pozicemi, musíte jednoduše vytvořit soubor se stejným jménem a cestou jako původní ve vašem stylu.

Pokud potřebujete přizpůsobit CSS/JS soubory, podívejte se na téma [téma](./developer-theming.md).