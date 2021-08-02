# give-free-form

Módulo de estilização de formulário
Versão: 1.2.0

## Modo de Instalação

1) Faça o upload dos arquivos para a pasta /urldoseusite.com/wp-content/plugins/lkn-give-free-form/ caso a pasta do lkn-give-free-form não exista é necessário criá-la;

2) Após o upload vá para a área de administrador do seu wordpress e selecione a opção 'plugins';

3) Procure pelo plugin de nome 'Give - Formulário Customizado'

4) Clique em ativar;

5) Clique na opção 'todos os formulários' do GiveWP;

6) Selecione o formulário que deseja personalizar;

7) Habilite o Modelo 'Formulário de doação legado';

8) Nas opções de formulário selecione a seção 'Estilização do Formulário';

9) Clique em habilitar e personalize as cores e espaçamento da maneira que preferir;

10) Agora clique no botão de publicar (caso já esteja publicado será o botão de atualizar);

Pronto, agora o seu plugin de personalização de formulário está devidamente configurado e pronto para uso.

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