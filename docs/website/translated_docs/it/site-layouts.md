---
id: layout-sito
title: Layout
---

"Disposizioni" determina le posizioni dei blocchi disponibili e come vengono visualizzate.

## Posizione blocco

Le posizioni bloccate sono aree predefinite sul tuo sito dove possono esistere blocchi. Le posizioni di blocco disponibili sono determinate dallo stile del template che stai usando. Per prosilver, phpBB SiteMaker è dotato delle seguenti posizioni a blocco: * pannello: larghezza intera in alto * barre laterali: sinistra/destra a seconda del layout sottostante * sottodomino: simile alla barra laterale appena più grande * top_hor: blocchi orizzontali in alto fianco sopra la barra laterale/sotto-contenuto a seconda del layout * superiore: sopra il contenuto principale * casella: larghezza uguale, blocchi orizzontali sotto il contenuto principale * bassi: sotto il contenuto principale * inferiore: blocchi orizzontali oltre il basso, fiancheggiando la barra laterale/sotto-contenuto a seconda del layout * footer: blocchi orizzontali nel piè di pagina È possibile aggiungere ulteriori punti nei propri modelli di stile copiando e modificando i corrispondenti modelli phpBB SiteMaker

## Layout Sito

Puoi scegliere il layout per il tuo sito in ACP (Esiche > Sitemaker > Impostazioni): * **Blog**: sottocontenuto e barra laterale vicini l'uno all'altro spinto a destra, top_hor/botom_hor di sottodolore fianco * **Sacro Grail**: larghezza uguale della barra laterale e sottodimensionamento sul lato opposto top_hor/botom_hor sotto-content flank * **Portale**: sidebar a sinistra, sottodominio a destra, sottocontenuto top_hor/botom_hor flank * **Portal Alt**: sottocontenuto a sinistra, sidebar a destra top_hor/botom_hor Sidebar flank * **Custom**: Imposta manualmente la larghezza della barra laterale come px, %, em o rem. Default a 200px su ogni lato

## Modelli/stili personalizzati

Per quanto possibile, abbiamo provato a mettere i file del modello e gli asset nella cartella stili/tutti/ in modo da poterli sovrascrivere creando un file con lo stesso nome sotto il tuo tema modello, ad esempio prosilver. Quindi, se vuoi modificare come viene visualizzato un determinato blocco o se vuoi creare un layout con le tue posizioni di blocco, devi semplicemente creare un file con lo stesso nome e percorso dell'originale nel tuo stile.

Se hai bisogno di personalizzare i file CSS/JS, dai un'occhiata alla sezione [del tema](./developer-theming.md).