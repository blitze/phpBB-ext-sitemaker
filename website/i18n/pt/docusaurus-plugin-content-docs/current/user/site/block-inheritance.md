---
title: Bloco herança
sidebar_position: 5
---

Já vimos isso definindo um layout padrão, outras páginas que não possuem blocos próprios herdarão os blocos do layout padrão. Existe, no entanto, um outro tipo de herança de blocos.

## Rotas pai/filho
No phpBB SiteMaker, falamos de rotas aninhadas em termos de diretórios (sub) aninhados ou caminhos/rotas virtualmente aninhadas. Por favor, fique comigo :).
* Rotas reais pasta/filho: Por exemplo, o caminho /some_directory/sub_directory/index.php é filho de /some_directory/index.php
* Rotas virtuais pasta/filho: Por exemplo, viewtopic.php é tratado como um filho de viewforum.php.

Aqui estão alguns exemplos de rotas parentais/filho:

| Antecessor         | Filho(a)                       |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/artigos   | /app.php/articles/meu-artigo   |

## Herança do Bloco Pai/Criança
Para rotas pai/filho, a rota filho herda os blocos da rota pai (se o pai tiver seus próprios blocos) ou do layout padrão (se uma foi definida). Em outras palavras, mesmo que haja um layout padrão, a rota filho herdará blocos da rota pai se a rota pai tiver seus próprios blocos. Mas nem todos os blocos da rota pai devem ser herdados.

## Controlando Herança de Blocos
A nível de blocos, você pode controlar quando um bloco pode ser herdado por rotas filhas. Nós tocamos nisso anteriormente na [Edição das Configurações do Bloco](/docs/user/blocks/managing-blocks#editing-block-settings).

Considere a seguinte estrutura real de diretórios:
```text
phpBB
── index.php
── filmes/
    ── index.php
    ── page.php
    ├── page.php
        ── Comedy/ 
 ── index.php
```

Para fins de herança de blocos, dizemos:
* A rota principal do /phpBB/Movies/Comedy/index.php é /phpBB/Movies/index.php e não /phpBB/Movies/page.php
* Todas as páginas em um sub-diretório relativo ao /phpBB/index.php são uma rota filha do /phpBB/index.php. Então /phpBB/Movies/index.php e /phpBB/Movies/page.php são filhos de /phpBB/index.php e, portanto, herdarão seus blocos se não tiverem blocos próprios. Neste caso:
    * Quando um bloco do /phpBB/index.php está definido para ser exibido em **Ocultar em rotas filhas**, o bloco será exibido em /phpBB/index. hp (rota pai) mas não em suas rotas filhas
    * Quando um bloco do /phpBB/index.php está definido para ser exibido em **Mostrar somente em rotas filhas**, ele será exibido em /phpBB/Movies/index. hp e /phpBB/Movies/page.php (rotas filhas) mas não em /phpBB/index.php (pai), nem em /phpBB/Movies/Comedy/index.php (nós só usamos um nível de profundidade)
    * Quando um bloco no /phpBB/index.php está configurado para exibir **sempre** (padrão), ele será exibido em /phpBB/index. hp (principal), /phpBB/Movies/index.php e /phpBB/page.php (rotas filhas) mas não em /phpBB/Movies/Comedy/index.php (só vamos a um nível de profundidade). Neste caso, /phpBB/Movies/Comedy/index.php herdará da rota padrão (se existir)

## Estado futuro possível
Estou muito interessado em seu feedback nesta área. A maioria dos usuários do phpBB não terão diretórios reais conforme descrito acima. Então estou pensando em usar a estrutura definida em um bloco de menu como uma estrutura virtual de diretórios e aplicar esta herança pai ou filho a ela. Também estou pensando em ir além de um nível de profundidade. Por favor, deixe-me saber se isso será útil para você.