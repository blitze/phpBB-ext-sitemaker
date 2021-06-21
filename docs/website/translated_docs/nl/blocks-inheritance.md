---
id: blokken-erfenis
title: Erkennende Blok Ererisief
---

We hebben al gezien dat door het instellen van een standaard lay-out, andere pagina's die geen eigen blokken hebben de blokken van de standaard lay-out zullen overnemen. Er is echter nog een andere vorm van groepsovername.

## Ouder/Kind Routes

In phpBB SiteMaker hebben we het over geneste routes in termen van echte geneste (sub) mappen of bijna geneste paden/routes. Blijf bij mij :). * Real Parent/Child routes: bijvoorbeeld het pad /some_directory/sub_directory/index.php is een kind van /some_directory/index.php. * Virtual Parent/Child routes: Bijvoorbeeld, viewtopic.php wordt behandeld als een kind van viewforum.php.

Hier zijn enkele voorbeelden van ouder/kind routes:

| Ouder              | Kind                            |
| ------------------ | ------------------------------- |
| /index.php         | /viewforum.php, /dir/index.php  |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1          |
| /app.php/artikelen | /app.php/artikelen/mijn-artikel |

## Bovenliggend/Kind Blok Erven

Voor bovenliggende/kind routes erft de onderliggende route de blokken van de bovenliggende route (als de ouder zijn eigen blokken heeft) of van de standaard lay-out (als deze is ingesteld). Met andere woorden, zelfs als er een standaard lay-out is, zal de onderliggende route blokken van de bovenliggende route overnemen als de bovenliggende route zijn eigen blokken heeft. Maar niet alle blokken van de bovenliggende route moeten geërfd worden.

## Blok Overnemen bepalen

Op een blokniveau kun je bepalen wanneer een blok geërfd kan worden door onderliggende routes. We hebben dit eerder aangeraakt in de [Blok Instellingen](./blocks-managing#editing-block-settings).

Overweeg de volgende echte map structuur:

```text
phpBB

 <unk> <unk> index.php
<unk> <unk> Movies/
    Verandert u index.php
    <unk> <unk> pagina.php
    <unk> <unk> Comedy/
        <unk> <unk> <unk> index.php
```

Voor het erfgenamen van blokken zeggen we: * De bovenliggende route van /phpBB/Files/Comedy/index.php is /phpBB/Files/index.php en niet /phpBB/Movies/page.php * Alle pagina's in een sub directory relatief aan /phpBB/index.php is een kind van /phpBB/index.php. Dus /phpBB/Files/index.php en /phpBB/Movies/page.php zijn alle kinderen van /phpBB/index.php en zullen daarom de blokken overnemen als ze geen eigen blokken hebben. In dit geval: * Wanneer een blok op /phpBB/index. hp is ingesteld om weer te geven op **Verberg op subroutes**, het blok wordt weergegeven op /phpBB/index. hp (bovenliggende route) maar niet op de onderliggende routes * Wanneer een blok op /phpBB/index staat. hp is ingesteld om weer te geven op **Toon op subroutes alleen**, het wordt weergegeven op /phpBB/Movies/index.php en /phpBB/Movies/page. hp (kinderroutes) maar niet op /phpBB/index.php (ouder), of /phpBB/Movies/Comedy/index. hp (we gaan maar één niveau diep) * Wanneer een blok op /phpBB/index staat. hp is ingesteld op weergave van **altijd** (standaard), het wordt weergegeven op /phpBB/index.php (ouder), /phpBB/Movies/index. hp en /phpBB/page.php (onderkinderroutes) maar niet op /phpBB/Movies/Comedy/index.php (we gaan slechts een diepte). In dit geval zal, /phpBB/Files/Comedy/index.php geërfd worden van de standaard route (als deze bestaat)

## Mogelijke toekomstige status

Ik ben echt geïnteresseerd in uw feedback in dit gebied. De meeste phpBB-gebruikers zullen geen echte mappen hebben zoals hierboven beschreven. Ik denk dus aan het gebruik van de structuur die gedefinieerd is in een menu blok als een virtuele directory structuur en gebruik deze ouder/kind erfenis erop. Ik ben ook van plan om verder te gaan dan één niveau diep. Laat mij weten of dit nuttig voor u is.