---
id: zarządzanie blokami
title: Zarządzanie blokami
---

Aby zarządzać blokami w phpBB SiteMaker, musisz być w [trybie edycji](./blocks-overview#edit-mode).

> Gdy blok nie wyświetla żadnej zawartości, nie będzie on wyświetlany, z wyjątkiem trybu edycji. W ten sposób możesz podać jej zawartość (w przypadku bloku niestandardowego) lub zmienić jego ustawienia.
> 
> W trybie edycji, nieco przezroczyste bloki to bloki, które w przeciwnym razie nie będą wyświetlane, ale są wyświetlane tylko dlatego, że jesteśmy w trybie edycji

## Dodawanie bloków

Możesz dodać bloki do każdej strony skierowanej do przodu, z wyjątkiem Panelu Kontroli Użytkownika i Panelu Zarządzania Moderatorami. Aby dodać blok, będziesz musiał: * kliknij na **Bloki** w pasku administracyjnym. To wyświetli listę dostępnych bloków * Przeciągnij i upuść żądany blok na dowolną pozycję bloku

## Edycja bloków

### Dodawanie ikony bloku

W lewo od tytułu bloku (prosrow) znajduje się pole dla ikony bloku. Kliknij na to pole, aby uzyskać wybór ikon. Możesz wybrać rozmiar ikony, kolor, pływanie, obracanie itp.

### Edycja tytułu bloku

Bloki phpBB SiteMaker będą miały domyślny, przetłumaczony tytuł, ale jeśli tytuł nie spełnia Twoich potrzeb, możesz go zmienić. Aby edytować tytuł bloku, * Kliknij na tytuł bloku, aby uzyskać formularz edycji wbudowanej * Zmień tytuł na coś, co chcesz * Usuń koncentrację z pola lub naciśnij Enter, aby przesłać zmiany

> Twój zmodyfikowany tytuł bloku nie jest przetłumaczony
> 
> Aby powrócić do domyślnego tytułu, po prostu usuń tytuł i naciśnij enter

### Edycja ustawień bloku

Po najechaniu nad blokiem, ikona kug pojawi się po prawej stronie bloku, który może być użyty do edycji bloku. W oknie dialogowym bloku edycji możesz: - Włącz/Wyłącz blok [Status] - Wybierz kiedy blok powinien/nie powinien być wyświetlany [Display]. Ma to zastosowanie tylko w przypadkach gdy zagnieżdżono strony (patrz [Zrozumienie dziedziczenia bloku](./blocks-inheritance.md)): - **Zawsze**: Zawsze wyświetl blok - **Ukryj na trasach podrzędnych**: Pokaż tylko ten blok na ścieżce nadrzędnej - **Pokaż tylko na trasach podrzędnych**: Pokaż tylko ten blok na ścieżce podrzędnej - Wybierz, które grupy użytkowników mogą wyświetlić blok [widoczny przez]. Użyj CTRL + kliknij aby wybrać wiele grup. - Ustaw niestandardowe klasy aby zmodyfikować wygląd bloku lub elementów (listy, obrazki, tło, etc) w bloku [klasa CSS] - Pokaż/ukryj tytuł bloku [Ukryj tytuł bloku? - Wybierz widok bloku [Widok bloku]. Możesz wybrać domyślny widok bloków po dodaniu nowych bloków w ACP. - **Domyślny / Prosty**: używa klasy panelu prosrebrnego do zawinięcia bloku w wypełnionym pojemniku - **Basic**: blok nie ma opakowania - **Boxed**: używa klasy forabg prosrebra do zawinięcia bloku w polu - Ustaw / Aktualizuj konkretne ustawienia - Jeśli masz ten sam blok na wielu stronach, możesz zaktualizować wszystkie na raz poprzez sprawdzenie **bloków aktualizacji z podobnymi ustawieniami**

## Usuwanie bloków

- Przytrzymaj nad blokiem, który chcesz usunąć
- Kliknij ikonę **x** i potwierdź, że chcesz usunąć blok
- Przejdź do paska administratora i kliknij na `Zapisz zmiany`