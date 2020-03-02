---
id: gerenciador de arquivos
title: Líder Responsivo
---

A partir da versão 3.1.0, o phpBB SiteMaker suporta o [Arquivo Responsivo](http://responsivefilemanager.com)

* O gerenciador de arquivos é usado como um TinyMCE pluging (editor WYSIWYG) ao editar blocos personalizados
* Atualmente está configurado para criar pastas separadas para cada usuário, exceto o usuário com permissão_sm_filemanager (Pode ver/gerenciar pastas de outros usuários), que permite que eles acessem para ver/gerenciar todas as pastas de upload.

## Instalação

* Baixe o [Gerenciador de Arquivos Responsivos](http://responsivefilemanager.com/index.php#sthash.5UrnhjX2.dpbs)
* Extraia-o e envie os arquivos para a pasta raiz do phpBB. A estrutura do arquivo deve ser como abaixo:

```text
phpBB
<unk> Α<unk> images/
<unk> <unk> <unk> <unk> includes/
<unk> pt...
<unk> 用<unk> ResponsiveFilemanager/
    <unk> © <unk> Archi<unk> filemanager/
        <unk> <unk> config/
            <unk> © <unk> .htaccess
            <unk> <unk> config.php
```

## Ativação

* Ir para ACP > Extensões > SiteMaker > Configurações
* Ativar recurso de Gerenciador de Arquivos
* Salvar alterações
* Atualizar permissões de usuário (aba Misc) para determinar quem pode usar este recurso [Pode usar o Gerenciador de Arquivos]
* Atualizar permissões de administrador (aba Misc) para determinar quem pode gerenciar pastas de usuários [Pode ver/gerenciar pastas de outros usuários no Gerenciador de Arquivos]