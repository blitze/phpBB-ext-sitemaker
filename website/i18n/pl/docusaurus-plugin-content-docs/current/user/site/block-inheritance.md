---
title: Blokuj dziedziczenie
sidebar_position: 5
---

Już to widzieliśmy, ustawiając domyślny układ, inne strony, które nie mają własnych bloków, odziedziczą bloki z domyślnego układu. Istnieje jednak inny rodzaj dziedziczenia grupowego.

## Trasy rodzica/potomne
W phpBB SiteMaker mówimy o zagnieżdżonych trasach w postaci prawdziwych zagnieżdżonych (pod) katalogów lub praktycznie zagnieżdżonych tras. Proszę zostań ze mną :).
* Prawdziwe trasy rodzicielskie/podrzędne: Na przykład ścieżka /some_directory/sub_directory/index.php jest dzieckiem /some_directory/index.php
* Wirtualny rodzic/podrzędne: Na przykład viewtopic.php jest traktowany jako dziecko viewforum.php.

Oto kilka przykładów tras nadrzędnych/podrzędnych:

| Rodzic             | Dziecko                          |
| ------------------ | -------------------------------- |
| /index.php         | /viewforum.php, /dir/index.php   |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1           |
| /app.php/artykuły  | /pl/app.php/articles/moj-article |

## Dziedzictwo rodzica/bloku podrzędnego
dla tras nadrzędnych/podrzędnych, trasa potomna dziedziczy bloki trasy nadrzędnej (jeżeli rodzic ma własne bloki) lub domyślny układ (jeżeli jeden został ustawiony). Innymi słowy, nawet jeśli istnieje domyślny układ, trasa potomna będzie dziedziczyć bloki z trasy nadrzędnej, jeśli trasa nadrzędna ma własne bloki. Ale nie wszystkie bloki z trasy nadrzędnej muszą być dziedziczone.

## Kontrolowanie dziedziczenia bloku
Na poziomie bloku, możesz kontrolować, kiedy blok może być dziedziczony przez podrzędne trasy. Dotknęliśmy na to wcześniej w [Edytujących ustawieniach bloku](/docs/user/blocks/managing-blocks#editing-block-settings).

Rozważ następującą strukturę prawdziwego katalogu:
```text
phpBB
↑ index.php
↑ Movies/
    ↑ ↑ index.php
    <unk> <unk> <unk> <unk> page.php
    <unk> <unk> <unk> <unk> <unk> Comedy/
        <unk> <unk> <unk> index.php
```

Dla celów odziedziczenia bloków mówimy:
* Trasa nadrzędna /phpBB/Movies/Comedy/index.php to /phpBB/Movies/index.php i nie /phpBB/Movies/page.php
* Wszystkie strony w podkatalogu względem /phpBB/index.php są podrzędną trasą /phpBB/index.php. Dlatego /phpBB/Movies/index.php i /phpBB/Movies/page.php są dziećmi /phpBB/index.php i w związku z tym odziedziczą jego bloki, jeśli nie mają własnych bloków. W tym przypadku:
    * Gdy blok na /phpBB/index.php jest ustawiony na **Ukryj na podrzędnych trasach**, blok pojawi się na /phpBB/index. hp (droga nadrzędna), ale nie na jej drogach podrzędnych
    * Gdy blok na /phpBB/index.php jest ustawiony na **Pokaż tylko na podrzędnych trasach**, wyświetli się na /phpBB/Movies/index. hp i /phpBB/Movies/page.php (podrzędne trasy), ale nie na /phpBB/index.php (parent), ani /phpBB/Movies/Comedy/index.php (podajemy tylko jeden poziom głębokości)
    * Gdy blok na /phpBB/index.php jest ustawiony na **zawsze** (domyślnie), będzie wyświetlany na /phpBB/index. hp (parent), /phpBB/Movies/index.php oraz /phpBB/page.php (podrzędne trasy), ale nie na /phpBB/Movies/Comedy/index.php (podrzędne są tylko jeden poziom). W tym przypadku /phpBB/Movies/Comedy/index.php odziedziczy z domyślnej trasy (jeżeli istnieje)

## Posible Future State
Jestem bardzo zainteresowany twoją opinią w tym obszarze. Większość użytkowników phpBB nie będzie miała prawdziwych katalogów jak opisano powyżej. Myślę więc o użyciu struktury, która jest zdefiniowana w bloku menu jako wirtualna struktura katalogów i zastosuj do niej dziedziczenie rodzica/dzieci. Rozważam również głębsze wyjście poza jeden poziom. Daj mi znać, czy będzie to przydatne dla Ciebie.