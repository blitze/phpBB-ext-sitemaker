---
title: Brugerdefineret Blok
sidebar_position: 4
---

Hvis de tilgængelige blokke ikke giver dig den frihed, du har brug for, der er `Custom Block` , som giver dig frihed til at vise dit eget indhold ved hjælp af BBcode eller HTML. Blokken kommer med en WYSIWYG editor (TinyMCE) og en scripts manager:

## Redaktøren

-   Du kan bruge editoren til at oprette HTML-indhold
-   Du kan redigere kildekoden, hvis du har brug for dette kontrolniveau ved at klikke på ikonet `Kildekode` (`<>`) i editoren
-   Editoren giver dig mulighed for at uploade og ændre billeder
    -   Det skaber en ny mappe i phpBB/images/sitemaker_uploads / for hver bruger, der har adgang til det
    -   Du kan se/administrere alle brugermapper
-   Editoren filtrerer alle potentielt farlige scripts som javascript, osv. Hvis du har brug for at tilføje indhold som google annoncer, javascript vil blive filtreret ud, men du kan komme rundt at ved at gøre følgende:
    -   Tilføj den brugerdefinerede blok til den ønskede placering
    -   Rediger den brugerdefinerede blok, klik på `HTML` fanen og indsæt din Javascript

## Scripts Håndtering

Brugerdefineret blok giver dig også mulighed for at tilføje brugerdefinerede CSS og Javascript filer til din side. For at gøre dette:

-   Tilføj en `brugerdefineret blok` til enhver blok position. Positionen er ligegyldig, medmindre du også viser indhold med blokken
-   Rediger blokken klik på fanen `Scripts` og tilføj dine CSS eller Javascript filer > Word af forsigtighed selvfølgelig: Tilføjelse til mange scripts på din side kan påvirke indlæsningstider
