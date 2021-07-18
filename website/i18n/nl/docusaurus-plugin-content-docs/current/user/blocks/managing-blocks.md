---
title: Blokken beheren
sidebar_position: 3
---

Om blokken in phpBB SiteMaker te beheren, moet je in [Wijzig modus](./overview#edit-mode).

> Wanneer een blok geen inhoud weergeeft, wordt deze niet weergegeven, behalve in de bewerkingsmodus. Op die manier kunt u de inhoud geven (in het geval van het eigen blok) of de instellingen ervan wijzigen.

> In bewerkingsmodus, de enigszins transparante blokken zijn blokken die anders niet worden weergegeven maar alleen worden weergegeven omdat we in bewerkingsmodus zijn

## Blokken toevoegen
U kunt blokken toevoegen aan elke voorkant pagina, behalve het User Control Panel en Moderator Control Panel pagina's. Om een blok toe te voegen moet je:
* klik op **Blokken** in de beheerbalk. Dit zal een lijst met beschikbare blokken weergeven
* Slepen en neerzetten van het gewenste blok naar elke blok positie

## Blokken bewerken
### Een blokpictogram toevoegen
Aan de linkerkant van de bloktitel (prozilver) is er een vak voor het blokpictogram. Klik op deze box om de icoon kiezer te krijgen. Je kunt de pictogramgrootte selecteren, kleur, float, rotatie, enz.

### Wijzigt de bloktitel
phpBB SiteMaker blokken hebben een standaard, vertaalde titel, maar als de titel niet aan uw behoeften voldoet, kunt u het veranderen. Om de titel van het blok te bewerken
* Klik op de bloktitel om een inline wijzigingsformulier te krijgen
* Verander de titel naar wat je maar wilt
* Verwijder focus van het veld of druk op enter om wijzigingen in te dienen

> De aangepaste bloktitel is niet vertaald

> Om terug te keren naar de standaard titel, verwijder eenvoudig de titel en druk op enter

### Blok instellingen bewerken
Wanneer je over een blok beweegt, verschijnt er een tandrad-icoontje rechts van het blok dat kan worden gebruikt om het blok te bewerken. In het block-dialoogvenster kunt u:
- Inschakelen/uitschakelen van een blok [Status]
- Kies wanneer het blok niet moet worden weergegeven/weergegeven [Display]. Dit geldt alleen in gevallen waar u geneste pagina's hebt (zie [Begrijp Blok Overerving](/docs/user/site/block-inheritance)):
    - **Altijd**: Toon altijd het blok
    - **Verberg bij subroutes**: Toon dit blok alleen op de bovenliggende route
    - **Toon alleen bij onderliggende routes**: Toon dit blok alleen op een onderliggende route
- Kies welke groepen gebruikers het blok kunnen bekijken [Weergeven door]. Gebruik CTRL + klik om meerdere groepen te selecteren.
- Stel aangepaste klassen in om het uiterlijk van het blok of items te wijzigen (lijsten, afbeeldingen, achtergrond, enz.) binnen het blok [CSS Class]
- Toon/Verberg de bloktitel [Verberg bloktitel?]
- Selecteer de blok weergave [Blok weergave]. U kunt een standaard blokweergave selecteren wanneer nieuwe blokken worden toegevoegd aan ACP.
    - **Standaard / Eenvoudig**: gebruik de klasse van het prozilveren paneel om het blok in een gewatteerde container te omhullen
    - **Basis**: Blok heeft geen containerverpakking
    - **Ingeschakeld**: gebruikt de prozilver forabg class om het blok in een doos te wikkelen
- Set / Update blok specifieke instellingen
- Als je hetzelfde blok met dezelfde instellingen over meerdere pagina's hebt, je kan ze allemaal tegelijk bijwerken door de **Update blokken met vergelijkbare instellingen** te controleren

## Blokken verwijderen
- Beweeg over het blok dat u wilt verwijderen
- Klik op het pictogram **x** en bevestig dat je het blok wilt verwijderen
- Ga omhoog naar de admin balk en klik op `Wijzigingen opslaan`
