---
title: Blocco Personalizzato
sidebar_position: 4
---

Se i blocchi disponibili non ti danno la libertà di cui hai bisogno, c'è il blocco personalizzato `` che ti permette la libertà di visualizzare i tuoi contenuti utilizzando BBcode o HTML. Il blocco viene fornito con un editor WYSIWYG (TinyMCE) e un gestore di script:

## L'editor

-   È possibile utilizzare l'editor per creare contenuti HTML
-   Puoi modificare il codice sorgente se hai bisogno di quel livello di controllo facendo clic sull'icona `Codice sorgente` (`<>`) nell'editor
-   L'editor consente di caricare e modificare le immagini
    -   Crea una nuova cartella in phpBB/images/sitemaker_uploads/ per ogni utente che ha accesso ad essa
    -   È possibile visualizzare/gestire tutte le cartelle utente
-   L'editor filtra tutti gli script potenzialmente pericolosi come javascript, ecc. Se avete bisogno di aggiungere contenuti come annunci google, il javascript sarà filtrato, ma è possibile aggirare questo facendo il seguente:
    -   Aggiungi il blocco personalizzato alla posizione desiderata
    -   Modifica il blocco personalizzato, clicca sulla scheda `HTML` e incolla il tuo Javascript

## Il Gestore Degli Script

Il blocco personalizzato consente anche di aggiungere file CSS e Javascript personalizzati alla tua pagina. Per fare questo:

-   Aggiungi un `blocco personalizzato` a qualsiasi posizione di blocco. La posizione non importa a meno che non si visualizzano anche contenuti con il blocco
-   Modifica il blocco, fare clic sulla scheda `Script` e aggiungere i file CSS o Javascript > Parola di cautela però: Aggiungere a molti script sulla tua pagina può influenzare i tempi di caricamento
