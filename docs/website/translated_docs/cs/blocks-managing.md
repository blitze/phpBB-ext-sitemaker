---
id: správa bloků
title: Správa bloků
---

Chcete-li spravovat bloky v phpBB SiteMaker, musíte být v [Edit Mode](./blocks-overview#edit-mode).

> Pokud blok nezobrazí žádný obsah, nebude zobrazen, s výjimkou editačního režimu. Tímto způsobem jej můžete buď seznámit s obsahem (v případě celního bloku) nebo změnit jeho nastavení.
> 
> V editačním režimu jsou poněkud transparentní bloky, které se jinak nezobrazují, ale zobrazují se pouze proto, že jsme v režimu úpravy.

## Přidání bloků

Bloky můžete přidávat na libovolnou stránku s náporem, kromě User Control Panel a Moderator Control Panel stránek. Chceš-li přidat blok, musíš to: * klikni na **bloky** v panelu Admina. Toto zobrazí seznam dostupných bloků * přetáhni požadovaný blok na jakoukoli pozici bloku

## Nastavení bloků

### Přidáním blokové ikony

Pro levou část blokového titulu (prosilver) je zde krabice pro ikonu bloku. Klikněte na tuto schránku, abyste si vybrali ikonu. Můžete zvolit velikost ikon, barvu, float, rotaci, atd.

### Upravit blokovou hlavičku

phpBB SiteMaker bloky budou mít výchozí, přeložené tituly, ale pokud název nesplňuje vaše potřeby, můžete změnit. Možnost upravit název bloku, * Klikni na název bloku a najdi inline editační formulář * Změň název na cokoliv chceš * Odstraň zaměření pole nebo stiskni enter pro submit změn.

> Vaše modifikovaný název není přeložen
> 
> Pro návrat do výchozího názvu jednoduše smažte název a stiskněte Enter.

### Upravit nastavení bloků

Když se vznášíte přes blok, objeví se ikona pro sdílení pravé části bloku, který může být použit k úpravě bloku. V okně bloku úprav můžete: - Povolit/zakázat blok [Status] - Vyberte kdy by blok neměl být zobrazován [Display]. This only applies in cases where you have nested pages (see [Understanding Block Inheritance](./blocks-inheritance.md)): - **Always**: Always display the block - **Hide on child routes**: Only show this block on the parent route - **Show on child routes only**: Only show this block on a child route - Choose which groups of users can view the block [Viewable by]. Použijte CTRL + klikněte na výběr více skupin. - Nastavte vlastní třídy pro změnu vzhledu bloku nebo položek (seznamy, obrázky, pozadí. atd) v bloku [CSS Class] - Zobrazit/skrýt název bloku [Skrýt název bloku? - Vyberte si zobrazení bloku [Block view]. Při přidání nových bloků do zemí AKT si můžete zvolit výchozí blokový náhled. - **Výchozí / Jednoduché**: použije třídu prostříbra panelu bloku pro zabalení do ohraničeného kontejneru - **Basic**: blok nemá žádný kontejner zabalený - **Boxed**: používá prosilver třídy pro zabalení bloku do pole - Aktualizujte specifické nastavení blokování - Pokud máte stejný blok se stejným nastavením na více stránkách, všechny aktualizace můžete aktualizovat najednou kontrolou **aktualizačních bloků v podobném nastavení**

## Odstranění bloků

- Hover nad blokem, který chcete odstranit
- Klepněte na ikonu **x** a potvrďte, že chcete tento blok odstranit.
- Jdi na panel administrace a klikni na `Uložit změny`