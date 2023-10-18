# Donation Form Customization for GiveWP

O [Donation Form Customization for GiveWP](https://www.linknacional.com.br/wordpress/givewp/give-free-form/) é um plugin extensão que oferece uma opção de editar os valores CSS dos formulário de doação, dentro das configurações de formulário do GiveWP.

A estilização de formulário não é relevante para o formulário Multi-step do GiveWP. Caso você deseje utilizar o Donation Form Customization for GiveWP, você precisa mudar o template do formulário para a opção "Legado".

## Dependencias

O plugin Donation Form Customization for GiveWP é dependente da ativação do [Give plugin](https://givewp.com/), por favor, tenha certeza de que ele esteja instalado e apropriadamente configurado antes de iniciar a instalação do Donation Form Customization for GiveWP.

## Instalação

1) Procure na barra lateral a área de "Plugins" do Wordpress;

2) Clique no botão "Adicionar novo", ao lado do título "Plugins" no topo do página;

3) Clique no botão "Enviar plugin", ao lado do título no topo do página e faça o upload do plugin lkn-give-free-form.zip;

4) Clique no botão 'Instalar agora' e depois ative o plugin instalado;

Ao terminar esses passos, o Donation Form Customization for GiveWP estará ativado e pronto para ser utilizado.

## Instruções uso

1) Na sidebar do Wordpress, procure pela opção "Doações" e selecione-a;

2) Na página "Formulário de doação", procure o formulário de doação - preferencialmente do template legado - para customizar e clique em "Editar";

3) Na sidebar das Opções do formulário de doação, clique na opção "Estilização do formulário";

4) No primeiro campo "Habilitar", selecione Habilitado;

5) Configure o restante da estilização do formulário de acordo com suas necessidades;

6) Agora, clique no botão de "Publicar" (caso já esteja publicado será o botão de "Atualizar");

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

## Notas de desenvolvimento

### Documentações para o desenvolvimento

- Wordpress Plugin Development: <https://developer.wordpress.org/plugins/>
- GiveWP: <https://github.com/impress-org/givewp>

### Estrutura de pastas

- `/admin/`: contém o arquivo onde é executado as funções para o lado administrativo do plugin, que consiste na definição da definição das configurações de estilização, e do script de apresentação do aviso de irrelevância para outros templates de formulário.
- `/includes/`: contém diversos arquivos responsáveis pelo funcionamento do plugin.
- `/public/`: contém o arquivo onde é executado as funções para o lado público do plugin, como a definição da estilização do formulário, bem como o script de aviso de plataforma segura de doação.