---
id: blocos-customizados
title: Bloco personalizado
---

Se os blocos disponíveis não lhe dão a liberdade que você precisa. há o `Bloco Personalizado` que lhe permite exibir seu próprio conteúdo usando BBcode ou HTML. The block comes with a WYSIWYG editor (TinyMCE) and a scripts manager:

## O editor

- Você pode usar o editor para criar conteúdo HTML
- Você pode editar o código-fonte se você precisar desse nível de controle clicando no ícone `código-fonte` (`<>`) no editor
- The editor allows you to upload and modify images 
    - It creates a new folder in phpBB/images/sitemaker_uploads/ for every user who has access to it
    - You can view/manage all user folders
- O editor filtra quaisquer scripts potencialmente perigosos como javascript, etc. Se você precisa adicionar conteúdo como google ads, o javascript será filtrado, mas você pode contornar isso fazendo o seguinte: 
    - Adicionar o bloco personalizado ao local desejado
    - Edite o Bloco Personalizado, clique na aba `HTML` e cole seu Javascript

## The Scripts Manager

The Custom Block also allows you to add custom CSS and Javascript files to your page. To do this:

- Add a `Custom Block` to any block position. The position does not matter unless you are also displaying content with the block
- Edit the block, click on the `Scripts` tab and add your CSS or Javascript files > Word of caution though: Adding to many scripts on your page can affect load times