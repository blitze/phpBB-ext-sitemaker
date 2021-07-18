---
id: niestandardowe bloki
title: Własny blok
---

Jeśli dostępne bloki nie dają ci potrzebnej wolności, istnieje `Blok niestandardowy` który pozwala ci na swobodne wyświetlanie własnych treści za pomocą BBcode lub HTML. Blok jest wyposażony w edytor WYSIWYG (TinyMCE) i menedżer skryptów:

## Edytor

- Możesz użyć edytora do tworzenia zawartości HTML
- Możesz edytować kod źródłowy, jeśli potrzebujesz tego poziomu kontroli klikając na ikonę `kodu źródłowego` (`<>`) w edytorze
- Edytor pozwala na przesyłanie i modyfikowanie obrazów 
    - Tworzy nowy folder w phpBB/images/sitemaker_uploads/ dla każdego użytkownika, który ma do niego dostęp.
    - Możesz przeglądać/zarządzać wszystkimi folderami użytkowników
- Edytor filtruje wszelkie potencjalnie niebezpieczne skrypty, takie jak javascript, itp. Jeśli potrzebujesz dodać treści takie jak reklamy google, javascript zostanie przefiltrowany, ale możesz to obejść, wykonując następujące czynności: 
    - Dodaj niestandardowy blok do pożądanej lokalizacji
    - Edytuj niestandardowy blokadę, kliknij na kartę `HTML` i wklej Javascript

## Menedżer skryptów

Niestandardowy blok pozwala również na dodawanie niestandardowych plików CSS i Javascript do twojej strony. Aby to zrobić:

- Dodaj `niestandardowy blok` do każdej pozycji bloku. Pozycja nie ma znaczenia, chyba że wyświetlasz również zawartość z blokiem
- Edytuj blok, kliknij na karcie `Skrypty` i dodaj pliki CSS lub Javascript > Ostrzeżenie: Dodanie do wielu skryptów na stronie może mieć wpływ na czas ładowania