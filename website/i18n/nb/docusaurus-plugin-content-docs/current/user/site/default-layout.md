---
title: Angi en standard oppsett
sidebar_position: 4
---

Når du legger til en blokk, er den lagt til den bestemte siden. Det vil derfor være en kjedelig oppgave å sette blokker for alle sidene på ditt nettsted. Du kan angi alle ønskede blokker for en bestemt side, og deretter angi denne siden som standardoppsett. Med andre ord vil hvilken som helst side som ikke har sine egne blokker arve blokker fra denne siden.

Hvis du vil angi et standardoppsett
* Gå til siden du ønsker å sette som standardoppsett
* Klikk på `Innstillinger` i admin-linjen
* Klikk på `Sett som standard oppsett` -knappen

Si vi legger til blokker til en side (phpBB/index.php) med blokker i sidepanelet og de øverste posisjonene, for eksempel, og sett den som standard oppsett. Dette har følgende effekter for andre sider:
* Hvilken som helst side ikke har egne blokker, vil arve blokkene fra standardoppsettet. Se [Understå blokkarving](/docs/user/site/block-inheritance) for unntak.
* Du kan fremdeles arve blokker fra et standardoppsett (index. hp) men velg å ikke vise blokker på enkelte blokkposisjoner, eller ikke vise noen blokker i det hele tatt. To do this
    * Gå til siden du ikke vil at alle / noen blokker skal vises
    * Klikk på `Innstillinger` i admin-linjen
    * Velg `Ikke vis blokker på denne siden` hvis du ikke vil arve/vise noen blokker på denne siden ELLER
    * Bruk CTRL + klikk for å velge blokkposisjonene (til høyre) som du ikke vil vise blokker på
* I `redigeringsmodus`kan en side som arver blokker fra standardoppsettet. vil ikke vise noen blokker, noe som gir deg muligheten til å legge til blokker til siden om du ønsker å
* Enhver side som har egne blokker vil ikke arve fra standardoppsettet
