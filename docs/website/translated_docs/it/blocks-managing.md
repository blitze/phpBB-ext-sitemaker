---
id: gestione blocchi
title: Gestione dei blocchi
---

Per gestire i blocchi in phpBB SiteMaker, devi essere in [Modo Modifica](./blocks-overview#edit-mode).

> Quando un blocco non mostra alcun contenuto, non verrà visualizzato, eccetto in modalità modifica. In questo modo, puoi dargli contenuto (nel caso del blocco personalizzato) o cambiarne le impostazioni.
> 
> In modalità modifica, i blocchi in un certo senso trasparenti sono blocchi che altrimenti non verranno visualizzati ma verranno visualizzati solo perché siamo in modalità di modifica

## Aggiungi blocchi

Puoi aggiungere blocchi a qualsiasi pagina frontale, eccetto il Pannello di Controllo Utente e le pagine del Pannello di Controllo Moderatore. Per aggiungere un blocco, devi: * clicca su **Blocchi** nella barra di amministrazione. Questo mostrerà una lista di blocchi disponibili * Trascina e rilascia il blocco desiderato in qualsiasi posizione di blocco

## Modifica blocchi

### Aggiungi icona blocco

A sinistra del titolo del blocco (prosilver), c'è una casella per l'icona del blocco. Clicca su questa casella per ottenere il selettore icona. È possibile selezionare la dimensione dell'icona, colore, float, rotazione, ecc.

### Modifica del titolo del blocco

phpBB SiteMaker blocchi avranno un titolo predefinito, tradotto ma se il titolo non soddisfa le tue esigenze, puoi cambiarlo. Per modificare il titolo del blocco, * Clicca sul titolo del blocco per ottenere un modulo di modifica inline * Cambia il titolo in quello che vuoi * Rimuovi il focus dal campo o premi invio per inviare le modifiche

> Il titolo del blocco modificato non è tradotto
> 
> Per tornare al titolo predefinito, elimina il titolo e premi invio

### Modifica impostazioni blocco

Quando passi sopra un blocco, un'icona rotellino apparirà a destra del blocco che può essere utilizzato per modificare il blocco. Nella finestra di modifica del blocco, puoi: - Abilita/disabilita un blocco [Status] - Scegli quando il blocco non deve essere visualizzato [Display]. Questo vale solo per i casi in cui hai annidato pagine (vedi [Understanding Block Inheritance](./blocks-inheritance.md)): - **Sempre**: mostra sempre il blocco - **Hide on Children**: Mostra solo questo blocco sul percorso genitore - **Mostra solo sulle rotte figli**: mostra solo questo blocco su un percorso figlio - Scegli quali gruppi di utenti possono visualizzare il blocco [Visualizzabile da]. Usa CTRL + click per selezionare più gruppi. - Imposta le classi personalizzate per modificare l'aspetto del blocco o degli elementi (liste, immagini, sfondo, ecc) all'interno del blocco [CSS Class] - Mostra/nascondi il titolo del blocco [Nascondi titolo del blocco?] - Seleziona la vista del blocco [Vista blocco]. Puoi selezionare una vista di blocco predefinita quando vengono aggiunti nuovi blocchi nei paesi ACP. - **di default / Semplice**: usa la classe pannello proargento per inserire il blocco in un contenitore imbottito - **Base**: il blocco non ha alcun contenitore da confezionare - **Boxed**: usa la classe proargver forabg per ingoiare il blocco in una casella - Imposta / Aggiorna impostazioni specifiche del blocco - se hai lo stesso blocco con le stesse impostazioni in più pagine, puoi aggiornarli tutti contemporaneamente controllando i **blocchi di aggiornamento con impostazioni simili**

## Eliminazione blocchi

- Passa sopra il blocco che vuoi eliminare
- Clicca sull'icona **x** e conferma di voler eliminare il blocco
- Vai fino alla barra di amministrazione e clicca su `Salva le modifiche`