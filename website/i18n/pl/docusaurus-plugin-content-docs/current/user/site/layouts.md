---
title: Układy
sidebar_position: 1
---

"Układy" określają dostępne pozycje bloków i sposób ich wyświetlania.

## Zablokuj pozycje
Pozycje bloków są wstępnie zdefiniowanymi obszarami na twojej stronie, gdzie mogą istnieć bloki. Dostępne pozycje bloków są określone przez styl szablonu, którego używasz. Dla srebra phpBB SiteMaker posiada następujące pozycje bloku:
* panel: pełna szerokość na górze
* pasek boczny: lewy/prawo w zależności od układu poniżej
* podzawartość: podobna do paska bocznego tylko większa
* Góra_hor: poziome bloki na górze, flankujące nad paskiem bocznym/podzawartością w zależności od układu
* góra: powyżej głównej zawartości
* pola: równa szerokość, bloki poziome poniżej głównej zawartości
* na dole: poniżej głównej zawartości
* dolny_hor: poziome bloki na dole, flankujące pasek boczny/podzawartość w zależności od układu
* stopka: poziome bloki w stopce Możesz dodać więcej pozycji bloków we własnych szablonach stylu, kopiując i modyfikując odpowiednie szablony phpBB SiteMaker

## Układ witryny
Możesz wybrać układ swojej witryny w AKP (Rozszerzenia > Sitemaker > Ustawienia):
* **Blog**: podzawartość i pasek boczny obok siebie, popychane w prawo, top_hor/botom_hor flank
* **Święty Grail**: pasek boczny o tej samej szerokości i subzawartość po przeciwnych stronach, top_hor/botom_hor flank
* **Portal**: pasek boczny po lewej stronie, podzawartość po prawej, top_hor/botom_hor flank
* **Portal Alt**: subzawartość po lewej stronie, pasek boczny po prawej, top_hor/botom_hor flank
* **Niestandardowy**: ręcznie ustaw szerokość pasków bocznych jako px, %, em lub rem. Domyślnie 200 px po każdej stronie

## Niestandardowe szablony / style
O ile to możliwe, próbowaliśmy umieścić pliki szablonu i zasoby w stylu/wszystkie/folderze tak, aby można je nadpisać, tworząc plik o tej samej nazwie pod własnym szablonem. . potwierdź. Więc jeśli chcesz zmodyfikować sposób wyświetlania określonych bloków lub jeśli chcesz utworzyć własny układ z własnymi pozycjami bloków, po prostu musisz utworzyć plik o tej samej nazwie i ścieżce co oryginał w swoim własnym stylu.

Jeśli potrzebujesz dostosować pliki CSS/JS, zajrzyj do sekcji [motywu](/docs/dev/theming).