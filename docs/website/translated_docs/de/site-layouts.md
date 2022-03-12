---
id: site-layouts
title: Layouts
---

"Layouts" bestimmen die verfügbaren Blockpositionen und wie sie angezeigt werden.

## Blockpositionen

Blockpositionen sind vordefinierte Bereiche auf Ihrer Website, in denen Blöcke existieren können. Die verfügbaren Blockpositionen werden durch den verwendeten Template-Stil bestimmt. Für Prosilver, phpBB SiteMaker enthält die folgenden Blockpositionen: * Panel: volle Breite über die obere * Seitenleiste: links/rechts je nach Layout unten * Subcontent: ähnlich der Seitenleiste nur größer * top_hor: horizontale Blöcke über die Oberseite, Flansche oberhalb der Seitenleiste/Unterinhalt abhängig vom Layout * oben: oberhalb des Hauptinhalts * Box: gleiche Breite, horizontale Blöcke unterhalb des Hauptinhalts * unten: unterhalb des Hauptinhalts: * bottom_hor: horizontale Blöcke über die Unterseite, die Seitenleiste/Unterinhalt abhängig vom Layout * Fußzeile flankieren: horizontale Blöcke in der Fußzeile Sie können weitere Blockpositionen in Ihren eigenen Stilvorlagen hinzufügen, indem Sie die entsprechenden phpBB SiteMaker Templates kopieren und ändern

## Site-Layout

Sie können das Layout für Ihre Site in AKP auswählen (Erweiterungen > Sitemaker > Einstellungen): * **Blog**: Unterinhalt und Seitenleiste nebeneinander nach rechts gedrückt, top_hor/botom_hor Flankeninhalt * **Heiliger Gral**: gleiche Breite Seitenleiste und Unterinhalt auf gegenüberliegenden Seiten, top_hor/botom_hor flankieren Unterinhalt * **Portal**: Sidebar auf links, Unterinhalt auf der rechten Seite top_hor/botom_hor flankieren Unterinhalt * **Portal Alt**: Unterinhalt auf links, Seitenleiste auf der rechten Seite top_hor/botom_hor flank Sidebar * **Benutzerdefiniert**: Manuell die Breite der Sidebars als px, %, em oder rem. Standardeinstellung auf 200px auf jeder Seite

## Eigene Vorlagen/Stile

So weit wie möglich haben wir versucht, Template-Dateien und Assets in Styles/all/ Ordner zu setzen, so dass Sie diese überschreiben können, indem Sie eine Datei mit demselben Namen unter Ihrem eigenen Template-Theme erstellen, z.B. prosilver. Wenn Sie also ändern möchten, wie ein bestimmter Block angezeigt wird oder wenn Sie Ihr eigenes Layout mit Ihren eigenen Blockpositionen erstellen möchten, müssen Sie einfach eine Datei mit dem gleichen Namen und Pfad wie das Original in Ihrem eigenen Stil erstellen.

Wenn Sie CSS/JS-Dateien anpassen müssen, werfen Sie einen Blick auf das [Thema](./developer-theming.md).