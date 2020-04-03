---
id: block-Vererbung
title: Blockvererbung verstehen
---

Wir haben bereits gesehen, dass durch die Einstellung eines Standardlayouts andere Seiten, die keine eigenen Blöcke haben, die Blöcke aus dem Standardlayout erben. Es gibt jedoch eine andere Art von Blockvererbung.

## Eltern-/Kind-Routen

In phpBB SiteMaker sprechen wir von verschachtelten Routen in Bezug auf echte verschachtelte (Sub-)Verzeichnisse oder praktisch verschachtelte Pfade/Routen. Bitte bleiben Sie bei mir :). * Real Parent/Child routes: Zum Beispiel ist der Pfad /some_directory/sub_directory/index.php ein Kind von /some_directory/index.php * Virtual Parent/Child routes: Zum Beispiel wird viewtopic.php als Kind von viewforum.php behandelt.

Hier sind einige Beispiele für Eltern-/Kind-Routen:

| Eltern             | Kind                           |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/artikel   | /app.php/articles/my-article   |

## Eltern-/Kind-Block Vererbung

Bei übergeordneten/untergeordneten Routen erbt die untergeordnete Route die Blöcke der übergeordneten Route (wenn der Elternteil eigene Blöcke hat) oder des Standardlayouts (falls eine gesetzt wurde). Mit anderen Worten, selbst wenn es ein Standardlayout gibt, wird die untergeordnete Route Blöcke von ihrer übergeordneten Route erben, wenn die übergeordnete Route eigene Blöcke hat. Aber nicht alle Blöcke der übergeordneten Route müssen geerbt werden.

## Blockvererbung kontrollieren

Auf einer Blockebene können Sie festlegen, wann ein Block durch Kinderrouten vererbt werden kann. Wir haben dies bereits in den [Editing Block Settings](./blocks-managing#editing-block-settings) erwähnt.

Betrachten Sie die folgende echte Verzeichnisstruktur:

```text
phpBB
<unk> 本<unk> index.php
<unk> <unk> <unk> <unk> <unk> Movies/
    <unk> <unk> <unk> <unk> index.php
    <unk> <unk> page.php
    <unk> <unk> <unk> Comedy/
        <unk> <unk> <unk> index.php
```

Zum Zwecke der Vererbung von Blöcken sagen wir: * Die übergeordnete Route von /phpBB/Movies/Comedy/index.php ist /phpBB/Movies/index.php und nicht /phpBB/Movies/page.php * Alle Seiten in einem Unterverzeichnis relativ zu /phpBB/index.php ist eine untergeordnete Route von /phpBB/index.php. Also /phpBB/Movies/index.php und /phpBB/Movies/page.php sind alle Kinder von /phpBB/index.php und werden daher ihre Blöcke erben, wenn sie keine eigenen Blöcke haben. In diesem Fall: * Wenn ein Block auf /phpBB/index. hp ist auf **Ausblenden auf untergeordneten Routen**gesetzt, der Block wird auf /phpBB/index angezeigt. hp (übergeordnete Route) aber nicht auf seinen untergeordneten Routen * Wenn ein Block auf /phpBB/index. hp wird auf **nur auf untergeordneten Routen angezeigt**, es wird auf /phpBB/Movies/index.php und /phpBB/Movies/page angezeigt. hp (Kindrouten), aber nicht auf /phpBB/index.php (parent), noch /phpBB/Movies/Comedy/index. hp (wir gehen nur eine Ebene tief) * Wenn ein Block auf /phpBB/index. hp wird auf **immer** gesetzt (Standard), es wird auf /phpBB/index.php (parent), /phpBB/Movies/index angezeigt. hp und /phpBB/page.php (Kind-Routen) aber nicht auf /phpBB/Movies/Comedy/index.php (wir gehen nur eine Ebene deep). In diesem Fall wird /phpBB/Movies/Comedy/index.php von der Standardroute geerbt (falls vorhanden)

## Posible Zukunft Status

Ich bin wirklich an Ihrem Feedback in diesem Bereich interessiert. Die meisten phpBB-Benutzer werden keine echten Verzeichnisse wie oben beschrieben haben. Ich denke also an die Struktur, die in einem Menüblock als virtuelle Verzeichnisstruktur definiert ist, und verwende diese übergeordnete/untergeordnete Vererbung. Ich denke auch darüber hinaus gehen über eine Ebene tief. Bitte lassen Sie mich wissen, ob dies Ihnen nützlich sein wird.