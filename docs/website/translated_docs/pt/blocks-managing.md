---
id: gerenciamento de blocos
title: Gerenciando blocos
---

Para gerenciar blocos no phpBB SiteMaker, você deve estar no [Modo de Edição](./blocks-overview#edit-mode).

> Quando um bloco não exibir nenhum conteúdo, ele não será exibido, exceto no modo de edição. Dessa forma, você pode dar conteúdo (no caso do bloco personalizado) ou alterar suas configurações.
> 
> No modo de edição, os blocos algo transparentes são blocos que, de outra forma, não serão exibidos, mas apenas porque estamos no modo de edição

## Adicionando blocos

Você pode adicionar blocos a qualquer página frontal, exceto as páginas do Painel de Controle do Usuário e do Painel de Controle do Moderador. Para adicionar um bloco, você precisará: * clique em **Blocos** na barra de Admin. Isto irá exibir uma lista de blocos disponíveis * Arraste e solte o bloco desejado para qualquer posição de bloco

## Editando blocos

### Adicionando um ícone de bloco

Para a esquerda do título do bloco (prosilver), há uma caixa para o ícone do bloco. Clique nesta caixa para obter o seletor de ícones. Você pode selecionar o tamanho do ícone, cor, flutuante, rotação, etc.

### Editando o título do bloco

blocos phpBB SiteMaker terão um título padrão, traduzido, mas se o título não atender às suas necessidades, você pode alterá-lo. Para editar o título do bloco, * Clique no título do bloco para obter um formulário de edição inline * Altere o título para o que quiser * Remova o foco do campo ou pressione enter para enviar alterações

> O título do bloco modificado não foi traduzido
> 
> Para reverter para o título padrão, simplesmente apague o título e pressione enter

### Editando configurações de bloco

Quando você passar o mouse sobre um bloco, um ícone de engrenagem aparecerá à direita do bloco que pode ser usado para editar o bloco. Na caixa de diálogo do bloco editar, você pode: - Ativar/desativar um bloco [Status] - Escolha quando o bloco deve/não ser exibido [Display]. Isso só se aplica em casos em que você tem páginas aninhadas (veja [herança de bloco compreensível](./blocks-inheritance.md)): - **Always**: Sempre exibir o bloco - **Esconder em rotas descendentes**: Apenas mostre este bloco na rota pai - **Mostrar nas rotas descendentes apenas**: Apenas mostrar este bloco em uma rota filha - Escolha quais grupos de usuários podem ver o bloco [Visualizável]. Use CTRL + clique para selecionar vários grupos. - Defina classes personalizadas para modificar a aparência do bloco ou itens (listas, imagens, fundo, etc) dentro do bloco [Classe CSS] - Mostrar/ocultar o título do bloco [Ocultar título do bloco?] - Selecione a visualização do bloco [Vista de bloco]. Você pode selecionar um bloco padrão quando novos blocos forem adicionados em ACP. - **Padrão / Simples**: usa a classe do painel proprata para embrulhar o bloco em um recipiente adicionado - **Básico**: o bloco não tem nenhum container encapitando-o - **Boxed**: usa a classe proprata forabg para embrulhar o bloco em uma caixa - Defina / Atualize configurações específicas - Se você tiver o mesmo bloco com as mesmas configurações em várias páginas, você pode atualizar todos de uma vez ao verificar os **blocos de atualização com configurações semelhantes**

## Excluindo blocos

- Passe o mouse sobre o bloco que você gostaria de excluir
- Clique no ícone **x** e confirme que deseja excluir o bloco
- Vá para a barra de administração e clique em `Salvar Alterações`