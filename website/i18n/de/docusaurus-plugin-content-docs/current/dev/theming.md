---
title: Design
sidebar_position: 3
---

Wir verstehen, dass die Template-Dateien und die JS/CSS-Dateien nicht für jeden Stil funktionieren so unten finden Sie einige Möglichkeiten, wie Sie Ihre eigenen Vorlagen verwenden und JS/CSS-Dateien für Ihren speziellen Stil erstellen können.

## Eigene Vorlage verwenden

Wenn die Standardvorlagen mit phpBB Sitemaker nicht gut für Ihren bestimmten Stil funktionieren Sie können es einfach überschreiben, um Ihre eigene Vorlagen-Datei zu verwenden, indem Sie die entsprechende Datei im Stylesverzeichnis anlegen.

Zum Beispiel angeben, dass Ihr Stil `Backlash` ist und eine bestimmte Art hat, wie das HTML für den Block Header Abschnitt für die [boxed View](/docs/user/blocks/block-views) strukturiert werden muss. Sie können diese Vorlage überschreiben, indem Sie eine Datei mit dem gleichen Namen wie folgt erstellen: `phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

Mit anderen Worten, um Ihre eigene Vorlagen-Datei zu verwenden, müssen Sie folgendes tun:
* Identifizieren, welche phpBB Sitemaker Datei überschrieben werden muss
* Erstellen Sie eine Datei mit dem gleichen Namen im Sitemaker `Styles` Ordner unter Ihrem Stilnamen

> Hinweis: Wenn Sie Ihre eigenen Vorlagen erstellen Löschen Sie nicht den `phpbb/ext/blitze/sitemaker` Ordner wenn Sie die Erweiterung aktualisieren, da Ihre benutzerdefinierten Dateien gelöscht werden. Stattdessen überschreiben Sie einfach die vorhandenen Dateien mit den neuen Dateien.

## Erstelle JS/CSS-Dateien für deinen Stil

Hinweis:
* Für die folgenden Anweisungen gehen wir davon aus, dass Sie einen Stil namens my-style haben.

In phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Von der Kommandozeile zum Sitemaker-Verzeichnis:

    cd phpBB/ext/blitze/sitemaker

**Anbieter installieren**

    Komponisteninstallation

**Pakete installieren**

Für die folgenden Befehle können Sie npm oder [Garn](https://yarnpkg.com) verwenden

    yarn installieren

**Änderungen beobachten**

    yarn start --theme my-style

**Änderungen vornehmen**

* Ändern Sie die Dateien im phpBB/ext/blitze/sitemaker/develop Ordner.
* Siehe phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss nach sass-Variablen

**Assets erstellen**

    yarn build --theme my-style

**Deploy**

Sie können nun die generierten Dateien von phpBB/ext/blitze/sitemaker/styles/my-style kopieren und auf Ihren Produktionsserver hochladen.

> Diese Erweiterung verwendet jQuery UI für Tabs, Dialoge und Schaltflächen. Das Standard jQuery Theme ist 'smoothness.' Sie können ein anderes jQuery UI Theme verwenden, das am besten zu Ihrem Thema passt. Sie können das jQuery UI Theme mit dem Flag --jq_ui_theme angeben. Zum Beispiel:

    yarn build --theme my-style --jq_ui_theme ui-lightness
