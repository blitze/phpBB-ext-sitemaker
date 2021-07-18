---
title: Własny blok
sidebar_position: 4
---

Jeśli dostępne bloki nie dają Ci wolności, której potrzebujesz, jest `niestandardowy blok` , który pozwala na swobodne wyświetlanie własnych treści za pomocą BBcode lub HTML. Blok jest wyposażony w edytor WYSIWYG (TinyMCE) i menedżer skryptów:

## Edytor

-   Możesz użyć edytora do tworzenia treści HTML
-   Możesz edytować kod źródłowy, jeśli potrzebujesz tego poziomu kontroli, klikając ikonę `kodu źródłowego` (`<>`) w edytorze
-   Edytor pozwala na przesyłanie i modyfikowanie obrazów
    -   Tworzy nowy folder w phpBB/images/sitemaker_uploads/ dla każdego użytkownika, który ma do niego dostęp.
    -   Możesz przeglądać/zarządzać wszystkimi folderami użytkowników
-   Edytor filtruje wszelkie potencjalnie niebezpieczne skrypty, takie jak javascript, itp. Jeśli chcesz dodać treści takie jak reklamy google, javascript zostanie odfiltrowany, ale możesz dostrzec to wykonując następujące czynności:
    -   Dodaj blok niestandardowy do wybranej lokalizacji
    -   Edytuj blok niestandardowy, kliknij na zakładkę `HTML` i wklej swój Javascript

## Menedżer skryptów

Niestandardowy blok pozwala również na dodawanie niestandardowych plików CSS i Javascript do twojej strony. Aby to zrobić:

-   Dodaj `niestandardowy blok` do każdej pozycji bloku. Pozycja nie ma znaczenia, chyba że wyświetlasz również zawartość z blokiem
-   Edytuj blok, kliknij na karcie `Skrypty` i dodaj pliki CSS lub Javascript > Uważne słowo: Dodanie do wielu skryptów na twojej stronie może mieć wpływ na czas ładowania
