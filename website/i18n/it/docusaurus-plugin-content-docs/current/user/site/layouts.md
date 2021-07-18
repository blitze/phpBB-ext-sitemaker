---
title: Layout
sidebar_position: 1
---

"Layouts" determina le posizioni dei blocchi disponibili e come vengono visualizzate.

## Posizioni A Blocchi
Le posizioni di blocco sono aree predefinite sul tuo sito dove i blocchi possono esistere. Le posizioni dei blocchi disponibili sono determinate dallo stile del modello che stai utilizzando. Per prosilver, phpBB SiteMaker viene fornito con le seguenti posizioni di blocco:
* pannello: tutta la larghezza in alto
* barra laterale: sinistra/destra a seconda del layout sottostante
* contenuto: simile alla barra laterale appena più grande
* top_hor: blocchi orizzontali in alto, fiancheggiando sopra la barra laterale/sotto-contenuto a seconda del layout
* top: sopra il contenuto principale
* scatola: larghezza uguale, blocchi orizzontali sotto il contenuto principale
* in basso: sotto il contenuto principale
* bottom_hor: blocchi orizzontali attraverso il fondo, affiancando la barra laterale/il sotto-contenuto a seconda del layout
* piè di pagina: blocchi orizzontali nel piè di pagina Puoi aggiungere più posizioni di blocco nei tuoi modelli di stile copiando e modificando i modelli phpBB SiteMaker corrispondenti

## Layout Del Sito
È possibile scegliere il layout per il vostro sito in ACP (Estensioni > Sitemaker > Impostazioni):
* **Blog**: sotto-contenuto e barra laterale uno accanto all'altro, spinti a destra, sotto-contenuto top_hor/botom_hor
* **Santo Graal**: pari larghezza sidebar e sotto-contenuto sui lati opposti, sotto-contenuto top_hor/botom_hor
* **Portale**: barra laterale a sinistra, sotto-contenuto a destra, sotto-contenuto top_hor/botom_hor
* **Portal Alt**: sotto-contenuto a sinistra, barra laterale a destra, top_hor/botom_hor barra laterale
* **Personalizzato**: Imposta manualmente la larghezza delle barre laterali come px, %, em o rem. Predefiniti a 200px su ogni lato

## Modelli/stili personalizzati
Per quanto possibile, abbiamo cercato di mettere i file di template e le risorse in stili/all/ cartella in modo che tu possa sovrascriverli creando un file con lo stesso nome sotto il tuo tema template e. . prosilver. Quindi, se si desidera modificare come un determinato blocco visualizza o se si desidera creare il proprio layout con le proprie posizioni di blocchi, devi semplicemente creare un file con lo stesso nome e lo stesso percorso dell'originale nel tuo stile.

Se hai bisogno di personalizzare i file CSS/JS, dai un'occhiata alla sezione [theming](/docs/dev/theming).