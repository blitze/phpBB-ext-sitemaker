---
title: Eigener Block
sidebar_position: 4
---

Wenn die verfügbaren Blöcke dir nicht die Freiheit geben, die du benötigst gibt es den `Custom Block` der Ihnen die Freiheit erlaubt, Ihre eigenen Inhalte mit BBcode oder HTML anzuzeigen. Der Block kommt mit einem WYSIWYG-Editor (TinyMCE) und einem Skript-Manager:

## Der Editor

-   Sie können den Editor verwenden, um HTML-Inhalte zu erstellen
-   Sie können den Quellcode bearbeiten, wenn Sie diese Stufe der Kontrolle benötigen, indem Sie auf das `Quellcode` Symbol (`<>`) im Editor klicken
-   Mit dem Editor können Sie Bilder hochladen und bearbeiten
    -   Es erstellt einen neuen Ordner in phpBB/images/sitemaker_uploads/ für jeden Benutzer, der Zugriff darauf hat
    -   Sie können alle Benutzerordner ansehen/verwalten
-   Der Editor filtert potenziell gefährliche Skripte wie Javascript, etc. aus. Wenn Sie Inhalte wie Google-Anzeigen hinzufügen müssen, wird das Javascript ausgefiltert, aber Sie können das umgehen, indem Sie folgendes tun:
    -   Fügen Sie den eigenen Block zum gewünschten Standort hinzu
    -   Bearbeiten Sie den benutzerdefinierten Block, klicken Sie auf den `HTML-` Tab und fügen Sie Ihr Javascript ein

## Skript-Verwaltung

Mit dem Custom Block können Sie auch benutzerdefinierte CSS- und Javascript-Dateien zu Ihrer Seite hinzufügen. Du kannst das folgendermaßen tun:

-   Fügen Sie einen `benutzerdefinierten Block` zu jeder Blockposition hinzu. Die Position spielt keine Rolle, es sei denn, Sie zeigen auch Inhalte mit dem Block
-   Den Block bearbeiten, klicken Sie auf den `Reiter` und fügen Sie Ihre CSS- oder Javascript-Dateien hinzu > Word der Vorsicht: Das Hinzufügen zu vielen Skripten auf Ihrer Seite kann die Ladezeiten beeinflussen
