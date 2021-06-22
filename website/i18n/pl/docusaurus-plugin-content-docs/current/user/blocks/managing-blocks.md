---
title: Mananaging Blocks
sidebar_position: 3
---

Aby zarządzać blokami w phpBB SiteMaker, musisz być w [Tryb edycji](./overview#edit-mode).

> Gdy blok nie wyświetla żadnych treści, nie będzie wyświetlany, z wyjątkiem trybu edycji. W ten sposób możesz nadać jej zawartość (w przypadku bloku niestandardowego) lub zmienić jej ustawienia.

> W trybie edycji, nieco przezroczyste bloki to bloki, które w przeciwnym razie nie będą wyświetlane, ale będą wyświetlane tylko dlatego, że jesteśmy w trybie edycji

## Dodawanie bloków
Możesz dodawać bloki do każdej strony skierowanej przodem do kierunku jazdy, z wyjątkiem panelu sterowania użytkownika i stron panelu zarządzania. Aby dodać blok, musisz:
* kliknij na **bloków** w pasku administratora. To wyświetli listę dostępnych bloków
* Przeciągnij i upuść żądany blok do dowolnej pozycji bloku

## Edycja bloków
### Dodawanie ikony bloku
Po lewej stronie tytułu bloku (przysłowia) znajduje się pole dla ikony bloku. Kliknij na to pole, aby pobrać wybieranie ikon. Możesz wybrać rozmiar ikony, kolor, zmienny, obrót, itp.

### Edycja tytułu bloku
Bloki phpBB SiteMaker będą miały domyślny, przetłumaczony tytuł, ale jeśli tytuł nie spełnia Twoich potrzeb, możesz go zmienić. Aby edytować tytuł bloku,
* Kliknij na tytuł bloku, aby uzyskać formularz edycji w linii
* Zmień tytuł na cokolwiek chcesz
* Usuń ostrość z pola lub wpisz aby przesłać zmiany

> Twój zmodyfikowany tytuł bloku nie jest przetłumaczony

> Aby powrócić do domyślnego tytułu, usuń tytuł i wciśnij enter

### Edycja ustawień bloku
Po najechaniu kursorem nad blokiem, ikona kursora pojawi się po prawej stronie bloku, który może być użyty do edycji bloku. W oknie bloku edycji możesz:
- Włącz/wyłącz blok [Status]
- Wybierz, kiedy blok nie powinien/nie powinien być wyświetlany [Display]. Dotyczy to tylko przypadków, w których masz zagnieżdżone strony (patrz [Zrozumienie dziedziczenia bloku](/docs/user/site/block-inheritance)):
    - **Zawsze**: Zawsze wyświetlaj blok
    - **Ukryj na podrzędnych trasach**: Pokaż tylko ten blok na trasie nadrzędnej
    - **Pokaż tylko na trasach podrzędnych**: Pokaż tylko ten blok na trasie podrzędnej
- Wybierz, które grupy użytkowników mogą przeglądać blok [Wyświetlane przez]. Użyj CTRL + kliknij, aby wybrać wiele grup.
- Ustaw klasy niestandardowe, aby modyfikować wygląd bloku lub elementów (listy, obrazy, tło itp.) w bloku [klasa CSS]
- Pokaż/ukryj tytuł bloku [Ukryj tytuł bloku?]
- Wybierz widok bloku [Widok bloku]. Możesz wybrać domyślny widok bloku, gdy nowe bloki zostaną dodane do AKP.
    - **Domyślne / Proste**: użyj klasy panelu prosbra do zawijania bloku w wypełnionym kontenerem
    - **Basic**: blok nie ma opakowania kontenerowego
    - **Boxed**: użyj klasy forabg do zawijania bloku w pudełku
- Ustaw / aktualizuj specyficzne ustawienia bloku
- Jeśli masz ten sam blok z tymi samymi ustawieniami na wielu stronach, możesz zaktualizować wszystkie na raz, sprawdzając **bloki aktualizacji z podobnymi ustawieniami**

## Usuwanie bloków
- Najedź kursorem nad blokiem, który chcesz usunąć
- Kliknij na ikonę **x** i potwierdź, że chcesz usunąć blok
- Przejdź do paska administratora i kliknij `Zapisz zmiany`
