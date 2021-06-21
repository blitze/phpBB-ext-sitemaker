---
id: blocchi-personalizzati
title: Blocco personalizzato
---

Se i blocchi disponibili non ti danno la libertà che ti serve, c'è il blocco `personalizzato` che ti permette di visualizzare liberamente i tuoi contenuti utilizzando BBcode o HTML. The block comes with a WYSIWYG editor (TinyMCE) and a scripts manager:

## L'editor

- Puoi usare l'editor per creare contenuti HTML
- Puoi modificare il codice sorgente se hai bisogno di questo livello di controllo cliccando sull'icona `del codice sorgente` (`<>`) nell'editor
- The editor allows you to upload and modify images 
    - It creates a new folder in phpBB/images/sitemaker_uploads/ for every user who has access to it
    - You can view/manage all user folders
- L'editor filtra qualsiasi script potenzialmente pericoloso come javascript, ecc. Se hai bisogno di aggiungere contenuti come pubblicità google, gli javascript verranno filtrati, ma è possibile aggirare questo problema facendo quanto segue: 
    - Aggiungi il blocco personalizzato alla posizione desiderata
    - Modifica il Blocco Personalizzato, clicca sulla scheda `HTML` e incolla il tuo Javascript

## The Scripts Manager

The Custom Block also allows you to add custom CSS and Javascript files to your page. To do this:

- Add a `Custom Block` to any block position. The position does not matter unless you are also displaying content with the block
- Edit the block, click on the `Scripts` tab and add your CSS or Javascript files > Word of caution though: Adding to many scripts on your page can affect load times