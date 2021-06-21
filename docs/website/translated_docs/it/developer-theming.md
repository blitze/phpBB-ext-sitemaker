---
id: tema-sviluppatore
title: Tema
---

phpBB SiteMaker viene con stili e colori realizzati per il prosilver. Puoi sovrascrivere i file CSS, JS e HTML creando il file corrispondente nella cartella del tuo stile.

# Creazione di file JS/CSS per il tuo stile

Nota: * Per le istruzioni qui sotto, supponiamo che tu abbia uno stile chiamato il mio stile.

Clona in phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Dalla linea di comando vai alla directory sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Installa venditori**

    installazione compositore
    

**Installa pacchetti**

Per i comandi qui sotto puoi usare npm o [yarn](https://yarnpkg.com)

    installa yarn
    

**Guarda le modifiche**

    yarn start --theme-style
    

**Crea modifiche**

* Effettua le modifiche ai file nella cartella phpBB/ext/blitze/sitemaker/develop.
* Guarda phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss per le variabili sass

**Costruisci Risorse**

    yarn build --theme-style
    

**Deploy**

Ora puoi copiare i file generati da phpBB/ext/blitze/sitemaker/stili/mio-style e caricarli sul tuo server di produzione.

> Questa estensione utilizza jQuery UI per schede, finestre e pulsanti. Il tema predefinito jQuery è 'fluido.' Puoi utilizzare un altro tema jQuery UI che meglio si adatta al tuo tema. È possibile specificare il tema jQuery UI utilizzando il flag --jq_ui_theme. Per esempio:

    yarn build --theme my-style --jq_ui_theme ui-lightness