---
title: Layouts
sidebar_position: 1
---

"Layouts" bestimmen die verfügbaren Blockpositionen und wie sie angezeigt werden.

## Blockpositionen
Blockpositionen sind vordefinierte Bereiche auf Ihrer Website, wo Blöcke existieren können. Die verfügbaren Blockpositionen werden durch den von Ihnen verwendeten Template-Stil bestimmt. Für Prosilber kommt phpBB SiteMaker mit den folgenden Blockpositionen:
* Panel: volle Breite oben
* Seitenleiste: links/rechts je nach Layout unten
* subcontent: ähnlich der Sidebar nur größer
* top_hor: horizontale Blöcke oben über der Seitenleiste/Subcontent je nach Layout flankieren
* oben: oberhalb des Hauptinhalts
* box: gleiche Breite, horizontale Blöcke unterhalb des Hauptinhalts
* unten: unter dem Hauptinhalt
* bottom_hor: horizontale Blöcke auf der unteren, die Seitenleiste/Subcontent je nach Layout flankieren
* fuß: horizontale Blöcke im Footer Sie können weitere Blockpositionen in Ihren eigenen Stilvorlagen hinzufügen, indem Sie die entsprechenden phpBB SiteMaker Templates kopieren und ändern

## Seitenlayout
Sie können das Layout für Ihre Website in ACP wählen (Erweiterungen > Sitemaker > Einstellungen):
* **Blog**: Subcontent und Sidebar nebeneinander, nach rechts gedrückt, top_hor/botom_hor flankiert Subcontent
* **Heiliger Gral**: Gleiche Seitenleiste und Subinhalte auf gegenüberliegenden Seiten, top_hor/botom_hor Flanken Subcontent
* **Portal**: Seitenleiste links, Subcontent rechts, top_hor/botom_hor Flanken Subcontent
* **Portal Alt**: Subcontent links, Sidebar rechts, top_hor/botom_hor Flanken Seitenleiste
* **Benutzerdefiniertes**: Legt die Breite der Seitenleisten manuell auf px, %, em oder rem fest. Standardmäßig 200px auf jeder Seite

## Benutzerdefinierte Vorlagen/Stile
So weit wie möglich wir haben versucht, Template-Dateien und Assets in Styles/all/ Ordner zu setzen, so dass Sie sie überschreiben können, indem Sie eine Datei mit gleichem Namen unter Ihrem eigenen Template Theme e. . Also, wenn Sie ändern möchten, wie ein bestimmter Block angezeigt wird oder wenn Sie Ihr eigenes Layout mit eigenen Blockpositionen erstellen möchten, Sie müssen einfach eine Datei mit dem gleichen Namen und Pfad erstellen wie das Original in Ihrem eigenen Stil.

Wenn Sie CSS/JS-Dateien anpassen müssen, werfen Sie einen Blick auf den Bereich [Theming](/docs/dev/theming).