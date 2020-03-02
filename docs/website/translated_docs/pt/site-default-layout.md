---
id: layout-padrão do site
title: Definindo um Layout Padrão
---

Quando você adiciona um bloco, ele é adicionado a essa página específica. Seria, portanto, uma tarefa fastidiosa estabelecer blocos para todas as páginas do vosso sítio. Você pode definir todos os blocos desejados para uma página em particular, e então definir essa página como o layout padrão. Em outras palavras, qualquer página que não tenha seus próprios blocos, herdará blocos desta página.

Para definir um layout padrão * Vá para a página que você gostaria de definir como layout padrão * Clique em `Configurações` na barra de administração * Clique no `Definir como layout padrão` botão

Diga que adicionamos blocos a uma página (phpBB/index.php) com blocos na barra lateral e posições de topo, por exemplo, e defina-o como nosso layout padrão. Isto tem os seguintes efeitos para outras páginas: * Qualquer página que não tenha seus próprios blocos, herdará os blocos do layout padrão. Veja [Herança de Bloco Vice-existente](./blocks-inheritance.md) para exceções. * Você ainda pode herdar blocos de um layout padrão (index.php), mas escolha não exibir blocos em algumas posições de blocos ou não exibir nenhum bloco. Para isso, * Vá para a página que você não quer que todos/alguns blocos exibam * Clique em `Configurações` na barra de administração * Selecione `Não mostre blocos nesta página` se você não quer herdar/exibir quaisquer blocos nesta página OU * Use CTRL + clique para selecionar as posições de bloco (à direita) que você não deseja exibir blocos em * Em `modo de edição`, uma página que herda os blocos do layout padrão, não mostrará nenhum bloco, dar a você a oportunidade de adicionar blocos à página se você quiser * Qualquer página que tenha seus próprios blocos não herdará do layout padrão