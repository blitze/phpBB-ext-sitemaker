---
id: bloki – dziedziczenie
title: Zrozumienie dziedziczenia bloku
---

Widzieliśmy to już poprzez ustawienie domyślnego układu, inne strony, które nie mają własnych bloków, odziedziczą bloki z domyślnego układu. Istnieje jednak inny rodzaj dziedziczenia blokowego.

## Trasy rodzicielskie/podrzędne

W phpBB SiteMaker mówimy o zagnieżdżonych trasach w postaci realnych zagnieżdżonych katalogów lub praktycznie zagnieżdżonych trasach/trasach. Zostań ze mną :). * Rzeczywiste ścieżki rodzica/podrzędne: Na przykład ścieżka /some_directory/sub_directory/index.php jest podrzędną /some_directory/index. hp * Wirtualne ścieżki rodzica/podrzędne: Na przykład, viewtopic.php jest traktowany jako podrzędny viewforum.php.

Oto kilka przykładów tras rodzica/potomnych:

| Nadrzędny          | Dziecko                        |
| ------------------ | ------------------------------ |
| /pl/index.php      | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/artykuły  | /app.php/articles/moja pozycja |

## Dziedziczenie rodzica/Dziedzictwa

drogi rodzicielskie/dziecko, trasa podrzędna dziedziczy bloki trasy nadrzędnej (jeżeli rodzic ma własne bloki) lub z domyślnego układu (jeżeli został ustawiony). Innymi słowy, nawet jeśli istnieje domyślny układ, szlak potomny odziedziczy bloki od trasy rodzicielskiej, jeśli trasa nadrzędna ma własne bloki. Ale nie wszystkie bloki na linii macierzystej muszą być dziedziczone.

## Kontrola dziedziczenia bloku

Na poziomie bloku możesz kontrolować, kiedy blok może być dziedziczony przez trasy podrzędne. Dotknęliśmy do tego wcześniej w [Edycji ustawień bloku](./blocks-managing#editing-block-settings).

Rozważ następującą strukturę katalogów:

```text
phpBB
<unk> · index.php
<unk> · Filmy /
    <unk> · index.php
    <unk> <unk> · page.php
    <unk> · Comedy/
        <unk> · index.php
```

Do celów dziedziczenia bloków mówimy: * Droga nadrzędna /phpBB/Movies/Comedy/index.php to /phpBB/Movies/index. hp i nie /phpBB/Movies/page.php * Wszystkie strony w podkatalogu względem /phpBB/index.php to ścieżka podrzędna /phpBB/index.php. Więc /phpBB/Movies/index.php i /phpBB/Movies/page.php są wszystkimi potomkami /phpBB/index.php i dlatego dziedziczy swoje bloki, jeśli nie mają własnych bloków. W tym przypadku: * Gdy blok na /phpBB/index. hp jest ustawiony na **Ukryj na trasach podrzędnych**, blok pojawi się na /phpBB/index. hp (trasa nadrzędna), ale nie na trasach potomnych * Gdy blok na /phpBB/index. hp jest ustawiony na **Pokaż tylko na trasach podrzędnych**, będzie wyświetlany na /phpBB/Movies/index.php i /phpBB/Movies/page hp (trasy potomne), ale nie na /phpBB/index.php (nadrzędne), ani /phpBB/Movies/Comedy/index. hp (idź tylko jeden poziom) * Gdy blok na /phpBB/index. hp jest ustawiony na wyświetlanie **zawsze** (domyślnie), będzie wyświetlany na /phpBB/index.php (parent), /phpBB/Movies/index. hp and /phpBB/page.php (ścieżki podrzędne), ale nie na /phpBB/Movies/Comedy/index.php (idź tylko jeden poziom głębokości). W tym przypadku /phpBB/Movies/Comedy/index.php odziedziczy domyślną trasą (jeśli istnieje)

## Możliwy przyszły stan

Naprawdę interesuje mnie twoja opinia w tym obszarze. Większość użytkowników phpBB nie będzie miała prawdziwych katalogów jak opisano powyżej. Myślę więc o użyciu struktury, która jest zdefiniowana w bloku menu jako wirtualna struktura katalogów i zastosuj do niej dziedziczenie rodzica/dziecka. Rozważam również wyjście poza jeden poziom. Daj mi znać, czy to będzie dla Ciebie przydatne.