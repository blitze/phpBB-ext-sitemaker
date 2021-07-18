---
id: eventos-desenvolvedor
title: phpBB SiteMaker Eventos
---

Você pode modificar o comportamento do phpBB SiteMaker usando o sistema de eventos do phpBB.

## Eventos PHP

# blitze.sitemaker.acp_adicionar_opções_de_menu_bulk

- Localização: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- Desde: 3.1.0
- Objetivo: Adicionar opções de menu em massa no menu acp

# blitze.sitemaker.acp_form_de_configurações_do_site

- Localização: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Desde: 3.1.0
- Formulário de configurações do acp (sitemaker)

# blitze.sitemaker.acp_salvar_configurações

- Localização: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Desde: 3.1.0
- Purpose: Salvar configurações do acp (sitemaker)

# blitze.sitemaker.admin_bar.set_assets

- Localização: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- Desde: 3.0.1-RC1
- Carteira: Adicionar ativos para blocos disponíveis no modo de edição

# blitze.sitemaker.momodifique_posição_de_blocos

- Localização: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Desde: 3.0.1-RC1
- Purpo: Modificar posições do bloco

# blitze.sitemaker.modify_rendered_block

- Localização: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Desde: 3.0.1-RC1
- Purpo: Modifica um bloco renderizado

## Eventos de Modelo

# blitze_sitemaker_acp_settings

- Localização: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- Desde: 3.1.0
- Purpo: Adicionar campos de formulário para configurações do sitemaker

# blitze_sitemaker_barra_anexar

- Localização: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Desde: 3.1.0
- Carteira: Adicionar itens de menu na barra de administração

# blitze_sitemaker_templates

- Localização: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Desde: 3.1.0
- Purpose: Adicionar arquivos de modelo a serem usados em JS para exibições de blocos, etc

## Eventos de Javascript

# blitze_sitemaker_layout_saved

- Localização: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- Desde: 3.1.2
- Carteira: Evento para permitir que outras extensões façam algo quando as alterações no layout são salvas

# blitze_sitemaker_render_block_antes

- Localização: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Desde: 3.1.2
- Purpo: O evento permite que outras extensões façam algo antes que o bloco seja renderizado ou impeça que ele seja re-renderizado

# blitze_sitemaker_render_block_after

- Localização: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Desde: 3.1.2
- Purpo: O Evento para permitir que outras extensões façam algo após o bloco é renderizado

# blitze_sitemaker_salvar_bloco_antes

- Localização: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- Desde: 3.1.2
- Purpo: Evento para permitir que outras extensões modifiquem dados do bloco antes de serem salvos

# blitze_sitemaker_mostrar_todas_as_posição_de_blocos

- Localização: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Desde: 3.1.2
- Purpo: Evento para permitir que outras extensões façam algo quando todas as posições de blocos forem mostradas

# blitze_sitemaker_hide_empty_posição_de_bloco_

- Localização: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Desde: 3.1.2
- Purpo: Evento para permitir que outras extensões façam algo quando posições vazias estiverem ocultas

# blitze_layouker_de_site_limpo

- Localização: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Desde: 3.1.2
- Carteira: Evento para permitir que outras extensões façam algo quando o layout estiver limpo

# blitze_sitemaker_layout_atualizado

- Localização: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Desde: 3.1.2
- Carteira: Evento para permitir que outras extensões façam algo quando o layout é atualizado

# opções_do_sitemaker_tinymce_blitze_site

- Localização: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- Desde: 3.3.0
- Objetivo: Evento para permitir que outras extensões modifiquem opções de tinymce