---
id: blocchi-personalizzati
title: Blocco personalizzato
---

Se i blocchi disponibili non ti danno la libertà che ti serve, c'è il blocco `personalizzato` che ti permette di visualizzare liberamente i tuoi contenuti utilizzando BBcode o HTML. Il blocco è dotato di un editor WYSIWYG (TinyMCE), un [File Manager](./filemanager.md)e un gestore di script:

## L'editor

* Puoi usare l'editor per creare contenuti HTML
* Puoi modificare il codice sorgente se hai bisogno di questo livello di controllo cliccando sull'icona `del codice sorgente` (`<>`) nell'editor
* L'editor ti permette di caricare e modificare immagini
* L'editor filtra qualsiasi script potenzialmente pericoloso come javascript, ecc. Se hai bisogno di aggiungere contenuti come pubblicità google, gli javascript verranno filtrati, ma è possibile aggirare questo problema facendo quanto segue: 
    * Aggiungi il blocco personalizzato alla posizione desiderata
    * Modifica il Blocco Personalizzato, clicca sulla scheda `HTML` e incolla il tuo Javascript

## Gestore File

Il `Custom Block` è anche dotato di [File Manager](./filemanager.md) come un plugin TinyMCE * Crea una nuova cartella in phpBB/images/sitemaker_uploads/ per ogni utente che ha accesso a esso * È possibile vedere/gestire tutte le cartelle utente

## Lo script Manager

Il blocco personalizzato consente anche di aggiungere file CSS e Javascript personalizzati alla tua pagina. To do this: * Add a `Custom Block` to any block position. La posizione non è rilevante a meno che non si visualizza anche il contenuto con il blocco * modificarlo, clicca sulla scheda `Script` e aggiungi i tuoi file CSS o Javascript

> Ma la parola di cautela: aggiungere a molti script nella tua pagina può influire sui tempi di caricamento