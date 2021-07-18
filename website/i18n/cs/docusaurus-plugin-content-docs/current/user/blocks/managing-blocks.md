---
title: Správa bloků
sidebar_position: 3
---

Chcete-li spravovat bloky v phpBB SiteMaker, musíte být v [Režim úprav](./overview#edit-mode).

> Pokud blok nezobrazuje žádný obsah, nebude zobrazen, kromě režimu úprav. Tímto způsobem můžete buď dát obsah (v případě vlastního bloku) nebo změnit jeho nastavení.

> V režimu úprav, poněkud transparentní bloky jsou bloky, které jinak nebudou zobrazeny, ale jsou zobrazeny pouze proto, že jsme v režimu úprav

## Přidávání bloků
Můžete přidat bloky na jakoukoliv stránku orientovanou na přední stranu, s výjimkou uživatelského ovládacího panelu a Moderátoru ovládacích stránek. Chcete-li přidat blok, musíte:
* klikněte na **Bloky** v panelu administrace. Zobrazí seznam dostupných bloků
* Přetáhněte požadovaný blok na libovolnou pozici bloku

## Úprava bloků
### Přidání ikony bloku
Nalevo od názvu bloku (prosilver) je zde pole pro ikonu bloku. Klikněte na toto políčko pro výběr ikon. Můžete vybrat velikost, barvu, plovoucí okno, otáčení atd.

### Úprava názvu bloku
phpBB SiteMaker bloky budou mít výchozí, přeložený název, ale pokud název nesplňuje vaše potřeby, můžete jej změnit. Pro úpravu názvu bloku,
* Klikněte na titulek bloku pro získání formuláře úpravy řádku
* Změňte název na cokoliv chcete
* Odstraňte zaostření z pole nebo stiskněte enter pro odeslání změn

> Váš upravený název bloku není přeložen

> Chcete-li se vrátit k výchozímu názvu, jednoduše smažte název a stiskněte Enter

### Úprava nastavení bloku
Když přejdete přes blok, objeví se ikona ozubeného kolečka vpravo od bloku, která může být použita k úpravě bloku. V dialogovém okně editace můžete:
- Povolit/zakázat blok [Status]
- Vyberte, kdy by se měl nebo neměl blok zobrazovat [Display]. To platí pouze v případech, kdy jste vnořili stránky (viz [Blok porozumění](/docs/user/site/block-inheritance)):
    - **Vždy**: Vždy zobrazit blok
    - **Skrýt na podřazených trasách**: Zobrazit pouze tento blok na nadřazené cestě
    - **Zobrazit pouze na podřízených trasách**: Zobrazit tento blok pouze na podřízené trase
- Vyberte, které skupiny uživatelů mohou zobrazit blok [zobrazitelné]. Použijte CTRL + klikněte pro výběr více skupin.
- Nastavte vlastní třídy pro úpravu vzhledu bloku nebo položek (seznamy, obrázky, pozadí, atd.) v bloku [CSS třída]
- Zobrazit/skrýt název bloku [Skrýt název bloku?]
- Vyberte zobrazení bloku [Blokovat zobrazení]. Můžete vybrat výchozí zobrazení bloku, když jsou přidány nové bloky v ACP.
    - **Výchozí / Jednoduchý**: používá třídu prostříbrného panelu k zabalení bloku do vycpávaného kontejneru
    - **Základní**: blok nemá žádné balení kontejneru
    - **Boxovaný**: k zabalení bloku do krabice používá prostříbrnou forabg třídu
- Nastavit / aktualizovat konkrétní nastavení bloku
- Pokud máte stejný blok se stejným nastavením na více stránkách, všechny můžete aktualizovat najednou kontrolou **Aktualizačních bloků s podobnými nastavením**

## Odstraňování bloků
- Přejeďte blok, který chcete odstranit
- Klikněte na ikonu **x** a potvrďte, že chcete odstranit blok
- Přejdi na admin panel a klikni na `Uložit změny`
