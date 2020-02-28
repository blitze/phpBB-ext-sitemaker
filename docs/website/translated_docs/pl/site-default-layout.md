---
id: domyślny układ strony
title: Ustawienie domyślnego układu
---

Po dodaniu bloku, jest on dodany do tej konkretnej strony. W związku z tym trudnym zadaniem byłoby ustawienie bloków dla wszystkich stron twojej witryny. Możesz ustawić wszystkie bloki dla danej strony, a następnie ustawić tę stronę jako domyślny układ. Innymi słowy, każda strona, która nie ma własnych bloków, dziedziczy bloki z tej strony.

Aby ustawić domyślny układ * Przejdź do strony, którą chcesz ustawić jako domyślny układ * Kliknij `Ustawienia` na pasku administracyjnym * Kliknij `Ustaw jako domyślny układ`

Powiedz że dodajemy bloki do strony (phpBB/index.php) z blokami na pasku bocznym i na górnych pozycjach i ustaw je jako nasz domyślny układ. Ma to następujące efekty dla innych stron: * Dowolna strona, która nie ma własnych bloków, dziedziczy bloki z domyślnego układu. Zobacz [Zrozumienie dziedziczenia bloku](./blocks-inheritance.md) w celu uzyskania wyjątków. * Możesz nadal dziedziczyć bloki z domyślnego układu (indeks. hp), ale wybierz nie wyświetlaj bloków na niektórych pozycjach bloków lub nie wyświetlaj żadnych bloków. To do this, * Go to the page that you don't want all/some blocks to display * Click on `Settings` in the admin bar * Select `Do not show blocks on this page` if you don't want to inherit/display any blocks on this page OR * Use CTRL + click to select the block positions (on the right) that you do not want to display blocks on * In `edit mode`, a page that inherits blocks from the default layout, will not show any blocks, giving you the opportunity to add blocks to the page if you want to * Any page that has its own blocks will not inherit from the default layout