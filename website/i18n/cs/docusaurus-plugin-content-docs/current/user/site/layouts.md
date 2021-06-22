---
title: Rozvržení
sidebar_position: 1
---

"Rozvržení" určují dostupné pozice bloku a jak jsou zobrazeny.

## Blokované pozice
Blokované pozice jsou předdefinované oblasti na vašem místě, kde mohou existovat bloky. Položky s kupní opcí uplatnitelnou po datu pro vykazování, které po datu skutečné splatnosti nesplňují podmínky podle článku 63 nařízení o kapitálových požadavcích Pro prosilver, phpBB SiteMaker přichází s následujícími pozicemi:
* panel: celá šířka nahoře
* postranní panel: vlevo/vpravo v závislosti na rozložení níže
* subobsah: podobně jako právě větší postranní panel
* top_hor: vodorovné bloky přes horní okraj bočního panelu/subobsah v závislosti na rozložení
* horní: nad hlavním obsahem
* pole: stejná šířka, vodorovné bloky pod hlavním obsahem
* dole pod hlavním obsahem
* spodní_hor: vodorovné bloky dole, přilehlé k postrannímu panelu/subobsahu v závislosti na rozvržení
* zápatí: horizontální bloky v zápatí Můžete přidat další blokové pozice ve vlastních šablonách stylu zkopírováním a úpravou odpovídajících phpBB SiteMaker šablon

## Rozložení webu
Můžete si vybrat rozvržení vašeho webu v zemích AKT (Vypnutí > Nastavení položky > Nastavení):
* **Blog**: subobsah a postranní panel vedle sebe, tlačené vpravo, subobsah top_hor/botom_hor bok
* **Svatý Grail**: stejný šířkový postranní panel a subobsah na opačných stranách, top_hor/botom_hor subobsah boku
* **Portal**: postranní panel vlevo, subobsah na pravé straně top_hor/botom_hor křídla
* **Portál Alt**: subobsah vlevo, postranní panel vpravo, top_hor/botom_hor boční panel
* **Vlastní**: Ručně nastavte šířku postranních panelů na px, %, em nebo rem. Výchozí nastavení je 200px na každé straně

## Vlastní šablony/styly
Pokud je to možné, pokusili jsme se vložit soubory šablon a majetku do style/vše/složky, abyste je mohli přepsat vytvořením souboru se stejným jménem pod vlastní šablonou šablony. . prosilver. Takže pokud chcete upravit zobrazení určitého bloku nebo pokud chcete vytvořit vlastní rozložení s vlastními pozicemi, jednoduše musíte vytvořit soubor se stejným názvem a cestou, jako je originální ve svém vlastním stylu.

Pokud potřebujete přizpůsobit CSS/JS soubory, podívejte se na [témata](/docs/dev/theming).