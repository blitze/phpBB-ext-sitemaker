---
title: Temas
sidebar_position: 3
---

Entendemos que os arquivos de template e JS/CSS não funcionarão para todos os estilos, portanto, abaixo estão algumas maneiras de usar seus próprios templates e criar arquivos JS/CSS para seu estilo específico.

## Usando o seu próprio modelo

Se os templates padrão que vêm com o phpBB Sitemaker não funcionarem bem para o seu estilo em particular, você pode facilmente substituí-lo para usar o próprio arquivo de template, criando o arquivo correspondente na pasta de estilos.

Por exemplo, diz que o seu estilo é chamado de `Backlash` e tem uma maneira particular de estruturar o HTML para a seção de cabeçalho do bloco para a visão de [boxed](/docs/user/blocks/block-views). Você pode substituir esse modelo em particular criando um arquivo pelo mesmo nome assim: `phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

Em outras palavras, para usar seu próprio arquivo de template, você precisa:
* Identificar qual arquivo do phpBB Sitemaker precisa ser substituído
* Crie um arquivo pelo mesmo nome na pasta `estilos` do Sitemaker sob seu nome de estilo

> Nota: Se você criar seus próprios arquivos de template, certifique-se de não excluir a pasta `phpbb/ext/blitze/sitemaker` quando atualizar a extensão como seus arquivos personalizados serão excluídos. Em vez disso, basta sobrescrever os arquivos existentes com os novos.

## Criando arquivos JS/CSS para seu estilo

Nota:
* Para propósito das instruções abaixo, assumimos que você tem um estilo chamado meu-estilo.

Clonar em phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

Da linha de comando vá para o diretório sitemaker:

    cd phpBB/ext/blitze/sitemaker

**Instalar fornecedores**

    instalar compositor

**Instalar pacotes**

Para os comandos abaixo você pode usar o npm ou o [yarn](https://yarnpkg.com)

    instalar Yarn

**Ver alterações**

    yarn start --theme meu-estilo

**Fazer alterações**

* Faça suas alterações nos arquivos na pasta phpBB/ext/blitze/sitemaker/desenvolver.
* Veja o phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss para variáveis de sass

**Compilar ativos**

    yarn build --theme meu-estilo

**Implantar**

Agora você pode copiar os arquivos gerados do phpBB/ext/blitze/sitemaker/styles/meu-estilo e enviá-los para o seu servidor de produção.

> Esta extensão usa jQuery UI para abas, diálogos e botões. O tema padrão do jQuery é 'suave'. Você pode usar um tema jQuery UI diferente que melhor se encaixa ao seu tema. Você pode especificar o tema da UI do jQuery usando a flag --jq_ui_theme. Por exemplo:

    yarn build --theme meu-style --jq_ui_theme ui-lightness
