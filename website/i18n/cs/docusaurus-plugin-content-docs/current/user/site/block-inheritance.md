---
title: Blokovat dědictví
sidebar_position: 5
---

To jsme již viděli, nastavením výchozího rozvržení, ostatní stránky, které nemají vlastní bloky, zdědí bloky z výchozího rozložení. Existuje však i další druh blokové dědictví.

## Rodičové/podřízené trasy
V phpBB SiteMaker, mluvíme o vnořených trasách, pokud jde o skutečné vnořené (pod) adresáře nebo prakticky vnořené cesty/trasy. Prosím, zůstaňte se mnou :).
* Skutečné rodičovské trasy: Cesta /some_directory/sub_directory/index.php je dílem /some_directory/index.php
* Virtuální rodiče/Dětské cesty: Například viewtopic.php je považováno za dítě z viewforum.php.

Zde jsou některé příklady rodičů/dětských cest:

| Rodič              | Potomek                        |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/výrobky   | /app.php/articles/my-article   |

## Dědičnost rodiče/dětského bloku
Pro rodiče/dětskou trasu dětská trasa zdědí bloky mateřské trasy (pokud rodič má své vlastní bloky) nebo z výchozího rozložení (pokud byla nastavena). Jinými slovy, i když existuje výchozí uspořádání, dětská trasa zdědí bloky od nadřazené trasy, pokud má nadřazená trasa vlastní bloky. Ale ne všechny bloky od nadřazené trasy musí být zděděny.

## Kontrola dědictví bloků
Na úrovni bloků můžete ovládat, kdy může být blok zděděn dětskými trasami. Dříve jsme se toho dotkli v [Nastavení bloků](/docs/user/blocks/managing-blocks#editing-block-settings).

Zvažte následující skutečnou strukturu adresáře:
```text
phpBB
├── index.php
└── Movies/
    ├── index.php
    ├── page.php
    └── Comedy/
        └── index.php
```

Pro účely zdědění bloků říkáme:
* Nadřazená cesta /phpBB/Movies/Comedy/index.php je /phpBB/Movies/index.php a ne /phpBB/Movies/page.php
* Všechny stránky v podadresáři vzhledem k /phpBB/index.php jsou podřízenou cestou /phpBB/index.php. Takže /phpBB/Movies/index.php a /phpBB/Movies/page.php jsou všechny děti /phpBB/index.php a proto zdědí jeho bloky, pokud nemají vlastní bloky. V tomto případě:
    * Když je nastaven blok na /phpBB/index.php pro zobrazení na **Skrýt na podřízených trasách**, blok se zobrazí na /phpBB/index. hp (mateřská cesta), ale ne na dětských trasách
    * Když je na /phpBB/index.php nastaven blok na **Zobrazit pouze na podřízených trasách**, zobrazí se na /phpBB/Movies/index. hp and /phpBB/Movies/page.php (podřízené trasy), ale ne na /phpBB/index.php (rodiče), ani /phpBB/Movies/Comedy/index.php (jdeme pouze o jednu úroveň hloubky)
    * Když je blok na /phpBB/index.php nastaven na zobrazení **vždy** (výchozí), zobrazí se na /phpBB/index. hp (rodiče), /phpBB/Movies/index.php and /phpBB/page.php (podřízené trasy), ale ne na /phpBB/Movies/Comedy/index.php (jdeme pouze o úroveň hloubky). V tomto případě /phpBB/Movies/Comedy/index.php zdědí z výchozí trasy (pokud existuje)

## Možný budoucí stav
Mám opravdu zájem o vaši zpětnou vazbu v této oblasti. Většina uživatelů phpBB nebude mít skutečné adresáře, jak je uvedeno výše. Takže mám na mysli použití struktury, která je definována v nabídkovém bloku jako virtuální adresářová struktura a aplikovat na ni toto rodiče/dětskou dědičnost. Zvažuji také, že jdu hluboko nad jednu úroveň. Dejte mi prosím vědět, jestli vám to bude užitečné.