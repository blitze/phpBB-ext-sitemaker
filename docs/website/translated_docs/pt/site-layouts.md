---
id: layouts do site
title: Layouts
---

"Layouts" determinam as posições de bloco disponíveis e como elas são exibidas.

## Bloquear Posições

As posições dos blocos são áreas predefinidas em seu site onde os blocos podem existir. As posições de blocos disponíveis são determinadas pelo estilo de modelo que você está usando. Proprver, phpBB SiteMaker vem com as seguintes posições de bloco: * painel: largura total na parte superior * barra lateral: esquerda/direita dependendo do layout abaixo * subconteúdo: similar à barra lateral apenas maior * top_hor: blocos horizontais no topo, flanqueando acima da barra lateral/subconteúdo dependendo do layout * topo: acima do conteúdo principal * caixa: largura igual, Blocos horizontais abaixo do conteúdo principal * inferior: abaixo do conteúdo principal * bottom_hor: blocos horizontais na parte inferior, flanqueando o sidebe/subcontent dependendo do layout * rodapé: blocos horizontais no rodapé Você pode adicionar mais posições de blocos em seus próprios modelos de estilo copiando e modificando os correspondentes modelos phpBB SiteMaker

## Layout do site

Você pode escolher o layout do seu site em ACP (Expresses > Sitemaker > Configurações): * **Blog**: subconteúdo e barra lateral lado a lado um do outro. pressionado para a direita, top_hor/botom_hor subconteúdo do flanco * **Santo Graly**: barra lateral de largura igual e subconteúdo em lados opostos. top_hor/botom_hor subconteúdo do flanco * **Portal**: barra lateral à esquerda, subconteúdo à direita, top_hor/botom_hor subconteúdo do flanco * **Portal Alt**: subconteúdo à esquerda, barra lateral à direita top_hor/botom_hor flanco siar * **Personalizado**: Definir manualmente a largura das barras laterais como px, %, em ou em. O padrão é 200px em cada lado

## Modelos/estilos personalizados

Tanto quanto possível, nós tentamos colocar arquivos de template e assets na pasta styles/all/ para que você possa substituí-los criando um arquivo com o mesmo nome no seu próprio tema de template, por exemplo, prosilver. Então, se você quiser modificar como um determinado bloco exibe ou se você quiser criar seu próprio layout com suas próprias posições de bloco, você simplesmente precisa criar um arquivo com o mesmo nome e caminho que o original no seu próprio estilo.

Se você precisa personalizar arquivos CSS/JS, dê uma olhada na seção [theming](./developer-theming.md).