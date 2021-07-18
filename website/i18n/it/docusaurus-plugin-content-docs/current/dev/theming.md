---
title: Temi
sidebar_position: 3
---

Comprendiamo che i file modello e i file JS/CSS non funzioneranno per ogni stile, così di seguito sono alcuni modi in cui è possibile utilizzare i propri modelli e creare file JS/CSS per il vostro stile particolare.

## Usare il proprio modello

Se i modelli predefiniti che vengono con phpBB Sitemaker non funzionano bene per il vostro particolare stile, puoi facilmente sovrascriverlo per usare il tuo modello di file creando il file corrispondente nella cartella dei tuoi stili.

Ad esempio, say your style is called `Backlash` and it has a particular way in which the HTML for the block header section need to be structured for the [boxed view](/docs/user/blocks/block-views). È possibile sovrascrivere quel particolare modello creando un file con lo stesso nome così: `phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

In altre parole, per utilizzare il proprio file modello, è necessario:
* Identifica quale file phpBB Sitemaker deve essere sovrascritto
* Crea un file con lo stesso nome nella cartella Sitemaker `stili` sotto il tuo nome di stile

> Nota: Se crei i tuoi file di modello, assicurati di non eliminare la cartella `phpbb/ext/blitze/sitemaker` durante l'aggiornamento dell'estensione come i file personalizzati verranno eliminati. Piuttosto, sovrascrivere i file esistenti con quelli nuovi.

## Creazione di file JS/CSS per il tuo stile

Nota:
* Con lo scopo delle istruzioni di seguito supponiamo che avete uno stile chiamato mio-stile.

Clona in phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Dalla riga di comando vai alla directory sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Installa i fornitori**

    installazione compositore

**Installa pacchetti**

Per i comandi sottostanti puoi usare npm o [yarn](https://yarnpkg.com)

    yarn install

**Guarda Le Modifiche**

    yarn start --theme mio-stile

**Effettua Modifiche**

* Effettua le modifiche ai file nella cartella phpBB/ext/blitze/sitemaker/developing.
* Guardate phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss per le variabili di sass

**Costruisci Risorse**

    yarn build --theme mio-stile

**Dispiega**

Ora puoi copiare i file generati da phpBB/ext/blitze/sitemaker/styles/my-style e caricarli sul tuo server di produzione.

> Questa estensione utilizza jQuery UI per schede, finestre di dialogo e pulsanti. Il tema jQuery predefinito è 'scorrevolezza.' È possibile utilizzare un diverso tema jQuery UI che meglio si adatta al tuo tema. È possibile specificare il tema jQuery UI utilizzando il flag --jq_ui_theme. Per esempio:

    yarn build --theme my-style --jq_ui_theme ui-lightness
