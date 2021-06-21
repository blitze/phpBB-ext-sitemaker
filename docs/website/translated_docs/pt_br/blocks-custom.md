---
id: blocos-personalizado
title: Bloco personalizado
---

Se os blocos disponíveis não lhe derem a liberdade de que precisa. existe o `Bloco Customizado` que lhe permite exibir seu próprio conteúdo usando BBcode ou HTML. O bloco vem com um editor WYSIWYG (TinyMCE) e um gerenciador de scripts:

## O editor

- Você pode usar o editor para criar conteúdo HTML
- Você pode editar o código fonte se você precisar desse nível de controle clicando no ícone do</code> Código Fonte `(<code><>`) no editor
- O editor permite que você envie e modifique imagens 
    - Cria uma nova pasta no phpBB/images/sitemaker_uploads/ para todos os usuários que têm acesso a ela
    - Você pode ver/gerenciar todas as pastas do usuário
- O editor filtra quaisquer scripts potencialmente perigosos como javascript, etc. Se você precisar adicionar conteúdo como anúncios do google, o javascript será filtrado, mas você pode contornar isso fazendo o seguinte: 
    - Adicione o bloco personalizado ao local desejado
    - Edite o Bloco Personalizado, clique na aba `HTML` e cole o seu Javascript

## O Gerenciador de Scripts

O Bloco Personalizado também permite que você adicione arquivos CSS e Javascript personalizados à sua página. Para fazer isso:

- Adicione um `Bloco Personalizado` a qualquer posição do bloco. A posição não importa a menos que você também esteja exibindo conteúdo com o bloco
- Edite o bloco, clique na guia `Scripts` e adicione seus arquivos CSS ou Javascript > Palavra de Cuidado: Adicionar a vários scripts em sua página pode afetar os tempos de carregamento