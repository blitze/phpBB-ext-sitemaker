---
id: layouty strony
title: Układy
---

"Układy" określają dostępne pozycje bloków i sposób ich wyświetlania.

## Położenie bloku

Pozycje bloków to wstępnie określone obszary na twojej witrynie, gdzie mogą istnieć bloki. Dostępne pozycje bloków są określane przez styl szablonu, którego używasz. O pojemności skokowej przekraczającej 2500 cm3 phpBB SiteMaker jest wyposażony w następujące pozycje bloku: * panel: pełna szerokość w górze * boczny pasek: lewo/prawo w zależności od układu poniżej * subzawartość: podobne do panelu bocznego * górny poziomy blok w górze, okładka nad paskiem bocznym/podzawartością w zależności od układu * góra: nad główną zawartością * pola: taka sama szerokość, bloki poziome poniżej głównej zawartości * dół: poniżej głównej zawartości * dolnej_hor: bloki poziome na dole, otaczanie paska bocznego/podzawartości w zależności od układu * stopki: bloki poziome w stopce Możesz dodać więcej pozycji blokowych we własnych szablonach poprzez kopiowanie i modyfikację odpowiednich szablonów phpBB SiteMaker

## Układ witryny

Możesz wybrać układ dla swojej witryny w AKP (rozszerzenia > Sitemaker > Ustawienia): * **Blog**: subzawartość i pasek boczny obok siebie, wypchnięty w prawo, górny _hor/botom_hor podzawartość boków * **Święty Grail**: pasek boczny o równej szerokości i podzawartość po przeciwległych stronach, top_hor/botom_hor flank subzawartość * **Portal**: pasek boczny po lewej, subzawartość po prawej stronie, top_hor/botom_hor flank subzawartość * **Alt Portal**: podzawartość po lewej stronie, pasek boczny po prawej, top_hor/botom_hor pasek boczny * **Niestandardowy**: Ręcznie ustaw szerokość pasków bocznych jako px, %, em lub rem. Domyślna wartość 200px po każdej stronie

## Własne szablony/style

W miarę możliwości, próbowaliśmy umieścić pliki szablonu i zasoby w style/wszystkich/folderze, aby móc je nadpisać tworząc plik o tej samej nazwie pod własnym szablonem. . prosrow. Więc jeśli chcesz zmodyfikować sposób wyświetlania określonego bloku lub jeśli chcesz utworzyć własny układ z własnymi pozycjami bloku, po prostu musisz utworzyć plik o tej samej nazwie i ścieżce co oryginał w swoim własnym stylu.

Jeśli potrzebujesz dostosować pliki CSS/JS, spójrz się z sekcją [motywu](./developer-theming.md).