---
id: blocks-inheritance
title: Porozumění blokové gramotnosti
---

Již jsme viděli, že pokud nastavíme výchozí rozložení, jiné stránky, které nemají vlastní bloky, zdědí bloky z výchozí rozložení. Existuje však i další typ blokového dědictví.

## Rodiče/děti

V phpBB SiteMaker, mluvíme o hnízdních trasách z hlediska skutečných hnízdních (sub) adresářů nebo prakticky zasazené cesty/trasy. Prosím, zůstaňte se mnou :). * Real Parent/Child routes: například cesta /some_directory/sub_directory/index.php je dítě /some_directory/index.php * Virtual Parent/Child routes: například prohlížení.php je zacházeno jako s dítětem divforum.php.

Zde jsou některé příklady tras rodiče/dítě:

| Parent             | Dět                             |
| ------------------ | ------------------------------- |
| /index.php         | /viewforum.php, /dir/index.php. |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1          |
| /app.php/articles  | /app.php/articles/my-článek     |

## Parent/dítě blokové gramotnosti

U rodičovských či dětských tras zdědí trasa rodičovské (pokud má rodič své vlastní bloky) nebo výchozí rozložení (pokud byla nastavena). Jinými slovy, i když existuje standardní rozložení, po rodičovské trase zdědí bloky z rodičovské trasy, pokud má rodičovská trasa své vlastní bloky. Ne všechny bloky rodičovské trasy však musí být zděděny.

## Kontrola blokové gramotnosti

Na blokové úrovni můžete kontrolovat, zda blok lze zdědit dětskými trasami. Tohle jsme se dotkli již dříve v [Upravit nastavení bloků](./blocks-managing#editing-block-settings).

Uvažme následující skutečnou strukturu katalogů:

```text
phpBB
<unk> 「<unk> index.php
<unk> َ<unk> Movies/
    <unk> <unk> <unk> <unk> index.php
    <unk> page.php
    <unk> <unk> <unk> <unk> <unk> <unk> Comedy/
        <unk> 32/<unk> index.php
```

Pro účely dědice bloků říkáme: * Nadřízená trasa /phpBB/Movies/Comedy/index.php je /phpBB/Movies/index. hp a ne /phpBB/Movies/page.php * Všechny stránky v podadresáři relativní k /phpBB/index.php je podřízená cesta z /phpBB/index.php. Takže /phpBB/Movies/index.php a /phpBB/Movies/page.php jsou všechny děti /phpBB/index.php, a proto zdědí své bloky, pokud nemají své vlastní bloky. V tomto případě: * Když blok na /phpBB/index. hp je nastaven na **Hide on child routes**, blok se zobrazí na /phpBB/index. hp (nadřazená cesta), ale ne na jejích podřízených směrech * Když blok na /phpBB/index. hp je nastaven na zobrazení na **Zobrazit pouze na dětských cestách**, bude se zobrazovat na /phpBB/Movies/index.php a /phpBB/Movies/page. hp (dětské trasy), ale ne na /phpBB/index.php (rodič), nebo /phpBB/Movies/Comedy/index. hp (jdeme pouze do jedné úrovně) * Když blok na /phpBB/index. hp je nastaven na zobrazení **vždy** (výchozí), zobrazí se na /phpBB/index.php (rodič), /phpBB/Movies/index. hp a /phpBB/page.php (dětské trasy), ale ne na /phpBB/Movies/Comedy/index.php (pouze jdeme o jednu úroveň hluboká). V tomto případě, /phpBB/Movies/Comedy/index.php zdědí z výchozí trasy (pokud existuje)

## Budoucnost státu

Skutečně se zajímám o vaši zpětnou vazbu v této oblasti. Většina uživatelů phpBB nebude mít skutečné adresáře uvedené výše. Proto přemýšlím o použití struktury, která je definována v menu bloku jako virtuální adresářová struktura, a uplatním na ni tento rodič/dítě inheritance. Zvažujem také jít nad rámec jedné úrovně hluboko. Prosím, dejte mi vědět, zda to bude pro vás užitečné.