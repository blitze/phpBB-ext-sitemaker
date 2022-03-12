---
id: Blokk-styring
title: Mananaging Blocks
---

For å behandle blokker i phpBB SiteMaker, må du være i [Redigeringsmodus](./blocks-overview#edit-mode).

> Når en blokk ikke viser noe innhold, vises den ikke unntatt i redigeringsmodus. På den måten kan du enten gi det innhold (i tilfelle av "Tilpasset"-blokken) eller endre innstillingene.
> 
> I redigeringsmodus, de litt gjennomsiktige blokkene er blokker som ellers ikke vil vises, men bare vises fordi vi er i redigeringsmodus

## Legger til blokker

Du kan legge til blokker til alle sider på siden, unntatt Brukerkontrollpanelet og Moderator kontrollpanelet. For å legge til en blokk må du * klikke på **Blokker** på Admin-feltet. Dette vil vise en liste over tilgjengelige blokker * Dra og slipp den ønskede blokken til enhver blokkplassering

## Redigerer blokker

### Legge til et blokk-ikon

Til venstre for blokktittelen (prosilver) er det en boks for blokkens ikon. Klikk på denne boksen for å få ikonvelgeren. Du kan velge ikonstørrelsen, farge, gulv, rotasjon, osv.

### Redigering av tittel på blokken

phpBB SiteMaker blokker vil ha en standard, oversatt tittel, men hvis tittelen ikke oppfyller dine behov, kan du endre den. For å redigere blokktittelen, * Klikk på blokktittelen for å få et skjema for redigering * Endre tittelen til hva du vil * Fjern fokus fra feltet eller trykk på enter for å sende inn endringer

> Din modifisert blokk tittel er ikke oversatt
> 
> For å gå tilbake til standardtittelen, enkelt slett tittelen og treff angi

### Redigerer blokkinnstillinger

Når du holder musepekeren over en blokk, vil det se ut et cog-ikon til høyre for blokken som kan brukes til å redigere blokken. I dialogboksen for redigering kan du: - Aktiver/deaktivere en blokk [Status] – Velg når blokken bør/ikke vises [Display]. Dette gjelder bare i tilfeller der du har nestede sider (se [Understanding Block Inheritance](./blocks-inheritance.md)): - **Alltid**: Vis alltid blokk - **Skjul på underveger**: Bare vis denne blokken på overordnet rute - **Vis kun underordnede ruter**: Bare vis denne blokken på en underordnet rute - Velg hvilke brukergrupper som kan vise blokken [Synlig av]. Bruk CTRL + klikk for å velge flere grupper. - Angi egendefinerte klasser for å endre utseendet til blokken eller elementer (lister, bilder, bakgrunn, etc) i blokken [CSS Class] - Vis/skjul blokktittelen [Skjul blokktittel? - Velg blokkvisning [Block view]. Du kan velge en standard blokkvisning når nye blokker er lagt til i ACP. - **Standard / Simple**: bruker prosilver panelklassen til å pakke inn blokken i en polert beholder - **Vanlig**: blokken har ingen beholder innpakning - **i boks**: bruker antakerens glemmelighet til å pakke blokken i en boks - Sett / Oppdater blokk spesifikke innstillinger - Hvis du har samme blokk med samme innstillinger på tvers av flere sider, du kan oppdatere alle blokkene på en gang ved å sjekke oppdateringsblokkene **med lignende innstillinger**

## Sletter blokker

- Hold over blokken du ønsker å slette
- Klikk på **x** -ikonet og bekreft at du ønsker å slette blokken
- Gå opp til admin-baren og klikk på `Lagre endringer`