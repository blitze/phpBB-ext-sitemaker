---
id: contrib-pull-requests
title: Enviando um Pull Request
sidebar_label: Pull Requests
---

`Pull requests permitem que você informe aos outros sobre as alterações que você fez push em um branch no repositório do GitHub. Quando um pull request for aberto, você pode discutir e rever as mudanças potenciais com colaboradores e adicionar commits de acompanhamento antes que suas alterações sejam mescladas na branch base.` [Leia mais](https://help.github.com/articles/about-pull-requests/)

## Forking/Clonagem

* Criar uma conta no github se você ainda não tiver uma
* Vá para https://github.com/blitze/phpBB-ext-sitemaker.git e clique em "Fork"

Clone seu fork do repositório:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Da linha de comando vá para o diretório sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Configurar git:**

Adicione seu nome de usuário ao Git no seu sistema:

    git config --global user.name "Seu Nome Aqui"
    

Adicione seu endereço de e-mail ao Git no seu sistema:

    git config --add user.email username@phpbb.com
    

Adicione o controle remoto do upstream (você pode mudar o 'upstream' para o que quiser):

    adicione git://github.com/blitze/phpBB-ext-sitemaker.git remotamente
    

**Instalar fornecedores**

    instalar compositor
    

**Instalar pacotes NPM**

    npm install
    

Como alternativa, você pode usar o [yarn](https://yarnpkg.com):

    instalar Yarn
    

## Pull Requests

    # Crie uma nova branch para o seu recurso & mude para ela
    git check-b feature/my-fancy-new-feature
    
    # crie uma nova branch para a issue em que você está trabalhando * mudar para ela (ticket # é do github tracker)
    git check-b ticket/1234
    

Faça suas alterações

    # Estágio
    git add <files> 
    
    # Commit arquivos staged - por favor, use uma mensagem de commit
    git commit -m "minha mensagem de commit"
    

Faça um push do branch de volta ao GitHub git push out feature/meu-meu-novo-recurso

Submeter um pull request [](https://github.com/blitze/phpBB-ext-sitemaker/pulls)