# give-free-form

Módulo de estilização e personalização de formulários do GiveWP.

## Modo de Instalação

1) Procure na barra lateral a área de plugins do Wordpress;

2) Em plugins instalados procure pela opção 'adicionar novo' no cabeçalho;

3) Clique na opção de 'enviar plugin' no título da página e faça o upload do plugin give-free-form.zip;

4) Clique no botão 'instalar agora' e depois ative o plugin instalado;

Pronto! Agora o plugin foi devidamente instalado.

## Modo de uso

1) Clique na opção 'todos os formulários' do GiveWP;

2) Selecione o formulário que deseja personalizar;

3) Habilite o Template 'Legacy form';

4) Nas opções laterais do formulário selecione a seção 'Estilização do Formulário';

5) Clique em habilitar e personalize as cores e espaçamento da maneira que preferir;

6) Agora clique no botão de publicar (caso já esteja publicado será o botão de atualizar);

Pronto! Agora seu formulário foi personalizado.

## Modo de personalização via CSS

Existe um campo para fazer a personalização do CSS, abaixo há alguns exemplos de como fazer personalização de alguns elementos.

### Exemplo de mudar a cor de botões de doação por níveis:

/* Essa classe diz respeito aos botões de seleção de moedas */
.give-donation-level-btn {
background-color: #ffffff;
color: #1e73be;
}
.give-donation-level-btn:hover{
background-color: #ffffff;
color: #1e73be;
filter: brightness(120%);
}
/* Essa classe diz respeito ao botão selecionado/clicado */
.give-default-level{
background-color: #1e73be;
color: #ffffff;
}
.give-default-level:hover{
background-color: #1e73be;
color: #ffffff;
filter: brightness(120%);
}

### Exemplo de como alterar cores dos botões de seleção de modo de pagamento:

/* Essa classe representa as formas de pagamento */
form[id*=give-form] #give-gateway-radio-list>li{
    background-color: #ffffff;
    color: #1e73be;
}
/* Essa classe em específico é referente a forma de pagamento selecionada, é necessário adicionar o !important*/
.give-gateway-option-selected{
    background-color: #1e73be !important;
    color: #ffffff !important;
}

### Exemplo de como alterar cor e tamanho do botão de doar:

#give-purchase-button{
    background-color: #1e73be;
    color: #ffffff;
    font-size: 1vw;
}

## Changelog

### 1.3.2
* Bug fixes on new Classical template

### 1.3.1
* Footer message fix

### 1.3.0
* Changes on CSS configuration
* Added footer message
* Bug fixes

### 1.2.0
* new CSS configuration

### 1.0.0
* First Release