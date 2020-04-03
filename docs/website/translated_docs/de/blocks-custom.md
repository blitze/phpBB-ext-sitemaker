---
id: blockspezifische
title: Eigener Block
---

Wenn die verfügbaren Blöcke dir nicht die Freiheit geben die du brauchst gibt es den `benutzerdefinierten Block` der es dir erlaubt, deine eigenen Inhalte mit BBcode oder HTML anzuzeigen. Der Block kommt mit einem WYSIWYG-Editor (TinyMCE), einem [Dateimanager](./filemanager.md)und einem Skriptmanager:

## Der Editor

* Sie können den Editor verwenden, um HTML-Inhalte zu erstellen
* Sie können den Quellcode bearbeiten, wenn Sie diese Kontrollstufe benötigen, indem Sie auf das `Quellcode` Symbol (`<>`) im Editor klicken
* Der Editor erlaubt es Ihnen Bilder hochzuladen und zu ändern
* Der Editor filtert potenziell gefährliche Skripte wie Javascript usw. Wenn Sie Inhalte wie Google-Anzeigen hinzufügen müssen, wird das Javascript gefiltert, aber Sie können das umgehen, indem Sie folgendes tun: 
    * Füge den Custom Block zu dem gewünschten Ort hinzu
    * Bearbeiten Sie den benutzerdefinierten Block, klicken Sie auf den `HTML` Tab und fügen Sie Ihr Javascript ein

## Der Dateimanager

Der `Benutzerdefinierte Block` wird auch mit einem [Dateimanager](./filemanager.md) als TinyMCE-Plugin * erstellt für jeden Benutzer, der Zugriff darauf hat, einen neuen Ordner in phpBB/images/sitemaker_uploads/ für jeden Benutzer mit * Sie können alle Benutzerordner einsehen/verwalten

## Der Skript-Manager

Der benutzerdefinierte Block erlaubt Ihnen auch, benutzerdefinierte CSS- und Javascript-Dateien zu Ihrer Seite hinzuzufügen. Um dies zu tun: * Fügen Sie einen `benutzerdefinierten Block` zu jeder Blockposition hinzu. Die Position spielt keine Rolle, außer du siehst auch Inhalte mit dem Block * Bearbeite den Block, klicken Sie auf den Tab `Scripts` und fügen Sie Ihre CSS- oder Javascript Dateien hinzu

> Wort der Vorsicht: Hinzufügen zu vielen Skripten auf Ihrer Seite kann die Ladezeiten beeinflussen