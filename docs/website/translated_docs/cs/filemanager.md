---
id: filemanager
title: Responsivní správce souborů
---

Od verze 3.1.0, phpBB SiteMaker podporuje [Responsive Filemanager](http://responsivefilemanager.com)

* Správce souborů se používá jako pluging TinyMCE (WYSIWYG editor) při úpravě vlastních bloků
* V současné době je konfigurován tak, aby vytvářel pro každého uživatele oddělené složky kromě uživatele s povolením_sm_filemanager (můžete vidět/spravovat složky ostatních uživatelů), které jim umožní přístup k zobrazení a správu všech složek pro nahrávání.

## Instalace

* Stáhni si [Responsive FileManager](http://responsivefilemanager.com/index.php#sthash.5UrnhjX2.dpbs)
* Extract it, a upload souborů do vaší kořenové složky phpBB. Struktura souboru by měla být následující:

```text
phpBB
<unk> َ<unk> images/
<unk> َ<unk> includes/
<unk> <unk> ...
<unk> <unk> ResponsiveFilemanager/
    <unk> <unk> َ<unk> filemanager/
        <unk> ★<unk> config/
            <unk> <unk> .htaccess
            <unk> config.php
```

## Aktivita

* Přejděte do AKT > Rozšíření > SiteMaker > Nastavení
* Povolit funkci Správce souborů
* Uložit změny
* Aktualizovat uživatelská oprávnění (Překročit kartu), aby se určilo, kdo může tuto vlastnost používat [Can use File Manager]
* Update administrace oprávnění (Opustit kartu), která určuje, kdo může spravovat složky pro uživatele [Může vidět/spravovat složky ostatních uživatelů v File Manager]