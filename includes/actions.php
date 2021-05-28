<?php

include_once __DIR__ . '/misc-functions.php';

/**
 * Give - Free Form Frontend Actions
 *
 * @since 2.5.0
 *
 * @package    Give
 * @copyright  Copyright (c) 2019, GiveWP
 * @license    https://opensource.org/licenses/gpl-license GNU Public License
 */

// Exit, if accessed directly.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/////// HELPERS

/**
 * This function centralizes the data in one spot for ease mannagment
 * 
 * @return array
 */
function lkn_give_free_form_get_configs () {
    $configs = [];

    $configs['base'] = __DIR__ . '/../free_form.errors.log';
    $configs['debug'] = lkn_give_free_form_get_debug();

    return $configs;
}

/**
 * Verify if the debug mode is enabled
 * 
 * @return string
 */
function lkn_give_free_form_get_debug() {
    $debug = give_get_option('lkn_free_form_debug');

    return $debug;
}

/**
 * Function that builds and executes a curl Query
 * 
 * @param array $array - contains headers info
 * 
 * @param string $url - contains the url the query is consulting
 * 
 * @param string $query - contains the Query to be executed
 * 
 * @return array $response - contains Query data
 */
function lkn_give_free_form_connect_query($array, $url ,$query) {
    $configs = lkn_give_free_form_get_configs();
    $base = $configs['base'];

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_URL => $url . $query,
        CURLOPT_HTTPHEADER => $array,
        CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($ch);
    $erro = curl_error($ch);
    $info = curl_getinfo($ch);

    curl_close($ch);

    if ($configs['debug'] === 'enabled') {
        error_log(' Query result: ' . var_export($response,true) . ' //// Curl Erro: ' . var_export($erro,true) . ' /// request result: ' . var_export($info['http_code'],true) . '\n \rn', 3, $base);
    }

    return $response;
}

/**
 * Function that builds and executes a curl Post
 * 
 * @param array $header
 * 
 * @param array $body
 * 
 * @param string $requisicao
 * 
 * @return array $response
 * 
 */
function lkn_give_free_form_connect_request ($header, $body, $requisicao ) {
    // set configs attribute
    $configs = lkn_give_free_form_get_configs();
    $base = $configs['base'];

    //início do CURL - Inicializando ele
    $curl_chamada = curl_init();

    //função que passa diversos parâmetros através de um array
    curl_setopt_array($curl_chamada, [
        CURLOPT_CUSTOMREQUEST => 'POST', 
        //tipo de requisição que será feita

        CURLOPT_URL => $configs['urlPost'] . $requisicao,
        //qual url que irá utilizar para requisição

        CURLOPT_HTTPHEADER => $header, 
        //cabecalhos que serão passados na requisicao.

        CURLOPT_POSTFIELDS => json_encode($body),
        //a variável $corpo possui o array com os campos que serão enviados via POST

        CURLOPT_RETURNTRANSFER => true 
        //resposta via string para a requisição
    ]);

    $result = curl_exec($curl_chamada);
    $erro = curl_error($curl_chamada);
    $info = curl_getinfo($curl_chamada);

    curl_close($curl_chamada);

    if ($configs['debug'] === 'enabled') {
        error_log(' POST result: ' . var_export($result,true) . ' //// Curl Erro: ' . var_export($erro,true) . ' /// CURL info: ' . var_export($info,true) . '\n \rn', 3, $base);
    }

    return $result;
}

/////// HELPERS

/**
 * Function that styles the form
 * 
 * @param int $form_id - the form identificator
 * 
 * @param array $args - list of additional arguments
 * 
 * @return mixed
 */
function lkn_give_free_form_form( $form_id, $args ) {
    $id_prefix = !empty( $args['id_prefix'] ) ? $args['id_prefix'] : '';
    $configs = lkn_give_free_form_get_configs();

    $status = get_post_meta( $form_id, 'free_form-fields_lkn_form_style_status', true);
    $color = get_post_meta( $form_id, 'free_form-fields_lkn_form_color', true);
    $colorDet = get_post_meta($form_id, 'free_form-fields_lkn_details_color', true);

    if ( !is_ssl() ) {
        Give()->notices->print_frontend_notice(
				sprintf(
					'<strong>%1$s</strong> %2$s',
					esc_html__( 'Erro:', 'give' ),
					esc_html__( 'Doação desabilitada por falta de SSL (HTTPS).', 'give' )
				)
			);
    } elseif ( $status !== 'enabled' ) {
        return false;
    } else {
        $form = <<<HTML
        <style>
            #give-purchase-button{
                background-color: $color;
                color: $colorDet;
                margin-left: 50%;
                margin-right: 50%;
            }

            [id*=give-form] div.summary{
                width: 100%;
                float: none;
            }

            #give-payment-mode-select{
                display: none;
            }

            #give-sidebar-left{
                display: none;
            }

            #lkn_give_purchase_form_wrap{
                display: none;
            }

            .give-donation-level-btn{
                background-color: $color;
                border: 2px solid #ccc;
                color: $colorDet;
                padding: 12px 15px;
                cursor: pointer;
                line-height: 1.4em;
                font-size: 1em;
            }

            .give-donation-level-btn:hover{
                background-color: $colorDet;
                color: $color;
            }

            .give-default-level{
                background-color: $colorDet;
                color: $color;
            }

            .give-gateway{
                display: none !important;
            }

            .give-gateway-option-selected{
                background-color: $colorDet !important;
                color: $color !important;
            }

            form[id*=give-form] #give-gateway-radio-list>li{
                background-color: $color;
                color: $colorDet;
                border: groove;
                padding: 2px 5px;
                margin: 5px; 
                text-align: center;
            }

        </style>

        <script>
            // @TODO é necessário levar em consideração quando o formulário tem apenas 1 forma de pagamento
            document.addEventListener('DOMContentLoaded', function() {
                console.log('reconheceu o script de modificação do formulário');
                var giveBtnReveal = document.getElementsByClassName('give-btn-reveal'); // verifica se o botão de revelar foi configurado pelo giveWP
                var listaPayments = document.getElementById('give-gateway-radio-list'); // Contém a lista com todos os objetos <li></li>
                var paymentFieldset = document.getElementById('give-payment-mode-select'); // contém os botões de seleção de métodos de pagamento
                var checkoutForm = document.getElementById('give_purchase_form_wrap'); // formulário de pagamento
                var donateBtn = document.getElementById('give-purchase-button'); // botão de finalizar compra
                var paymentBtns = document.getElementsByClassName('give-donation-level-btn'); // botões de valores
                var gatewayList = listaPayments.getElementsByTagName('li'); // lista com todos os obj da lista de gateways para elecionar

                console.log('tamanho lista desordenada: ' + gatewayList.length);

                // função para mostrar os métodos de pagamento
                var paymentModeDisplay = function () {
                    paymentFieldset.style.display = 'block';
                    console.log('payment modes foram mostrados');
                }

                // função para mostrar o formulário de finalização de pagamento
                var checkoutFormDisplay = function (){
                    checkoutForm.style.display = 'block';
                    checkoutForm.id = 'give_purchase_form_wrap';
                    console.log('checkout form foi mostrada');
                };

                console.log('verifica array de pagamentos ativos: ' + gatewayList.length);

                // caso não exista botão para revelar o restante do formulário mostra os mesmos
                if(giveBtnReveal.length == 0) {
                    console.log('nenhum botão de revelar reconhecido');
                    paymentFieldset.style.display = 'block';
                    checkoutForm.id = 'give_purchase_form_wrap';
                }

                if(gatewayList.length !== 1) {

                    checkoutForm.id = 'lkn_give_purchase_form_wrap';

                    // @TODO remover a classe de seleção? deixar seguir com o padrão selecionado?
                    // gatewayList[0].classList.remove('give-gateway-option-selected');
                    for(let c = 0; c < gatewayList.length; c++){
                        console.log('lista index: ' + c + ' lista obj: ' + gatewayList[c]);
                        
                        gatewayList[c].addEventListener('click', checkoutFormDisplay, false);

                    }
                }

            }, false);

        </script>

HTML;

        echo $form;
    }
}

add_action( 'give_donation_form_top', 'lkn_give_free_form_form', 10, 3 );
