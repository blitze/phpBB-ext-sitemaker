---
id: blockverwaltung
title: Verwalte Blöcke
---

Um Blöcke in phpBB SiteMaker zu verwalten, müssen Sie im [Edit Mode](./blocks-overview#edit-mode) sein.

> Wenn ein Block keinen Inhalt anzeigt, wird er nicht angezeigt, außer im Bearbeitungsmodus. Auf diese Weise können Sie entweder Inhalte geben (im Falle des benutzerdefinierten Blocks) oder seine Einstellungen ändern.
> 
> Im Bearbeitungsmodus sind die etwas transparenten Blöcke Blöcke, die ansonsten nicht angezeigt werden, sondern nur angezeigt werden, weil wir im Bearbeitungsmodus sind

## Füge Blöcke hinzu

Sie können Blöcke zu jeder Frontseite hinzufügen, außer den Seiten für Benutzerverwaltung und Moderator-Systemsteuerung. Um einen Block hinzuzufügen, müssen Sie: * klicken Sie auf **Blöcke** in der Admin-Leiste. Hier wird eine Liste der verfügbaren Blöcke angezeigt * Ziehen und den gewünschten Block an eine beliebige Blockposition ablegen

## Blöcke bearbeiten

### Füge ein Blocksymbol hinzu

Links vom Blocktitel (Prosilver) befindet sich ein Feld für das Blocksymbol. Klicken Sie auf dieses Feld, um die Symbolauswahl zu erhalten. Sie können die Symbolgröße, Farbe, Float, Rotation usw. auswählen.

### Block-Titel bearbeiten

phpBB SiteMaker Blöcke haben einen Standard-übersetzten Titel, aber wenn der Titel nicht Ihren Bedürfnissen entspricht, können Sie ihn ändern. Um den Block-Titel zu bearbeiten, * Klicken Sie auf den Block-Titel, um ein Inline-Bearbeitungsformular zu erhalten * Ändern Sie den Titel auf was Sie wollen * Fokus aus dem Feld entfernen oder Enter drücken, um Änderungen einzureichen

> Ihr modifizierter Block-Titel ist nicht übersetzt
> 
> Um zum Standardtitel zurückzukehren, löschen Sie einfach den Titel und drücken Sie Enter

### Blockeinstellungen bearbeiten

Wenn Sie über einem Block schweben, erscheint rechts auf dem Block ein Zahnrad-Symbol, das zum Bearbeiten des Blocks verwendet werden kann. Im Bearbeiten-Block-Dialog können Sie: - Aktiviere/Deaktiviere einen Block [Status] - Wähle, wann der Block angezeigt werden soll/sollte [Display]. Dies gilt nur in Fällen, in denen Sie verschachtelte Seiten haben (siehe [Block Vererbung verstehen](./blocks-inheritance.md)): - **Immer**: Immer den Block - **auf Unterrouten ausblenden**: Nur diesen Block auf der übergeordneten Route anzeigen - **Nur auf untergeordneten Routen anzeigen**: Nur diesen Block auf einer untergeordneten Route anzeigen - Wählen Sie, welche Benutzergruppen den Block ansehen können [Sichtbar von]. Verwenden Sie STRG + klicken, um mehrere Gruppen auszuwählen. - Legen Sie benutzerdefinierte Klassen fest, um das Aussehen des Blocks oder der Elemente (Listen, Bilder, Hintergrund usw.) innerhalb des Blocks [CSS-Klasse] - Zeige/Verstecke den Blocktitel [Block-Titel verbergen?] - Wählen Sie die Blockansicht [Block-Ansicht]. Sie können eine Standard-Blockansicht auswählen, wenn neue Blöcke in den AKP-Ländern hinzugefügt werden. - **Standard / Einfache**: verwendet die prosilber-Panel-Klasse, um den Block in einen gepolsterten Container zu verpacken - **Basic**: Block hat keinen Container, der ihn umwickelt - **Boxed**: verwendet die prosilber-Forabg-Klasse, um den Block in ein Feld einzuwickeln - Setze / Update-Block spezifische Einstellungen - Wenn du denselben Block mit gleichen Einstellungen auf mehreren Seiten hast, du kannst alle auf einmal aktualisieren, indem du die **Update-Blöcke mit ähnlichen Einstellungen auswählst**

## Lösche Blöcke

- Hover über dem Block, den du löschen möchtest
- Klicken Sie auf das Symbol **x** und bestätigen Sie, dass Sie den Block löschen möchten
- Gehe zur Admin-Leiste und klicke auf `Änderungen speichern`