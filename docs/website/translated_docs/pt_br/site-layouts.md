---
id: layouts
title: Layouts
---

"Layouts" determinam as posições de blocos disponíveis e como elas são exibidas.

## Posições do Bloco

Posições do bloco são áreas predefinidas em seu site onde blocos podem existir. As posições de blocos disponíveis são determinadas pelo estilo de modelo que você está usando. Para prosilver, phpBB SiteMaker vem com as seguintes posições de blocos: * painel: largura total através do topo * barra lateral: esquerda/direita dependendo do layout abaixo de * subconteúdo: similar a barra lateral maior * top_hor: blocos horizontais no topo, flanking acima da barra lateral/subconteúdo dependendo do layout * topo: acima do conteúdo principal * caixa: largura igual, blocos horizontais abaixo do conteúdo principal * inferior: abaixo do conteúdo principal * inferior_hor: blocos horizontais na parte inferior, flanqueando a barra lateral/subconteúdo dependendo do layout * rodapé: blocos horizontais no rodapé Você pode adicionar mais posições de blocos em seus próprios modelos de estilo copiando e modificando os templates do phpBB SiteMaker correspondentes

## Layout do site

Você pode escolher o layout para o seu site em ACP (Extensões > Sitemaker > Configurações): * **Blog**: subconteúdo e barra lateral lado a lado. pushed para a direita, top_hor/botom_hor flank subconteúdo * **Santa Grail**: barra lateral de largura igual e subconteúdo em lados opostos, top_hor/botom_hor flank subconteúdo * **Portal**: barra lateral à esquerda, subconteúdo à direita, top_hor/botom_hor flank subconteúdo * **Portal Alt**: subconteúdo à esquerda, barra lateral à direita, top_hor/botom_hor flank sidebar * **Custom**: Defina manualmente a largura das barras laterais como px, %, em ou teria. O padrão é 200px em cada lado

## Temas/estilos personalizados

Tanto quanto possível, nós tentamos colocar arquivos de template e assets em estilos/todos/ pastas para que você possa substituí-los criando um arquivo com o mesmo nome sob o seu próprio tema de template. . prosilver. Portanto, se você quiser modificar a forma como um determinado bloco é exibido ou se você quiser criar seu próprio layout com suas próprias posições de bloco, você precisa simplesmente criar um arquivo com o mesmo nome e caminho do original no seu próprio estilo.

Se você precisar customizar arquivos CSS/JS, dê uma olhada na seção [de temas](./developer-theming.md).