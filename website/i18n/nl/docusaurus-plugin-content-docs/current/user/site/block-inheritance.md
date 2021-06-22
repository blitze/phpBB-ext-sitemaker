---
title: Blok erfenis
sidebar_position: 5
---

We hebben dit al gezien door het instellen van een standaard lay-out, andere pagina's die geen eigen blokken hebben, erven de blokken van de standaard lay-out. Er is echter nog een ander soort blokkades.

## Ouder/Kind Routes
In phpBB SiteMaker hebben we het over geneste routes in de vorm van echt geneste (sub) directories of vrijwel geneste paden/routes. Blijf bij mij :).
* Real Parent/Child routes: Bijvoorbeeld, het pad /some_directory/sub_directory/index.php is een kind van /some_directory/index.php
* Virtuele ouder/Kindroutes: Bijvoorbeeld, viewtopic.php wordt behandeld als een kind van viewforum.php.

Hier zijn enkele voorbeelden van ouder/kinderroutes:

| Bovenliggende      | Kind                            |
| ------------------ | ------------------------------- |
| /index.php         | /viewforum.php, //dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1          |
| /app.php/artikelen | /app.php/articles/mijn-artikel  |

## Ouder/Kinderblok overerving
Voor ouder/onderliggende routes, de child route erft de blokken van de bovenliggende route (als de ouder zijn eigen blokken heeft) of van de standaard lay-out (als er één is ingesteld). Met andere woorden, zelfs als er een standaardweergave is, de kindroute erft blokken van zijn bovenliggende route als de bovenliggende route zijn eigen blokken heeft. Maar niet alle blokken van de bovenliggende route moeten worden geërfd.

## Beheer Blok overerving
Op een blokniveau kun je controleren wanneer een blok kan worden overgenomen door kindroutes. We hebben dit eerder aangestipt in de [Instellingen voor bewerken blok](/docs/user/blocks/managing-blocks#editing-block-settings).

Zie de volgende echte directory structuur:
```text
phpBB
taxes, taxes, index.php
½ ½ Movies/
    ########ies/ 
 Ο±index index.php
    CE CE CE page.php
    CE CE leading page.php 
 taxes, Comedy/
        enquete/6 index.php
```

Om blokken te erven zeggen we:
* De bovenliggende route van /phpBB/Movies/Comedy/index.php is /phpBB/Movies/index.php en niet /phpBB/Movies/page.php
* Alle pagina's in een submap relatief aan /phpBB/index.php is een kindroute van /phpBB/index.php. Dus /phpBB/Movies/index.php en /phpBB/Movies/page.php zijn alle kinderen van /phpBB/index.php en zullen hun blokken erven als ze geen eigen blokken hebben. In dit geval:
    * Wanneer een blok op /phpBB/index.php is ingesteld op **Verberg op onderliggende routes**, wordt het blok weergegeven op /phpBB/index. hp (bovenliggende route) maar niet op onderliggende routes
    * Wanneer een blok op /phpBB/index.php is ingesteld op **Toon alleen op onderliggende routes**, wordt het getoond op /phpBB/Movies/index. hp and /phpBB/Movies/page.php (child routes) maar niet op /phpBB/index.php (parent), noch /phpBB/Movies/Comedy/index.php (we gaan slechts één niveau diep )
    * Wanneer een blok op /phpBB/index.php is ingesteld om **altijd** (standaard) weer te geven, wordt het getoond op /phpBB/index. hp (parent), /phpBB/Movies/index.php en /phpBB/page.php (child routes) maar niet op /phpBB/Movies/Comedy/index.php (we gaan slechts één niveau diep). In dit geval zullen /phpBB/Movies/Comedy/index.php van de standaardroute erven (als deze bestaat)

## Positieve toekomstige staat
Ik ben echt geïnteresseerd in jouw feedback op dit gebied. De meeste phpBB-gebruikers zullen geen echte mappen hebben zoals hierboven beschreven. Dus denk aan het gebruik van de structuur die in een menublok is gedefinieerd als een virtuele mapstructuur en het toepassen van deze ouder/kind erfenis. Ik overweeg ook om verder te gaan dan één niveau diep. Laat me weten of dit nuttig voor jou zal zijn.