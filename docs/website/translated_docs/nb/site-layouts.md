---
id: Sidens oppsett
title: Oppsett
---

«Oppsett» bestemmer de tilgjengelige blokkposisjonene og hvordan de vises.

## Blokker posisjoner

Blokkposisjonene er forhåndsdefinerte områder på nettstedet ditt der det finnes blokker De tilgjengelige blokkposisjonene bestemmes av malens stil du bruker. For røvere, phpBB SiteMaker kommer med følgende blokkposisjoner: * panel: full bredde over toppen * sidestolpe: venstre/høyre avhengig av oppsettet under * delinnhold: lik bare større * top_hor: horisontale blokker over toppen, flankegang over sidebar/underinnhold avhengig av oppstilling * øverst: over hovedinnhold * boks: lik bredde, horisontale blokker under hovedinnholden * nederst: under hovedinnhold * bunn_hor: horisontale blokker utover på bunnen, å flankere side-/underinnhold avhengig av oppsett * bunntekst: horisontale blokker i bunnteksten Du kan legge til flere blokkposisjoner i dine egne stilmaler ved å kopiere og endre de tilsvarende phpBB SiteMaker malene

## Side Oppsett

Du kan velge oppsettet for din nettside i ACP (Extensions > Sitemaker > Settings): * **Blogg**: underinnhold og sidestolpe ved siden av hverandre, dyttet til høyre, topp_hor/botom_hor flankeseddel * **Den hellige gril**: lik bredde sidestolpe og underinnhold på motsatte sider, topp_hor/botom_hor flank subinnhold * **Portal**: sidestolpe til venstre, underinnhold til høyre, topp_hor/botom_hor flankert delinnhold * **Portal Alt**: underinnhold til venstre, sidepanel til høyre, topp_hor/botom_hor flankeside sidestolpe * **Egendefinert**: Angi bredden på sidestolpene som px, %, em eller rem. Standardverdi for 200 px på hver side

## Egendefinerte maler/stiler

Så mye som mulig Vi forsøkte å legge til designmalfiler og filer i stiler/alle/mappe slik at du kan overskrive dem ved å opprette en fil med samme navn under ditt eget maltema . . proselver. Hvis du ønsker å endre hvordan et bestemt blokkskjermer, eller hvis du vil lage ditt eget oppsett med dine egne blokkposisjoner, du trenger bare å opprette en fil med samme navn og sti som originalen i din egen stil.

Hvis du trenger å tilpasse CSS/JS-filer, ta en titt på [tema](./developer-theming.md) delen.