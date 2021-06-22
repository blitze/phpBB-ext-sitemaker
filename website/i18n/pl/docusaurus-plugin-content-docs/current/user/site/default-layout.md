---
title: Ustawianie domyślnego układu
sidebar_position: 4
---

Po dodaniu bloku zostanie on dodany do tej konkretnej strony. Ustawianie bloków dla wszystkich stron na Twojej stronie byłoby zatem żmudnym zadaniem. Możesz ustawić wszystkie pożądane bloki dla danej strony, a następnie ustawić tę stronę jako domyślny układ. Innymi słowy, każda strona, która nie ma własnych bloków, odziedziczy bloki z tej strony.

Aby ustawić domyślny układ
* Przejdź do strony, którą chcesz ustawić jako domyślny układ
* Kliknij na `Ustawienia` w pasku admina
* Kliknij przycisk `Ustaw jako domyślny układ`

Powiedz nam, że dodajemy bloki do strony (phpBB/index.php) z blokami w pasku bocznym i górnych pozycjach, na przykład i ustawiamy je jako nasz domyślny układ. Ma to następujące skutki dla innych stron:
* Każda strona, która nie ma własnych bloków, odziedziczy bloki z domyślnego układu. Zobacz [Zrozumienie dziedziczenia bloku](/docs/user/site/block-inheritance) dla wyjątków.
* Nadal możesz dziedziczyć bloki z domyślnego układu (indeks. hp), ale nie wyświetlaj bloków na niektórych pozycjach bloków lub w ogóle nie wyświetlaj żadnych bloków. W tym celu
    * Przejdź do strony, której nie chcesz wyświetlić wszystkie/kilka bloków
    * Kliknij na `Ustawienia` w pasku admina
    * Wybierz `Nie pokazuj bloków na tej stronie` jeśli nie chcesz dziedziczać/wyświetlać bloków na tej stronie LUB
    * Użyj CTRL + kliknij aby wybrać pozycje bloków (z prawej), na których nie chcesz wyświetlać bloków
* W `trybie edycji`, strona, która dziedziczy bloki z układu domyślnego, nie wyświetli żadnych bloków, dając Ci możliwość dodawania bloków do strony jeśli chcesz
* Żadna strona, która ma własne bloki, nie będzie dziedziczyć z domyślnego układu
