---
title: Layouts
sidebar_position: 1
---

"Layouts" determinam as posições de blocos disponíveis e como elas são exibidas.

## Posições do Bloco
Posições do bloco são áreas predefinidas em seu site onde blocos podem existir. As posições de blocos disponíveis são determinadas pelo estilo de modelo que você está usando. Para prosilver, phpBB SiteMaker vem com as seguintes posições de bloco:
* painel: largura total através do topo
* barra lateral: esquerda/direita dependendo do layout abaixo
* subconteúdo: similar à barra lateral maior
* top_hor: blocos horizontais no topo, flanqueando acima da barra lateral/subconteúdo dependendo do layout
* topo: acima do conteúdo principal
* caixa: largura igual, blocos horizontais abaixo do conteúdo principal
* abaixo: abaixo do conteúdo principal
* bottom_hor: blocos horizontais na parte inferior, flanqueando a barra lateral/subconteúdo dependendo do layout
* rodapé: blocos horizontais no rodapé Você pode adicionar mais posições de blocos em seus próprios modelos de estilo copiando e modificando os correspondentes modelos phpBB SiteMaker

## Layout do site
Você pode escolher o layout para o seu site em ACP (Extensões > Sitemaker > Configurações):
* **Blog**: subcontent e sidebar lado a lado, empurrado para a direita, de topo_hor/botom_hor subconteúdo de flank
* **Grau Sagrada**: barra lateral de largura igual e subconteúdo nos lados opostos, top_hor/botom_hor flank subcontent
* **Portal**: barra lateral à esquerda, subconteúdo à direita, top_hor/botom_hor flank subcontent
* **Portal Alternativo**: subconteúdo à esquerda, barra lateral à direita, top_hor/botom_hor sidebar
* **Personalizado**: Definir manualmente a largura das barras laterais como px, %, em ou h. O padrão é 200px em cada lado

## Temas/estilos personalizados
Tanto quanto possível, nós tentamos colocar arquivos de template e assets em estilos/todos/ pastas para que você possa substituí-los criando um arquivo com o mesmo nome sob o seu próprio tema de template. . prosilver. Portanto, se você quiser modificar a forma como um determinado bloco é exibido ou se você quiser criar seu próprio layout com suas próprias posições de bloco, você precisa simplesmente criar um arquivo com o mesmo nome e caminho do original no seu próprio estilo.

Se você precisar customizar arquivos CSS/JS, dê uma olhada na seção [de temas](/docs/dev/theming).