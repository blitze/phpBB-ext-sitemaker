---
id: blocos-customizados
title: Bloco personalizado
---

Se os blocos disponíveis não lhe dão a liberdade que você precisa. há o `Bloco Personalizado` que lhe permite exibir seu próprio conteúdo usando BBcode ou HTML. O bloco vem com um editor WYSIWYG (TinyMCE), um [Gerenciador de Arquivos](./filemanager.md)e um gerenciador de scripts:

## O editor

* Você pode usar o editor para criar conteúdo HTML
* Você pode editar o código-fonte se você precisar desse nível de controle clicando no ícone `código-fonte` (`<>`) no editor
* O editor permite que você faça upload e modifique imagens
* O editor filtra quaisquer scripts potencialmente perigosos como javascript, etc. Se você precisa adicionar conteúdo como google ads, o javascript será filtrado, mas você pode contornar isso fazendo o seguinte: 
    * Adicionar o bloco personalizado ao local desejado
    * Edite o Bloco Personalizado, clique na aba `HTML` e cole seu Javascript

## O Gerenciador de Arquivos

The `Custom Block` also comes with a [File Manager](./filemanager.md) as a TinyMCE pluglin * It creates a new folder in phpBB/images/sitemaker_uploads/ for every user who has access to it * You can view/manage all user folders

## O Gerenciador de Scripts

O Bloco Personalizado também permite que você adicione arquivos personalizados de CSS e Javascript à sua página. Para fazer isto: * Adicione um `bloco personalizado` em qualquer posição do bloco. A posição não importa a menos que você também esteja mostrando conteúdo com o bloco * Edite o bloco, clique na aba `Scripts` e adicione seus arquivos CSS ou Javascript

> No entanto, palavra de cautela: Adicionar a muitos scripts em sua página pode afetar o tempo de carregamento