---
title: Oppsett
sidebar_position: 1
---

«Oppsett» bestemmer de tilgjengelige blokkposisjonene og hvordan de vises.

## Blokker posisjoner
Blokkposisjonene er forhåndsdefinerte områder på nettstedet ditt der det finnes blokker De tilgjengelige blokkposisjonene bestemmes av malens stil du bruker. For prosilver følger phpBB SiteMaker med følgende blokkposisjoner:
* full bredde på tvers av toppsiden
* sidelinje: venstre/høyre, avhengig av oppsettet nedenfor
* underinnhold: lik sidepanelet bare større
* topp_hest: horisontale blokker over toppen, flankene over sidestolpen/delinnhold avhengig av oppsettet
* topp: over hovedinnhold
* boks: lik bredde, horisontale blokker under hovedinnhold
* bunn: under hovedinnhold
* bunn_hest: horisontale blokker over bunnen, flankere sidelinjen/delinnhold avhengig av oppsettet
* bunntekst: horisontale blokker i bunnteksten Du kan legge til flere blokkposisjoner i dine egne stilmaler ved å kopiere og endre de tilsvarende phpBB SiteMaker malene

## Side Oppsett
You can choose the layout for your site in ACP (Extensions > Sitemaker > Settings):
* **Blog**: underinnhold og sidestolpe ved siden av hverandre, dyttet til høyre, topp_hor/botom_hor flanke delinnhold
* **Den Hellige Grå**: lik bredde sidestolpe og underinnhold på motsatte sider, tover/hor/botom_hor flank subinnhold
* **Portal**: sidepanel til venstre, underinnhold til høyre, topp_hor/botom_hor flank underinnhold
* **Portal ALT**: underinnhold til venstre, sidepanelet til høyre, top_hor/botom_hor flank sidestolpe
* **Egendefinert**: Angi sidestolpebredden som px, %, em eller rem. Standardverdi for 200 px på hver side

## Egendefinerte maler/stiler
Så mye som mulig Vi forsøkte å legge til designmalfiler og filer i stiler/alle/mappe slik at du kan overskrive dem ved å opprette en fil med samme navn under ditt eget maltema . . proselver. Hvis du ønsker å endre hvordan et bestemt blokkskjermer, eller hvis du vil lage ditt eget oppsett med dine egne blokkposisjoner, du trenger bare å opprette en fil med samme navn og sti som originalen i din egen stil.

Hvis du trenger å tilpasse CSS/JS-filer, ta en titt på [tema](/docs/dev/theming) delen.