---
id: filemanager
title: Filemanante Responsivo
---

A partire dalla versione 3.1.0, phpBB SiteMaker supporta il [Responsive Filemanager](http://responsivefilemanager.com)

* Il file manager è utilizzato come un plugin TinyMCE (WYSIWYG editor) per la modifica di blocchi personalizzati
* Attualmente è configurato per creare cartelle separate per ogni utente, ad eccezione dell'utente con il permesso a_sm_filemanager (può vedere/gestire le cartelle degli altri utenti), che consente loro di accedere alla visualizzazione/gestire tutte le cartelle upload.

## Installazione

* Scarica il [Responsive File Manager](http://responsivefilemanager.com/index.php#sthash.5UrnhjX2.dpbs)
* Estrarlo e caricare i file nella cartella root di phpBB. La struttura del file deve essere come segue:

```text
phpBB
© images/
© includes/
<unk> <unk> <unk> <unk> ...
<unk> ，ResponsiveFilemanager/
    <unk> 藏 fileemager/
        <unk> 藏 config/
            l’unico modo in cui si applica il software in questione.htaccess
            <unk> → config.php
```

## Attivazione

* Vai a ACP > Estensioni > SiteMaker > Impostazioni
* Attiva la funzione Gestione File
* Salva modifiche
* Aggiorna i permessi utente (scheda varie) per determinare chi può utilizzare questa funzione [Può utilizzare File Manager]
* Aggiorna i permessi di amministratore (scheda varie) per determinare chi può gestire le cartelle utente [Può vedere/gestire le cartelle di altri utenti in File Manager]