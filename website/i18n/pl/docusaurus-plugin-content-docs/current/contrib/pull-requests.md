---
title: Przesyłanie Pull Request
sidebar_label: Pull Requesty
---

`Pull requesty pozwalają informować innych o zmianach, które przepchnąłeś do gałęzi w repozytorium na GitHub. Po otwarciu pull request, możesz przedyskutować i przeglądać potencjalne zmiany z współtwórcami i dodać kolejne commity zanim Twoje zmiany zostaną scalone do gałęzi bazowej.` [Czytaj więcej](https://help.github.com/articles/about-pull-requests/)

## Rozwinięcie/klonowanie

* Utwórz konto github jeśli jeszcze go nie posiadasz
* Przejdź do https://github.com/blitze/phpBB-ext-sitemaker.git i kliknij "Fork"

Sklonuj swój fork repozytorium:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Z wiersza poleceń przejdź do katalogu sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Konfiguruj git:**

Dodaj swoją nazwę użytkownika do Git w systemie:

    git config --global user.name "Twoja nazwa tutaj"

Dodaj swój adres e-mail do Git w systemie:

    git config --add user.email username@phpbb.com

Dodaj pilota wyższego szczebla (można zmienić „upstream” na dowolny z chcesz):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git

**Zainstaluj dostawców**

    instalacja kompozytora

**Zainstaluj pakiety NPM**

    npm install

Alternatywnie możesz użyć [yarn](https://yarnpkg.com):

    yarn instalacja

## Pull Requesty

    # Utwórz nową gałąź dla swojej funkcji & przełącz na nią
    git checkout -b feature/my-fancy-new-feature
    
    # utwórz nową gałąź dla problemu, nad którym pracujesz* przełącz się na nią (ticket # jest z github tracker)
    git checkout -b ticket/1234

Dokonaj zmian

    # Scenariusz plików
    git add <files> 
    
    # Zatwierdzone pliki - użyj poprawnego komunikatu commita
    git commit -m "moja wiadomość commit"

Wciśnij gałąź z powrotem do GitHub funkcji pochodzenia git push push

Prześlij [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
