---
id: contrib-pull-requests
title: Einreichen einer Pull-Anfrage
sidebar_label: Pull-Anfragen
---

`Pull-Requests lassen Sie andere über Änderungen informieren, die Sie in einen Branch in einem Repository auf GitHub kopiert haben. Sobald eine Pull-Anfrage geöffnet ist, können Sie die möglichen Änderungen mit Mitarbeitern besprechen und überprüfen und weitere Commits hinzufügen, bevor Ihre Änderungen in den Basiszweig eingefügt werden.` [Lesen Sie mehr](https://help.github.com/articles/about-pull-requests/)

## Gabeln/Klonen

* Erstellen Sie ein Github-Konto, wenn Sie noch kein Konto haben
* Gehe zu https://github.com/blitze/phpBB-ext-sitemaker.git und klicke auf "Fork"

Klone deine Fork des Repository:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Von der Kommandozeile gehen Sie in das Sitemaker-Verzeichnis:

    cd phpBB/ext/blitze/sitemaker
    

**Git konfigurieren:**

Füge deinen Benutzernamen zu Git auf deinem System hinzu:

    git config --global user.name "Your Name Here"
    

Füge deine E-Mail-Adresse zu Git auf deinem System hinzu:

    git config --add user.email username@phpbb.com
    

Fügen Sie die Upstream-Fernbedienung hinzu (Sie können 'Upstream' auf was immer Sie möchten ändern):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git
    

**Hersteller installieren**

    Komponist Installation
    

**NPM-Pakete installieren**

    npm Installation
    

Alternativ können Sie [Garn](https://yarnpkg.com) verwenden:

    yarn Installation
    

## Pull-Anfragen

    # Erstelle einen neuen Branch für deine Funktion & wechsle zu ihm
    git checkout -b feature/my-fancy-new-feature
    
    # erstelle einen neuen Branch für das Problem, an dem du arbeitest * wechsle zu ihm (Ticket # ist von github tracker)
    git checkout -b ticket/1234
    

Änderungen vornehmen

    # Stage die Dateien
    Git hinzufügen <files> 
    
    # Inszenierte Dateien übernehmen - bitte verwenden Sie eine korrekte Commit-Nachricht
    git commit -m "my commit message"
    

Push den Branch zurück zu GitHub git push origin feature/my-fancy-new-feature

Sende eine [Pull-Request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)