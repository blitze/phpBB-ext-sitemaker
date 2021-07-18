---
title: Gestione Dei Blocchi
sidebar_position: 3
---

Per gestire i blocchi in phpBB SiteMaker, devi essere in [Modalità Modifica](./overview#edit-mode).

> Quando un blocco non visualizza alcun contenuto, non verrà visualizzato, tranne in modalità modifica. In questo modo, puoi dargli il contenuto (nel caso del blocco personalizzato) o modificarne le impostazioni.

> In modalità modifica, i blocchi un po' trasparenti sono blocchi che altrimenti non verranno visualizzati ma vengono visualizzati solo perché siamo in modalità di modifica

## Aggiunta blocchi
È possibile aggiungere blocchi a qualsiasi pagina frontale tranne il Pannello di controllo utente e le pagine del Pannello di controllo moderato. Per aggiungere un blocco, è necessario:
* clicca su **Blocchi** nella barra di amministrazione. Questo mostrerà un elenco di blocchi disponibili
* Trascinare e rilasciare il blocco desiderato in qualsiasi posizione di blocco

## Modifica blocchi
### Aggiunta di un'icona di blocco
A sinistra del titolo del blocco (prosilver), c'è una casella per l'icona del blocco. Fare clic su questa casella per ottenere il selettore di icone. È possibile selezionare la dimensione dell'icona, il colore, il float, la rotazione, ecc.

### Modificare il Titolo del Blocco
phpBB SiteMaker blocchi avranno un titolo tradotto predefinito, ma se il titolo non soddisfa le vostre esigenze, potete cambiarlo. Per modificare il titolo del blocco,
* Fare clic sul titolo del blocco per ottenere un modulo di modifica in linea
* Cambia il titolo con quello che vuoi
* Rimuovi il focus dal campo o premi Invio per inviare le modifiche

> Il titolo del blocco modificato non è tradotto

> Per tornare al titolo predefinito, basta eliminare il titolo e premere Invio

### Modifica impostazioni blocco
Quando si passa sopra un blocco, un'icona di cog apparirà alla destra del blocco che può essere usato per modificare il blocco. Nella finestra di dialogo blocco di modifica, è possibile:
- Attiva/disattiva un blocco [Status]
- Scegli quando il blocco dovrebbe/non dovrebbe essere visualizzato [Display]. Questo si applica solo nei casi in cui hai annidato pagine (vedi [Capire l'eredità del blocco](/docs/user/site/block-inheritance)):
    - **Always**: Mostra sempre il blocco
    - **Nascondi su percorsi figli**: Mostra solo questo blocco sul percorso genitore
    - **Mostra solo sugli itinerari figli**: Mostra solo questo blocco su un percorso figlio
- Scegli quali gruppi di utenti possono visualizzare il blocco [Visualizzabile da]. Utilizzare CTRL + fare clic per selezionare più gruppi.
- Imposta classi personalizzate per modificare l'aspetto del blocco o degli elementi (elenchi, immagini, sfondo, ecc) all'interno del blocco [Classe CSS]
- Mostra/nascondi il titolo del blocco [Nascondi titolo del blocco?]
- Seleziona la vista blocco [Vista blocco]. È possibile selezionare una visualizzazione di blocco predefinita quando nuovi blocchi sono aggiunti in ACP.
    - **Default / Simple**: usa la classe del pannello prosilver per avvolgere il blocco in un contenitore imbottito
    - **Basic**: il blocco non ha alcun contenitore che lo avvolga
    - **Boxed**: usa la classe prosilver forabg per avvolgere il blocco in una scatola
- Imposta / Aggiorna impostazioni specifiche del blocco
- Se hai lo stesso blocco con le stesse impostazioni su più pagine, è possibile aggiornare tutti in una sola volta controllando i **Aggiorna blocchi con impostazioni simili**

## Eliminazione di blocchi
- Passa sopra il blocco che vuoi eliminare
- Fare clic sull'icona **x** e confermare che si desidera eliminare il blocco
- Vai alla barra di amministrazione e clicca su `Salva modifiche`
