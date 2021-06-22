---
title: Ställa in en standardlayout
sidebar_position: 4
---

När du lägger till ett block läggs det till på den specifika sidan. Det skulle därför vara en mödosam uppgift att sätta block för alla sidor på din webbplats. Du kan ställa in alla önskade block för en viss sida, och sedan ställa in den sidan som standard layout. Med andra ord, någon sida som inte har sina egna block, kommer att ärva block från denna sida.

Ange en standardlayout
* Gå till den sida som du vill ställa in som standardlayout
* Klicka på `Inställningar` i administratörsfältet
* Klicka på `Ange som standard layout` -knappen

Säg att vi lägger till block till en sida (phpBB/index.php) med block i sidofältet och topppositioner, till exempel, och ange det som vår standard layout. Detta har följande effekter för andra sidor:
* Alla sidor som inte har sina egna block, kommer att ärva blocken från standardlayouten. Se [Förstå Block Arv](/docs/user/site/block-inheritance) för undantag.
* Du kan fortfarande ärva block från en standardlayout (index. hp) men välj att inte visa block på vissa blockpositioner eller att inte visa några block alls. För att göra detta,
    * Gå till sidan som du inte vill att alla/några block ska visas
    * Klicka på `Inställningar` i administratörsfältet
    * Välj `Visa inte block på denna sida` om du inte vill ärva / visa några block på denna sida ELLER
    * Använd CTRL + klicka för att välja de blockpositioner (till höger) som du inte vill visa block på
* I `redigeringsläge`, en sida som ärver block från standard layout, kommer inte att visa några block, vilket ger dig möjlighet att lägga till block på sidan om du vill
* Alla sidor som har egna block kommer inte att ärva från standardlayouten
