---
id: eventos-desenvolvedor
title: eventos do phpBB SiteMaker
---

Você pode modificar o comportamento do phpBB SiteMaker usando o sistema de eventos da phpBB.

## Eventos PHP

# blitze.sitemaker.acp_add_bulk_menu_options

- Localização: /phpBB/ext/blitze/sitemaker/acp/menu_module.php
- Desde: 3.1.0
- Propósito: Adicionar opções de menu em massa no menu acp

# blitze.sitemaker.acp_display_settings_form

- Localização: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Desde: 3.1.0
- Propósito: exibir o formulário de configurações (sitemaker)

# blitze.sitemaker.acp_save_configurações

- Localização: /phpBB/ext/blitze/sitemaker/acp/settings_module.php
- Desde: 3.1.0
- Propósito: Salvar configurações de acp (sitemaker)

# blitze.sitemaker.admin_bar.set_assets

- Localização: /phpBB/ext/blitze/sitemaker/services/blocks/admin_bar.php
- Desde: 3.0.1-RC1
- Propósito: Adicionar ativos para blocos disponíveis no modo de edição

# blitze.sitemaker.modificar_posições_de_blocos

- Localização: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Desde: 3.0.1-RC1
- Propósito: Modificar posições dos blocos

# blitze.sitemaker.modificar_bloco_renderizado

- Localização: /phpBB/ext/blitze/sitemaker/services/blocks/blocks.php
- Desde: 3.0.1-RC1
- Propósito: Modificar um bloco renderizado

## Eventos do Template

# blitze_configurações_do_sitemaker

- Localização: /phpBB/ext/blitze/sitemaker/adm/style/acp_settings.html
- Desde: 3.1.0
- Propósito: Adicionar campos de formulário para configurações de sitemaker

# blitze_sitemaker_bar_admin_anexar

- Localização: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Desde: 3.1.0
- Objetivo: Adicionar itens de menu à barra de admin

# blitze_sitemaker_templates_bar_admin

- Localização: /phpBB/ext/blitze/sitemaker/styles/all/template/admin_bar.html
- Desde: 3.1.0
- Propósito: Adicionar arquivos de modelo a serem usados em JS para visualização de blocos, etc

## Eventos de Javascript

# blitze_sitemaker_layout_salvo

- Local: /phpBB/ext/blitze/sitemaker/develop/components/AdminBar/SaveLayout/index.js
- Desde: 3.1.2
- Propósito: Evento para permitir que outras extensões façam algo quando alterações de layout são salvas

# blitze_sitemaker_renderizar_bloco_antes

- Local: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Desde: 3.1.2
- Propósito: Evento para permitir que outras extensões façam algo antes que o bloco seja renderizado ou impedir que ele seja re-renderizado

# blitze_sitemaker_renderizar_bloco_após

- Local: /phpBB/ext/blitze/sitemaker/develop/components/BlockRenderer/index.js
- Desde: 3.1.2
- Propósito: Evento para permitir que outras extensões façam algo após o bloco ser renderizado

# blitze_sitemaker_salvar_bloco_antes

- Local: /phpBB/ext/blitze/sitemaker/develop/components/BlocksManager/Edit/index.js
- Desde: 3.1.2
- Propósito: Evento para permitir que outras extensões modifiquem os dados do bloco antes que ele seja salvo

# blitze_sitemaker_mostrar_todas_as_posições_de_blocos

- Local: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Desde: 3.1.2
- Propósito: Evento para permitir que outras extensões façam algo quando todas as posições dos blocos são mostradas

# blitze_sitemaker_ocultar_posições_vazias_de_blocos

- Local: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Desde: 3.1.2
- Objetivo: Evento para permitir que outras extensões façam algo quando posições vazias são ocultas

# blitze_layout_do_sitemaker_apagado

- Local: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Desde: 3.1.2
- Objetivo: Evento para permitir que outras extensões façam algo quando o layout for limpo

# blitze_layout_do_sitemaker_atualizado

- Local: /phpBB/ext/blitze/sitemaker/develop/components/Positions/Positions.js
- Desde: 3.1.2
- Propósito: Evento para permitir que outras extensões façam algo quando o layout é atualizado

# blitze_sitemaker_tinymce_options

- Location: /phpBB/ext/blitze/sitemaker/develop/components/CustomBlock/index.js
- Since: 3.3.0
- Purpose: Event to allow other extensions to modify tinymce options