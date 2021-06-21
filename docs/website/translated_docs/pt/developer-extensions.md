---
id: extensões-de-desenvolvedor
title: Estender o SiteMaker phpBB
---

Você pode estender/modificar o phpBB SiteMaker usando [serviço de substituição](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-replacement), [decoração de serviço](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_advanced.html#using-service-decoration)e [sistema de evento da phpBB](https://area51.phpbb.com/docs/dev/3.2.x/extensions/tutorial_events.html). Você pode encontrar uma lista de eventos suportados [aqui](./developer-events.md).

## Criando um bloco SiteMaker

Um bloco phpBB SiteMaker é simplesmente uma classe que estende o blitze\sitemaker\services\blocks\driver\block class e retorna uma matriz do método "display" com um 'título' e 'conteúdo'. Tudo o resto está entre você. Para tornar o seu bloco detectável pelo phpBB SiteMaker, você precisará lhe dar a tag "sitemaker.block".

Diga que temos uma extensão com vendedor/extensão como meu/exemplo. Para criar um bloco chamado "my_block" para phpBB SiteMaker:

- Criar uma pasta "blocos"
- Criar meu arquivo_block.php na pasta de blocos com o seguinte conteúdo

```php
namespace min\example\blocks;

use blitze\sitemaker\serviços\blocks\driver\block;

class my_block estende o bloco
{
    /**
     * {@inheritdoc}
     */
    exibição de função pública (matriz $settings, $edit_mode = falso)
    {
        return array(
            'title' => 'my block title',
            'conteúdo' => 'conteúdo do meu bloco',
        );
    }
}
```

Em seguida, no seu arquivo config.yml, adicione o seguinte:

```yml
serviços:

    ...

    my.example.block.my_block:
        classe: meu\exemplo\blocos\meu_block
        chamadas:
            - [set_name, [my.example.block.my_block]]
        tags:
            - { name: sitemaker.block }

    ....

```

No mínimo, é tudo o que você precisa. Se você entrar no modo de edição, você deve ver o bloco listado como 'MY_EXAMPLE_BLOCK_MY_BLOCK' que pode ser arrastado e soltado em qualquer posição de bloco. Mas este bloco não faz nada emocionante. Não tem configurações e não traduz o nome do bloco. Vamos torná-lo mais interessante.

### Configurações de bloco

Vamos modificar nossos blocos/meu_block. arquivo hp e adicione um método "get_config" em retorna uma matriz com as teclas sendo as configurações do bloco e os valores sendo um array descrevendo as configurações da seguinte forma:

```php
    /**
     * @inheritdoc
     */
    public function get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        return array(
            'legend1'   => 'TAB1',
            'checkbox'  => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'checkbox', 'options' => $options, 'default' => array(), 'explain' => false),
            'yes_no'    => array('lang' => 'SOME_LANG_VAR_2', 'validate' => 'bool', 'type' => 'radio:yes_no', 'explain' => false, 'default' => false),
            'radio'     => array('lang' => 'SOME_LANG_VAR_3', 'validate' => 'bool', 'type' => 'radio', 'options' => $options, 'explain' => false, 'default' => 'topic'),
            'select'    => array('lang' => 'SOME_LANG_VAR_4', 'validate' => 'string', 'type' => 'select', 'options' => $options, 'default' => '', 'explain' => false),
            'multi'     => array('lang' => 'SOME_LANG_VAR_5', 'validate' => 'string', 'type' => 'multi_select', 'options' => $options, 'default' => array(), 'explain' => false),
            'legend2'   => 'TAB2',
            'number'    => array('lang' => 'SOME_LANG_VAR_6', 'validate' => 'int:0:20', 'type' => 'number:0:20', 'maxlength' => 2, 'explain' => false, 'default' => 5),
            'textarea'  => array('lang' => 'SOME_LANG_VAR_7', 'validate' => 'string', 'type' => 'textarea:3:40', 'maxlength' => 2, 'explain' => true, 'default' => ''),
            'togglable' => array('lang' => 'SOME_TOGGLABLE_VAR', 'validate' => 'string', 'type' => 'select:1:0:toggle_key', 'options' => $options, 'default' => '', 'append' => '<div id="toggle_key-1">Only show when option 1 is selected</div>'),
        );
    }
```

Isto é construído da mesma forma que a phpBB constrói a configuração para as configurações de conselho dos países ACP. Você pode ver mais exemplos [aqui](https://github.com/phpbb/phpbb/blob/master/phpBB/includes/acp/acp_board.php).

Se você quer um tipo de campo personalizado, você pode ver um exemplo [aqui](https://github.com/blitze/phpBB-ext-sitemaker_content/blob/develop/blocks/recent.php) ('content_type' ajuste).

Aviso 'legend1' e 'legend2': Estes são usados para separar as configurações em abas.

### Blocos de nomeação

A convenção para nomes de blocos é que o nome do serviço (ex. meu.exemplo.block. y*bloco acima) será usado como a chave de idioma, substituindo os pontos (.) pelo underscore (*) (por exemplo, MY_EXAMPLE_BLOCK_MY_BLOCK_BLOCK).

### Tradução

Observe também que temos várias chaves de idioma que precisam ser traduzidas. Para fazer isso, crie um arquivo chamado "blocks_admin.php" na sua pasta de idioma. Este arquivo será carregado automaticamente ao editar blocos, e deve ter traduções para suas configurações de blocos e nomes de blocos.

    $lang = array_merge($lang, array(
        'SOME_LANG_VAR'     => 'Option 1',
        'OTR_LANG_VAR' => 'Option 2',
        'SOME_LANG_VAR_1'   => 'Configuração',
        ....
        'MY_EXAMPLE_BLOCK_MY_BLOCK' => 'Meu Bloco',
    );
    

Porque 'blocks_admin.php' só é carregado quando editar blocos, você precisará adicionar outras traduções (por exemplo, o título do bloco) carregando um arquivo de idioma no seu método de exibição, como por exemplo `$language->add_lang('my_lang_file', 'my/example');`

### Renderizando o bloco

O novo bloco só será exibido se estiver renderizando algo. Seu bloco pode retornar qualquer string como conteúdo, mas na maioria dos casos, você precisa de um modelo para renderizar seu conteúdo. Para renderizar seu bloco usando modelos, o bloco deve retornar um array que contém os dados que você deseja passar para o template e também deve implementar o método `get_template` como demonstrado abaixo:

```php
    /**
     * @inheritdoc
     */
    function pública get_config(array $settings)
    {
        $options = array(1 => 'SOME_LANG_VAR', 2 => 'OTHER_LANG_VAR');
        array de retorno(
            'legenda1' => 'TAB1',
            'some_setting' => array('lang' => 'SOME_LANG_VAR_1', 'validate' => 'string', 'type' => 'caixa de seleção', 'opções' => $options, 'default' => array(), 'explain' => false),
        );
    }

    /**
     * {@inheritdoc}
     */
    função pública get_template()
    {
        return '@my_example/my_block. tml';
    }

    /**
     * {@inheritdoc}
     */
    display de função pública(array $data, $edit_mode = false)
    {
        if ($edit_mode)
        {
            // faz algo apenas no modo de edição
        }

        return array(
            'title' => 'MY_BLOCK_TITLE',
            'dados' => matriz(
                'some_var' => $data['settings']['some_setting'],
            ),
        );
}
```

Então o arquivo de estilos/all/my_block.html ou estilos/prosilver/my_block.html pode parecer algo como isto:

    <p>Você selecionou: {{ some_var }}</p>
    

Em resumo, seu bloco deve retornar uma matriz com uma `chave de título` (para o título do bloco) e uma `chave de conteúdo` (se o bloco apenas exibir uma string e não usa um template) ou uma chave `data` (se o bloco usar um template, em que caso, você também precisará implementar o método `get_template`).

### Bloquear Ativos

If your block needs to add assets (css/js) to the page, I recommend using the sitemaker [util class](https://github.com/blitze/phpBB-ext-sitemaker/blob/develop/services/util.php) for that. Como pode haver mais de uma instância do mesmo bloco na página, ou outros blocos podem estar adicionando o mesmo recurso, a classe de util garante que o ativo é apenas adicionado.

```php
        $this->util->add_assets(array(
            'js' => array(
                '@my_example/assets/some s',
                100 => '@meu_exemplo/ativos/outros. s', // defina prioridade
            ),
            'css' => array(
                '@meu_exemplo/ativos/alguns. ss',
            )
));
```

A classe util precisará, é claro, ser adicionada às suas definições de serviço em config.yml assim: `- '@blitze.sitemaker. até` e definido no construtor do seu bloco `\blitze\sitemaker\services\util $util`.

E é isso. Estamos prontos!