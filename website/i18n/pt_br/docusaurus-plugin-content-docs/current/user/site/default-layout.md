---
title: Definindo um Layout Padrão
sidebar_position: 4
---

Quando você adiciona um bloco, ele é adicionado a essa página específica. Por conseguinte, seria uma tarefa tediosa estabelecer blocos para todas as páginas do seu site. Você pode definir todos os blocos desejados para uma determinada página e, em seguida, definir essa página como o layout padrão. Em outras palavras, qualquer página que não tenha seus próprios blocos, herdará blocos desta página.

Para definir um layout padrão
* Vá para a página que você gostaria de definir como layout padrão
* Clique em `Configurações` na barra de administração
* Clique no botão `Definir como layout` padrão

Digamos que adicionamos blocos a uma página (phpBB/index.php) com blocos na barra lateral e nas posições principais, por exemplo, e definimos como nosso layout padrão. Isto tem os seguintes efeitos para outras páginas:
* Qualquer página que não tiver seus próprios blocos, herdará os blocos do layout padrão. Veja [Compreender a herança de blocos](/docs/user/site/block-inheritance) para exceções.
* Você ainda pode herdar blocos de um layout padrão (índice. hp) mas escolha não exibir blocos em algumas posições de bloco ou não exibir nenhum bloco. Para fazer isso,
    * Vá para a página que você não quer que todos/alguns blocos sejam exibidos
    * Clique em `Configurações` na barra de administração
    * Selecione `Não mostrar blocos nesta página` se você não quiser herdar / exibir nenhum bloco nesta página OU
    * Use CTRL + clique para selecionar as posições do bloco (à direita) onde você não deseja exibir os blocos em
* No `modo de edição`, uma página que herda os blocos do layout padrão, não mostrará nenhum bloco, dando-lhe a oportunidade de adicionar blocos à página, se você quiser
* Qualquer página que tenha seus próprios blocos não herdará do layout padrão
