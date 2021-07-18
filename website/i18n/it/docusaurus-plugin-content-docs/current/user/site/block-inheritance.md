---
title: Blocca Ereditarietà
sidebar_position: 5
---

Lo abbiamo già visto impostando un layout predefinito, altre pagine che non hanno blocchi propri erediteranno i blocchi dal layout predefinito. C'è però un altro tipo di eredità di blocco.

## Percorsi Genitori/Bambino
In phpBB SiteMaker, parliamo di percorsi nidificati in termini di vere e proprie directory (sub) o virtualmente annidate percorsi/percorsi. Per favore, restate con me :).
* Percorsi Genitore/Figlio reali: Per esempio, il percorso /some_directory/sub_directory/index.php è figlio di /some_directory/index.php
* Virtual Parent/Child routes: Ad esempio, viewtopic.php è trattato come un figlio di viewforum.php.

Ecco alcuni esempi di itinerari genitori/figli:

| Genitore           | Figlio                         |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articoli/mio-articolo |

## Ereditarietà Parente/Blocco Bambino
Per itinerari genitori/figli il percorso figlio eredita i blocchi del percorso genitore (se il genitore ha i propri blocchi) o dal layout predefinito (se uno è stato impostato). In altre parole, anche se c'è un layout predefinito, il percorso figlio erediterà blocchi dal percorso genitore se il percorso genitore ha i suoi blocchi. Ma non tutti i blocchi dal percorso genitore devono essere ereditati.

## Controllare L'Ereditarietà Del Blocco
A un livello di blocco, puoi controllare quando un blocco può essere ereditato da percorsi figli. Lo abbiamo toccato in precedenza nelle [Impostazioni blocco di modifica](/docs/user/blocks/managing-blocks#editing-block-settings).

Considera la seguente struttura di directory reale:
```text
phpBB
├<unk> <unk> <unk> index.php
<unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> <unk> film/
    <unk> <unk> <unk> <unk> index.php
    <unk> <unk> <unk> page.php
    <unk> <unk> <unk> <unk> <unk> <unk> Comedy/
        <unk> <unk> <unk> <unk> <unk> <unk> index.php
```

Ai fini dell'eredità dei blocchi, diciamo:
* Il percorso principale di /phpBB/Movies/Comedy/index.php è /phpBB/Movies/index.php e non /phpBB/Movies/page.php
* Tutte le pagine in una sotto-directory relativa a /phpBB/index.php è un percorso figlio di /phpBB/index.php. Quindi /phpBB/Movies/index.php e /phpBB/Movies/page.php sono tutti figli di /phpBB/index.php e quindi erediteranno i suoi blocchi se non hanno blocchi propri. In questo caso:
    * Quando un blocco su /phpBB/index.php è impostato per visualizzare su **Hide on child route**, il blocco verrà visualizzato su /phpBB/index. hp (percorso principale) ma non sui suoi percorsi figli
    * Quando un blocco su /phpBB/index.php è impostato per visualizzare su **Mostra solo su percorsi figli**, verrà visualizzato su /phpBB/Movies/index. hp e /phpBB/Movies/page.php (percorsi figli) ma non su /phpBB/index.php (parent), né /phpBB/Movies/Comedy/index.php (andiamo solo un livello profondo)
    * Quando un blocco su /phpBB/index.php è impostato per visualizzare **sempre** (predefinito), verrà visualizzato su /phpBB/index. hp (genitore), /phpBB/Movies/index.php e /phpBB/page.php (itinerari figli) ma non su /phpBB/Movies/Comedy/index.php (andiamo solo un livello profondo). In questo caso, /phpBB/Movies/Comedy/index.php erediterà dal percorso predefinito (se esiste)

## Stato Futuro Posibile
Sono davvero interessato al tuo feedback in questa zona. La maggior parte degli utenti di phpBB non avrà directory reali come descritto sopra. Così sto pensando di usare la struttura che è definita in un blocco di menu come una struttura di directory virtuale e applicare questa eredità genitore/figlio ad esso. Sto anche considerando di andare oltre un livello profondo. Per piacere, fatemi sapere se questo sarà utile per voi.