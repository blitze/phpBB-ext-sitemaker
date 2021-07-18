---
id: site-default-layout
title: Indstilling af et standard layout
---

Når du tilføjer en blok, tilføjes den til den specifikke side. Det ville derfor være en kedelig opgave at sætte blokke for alle siderne på dit websted. Du kan indstille alle ønskede blokke for en bestemt side, og derefter indstille den side som standard layout. Med andre ord, enhver side, der ikke har sine egne blokke, vil arve blokke fra denne side.

For at angive et standard layout * Gå til den side, du gerne vil angive som standard layout * Klik på `Indstillinger` i admin bjælken * Klik på `Sæt som standard layout` knap

Sig at vi tilføjer blokke til en side (phpBB/index.php) med blokke i sidepanelet og toppositioner, for eksempel, og sæt det som vores standard layout. Dette har følgende effekter på andre sider: * Enhver side, der ikke har sine egne blokke, vil arve blokkene fra standardlayoutet. Se [Forståelse blok arv](./blocks-inheritance.md) for undtagelser. * Du kan stadig arve blokke fra et standard layout (indeks. hp), men vælg ikke at vise blokke på nogle blokpositioner eller slet ikke vise nogen blokke. For at gøre dette, * Gå til den side, du ikke ønsker, at alle/nogle blokke skal vises * Klik på `Indstillinger` i admin bjælken * Vælg `Vis ikke blokke på denne side` , hvis du ikke ønsker at arve/vise nogen blokke på denne side ELLER * Brug CTRL + klik for at vælge de blok positioner (til højre), som du ikke ønsker at vise blokke på * I `redigeringstilstand`, en side, der arver blokke fra standard layout, vil ikke vise nogen blokke, giver dig mulighed for at tilføje blokke til siden, hvis du ønsker at * Enhver side, der har sine egne blokke, vil ikke arve fra standard layout