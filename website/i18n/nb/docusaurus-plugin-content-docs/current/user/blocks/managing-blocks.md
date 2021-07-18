---
title: Mananaging Blocks
sidebar_position: 3
---

For å behandle blokker i phpBB SiteMaker, må du være i [Redigeringsmodus](./overview#edit-mode).

> Når en blokk ikke viser noe innhold, vises den ikke unntatt i redigeringsmodus. På den måten kan du enten gi det innhold (i tilfelle av "Tilpasset"-blokken) eller endre innstillingene.

> I redigeringsmodus, de litt gjennomsiktige blokkene er blokker som ellers ikke vil vises, men bare vises fordi vi er i redigeringsmodus

## Legger til blokker
Du kan legge til blokker til alle sider på siden, unntatt Brukerkontrollpanelet og Moderator kontrollpanelet. For å legge til en blokk må du:
* klikk på **Blokker** i Admin-linjen. Dette vil vise en liste over tilgjengelige blokker
* Dra og slipp den ønskede blokken til en hvilken som helst blokkplassering

## Redigerer blokker
### Legge til et blokk-ikon
Til venstre for blokktittelen (prosilver) er det en boks for blokkens ikon. Klikk på denne boksen for å få ikonvelgeren. Du kan velge ikonstørrelsen, farge, gulv, rotasjon, osv.

### Redigering av tittel på blokken
phpBB SiteMaker blokker vil ha en standard, oversatt tittel, men hvis tittelen ikke oppfyller dine behov, kan du endre den. For å redigere blokktittelen,
* Klikk på blokktittelen for å få et innebygd redigeringsskjema
* Endre tittelen til hva du vil
* Fjern fokus fra feltet eller treff enter for å sende endringer

> Din modifisert blokk tittel er ikke oversatt

> For å gå tilbake til standardtittelen, enkelt slett tittelen og treff angi

### Redigerer blokkinnstillinger
Når du holder musepekeren over en blokk, vil det se ut et cog-ikon til høyre for blokken som kan brukes til å redigere blokken. I dialogboksen for redigering kan du:
- Aktiver/deaktiver en blokk [Status]
- Velg når blokken bør /skal ikke vises [Display]. Dette gjelder bare i tilfeller hvor du har nestede sider (se [Understanding Block Inheritance](/docs/user/site/block-inheritance)):
    - **Alltid**: vis alltid blokken
    - **Skjul på underordnede ruter**: Vis bare denne blokken på overordnet rute
    - **Vis bare på underordnede ruter**: Bare vis denne blokken på en underrute
- Velg hvilke brukergrupper som kan vise blokken [Visbar av]. Bruk CTRL + klikk for å velge flere grupper.
- Velg egendefinerte klasser for å endre utseendet til blokken eller elementer (lister, bilder, bakgrunn, osv.) i blokken [CSS Class]
- Vis/Skjul blokkens tittel [Skjul blokk tittel?]
- Velg blokkvisning [Block view]. Du kan velge en standard blokkvisning når nye blokker er lagt til i ACP.
    - **Standard / Simple**: bruker spennviddens panelklasse til å pakke inn blokken i en polert beholder
    - **Basis**: blokken har ingen endosebeholder innpakking
    - **Bokset**: bruker prositveren forkortelse til å pakke inn blokken i en boks
- Angi / oppdater blokk spesifikke innstillinger
- Hvis du har samme blokk med samme innstillinger på tvers av flere sider, du kan oppdatere alle samtidig ved å sjekke **Oppdateringsblokkene med lignende innstillinger**

## Sletter blokker
- Hold over blokken du ønsker å slette
- Klikk på **x** -ikonet og bekreft at du ønsker å slette blokken
- Gå opp til admin-baren og klikk på `Lagre endringer`
