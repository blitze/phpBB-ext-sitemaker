---
id: blocchi-ereditarietà
title: Eredità Blocco Understanding
---

Abbiamo già visto che impostando un layout predefinito, altre pagine che non hanno blocchi propri erediteranno i blocchi dal layout predefinito. Vi è tuttavia un altro tipo di successione di blocchi.

## Route Genitori/Figlie

In phpBB SiteMaker, parliamo di rotte nidificate in termini di directory reali nidificate (sub) o percorsi/rotte virtualmente nidificate. Rimani con me :). * Real Parent/Child routes: ad esempio, il percorso /some_directory/sub_directory/index.php è un figlio di /some_directory/index.php * Virtual Parent/Child routes: viewtopic.php è trattato come figlio di viewforum.php.

Ecco alcuni esempi di percorsi genitore/figlio:

| Genitore           | Figlio                         |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articoli  | /app.php/articoli/mio-articolo |

## Eredità blocco genitore/figlio

Per i percorsi padre/figlio, il percorso figlio eredita i blocchi dell'itinerario genitore (se il genitore ha i propri blocchi) o dal layout predefinito (se è stato impostato uno). In altre parole, anche se c'è un layout predefinito, l'itinerario figlio erediterà blocchi dal suo percorso padre se l'itinerario genitore ha i propri blocchi. Ma non tutti i blocchi dell'itinerario genitore devono essere ereditati.

## Controllo dell'ereditarietà del blocco

A livello di blocco, puoi controllare quando un blocco può essere ereditato da percorsi figli. Ne abbiamo già parlato nelle [Impostazioni del blocco](./blocks-managing#editing-block-settings).

Considera la seguente struttura directory reale:

```text
phpBB
├<unk> <unk> <unk> index.php
<unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> film/
    <unk> <unk> <unk> <unk> index.php
    <unk> <unk> <unk> page.php
    <unk> <unk> <unk> <unk> <unk> <unk> Comedy/
        <unk> <unk> <unk> <unk> <unk> <unk> index.php
```

Per ereditare i blocchi, diciamo: * Il percorso genitore di /phpBB/Movies/Comedy/index.php è /phpBB/Movies/index.php e non /phpBB/Movies/page.php * Tutte le pagine in una sotto directory relativa a /phpBB/index.php è un percorso figlio di /phpBB/index.php. Quindi /phpBB/Movies/index.php e /phpBB/Movies/page.php sono tutti figli di /phpBB/index.php e quindi erediteranno i suoi blocchi se non hanno blocchi propri. In questo caso: * quando un blocco su /phpBB/index. hp è impostato per essere visualizzato su **Nascondi sulle rotte bambini**, il blocco verrà mostrato su /phpBB/indice. hp (itinerario genitore) ma non sulle sue rotte figlie * quando un blocco su /phpBB/indice. hp è impostato su **Mostra solo su percorsi bambini**, sarà visualizzato sulla pagina /phpBB/Filvies/index.php e /phpBB/Movies/page. hp (percorsi figli) ma non su /phpBB/index.php (genit), né /phpBB/Filvies/Comedy/index. hp (è profondo un solo livello) * quando un blocco su /phpBB/indice. hp è impostato per visualizzare **always** (default), verrà visualizzato su /phpBB/index.php (genito), /phpBB/Filvies/index. hp e /phpBB/page.php (percorsi figli) ma non su /phpBB/Filvies/Comedy/index.php (si va solo a un livello profondo). In questo caso, /phpBB/Movies/Comedy/index.php erediterà dal percorso predefinito (se esiste)

## Stato futuro sostenibile

Sono davvero interessato al tuo feedback in quest'area. La maggior parte degli utenti phpBB non avrà cartelle reali come delineate sopra. Sto pensando di utilizzare la struttura definita in un blocco di menu come struttura di directory virtuale e di applicare a questa eredità padre/figlio. Penso anche di andare oltre un livello profondo. Per favore, fatemi sapere se questo sarà utile per voi.