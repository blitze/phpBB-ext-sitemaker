---
title: Håndtering Af Blokke
sidebar_position: 3
---

For at administrere blokke i phpBB SiteMaker, skal du være i [Rediger tilstand](./overview#edit-mode).

> Når en blok ikke viser noget indhold, vil den ikke blive vist, undtagen i redigeringstilstand. På den måde kan du enten give det indhold (i tilfælde af den brugerdefinerede blok) eller ændre dens indstillinger.

> I redigeringstilstand de noget gennemsigtige blokke er blokke, der ellers ikke vil blive vist, men kun bliver vist, fordi vi er i redigeringstilstand

## Tilføjer blokke
Du kan tilføje blokke til enhver front-facing side, undtagen User Control Panel og Moderator Control Panel sider. For at tilføje en blok, skal du:
* klik på **Blokke** i administratorlinjen. Dette vil vise en liste over tilgængelige blokke
* Træk og slip den ønskede blok til enhver blokposition

## Redigering af blokke
### Tilføjer et blokikon
Til venstre for blokkens titel (forsølv), er der en boks til blokikonet. Klik på dette felt for at få ikonvælgeren. Du kan vælge ikonstørrelse, farve, float, rotation, osv.

### Redigering af blok titel
phpBB SiteMaker blokke vil have en standard, oversat titel, men hvis titlen ikke opfylder dine behov, kan du ændre den. For at redigere blokkens titel,
* Klik på blokkens titel for at få en inline redigeringsformular
* Ændre titlen til hvad du ønsker
* Fjern fokus fra feltet eller tryk enter for at indsende ændringer

> Din ændrede bloktitel er ikke oversat

> For at vende tilbage til standard titel, skal du slette titlen og trykke på enter

### Redigerer blokindstillinger
Når du svæver over en blok, vises et cog ikon til højre for blokken, der kan bruges til at redigere blokken. I redigeringsblok-dialogen, kan du:
- Aktiver/deaktiver en blok [Status]
- Vælg, hvornår blokken skal/bør ikke vises [Display]. Dette gælder kun i tilfælde, hvor du har indlejrede sider (se [Forståelse blok arv](/docs/user/site/block-inheritance)):
    - **Altid**: Vis altid blokken
    - **Skjul på under-ruter**: Vis kun denne blok på den overordnede rute
    - **Vis kun på under-ruter**: Vis kun denne blok på en under-rute
- Vælg hvilke grupper af brugere der kan se blokken [Kan ses af]. Brug CTRL + klik for at vælge flere grupper.
- Sæt brugerdefinerede klasser til at ændre udseendet af blokken eller elementer (lister, billeder, baggrund osv.) i blokken [CSS klasse]
- Vis/skjul blok titel [Skjul blok titel?]
- Vælg blokvisningen [Blokér visning]. Du kan vælge en standard blok visning, når nye blokke er tilføjet i ACP.
    - **Standard / Simple**: bruger prosilver panel klasse til at ombryde blokken i en polstret beholder
    - **Basic**: blok har ikke nogen container indpakning det
    - **Boxed**: bruger forsølv forabg klasse til at pakke blokken i en boks
- Sæt / Opdater blokspecifikke indstillinger
- Hvis du har den samme blok med samme indstillinger på tværs af flere sider, du kan opdatere dem alle på én gang ved at kontrollere **Opdater blokke med lignende indstillinger**

## Sletter blokke
- Hold musen over den blok, du vil slette
- Klik på **x** ikonet og bekræft, at du ønsker at slette blokken
- Gå op til admin bjælken og klik på `Gem ændringer`
