---
id: domyślny układ strony
title: Ustawienie domyślnego układu
---

Po dodaniu bloku, jest on dodany do tej konkretnej strony. W związku z tym trudnym zadaniem byłoby ustawienie bloków dla wszystkich stron twojej witryny. Możesz ustawić wszystkie bloki dla danej strony, a następnie ustawić tę stronę jako domyślny układ. Innymi słowy, każda strona, która nie ma własnych bloków, dziedziczy bloki z tej strony.

Aby ustawić domyślny układ * Przejdź do strony, którą chcesz ustawić jako domyślny układ * Kliknij `Ustawienia` na pasku administracyjnym * Kliknij `Ustaw jako domyślny układ`

Powiedz że dodajemy bloki do strony (phpBB/index.php) z blokami na pasku bocznym i na górnych pozycjach i ustaw je jako nasz domyślny układ. Ma to następujące efekty dla innych stron: * Dowolna strona, która nie ma własnych bloków, dziedziczy bloki z domyślnego układu. Zobacz [Zrozumienie dziedziczenia bloku](./blocks-inheritance.md) w celu uzyskania wyjątków. * Możesz nadal dziedziczyć bloki z domyślnego układu (indeks. hp), ale wybierz nie wyświetlaj bloków na niektórych pozycjach bloków lub nie wyświetlaj żadnych bloków. W tym celu * Przejdź do strony, której nie chcesz, aby wszystkie / niektóre bloki były wyświetlane * Kliknij `Ustawienia` w pasku administratora * Wybierz `Nie pokazuj bloków na tej stronie` jeśli nie chcesz dziedziczać/wyświetlać bloków na tej stronie LUB * Użyj CTRL + kliknij aby wybrać pozycje bloków (z prawej), których nie chcesz wyświetlać bloków na * W `trybie edycji`, strona, która dziedziczy bloki z domyślnego układu, nie wyświetli żadnych bloków, dając możliwość dodawania bloków do strony jeśli chcesz * Żadna strona, która ma własne bloki, nie będzie dziedziczyć z domyślnego układu