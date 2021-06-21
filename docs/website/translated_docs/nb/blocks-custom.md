---
id: blokkers-egendefinert
title: Egendefinert blokk
---

Hvis tilgjengelige blokker ikke gir deg den friheten du trenger, Det er `Egendefinerte blokker` som lar deg friheten til å vise ditt eget innhold ved hjelp av BBcode eller HTML. Blokken kommer med en WYSIWYG editor (TinyMCE) og administrerer:

## Redaktør

- Du kan bruke redigeringsprogrammet for å lage HTML-innhold
- Du kan redigere kildekoden hvis du trenger det kontrollnivået ved å klikke på `Kildekode` -ikonet (`<>`) i editoren
- Redigeringsprogrammet lar deg laste opp og endre bilder 
    - Det oppretter en ny mappe i phpBB/images/sitemaker_uploads/ for alle brukere som har tilgang til den
    - Du kan se/behandle alle brukermapper
- Redigeringsprogrammet filtrerer ut potensielt farlige skripter som javascript, osv. Hvis du trenger å legge til innhold som google annonser, vil JavaScript filtreres ut, men det kan du komme deg rundt ved å gjøre følgende: 
    - Legg til den egendefinerte blokken til ønsket sted
    - Rediger egendefinert blokk, klikk på `HTML` og lim inn Javascript

## Skript behandler

Den egendefinerte blokken lar deg også legge til egendefinerte CSS-filer til siden din. Å gjøre dette:

- Legg til en `egendefinert blokk` i hvilken som helst blokkposisjon. Denne posisjonen spiller ingen rolle med mindre du også viser innhold med blokken
- Rediger blokken, klikk på `Scripts` fanen og legg til dine CSS eller Javascript-filer > Varsomhet med ord: Legg til i mange skript på siden kan påvirke lastetiden