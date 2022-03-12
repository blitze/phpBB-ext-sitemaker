---
title: Motyw
sidebar_position: 3
---

Rozumiemy, że pliki szablonów i pliki JS/CSS nie będą działać dla każdego stylu, więc poniżej możesz użyć własnych szablonów i utworzyć pliki JS/CSS dla Twojego konkretnego stylu.

## Używanie własnego szablonu

Jeśli domyślne szablony z phpBB Sitemaker nie działają dobrze dla Twojego konkretnego stylu, możesz łatwo nadpisać plik, aby użyć własnego pliku szablonu, tworząc odpowiedni plik w folderze stylów.

Na przykład powiedz że twój styl jest nazywany `Backlash` i ma on szczególny sposób, w jaki HTML dla sekcji nagłówka bloku musi być ustrukturyzowany dla [widoku pól](/docs/user/blocks/block-views). Możesz nadpisać ten konkretny szablon tworząc plik o tej samej nazwie jak tak: `phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

Innymi słowy, aby użyć własnego pliku szablonu, musisz:
* Określ który plik phpBB Sitemaker musi być nadpisany
* Utwórz plik o tej samej nazwie w folderze Sitemaker `style` pod nazwą Twojego stylu

> Uwaga: Jeśli utworzysz własne pliki szablonu, upewnij się, że nie usuń folderu `phpbb/ext/blitze/sitemaker` podczas aktualizacji rozszerzenia, ponieważ twoje niestandardowe pliki zostaną usunięte. Zamiast tego po prostu nadpisz istniejące pliki nowymi plikami.

## Tworzenie plików JS/CSS dla twojego stylu

Uwaga:
* Do celów poniższych instrukcji zakładamy, że masz styl zwany my-stylem.

Sklonuj do phpBB/ext/blitze/sitemaker:

    Klon git https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Z wiersza poleceń przejdź do katalogu sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Zainstaluj dostawców**

    instalacja kompozytora

**Instaluj pakiety**

Dla poniższych poleceń możesz użyć npm lub [yarn](https://yarnpkg.com)

    yarn instalacja

**Obejrzyj zmiany**

    yarn start --theme my-style

**Dokonaj zmian**

* Dokonaj zmian w plikach w folderze phpBB/ext/blitze/sitemaker/rozwiń folder.
* Spójrz na phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss dla zmiennych sass

**Zbuduj zasoby**

    yarn kompilacja --theme my-style

**Wdrożenie**

Teraz możesz skopiować wygenerowane pliki z phpBB/ext/blitze/sitemaker/styles/my-style i przesłać je na serwer produkcyjny.

> To rozszerzenie używa jQuery UI dla kart, dialogów i przycisków. Domyślny motyw jQuery to 'gładkość'. Możesz użyć innego szablonu jQuery UI, który najlepiej pasuje do twojego motywu. Możesz określić motyw jQuery UI za pomocą flagi --jq_ui_theme. Na przykład:

    yarn build --theme my-style --jq_ui_theme ui-lightness
