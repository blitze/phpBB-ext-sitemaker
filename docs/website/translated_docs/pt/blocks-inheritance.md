---
id: blocos-herança
title: Herança do Bloco Entendido
---

Já vimos que ao definir um layout padrão, outras páginas que não têm blocos deles herdarão os blocos do layout padrão. Há, no entanto, outro tipo de herança de bloco.

## Rotas pais/filhos

No phpBB SiteMaker, falamos de rotas aninhadas em termos de diretórios aninhados (sub) ou praticamente aninhados caminhos/rotas. Por favor, fique comigo :). * Rotas reais Pai/Criança: Por exemplo, o caminho /some_directory/sub_directory/index.php é filho de /some_directory/index.php * Virtuais Parent/Child routes: Por exemplo, viewtopic.php é tratado como um filho do viewforum.php.

Aqui estão alguns exemplos de rotas pai/filho:

| Pai                | Criança                        |
| ------------------ | ------------------------------ |
| /index.php         | /viewforum.php, /dir/index.php |
| /viewforum.php?f=2 | /viewtopic.php?f=2&t=1         |
| /app.php/articles  | /app.php/articles/meu-artigo   |

## Herança do Bloco Pai/Criança

Para rotas pai/filho, a rota filho herda os blocos da rota pai (se o pai tem seus próprios blocos) ou do layout padrão (se um foi definido). Por outras palavras, mesmo que exista um layout padrão, a rota filho herdará os blocos de sua rota pai se a rota pai tiver seus próprios blocos. Mas nem todos os blocos da rota pai devem ser herdados.

## Controlando a herança do bloco

Em um nível de bloco, você pode controlar quando um bloco pode ser herdado por rotas filhas. Nós tocamos nisso anteriormente no [Editando Configurações de Bloco](./blocks-managing#editing-block-settings).

Considere a seguinte estrutura de diretório real:

```text
phpBB
<unk> Α<unk> index.php
<unk> © <unk> Movies/
    <unk> © <unk> index.php
    <unk> © <unk> page.php
    <unk> <unk> <unk> Comedy/
        <unk> © <unk> index.php
```

Para fins de herança de blocos, dizemos: * A rota pai de /phpBB/Movies/Comedy/index.php é /phpBB/Movies/index.php e não /phpBB/Movies/page.php * Todas as páginas de um sub-diretório relativo a /phpBB/index.php é uma rota filho de /phpBB/index.php. Então /phpBB/Movies/index.php e /phpBB/Movies/page.php são filhos de /phpBB/index.php e, portanto, herdarão seus blocos se não tiverem blocos próprios. Neste caso: * Quando um bloco no /phpBB/index. hp está definido para exibir no **Hide on child routes**, o bloco será exibido no /phpBB/index. hp (rota pai) mas não em suas rotas descendentes * Quando um bloco em /phpBB/index. hp está definido para exibir em **Mostrar somente nas rotas descendentes**, será exibido em /phpBB/filvies/index.php e /phpBB/filmes/page. hp (rotas filhos), mas não em /phpBB/index.php (pai), nem /phpBB/filmes/Comedy/index. hp (nós só vamos um nível) * Quando um bloco no /phpBB/index. hp está configurado para exibir **sempre** (padrão), ele será exibido em /phpBB/index.php (pai), /phpBB/filvies/index. hp e /phpBB/page.php (rotas filhos), mas não em /phpBB/Filvies/Comedy/index.php (nós apenas vamos um nível de profundidade). Neste caso, /phpBB/Movies/Comedy/index.php herdará da rota padrão (se existir)

## Estado Futuro Positivo

Estou realmente interessado em seu feedback nesta área. A maioria dos usuários phpBB não terá diretórios reais como descrito acima. Então estou pensando em usar a estrutura que é definida em um bloco de menu como uma estrutura de diretório virtual e aplicar esta herança pai/filho a ele. Eu também estou pensando em ir além de um nível profundo. Por favor, deixe-me saber se isso será útil para você.