---
title: Ein Pull-Request wird gesendet
sidebar_label: Pull-Anfragen
---

`Pull-Requests lassen Sie anderen über Änderungen berichten, die Sie in einem Repository auf GitHub in einen Branch gepresst haben. Sobald ein Pull-Request geöffnet ist, Sie können die möglichen Änderungen mit Mitarbeitern besprechen und einsehen und Follow-Commits hinzufügen, bevor Ihre Änderungen in den Base-Zweig integriert werden.` [Lesen Sie mehr](https://help.github.com/articles/about-pull-requests/)

## Forken/Klonen

* Github Konto erstellen, wenn noch kein Github vorhanden ist
* Gehe zu https://github.com/blitze/phpBB-ext-sitemaker.git und klicke auf "Fork"

Klonen Sie Ihre Fork des Projektarchivs:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Von der Kommandozeile zum Sitemaker-Verzeichnis:

    cd phpBB/ext/blitze/sitemaker

**Git konfigurieren:**

Fügen Sie Ihren Benutzernamen auf Git auf Ihrem System hinzu:

    git config --global user.name "Dein Name hier"

Fügen Sie Ihre E-Mail-Adresse auf Git auf Ihrem System hinzu:

    git config --add user.email username@phpbb.com

Fügen Sie das Upstream-Remote hinzu (Sie können "Upstream" zu Ihrem gewünschten Zeitpunkt ändern):

    git remote add upstream git://github.com/blitze/phpBB-ext-sitemaker.git

**Anbieter installieren**

    Komponisteninstallation

**NPM-Pakete installieren**

    npm install

Alternativ können Sie [Garn](https://yarnpkg.com) verwenden:

    yarn installieren

## Pull-Anfragen

    # Erstellen Sie einen neuen Branch für Ihr Feature & wechseln Sie darauf
    git checkout -b feature/my-fancy-new-feature
    
    # Erstellen Sie einen neuen Branch für das Problem, an dem Sie arbeiten * wechseln (Ticket # ist vom Github Tracker)
    git checkout -b ticket/1234

Änderungen vornehmen

    # Stage die Dateien
    git add <files> 
    
    # Geführte Dateien übertragen - bitte benutze eine korrekte Commit-Nachricht
    git commit -m "my commit message"

Den Branch zurück zu GitHub git push origin feature/my-fancy-new-feature

Senden Sie eine [Pull-Request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)
