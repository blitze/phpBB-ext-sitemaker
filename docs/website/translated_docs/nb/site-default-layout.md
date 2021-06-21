---
id: site-default-layout
title: Angi en standard oppsett
---

Når du legger til en blokk, er den lagt til den bestemte siden. Det vil derfor være en kjedelig oppgave å sette blokker for alle sidene på ditt nettsted. Du kan angi alle ønskede blokker for en bestemt side, og deretter angi denne siden som standardoppsett. Med andre ord vil hvilken som helst side som ikke har sine egne blokker arve blokker fra denne siden.

For å sette et standard oppsett * Gå til siden du vil sette som standard oppsett * Klikk `Innstillinger` i admin-linjen * Klikk på `som standard knapp for oppsett`

Si vi legger til blokker til en side (phpBB/index.php) med blokker i sidepanelet og de øverste posisjonene, for eksempel, og sett den som standard oppsett. Dette har følgende effekter på andre sider: * En side som ikke har sine egne blokker, vil arve blokkene fra standardoppsettet. Se [Understå blokkarving](./blocks-inheritance.md) for unntak. * Du kan fremdeles arve blokker fra et standardoppsett (index. hp) men velg å ikke vise blokker på enkelte blokkposisjoner, eller ikke vise noen blokker i det hele tatt. To do this * Gå til siden du ikke vil at alle/noen blokker skal vises * Klikk `Innstillinger` på admin-linjen * Velg `Ikke vis blokker på denne siden` hvis du ikke vil arv / vise blokker på denne siden ELLER * Bruk CTRL + klikk for å velge blokkposisjonene (til høyre) at du ikke ønsker å vise blokker på * I `redigeringsmodus`, . en side som arver blokker fra standardoppsettet, vil ikke vise noen blokker, gi deg muligheten til å legge til blokker til siden dersom du vil * En side med egne blokker vil ikke arve den fra standardoppsettet