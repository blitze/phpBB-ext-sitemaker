---
title: Mananaging Blocks
sidebar_position: 3
---

Para gerenciar os blocos no phpBB SiteMaker, você precisa estar no [Modo de Edição](./overview#edit-mode).

> Quando um bloco não exibe nenhum conteúdo, ele não será exibido, exceto no modo de edição. Dessa forma, você pode ou dar-lhe conteúdo (no caso do bloco Personalizado) ou alterar suas configurações.

> No modo de edição, os blocos um pouco transparentes são blocos que, de outra forma, não serão exibidos, mas estão sendo exibidos apenas porque estamos no modo de edição

## Adicionando blocos
Você pode adicionar blocos a qualquer página frontal, exceto ao Painel de Controle do Usuário e Painel de Controle do Moderador. Para adicionar um bloco, você precisará:
* clique em **Blocos** na barra Admin. Isto irá exibir uma lista de blocos disponíveis
* Arraste e solte o bloco desejado para qualquer posição de bloco

## Editando blocos
### Adicionando um ícone de bloco
À esquerda do título do bloco (prosilver), há uma caixa para o ícone do bloco. Clique nesta caixa para obter a seleção de ícone. Você pode selecionar o tamanho do ícone, cor, flutuação, rotação, etc.

### Editando o título do bloco
Os blocos phpBB SiteMaker terão um título padrão, traduzido mas se o título não atender às suas necessidades, você pode alterá-lo. Para editar o título do bloco,
* Clique no título do bloco para obter um formulário de edição embutido
* Altere o título para o que quiser
* Remover o foco do campo ou aperte enter para submeter alterações

> Seu título de bloco modificado não foi traduzido

> Para reverter para o título padrão, exclua simplesmente o título e aperte enter

### Editando configurações do bloco
Quando você passar o mouse sobre um bloco, um ícone de cog aparecerá à direita do bloco que pode ser usado para editar o bloco. Na caixa de diálogo Editar o bloco você pode:
- Ativar/desativar um bloco [Status]
- Escolha quando o bloco deve/não deve ser exibido [Display]. Isso só se aplica nos casos em que você tenha páginas aninhadas (veja [Compreensão de Herança de Bloco](/docs/user/site/block-inheritance)):
    - **Sempre**: exibir sempre o bloco
    - **Ocultar em rotas filhas**: Apenas mostrar este bloco na rota principal
    - **Mostrar apenas as rotas filhas**: Mostrar este bloco em uma rota filha
- Escolha quais grupos de usuários podem ver o bloco [Visível por]. Use CTRL + clique para selecionar múltiplos grupos.
- Defina classes personalizadas para modificar a aparência do bloco ou itens (listas, imagens, fundo, etc.) dentro do bloco [Classe CSS]
- Mostrar/ocultar o título do bloco [Ocultar título do bloco?]
- Selecione a vista de bloco [Visualização de bloco]. Você pode selecionar uma visualização de bloco padrão quando novos blocos são adicionados em ACP.
    - **Padrão / Simples**: usa a classe de painel da próprata para encapsular o bloco em um container preenchido
    - **Básico**: bloco não tem nenhum container embrulhado
    - **Boxed**: usa a classe de prosilver forabg para encapsular o bloco em uma caixa
- Definir / Atualizar configurações específicas do bloco
- Se você tiver o mesmo bloco com as mesmas configurações em múltiplas páginas, Você pode atualizar todos eles de uma vez, verificando os **blocos de atualização com configurações similares**

## Excluindo blocos
- Passe o mouse sobre o bloco que deseja excluir
- Clique no ícone **x** e confirme que você deseja excluir o bloco
- Vá até a barra de administração e clique em `Salvar Mudanças`
