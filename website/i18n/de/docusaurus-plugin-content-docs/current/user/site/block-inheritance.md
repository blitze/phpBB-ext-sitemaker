---
title: Vererbung blockieren
sidebar_position: 5
---

Wir haben das bereits durch das Festlegen eines Standard-Layouts gesehen, andere Seiten, die keine eigenen Blöcke haben, erben die Blöcke vom Standard-Layout. Es gibt jedoch noch eine andere Art von Blockvererbung.

## Eltern-/Kind-Routen
In phpBB SiteMaker sprechen wir von verschachtelten Routen in Form von real verschachtelten (Unter-)Verzeichnissen oder praktisch verschachtelten Pfaden/Routen. Bitte bleiben Sie bei mir :).
* Real Parent/Child-Routen: Zum Beispiel ist der Pfad /some_directory/sub_directory/index.php ein Kind von /some_directory/index.php
* Virtuelle Parent/Child-Routen: Zum Beispiel wird viewtopic.php als Kind von viewforum.php behandelt.

Hier sind einige Beispiele für Eltern/Unter-Routen:

| Elternteil         | Kind                           |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articles/my-article   |

## Erbschaft Eltern/Kind
Für Eltern-/Kind-Routen, die untergeordnete Route erbt die Blöcke der übergeordneten Route (falls der Elternteil eigene Blöcke hat) oder vom Standardlayout (falls eingestellt). Mit anderen Worten, selbst wenn es ein Standardlayout gibt, die untergeordnete Route wird Blöcke von der übergeordneten Route erben, wenn die übergeordnete Route ihre eigenen Blöcke hat. Aber nicht alle Blöcke der übergeordneten Route müssen vererbt werden.

## Steuerung der Blockvererbung
Auf Blockebene können Sie festlegen, ob ein Block von untergeordneten Routen geerbt werden kann. Wir haben dies bereits in den [Blockeinstellungen bearbeiten](/docs/user/blocks/managing-blocks#editing-block-settings) berührt.

Betrachten Sie die folgende echte Verzeichnisstruktur:
```text
phpBB
<unk> 本<unk> index.php
<unk> 本<unk> Movies/
    <unk> 本<unk> index.php
    <unk> 本<unk> page.php
    <unk> 本<unk> Comedy/
        <unk> 文<unk> index.php
```

Für das Erben von Blöcken sagen wir:
* Die übergeordnete Route von /phpBB/Movies/Comedy/index.php ist /phpBB/Movies/index.php und nicht /phpBB/Movies/page.php
* Alle Seiten in einem Unterverzeichnis relativ zu /phpBB/index.php ist eine untergeordnete Route von /phpBB/index.php. Also /phpBB/Movies/index.php und /phpBB/Movies/page.php sind alle Kinder von /phpBB/index.php und erben ihre Blöcke, wenn sie keine eigenen Blöcke haben. In diesem Fall:
    * Wenn ein Block auf /phpBB/index.php gesetzt ist, der auf **Versteckt bei untergeordneten Routen**angezeigt wird, wird der Block auf /phpBB/index angezeigt. hp (übergeordnete Route) aber nicht auf seinen untergeordneten Routen
    * When a block on /phpBB/index.php is set to display on **Show on child routes only**, it will display on /phpBB/Movies/index.php and /phpBB/Movies/page.php (child routes) but not on /phpBB/index.php (parent), nor /phpBB/Movies/Comedy/index.php (we only go one level deep)
    * Wenn ein Block auf /phpBB/index.php auf **immer** (Standard) gesetzt ist, wird er auf /phpBB/index angezeigt. hp (parent), /phpBB/Movies/index.php und /phpBB/page.php (child routes) aber nicht auf /phpBB/Movies/Comedy/index.php (wir gehen nur eine Ebene tief). In diesem Fall wird /phpBB/Movies/Comedy/index.php von der Standardroute vererbt (falls vorhanden)

## Positiver Zufallszustand
Ich bin wirklich an Ihrem Feedback in diesem Bereich interessiert. Die meisten phpBB-Benutzer haben keine echten Verzeichnisse, wie oben beschrieben. Daher denke ich daran, die Struktur, die in einem Menüblock als virtuelle Verzeichnisstruktur definiert ist, zu verwenden und diese Eltern-/Kindvererbung darauf anzuwenden. Ich erwäge auch, über eine Ebene tief zu gehen. Bitte lassen Sie mich wissen, ob dies für Sie nützlich sein wird.