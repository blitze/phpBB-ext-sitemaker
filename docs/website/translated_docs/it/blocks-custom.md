---
id: blocchi-personalizzati
title: Blocco personalizzato
---

Se i blocchi disponibili non ti danno la libertà che ti serve, c'è il blocco `personalizzato` che ti permette di visualizzare liberamente i tuoi contenuti utilizzando BBcode o HTML. Il blocco viene fornito con un editor WYSIWYG (TinyMCE) e un gestore di script:

## L'editor

- Puoi usare l'editor per creare contenuti HTML
- Puoi modificare il codice sorgente se hai bisogno di questo livello di controllo cliccando sull'icona `del codice sorgente` (`<>`) nell'editor
- L'editor consente di caricare e modificare le immagini 
    - Crea una nuova cartella in phpBB/images/sitemaker_uploads/ per ogni utente che ha accesso ad essa
    - È possibile visualizzare/gestire tutte le cartelle utente
- L'editor filtra qualsiasi script potenzialmente pericoloso come javascript, ecc. Se hai bisogno di aggiungere contenuti come pubblicità google, gli javascript verranno filtrati, ma è possibile aggirare questo problema facendo quanto segue: 
    - Aggiungi il blocco personalizzato alla posizione desiderata
    - Modifica il Blocco Personalizzato, clicca sulla scheda `HTML` e incolla il tuo Javascript

## Il Gestore Degli Script

Il blocco personalizzato consente anche di aggiungere file CSS e Javascript personalizzati alla tua pagina. Per fare questo:

- Aggiungi un `blocco personalizzato` a qualsiasi posizione di blocco. La posizione non importa a meno che non si visualizzano anche contenuti con il blocco
- Modifica il blocco, fare clic sulla scheda `Script` e aggiungere i file CSS o Javascript > Parola di cautela però: Aggiungere a molti script sulla tua pagina può influenzare i tempi di caricamento