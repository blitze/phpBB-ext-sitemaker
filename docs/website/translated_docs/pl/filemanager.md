---
id: menedżer plików
title: Responsywny menedżer plików
---

Od wersji 3.1.0, phpBB SiteMaker obsługuje [responsywny menedżer plików](http://responsivefilemanager.com)

* Menedżer plików jest używany jako wtyczka TinyMCE (edytor WYSIWYG) podczas edycji niestandardowych bloków
* Jest on obecnie skonfigurowany do tworzenia oddzielnych folderów dla każdego użytkownika, z wyjątkiem użytkownika z uprawnieniami a_sm_filemanager (zobacz/zarządzaj folderami innych użytkowników), które umożliwiają dostęp do przeglądania/zarządzania wszystkimi folderami wysyłania.

## Instalacja

* Pobierz [responsywny Menedżer plików](http://responsivefilemanager.com/index.php#sthash.5UrnhjX2.dpbs)
* Rozpakuj i prześlij pliki do katalogu głównego phpBB. Struktura pliku powinna być następująca:

```text
phpBB
<unk> →images/
<unk> · obejmuje/
<unk> <unk> →...
<unk> ✓ ResponsiveFilemanager/
    <unk> ✓ filemanager/
        <unk> · config/
            <unk> · .htaccess
            <unk> · config.php
```

## Aktywacja

* Przejdź do AKP > Rozszerzenia > SiteMaker > Ustawienia
* Włącz funkcję Menedżera Plików
* Zapisz zmiany
* Zaktualizuj uprawnienia użytkownika (karta mikrofonu), aby określić, kto może korzystać z tej funkcji [Może używać Menedżera plików]
* Zaktualizuj uprawnienia administratora (karta mikrofonu), aby określić, kto może zarządzać folderami użytkowników [Zobacz/zarządzać folderami innych użytkowników w Menedżerze plików]