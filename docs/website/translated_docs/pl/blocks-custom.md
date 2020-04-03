---
id: niestandardowe bloki
title: Własny blok
---

Jeśli dostępne bloki nie dają ci potrzebnej wolności, istnieje `Blok niestandardowy` który pozwala ci na swobodne wyświetlanie własnych treści za pomocą BBcode lub HTML. Blok zawiera edytor WYSIWYG (TinyMCE), [Menedżer plików](./filemanager.md)i menedżer skryptów:

## Edytor

* Możesz użyć edytora do tworzenia zawartości HTML
* Możesz edytować kod źródłowy, jeśli potrzebujesz tego poziomu kontroli klikając na ikonę `kodu źródłowego` (`<>`) w edytorze
* Edytor pozwala na wysyłanie i modyfikowanie obrazów
* Edytor filtruje wszelkie potencjalnie niebezpieczne skrypty, takie jak javascript, itp. Jeśli potrzebujesz dodać treści takie jak reklamy google, javascript zostanie przefiltrowany, ale możesz to obejść, wykonując następujące czynności: 
    * Dodaj niestandardowy blok do pożądanej lokalizacji
    * Edytuj niestandardowy blokadę, kliknij na kartę `HTML` i wklej Javascript

## Menedżer plików

`Własny blok` jest również z [Menadżżerem Plików](./filemanager.md) jako wtyczką TinyMCE * Tworzy nowy folder w phpBB/images/sitemaker_uploads/ dla każdego użytkownika, który ma do niego dostęp, * Możesz przeglądać/zarządzać wszystkimi folderami użytkowników

## Menedżer skryptów

Własny blok pozwala również dodać niestandardowe pliki CSS i JavaScript do swojej strony. Aby to zrobić: * Dodaj `Blok niestandardowy` do dowolnej pozycji bloku. Pozycja nie ma znaczenia, chyba że wyświetla się również zawartość z blokiem * Edytuj blok, kliknij na kartę `skryptów` i dodaj pliki CSS lub Javascript

> Słowo ostrożności: Dodanie do wielu skryptów na twojej stronie może mieć wpływ na czas ładowania