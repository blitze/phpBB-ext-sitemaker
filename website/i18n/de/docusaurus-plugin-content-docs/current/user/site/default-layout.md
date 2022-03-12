---
title: Standardlayout einstellen
sidebar_position: 4
---

Wenn du einen Block hinzufügst, wird er zu dieser bestimmten Seite hinzugefügt. Daher wäre es eine mühsame Aufgabe, Blöcke für alle Seiten auf Ihrer Website zu setzen. Sie können alle gewünschten Blöcke für eine bestimmte Seite festlegen und diese dann als Standardlayout festlegen. Mit anderen Worten, jede Seite, die keine eigenen Blöcke hat, erbt Blöcke von dieser Seite.

Um ein Standardlayout zu setzen
* Gehen Sie zu der Seite, die Sie als Standard-Layout festlegen möchten
* Klicken Sie auf `Einstellungen` in der Adminleiste
* Klicken Sie auf `Als Standardlayout festlegen`

Sagen wir Blöcke zu einer Seite (phpBB/index.php) mit Blöcken in der Sidebar und Top-Positionen zum Beispiel und setzen sie als Standardlayout. Dies hat folgende Effekte für andere Seiten:
* Jede Seite, die keine eigenen Blöcke hat, erbt die Blöcke vom Standard-Layout. Für Ausnahmen siehe [Blockvererbung](/docs/user/site/block-inheritance).
* Sie können weiterhin Blöcke aus einem Standard-Layout (Index) erben. hp), aber wählen Sie, ob Blöcke auf einigen Blockpositionen nicht angezeigt werden oder gar keine Blöcke angezeigt werden sollen. Du kannst das folgendermaßen tun,
    * Gehe zu der Seite, die nicht alle / einige Blöcke angezeigt werden sollen
    * Klicken Sie auf `Einstellungen` in der Adminleiste
    * Wählen Sie `Blöcke auf dieser Seite nicht anzeigen` wenn Sie keine Blöcke auf dieser Seite vererben/anzeigen möchten
    * Benutze STRG + klicke um die Blockpositionen auszuwählen (rechts), auf denen du keine Blöcke anzeigen willst
* Im `Bearbeitungsmodus`, einer Seite, die Blöcke vom Standardlayout vererbt hat, zeigt keine Blöcke an, die dir die Möglichkeit geben, Blöcke zur Seite hinzuzufügen, wenn du möchtest
* Jede Seite mit eigenen Blöcken wird nicht vom Standard-Layout vererbt
