---
id: filemanager
title: Responsive Dateimanager
---

Ab Version 3.1.0 unterstützt phpBB SiteMaker den [Responsive Filemanager](http://responsivefilemanager.com)

* Der Dateimanager wird als TinyMCE-Plug-In (WYSIWYG-Editor) verwendet, wenn benutzerdefinierte Blöcke bearbeitet werden
* Es ist derzeit konfiguriert, separate Ordner für jeden Benutzer zu erstellen, außer dem Benutzer mit a_sm_filemanager Berechtigung (Kann Ordner anderer Benutzer sehen/verwalten), was ihnen den Zugriff auf alle Upload-Ordner erlaubt.

## Installation

* Lade den [Responsive FileManager](http://responsivefilemanager.com/index.php#sthash.5UrnhjX2.dpbs) herunter
* Extrahieren Sie sie und laden Sie die Dateien in Ihren phpBB-Root-Ordner hoch. Die Dateistruktur sollte wie folgt sein:

```text
phpBB
<unk> 文<unk> Bilder/
<unk> <unk> <unk> <unk> <unk> <unk> includes/
<unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk>
<unk> <unk> ResponsiveFilemanager/
    <unk> 本<unk> filemanager/
        <unk> 本<unk> config/
            <unk> 本<unk> .htaccess
            <unk> <unk> <unk> config.php
```

## Aktivierung

* Gehen Sie zu AKP > Erweiterungen > SiteMaker > Einstellungen
* Dateimanager Funktion aktivieren
* Änderungen speichern
* Benutzerrechte aktualisieren (Misc Tab), um festzustellen, wer diese Funktion nutzen kann [Kann Dateimanager verwenden]
* Administratorrechte aktualisieren (Misc Tab), um festzustellen, wer Benutzerordner verwalten kann [Kann Ordner anderer Benutzer im Dateimanager sehen/verwalten]