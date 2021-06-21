---
id: layout-predefinito-sito
title: Impostazione Layout Predefinito
---

Quando aggiungi un blocco, viene aggiunto a quella pagina specifica. Sarebbe quindi noioso fissare blocchi per tutte le pagine del tuo sito. Puoi impostare tutti i blocchi desiderati per una pagina particolare, quindi impostare quella pagina come layout predefinito. In altre parole, qualsiasi pagina che non ha i propri blocchi, erediterà blocchi da questa pagina.

Per impostare un layout predefinito * Vai alla pagina che vorresti impostare come layout predefinito * Clicca su `Impostazioni` nella barra di amministrazione * Clicca sul `impostato come layout predefinito`

Dici che aggiungiamo blocchi a una pagina (phpBB/index.php) con blocchi nella barra laterale e posizioni top, ad esempio, e impostalo come nostro layout predefinito. Questo ha i seguenti effetti per altre pagine: * Qualsiasi pagina che non ha i propri blocchi, erediterà i blocchi dal layout predefinito. Vedi [Understanding Block Inheritance](./blocks-inheritance.md) per eccezioni. * Puoi ancora ereditare blocchi da un layout predefinito (index.php) ma scegliere di non visualizzare blocchi su alcune posizioni di blocco o di non visualizzare alcun blocco. To do this, * Go to the page that you don't want all/some blocks to display * Click on `Settings` in the admin bar * Select `Do not show blocks on this page` if you don't want to inherit/display any blocks on this page OR * Use CTRL + click to select the block positions (on the right) that you do not want to display blocks on * In `edit mode`, a page that inherits blocks from the default layout, will not show any blocks, giving you the opportunity to add blocks to the page if you want to * Any page that has its own blocks will not inherit from the default layout