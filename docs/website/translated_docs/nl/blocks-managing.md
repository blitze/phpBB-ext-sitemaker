---
id: blokken-beheer
title: Blokken beheren
---

Om blokken in phpBB SiteMaker te beheren, moet u in [Bewerkingsmodus](./blocks-overview#edit-mode) zijn.

> Wanneer een blok geen inhoud toont, zal het niet worden weergegeven, behalve in bewerkmodus. Op die manier kunt u het inhoud geven (in het geval van het aangepaste blok) of de instellingen wijzigen.
> 
> In bewerkmodus zijn de enigszins transparante blokken blokken die anders niet worden weergegeven maar alleen worden weergegeven omdat we in bewerkmodus zijn

## Blokken toevoegen

U kunt blokken toevoegen aan elke front-facing pagina, behalve de User Control Panel en de Moderator Control Panel pagina's. Om een blok toe te voegen moet u * klikken op **blokken** in de Admin balk. Dit toont een lijst van beschikbare blokken * Sleep en laat het gewenste blok naar een blok positie

## Blokken bewerken

### Een blok icoon toevoegen

Aan de linkerkant van de bloktitel (prosilver), is er een vak voor het blokpictogram. Klik op dit vak om de pictogrammenkiezer te krijgen. U kunt de grootte van het pictogram selecteren, kleur, zwevend, rotatie, enz.

### Bloktitel bewerken

phpBB SiteMaker blokken zullen een standaard, vertaalde titel hebben, maar als de titel niet voldoet aan uw behoeften, kunt u deze wijzigen. Om de bloktitel te bewerken, * Klik op de bloktitel om een inline bewerkformulier te krijgen * Verander de titel naar wat je wilt * Verwijder de focus uit het veld of klik op enter om wijzigingen in te dienen

> Uw aangepaste block titel is niet vertaald
> 
> Om terug te keren naar de standaardtitel, verwijder de titel en druk op enter

### Bewerken block instellingen

Wanneer je over een blok zweeft, zal een cog icoon naar rechts van het blok verschijnen dat gebruikt kan worden om het blok te bewerken. In het bewerk block dialoogvenster kunt u: - In- of uitschakelen van een blok [Status] - Kies wanneer het blok niet moet worden weergegeven [Display]. Dit is alleen van toepassing in de gevallen waarin je geneste pagina's hebt (zie [Understanding Block Inheritance](./blocks-inheritance.md)): - **Altijd**: altijd het blok - **Verbergen op onderliggende routes**: Toon alleen dit blok op de bovenliggende route - **Toon alleen op onderliggende routes**: Toon alleen dit blok op een onderliggende route - kies welke groepen het blok kunnen bekijken [Bekijk]. Gebruik CTRL + klik om meerdere groepen te selecteren. - Stel aangepaste klassen in om het uiterlijk van het blok of items (lijsten, afbeeldingen, achtergrond, enz) te wijzigen in het blok [CSS Class] - Toon/Verberg de bloktitel [Hide block title?] - Selecteer de blokweergave [Block view]. U kunt een standaard blokweergave selecteren wanneer nieuwe blokken worden toegevoegd in de ACS. - **Standaard / Eenvoudige**: maakt gebruik van de prosilver panel class om het blok in een geplakte container - **Basis**: blok bevat geen container verpakking - **Gebogen**: gebruikt de prosilver forg klasse om het blok in een box te verwerken, - Zet / Update blok specifieke instellingen - als je hetzelfde blok hebt met dezelfde instellingen op meerdere pagina's, je kunt ze allemaal tegelijk updaten door de **Update blokken te controleren met soortgelijke instellingen**

## Blokken verwijderen

- Beweeg over het blok dat je wilt verwijderen
- Klik op het pictogram **x** en bevestig dat u het blok wilt verwijderen
- Ga naar de admin balk en klik op `Wijzigingen opslaan`