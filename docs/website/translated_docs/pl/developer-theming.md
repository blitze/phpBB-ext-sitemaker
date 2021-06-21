---
id: deweloper-motyw
title: Motywowanie
---

phpBB SiteMaker jest wyposażony w style i kolory wykonane dla proslera. Możesz zastąpić pliki CSS, JS i HTML tworząc odpowiedni plik w folderze twojego stylu.

# Tworzenie plików JS/CSS dla Twojego stylu

Uwaga: * Dla celów poniższych instrukcji zakładamy, że masz styl zwany moim stylem.

Sklonuj do phpBB/ext/blitze/sitemaker:

    Klon git https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Z wiersza poleceń przejdź do katalogu sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Zainstaluj wykonawców**

    instalacja kompozytora
    

**Instaluj pakiety**

Dla poniższych poleceń możesz użyć npm lub [przędzy](https://yarnpkg.com)

    instalacja przędzy
    

**Obserwuj zmiany**

    yarn zaczyna --Them-style
    

**Zrób zmiany**

* Zrób zmiany w plikach w folderze phpBB/ext/blitze/sitemaker/develop.
* Spójrz na phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss dla zmiennych sass

**Kompilacja zasobów**

    yarn buduj --Them-styl
    

**Wdrożenie**

Możesz teraz skopiować wygenerowane pliki z phpBB/ext/blitze/sitemaker/style/my-style i przesłać je na serwer produkcyjny.

> To rozszerzenie używa jQuery UI dla zakładek, okien dialogowych i przycisków. Domyślny motyw jQuery to "gładkość". Możesz użyć innego motywu jQuery UI, który najlepiej pasuje do Twojego motywu. Możesz określić motyw jQuery UI używając flagi --jq_ui_theme. Na przykład:

    yarn build --Them-style --jq_ui_Themui-lightness