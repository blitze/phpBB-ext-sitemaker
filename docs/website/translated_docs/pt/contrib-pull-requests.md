---
id: contrib-pull-requests
title: Enviando um Pull Request
sidebar_label: Pull requests
---

`Pull requests permitem que você diga aos outros sobre as alterações que você empurrou para um branch em um repositório no GitHub. Uma vez aberto um pull request, você pode discutir e rever as possíveis mudanças com os colaboradores e adicionar commits de acompanhamento antes de suas alterações serem mescladas no branch base.` [Leia mais](https://help.github.com/articles/about-pull-requests/)

## Forjando/Clonando

* Crie uma conta no github se você ainda não tiver uma
* Vá para https://github.com/blitze/phpBB-ext-sitemaker.git e clique em "Fork"

Clone seu fork do repositório:

    git clone git://github.com/<my_github_name>/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Da linha de comando vá para o diretório sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Configurar git:**

Adicione seu nome de usuário ao Git no seu sistema:

    git config --global user.name "Your Name Here"
    

Adicione seu endereço de e-mail ao Git em seu sistema:

    git config --add user.email username@phpbb.com
    

Adicione o controle remoto de upstream (você pode mudar 'upstream' para o que quiser):

    git remoto add upstream git://github.com/blitze/phpBB-ext-sitemaker.git
    

**Instalar fornecedores**

    instalar compositor
    

**Instalar pacotes NPM**

    instalar npm
    

Alternativamente você pode usar [yarn](https://yarnpkg.com):

    Instalação yarn
    

## Pull requests

    # Criar um novo branch para o seu recurso & alterna para ele
    git checkout -b feature/my-fancy-new-feature
    
    # criar um novo branch para o problema em que você está trabalhando * alternar para ele (ticket # é de github tracker)
    git checkout -b/1234
    

Faça suas alterações

    # Estágio dos arquivos
    git add <files> 
    
    # Arquivos do commit - por favor, use uma mensagem de commit correta
    commit git -m "minha mensagem de commit"
    

Volte o branch para o GitHub git push origin feature/my-fancy-new-feature

Enviar um [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)