---
id: pull-requesty
title: Przesyłanie Pull Request
sidebar_label: Żądania ściągnięcia
---

`Pull requestów pozwala Ci powiedzieć innym o zmianach, które wymusiłeś do gałęzi w repozytorium na GitHub. Po otwarciu pull request, możesz przedyskutować i przejrzeć potencjalne zmiany ze współpracownikami, a także dodać następcze commity, zanim Twoje zmiany zostaną połączone z gałęzią bazową.` [Przeczytaj więcej](https://help.github.com/articles/about-pull-requests/)

## Forkowanie/Klonowanie

* Utwórz konto github, jeśli nie posiadasz go
* Przejdź do https://github.com/blitze/phpBB-ext-sitemaker.git i kliknij na "Fork"

Sklonuj swój fork repozytorium:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Z wiersza poleceń przejdź do katalogu sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Skonfiguruj git:**

Dodaj swoją nazwę użytkownika do Git w systemie:

    git config --global user.name "Twoje imię i nazwisko"
    

Dodaj swój adres e-mail do Git w systemie:

    git config --add user.email username@phpbb.com
    

Dodaj pilota w górę (możesz zmienić "upstream" na dowolny jaki chcesz):

    git remote add git://github.com/blitze/phpBB-ext-sitemaker.git
    

**Zainstaluj wykonawców**

    instalacja kompozytora
    

**Zainstaluj pakiety NPM**

    instalacja npm
    

Alternatywnie możesz użyć [przędzy](https://yarnpkg.com):

    instalacja przędzy
    

## Żądania ściągnięcia

    # Utwórz nową gałąź dla swojej funkcji & przełącz się na nią
    git checkout -b/my-fancy-new-feature
    
    # utwórz nową gałąź dla problemu, nad którym pracujesz * przełącz się na niego (bilet # jest z trackera github)
    git checkout -b ticket/1234
    

Dokonaj zmian

    # Etapuj pliki
    git add <files> 
    
    # Wykonaj pliki etapowe - użyj poprawnej wiadomości zatwierdzenia
    git commit -m "moja wiadomość zatwierdzenia"
    

Wypchnij gałąź z powrotem do GitHub git push feature/my-fancy-new-feature

Prześlij [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)