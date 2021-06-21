---
id: tema-desenvolvedor
title: Temas
---

phpBB SiteMaker vem com estilos e cores feitos para prosilver. Você pode substituir arquivos CSS, JS e HTML, criando o arquivo correspondente na pasta do seu estilo.

# Criando arquivos JS/CSS para seu estilo

Nota: * Para a finalidade das instruções abaixo, assumimos que você tem um estilo chamado meu-estilo.

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

> Esta extensão usa jQuery UI para abas, diálogos e botões. O tema padrão do jQuery é 'suave'. Você pode usar um tema jQuery UI diferente que melhor se adapte ao seu tema. Você pode especificar o tema da UI do jQuery usando a flag --jq_ui_theme. Por exemplo:

    yarn build --theme meu-style --jq_ui_theme ui-lightness