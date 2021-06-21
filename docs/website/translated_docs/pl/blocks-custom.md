---
id: niestandardowe bloki
title: Własny blok
---

Jeśli dostępne bloki nie dają ci potrzebnej wolności, istnieje `Blok niestandardowy` który pozwala ci na swobodne wyświetlanie własnych treści za pomocą BBcode lub HTML. The block comes with a WYSIWYG editor (TinyMCE) and a scripts manager:

## Edytor

- Możesz użyć edytora do tworzenia zawartości HTML
- Możesz edytować kod źródłowy, jeśli potrzebujesz tego poziomu kontroli klikając na ikonę `kodu źródłowego` (`<>`) w edytorze
- The editor allows you to upload and modify images 
    - It creates a new folder in phpBB/images/sitemaker_uploads/ for every user who has access to it
    - You can view/manage all user folders
- Edytor filtruje wszelkie potencjalnie niebezpieczne skrypty, takie jak javascript, itp. Jeśli potrzebujesz dodać treści takie jak reklamy google, javascript zostanie przefiltrowany, ale możesz to obejść, wykonując następujące czynności: 
    - Dodaj niestandardowy blok do pożądanej lokalizacji
    - Edytuj niestandardowy blokadę, kliknij na kartę `HTML` i wklej Javascript

## The Scripts Manager

The Custom Block also allows you to add custom CSS and Javascript files to your page. To do this:

- Add a `Custom Block` to any block position. The position does not matter unless you are also displaying content with the block
- Edit the block, click on the `Scripts` tab and add your CSS or Javascript files > Word of caution though: Adding to many scripts on your page can affect load times