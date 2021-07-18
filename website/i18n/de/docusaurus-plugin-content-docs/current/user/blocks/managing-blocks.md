---
title: Blöcke verwalten
sidebar_position: 3
---

Um Blöcke in phpBB SiteMaker zu verwalten, müssen Sie im [Bearbeitungsmodus](./overview#edit-mode) sein.

> Wenn ein Block keine Inhalte anzeigt, wird er nicht angezeigt, außer im Bearbeitungsmodus. Auf diese Weise können Sie ihn entweder Inhalt geben (im Fall des benutzerdefinierten Blocks) oder seine Einstellungen ändern.

> Im Bearbeitungsmodus, die etwas transparenten Blöcke sind Blöcke, die ansonsten nicht angezeigt werden sondern nur angezeigt werden, weil wir uns im Bearbeitungsmodus befinden

## Blöcke hinzufügen
Sie können Blöcke zu jeder vorderen Seite hinzufügen, mit Ausnahme der Seite Benutzerverwaltung und des Moderatorsteuerungsbereichs. Um einen Block hinzuzufügen, musst du folgendes hinzufügen:
* auf **Blöcke** in der Adminleiste klicken. Zeigt eine Liste der verfügbaren Blöcke an
* Ziehen und Ablegen des gewünschten Blocks an jede Blockposition

## Blöcke bearbeiten
### Blocksymbol hinzufügen
Links neben dem Blocktitel (prosilver) befindet sich ein Feld für das Blocksymbol. Klicken Sie auf dieses Feld, um die Symbolauswahl zu erhalten. Sie können die Symbolgröße, Farbe, Float, Rotation, etc. auswählen.

### Den Blocktitel bearbeiten
phpBB SiteMaker Blöcke haben einen standardmäßigen übersetzten Titel, aber wenn der Titel nicht Ihren Bedürfnissen entspricht, können Sie ihn ändern. Um den Blocktitel zu bearbeiten,
* Klicken Sie auf den Block-Titel, um ein Inline-Bearbeitungsformular zu erhalten
* Ändere den Titel zu dem, was du willst
* Fokus aus dem Feld entfernen oder Enter drücken, um Änderungen einzureichen

> Dein geänderter Blocktitel ist nicht übersetzt

> Um zum Standard-Titel zurückzukehren, lösche einfach den Titel und drücke Enter

### Blockeinstellungen bearbeiten
Wenn du über einen Block fährst, erscheint rechts neben dem Block, mit dem du den Block bearbeiten kannst. Im Dialog zum Bearbeiten des Blocks können Sie:
- Block aktivieren/deaktivieren [Status]
- Wählen Sie, wann der Block [Display] nicht angezeigt werden soll/soll. Dies gilt nur für die Fälle, in denen Sie verschachtelte Seiten haben (siehe [Erbschaftsvererbung verstehen](/docs/user/site/block-inheritance)):
    - **Immer**: Blöcke immer anzeigen
    - **Hide on child routes**: Only show this block on the parent route
    - **Show on child routes only**: Only show this block on a child route
- Wählen Sie aus, welche Benutzergruppen den Block [Sichtbar von] sehen können. Benutzen Sie STRG + klicken um mehrere Gruppen auszuwählen.
- Legen Sie benutzerdefinierte Klassen fest, um das Aussehen des Blocks oder der Elemente (Listen, Bilder, Hintergrund, usw.) innerhalb des Blocks [CSS-Klasse] zu verändern
- Ein-/Ausblenden des Block-Titels [Block-Titel ausblen?]
- Wählen Sie die Blockansicht [Blockansicht]. Sie können eine Standard-Blockansicht wählen, wenn neue Blöcke in ACP hinzugefügt werden.
    - **Standard / Einfache**: verwendet die Prosiler-Panel-Klasse um den Block in einen gepolsterten Container zu wickeln
    - **Basic**: Block hat keine Containerverpackung
    - **Boxed**: Verwendet die prosilver forabg Klasse um den Block in eine Box zu wickeln
- Blockspezifische Einstellungen setzen / aktualisieren
- Wenn Sie den gleichen Block mit den gleichen Einstellungen über mehrere Seiten hinweg haben, du kannst alle aktualisieren, indem du die **Update-Blöcke mit ähnlichen Einstellungen überprüfst**

## Lösche Blöcke
- Bewegen Sie den Block, den Sie löschen möchten
- Klicke auf das **x** Symbol und bestätige, dass du den Block löschen möchtest
- Gehen Sie nach oben in die Adminleiste und klicken Sie auf `Änderungen speichern`
