---
title: Layouter
sidebar_position: 1
---

"Layouts" bestämmer de tillgängliga blockpositionerna och hur de visas.

## Blockera positioner
Blockpositioner är fördefinierade områden på din webbplats där block kan existera. De tillgängliga blockpositionerna bestäms av mallens stil som du använder. För prosilver, kommer phpBB SiteMaker med följande blockpositioner:
* panel: full bredd över toppen
* sidofält: vänster/höger beroende på layout nedan
* underinnehåll: liknar sidofältet bara större
* top_hor: horisontella block över toppen, flankerar ovanför sidofältet/underinnehållet beroende på layout
* Topp: ovanför huvudinnehållet
* låda: lika bredd, horisontella block under huvudinnehållet
* botten: under huvudinnehållet
* bottom_hor: horisontella block över botten, flankerar sidofältet/underinnehållet beroende på layout
* sidfot: horisontella block i sidfoten Du kan lägga till fler blockpositioner i dina egna stilmallar genom att kopiera och modifiera motsvarande phpBB SiteMaker-mallar

## Webbplatsens layout
Du kan välja layout för din webbplats i AVS (tillägg > Sitemaker > Inställningar):
* **Blogg**: underinnehåll och sidofält bredvid varandra, pressas till höger, top_hor/botom_hor flank underinnehåll
* **Holy Grail**: lika bredd sidofält och underinnehåll på motsatta sidor, top_hor/botom_hor flank underinnehåll
* **Portal**: sidofält till vänster, underinnehåll till höger, top_hor/botom_hor flank underinnehåll
* **Portal Alt**: underinnehåll till vänster, sidofält till höger, top_hor/botom_hor flank sidofält
* **Anpassad**: Ställ manuellt in bredden på sidofälten som px, %, em eller rem. Standard är 200px på varje sida

## Anpassade mallar/stilar
Så mycket som möjligt, vi försökte sätta mallfiler och tillgångar i stilar / alla / mapp så att du kan skriva över dem genom att skapa en fil med samma namn under ditt eget malltema e. . Prosilver. Så om du vill ändra hur ett visst block visar eller om du vill skapa din egen layout med dina egna blockpositioner, du behöver helt enkelt skapa en fil med samma namn och sökväg som originalet i din egen stil.

Om du behöver anpassa CSS/JS-filer, ta en titt på avsnittet [theming](/docs/dev/theming).