---
title: Impostazione di un layout predefinito
sidebar_position: 4
---

Quando si aggiunge un blocco, viene aggiunto a quella pagina specifica. Sarebbe quindi un compito noioso impostare blocchi per tutte le pagine sul tuo sito. È possibile impostare tutti i blocchi desiderati per una particolare pagina, quindi impostare quella pagina come layout predefinito. In altre parole, qualsiasi pagina che non abbia blocchi propri, erediterà blocchi da questa pagina.

Per impostare un layout predefinito
* Vai alla pagina che vuoi impostare come layout predefinito
* Clicca su `Impostazioni` nella barra di amministrazione
* Fare clic sul pulsante `Imposta come layout predefinito`

Diciamo che aggiungiamo blocchi a una pagina (phpBB/index.php) con blocchi nella barra laterale e nelle posizioni superiori, ad esempio, e lo impostiamo come layout predefinito. Questo ha i seguenti effetti per altre pagine:
* Qualsiasi pagina che non abbia i propri blocchi, erediterà i blocchi dal layout predefinito. Vedi [Comprendere l'eredità di blocco](/docs/user/site/block-inheritance) per le eccezioni.
* Puoi ancora ereditare blocchi da un layout predefinito (indice. hp) ma scegliere di non visualizzare blocchi su alcune posizioni di blocco o non visualizzare alcun blocco a tutti. Per fare questo,
    * Vai alla pagina che non vuoi che vengano visualizzati tutti/alcuni blocchi
    * Clicca su `Impostazioni` nella barra di amministrazione
    * Seleziona `Non mostrare blocchi su questa pagina` se non vuoi ereditare/visualizzare nessun blocco su questa pagina O
    * Usa CTRL + clicca per selezionare le posizioni del blocco (a destra) su cui non vuoi visualizzare i blocchi
* In `edit mode`, una pagina che eredita blocchi dal layout predefinito, non mostrerà alcun blocco, dandoti la possibilità di aggiungere blocchi alla pagina se vuoi
* Qualsiasi pagina che ha i suoi blocchi non erediterà dal layout predefinito
