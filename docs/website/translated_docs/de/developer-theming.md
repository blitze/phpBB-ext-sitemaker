---
id: Entwicklerthema
title: Theming
---

phpBB SiteMaker enthält Stile und Farben für Prosilver. Sie können CSS-, JS- und HTML-Dateien überschreiben, indem Sie die entsprechende Datei im Ordner Ihres Stils erstellen.

# Erstellen von JS/CSS-Dateien für Ihren Stil

Hinweis: * Für den Zweck der folgenden Anweisungen gehen wir davon aus, dass Sie einen Stil namens my-style haben.

Klone in phpBB/ext/blitze/sitemaker:

    git Klon https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Von der Kommandozeile gehen Sie in das Sitemaker-Verzeichnis:

    cd phpBB/ext/blitze/sitemaker
    

**Hersteller installieren**

    Komponist Installation
    

**Pakete installieren**

Für die folgenden Befehle können Sie npm oder [Garn](https://yarnpkg.com) verwenden

    yarn Installation
    

**Änderungen beobachten**

    yarn start --theme my-style
    

**Änderungen vornehmen**

* Machen Sie Ihre Änderungen an Dateien im phpBB/ext/blitze/sitemaker/develop Ordner.
* Betrachten Sie phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss für sass Variablen

**Assets erstellen**

    yarn build --theme my-style
    

**Verteilen**

Sie können nun die generierten Dateien von phpBB/ext/blitze/sitemaker/styles/my-style kopieren und auf Ihren Produktionsserver hochladen.

> Diese Erweiterung verwendet jQuery UI für Tabs, Dialoge und Schaltflächen. Das Standard-jQuery-Theme ist 'Smoothness.' Du kannst ein anderes jQuery-UI-Theme verwenden, das am besten zu deinem Theme passt. Sie können das jQuery UI Theme mit dem Flag --jq_ui_theme angeben. Zum Beispiel:

    yarn Build --theme my-style --jq_ui_theme ui-lightness