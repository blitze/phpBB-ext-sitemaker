---
id: desenvolvedor-theming
title: Temas
---

phpBB SiteMaker vem com estilos e cores feitos para prosilver. Você pode substituir arquivos CSS, JS e HTML criando o arquivo correspondente na pasta do seu estilo.

# Criando arquivos JS/CSS para seu estilo

Nota: * Para o propósito das instruções abaixo, assumimos que você tem um estilo chamado meu-estilo.

Clonar para phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker
    

Da linha de comando vá para o diretório sitemaker:

    cd phpBB/ext/blitze/sitemaker
    

**Instalar fornecedores**

    instalar compositor
    

**Instalar pacotes**

Para os comandos abaixo você pode usar npm ou [yarn](https://yarnpkg.com)

    Instalação yarn
    

**Ver alterações**

    yarn start --tema meu-estilo
    

**Fazer alterações**

* Faça suas alterações em arquivos na pasta phpBB/ext/blitze/sitemaker/develop.
* Veja phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss para variáveis de segurança

**Criar Ativos**

    yarn build --tema meu-estilo
    

**Implantar**

Agora você pode copiar os arquivos gerados do phpBB/ext/blitze/sitemaker/styles/my-style e enviá-los para o seu servidor de produção.

> Esta extensão usa jQuery UI para abas, diálogos e botões. O tema jQuery padrão é 'suavidade.' Você pode usar um tema jQuery UI diferente que melhor se encaixa no seu tema. Você pode especificar o tema jQuery UI usando a bandeira --jq_ui_theme. Por exemplo:

    yarn build --theme my-style --jq_ui_theme ui-lightness