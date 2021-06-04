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
    $titleColor = get_post_meta($form_id, 'free_form-fields_lkn_title_color', true);
    $titleSize = get_post_meta($form_id, 'free_form-fields_lkn_title_size', true);
    $margin = get_post_meta($form_id, 'free_form-fields_lkn_section_margin', true);

    $titleSize .= 'px';
    $margin .= 'px';

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
                padding: 18px 70px;
                font-size: 1.4em;
                line-height: 1.4em;
                font-weight: 600;
                border-radius: 15px;
            }

            .give-submit-button-wrap{
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .give-submit-button-wrap:focus{
                filter: brightness(120%);
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
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background-color: $color;
                border: 2px solid #ccc;
                border-radius: 5px;
                color: $colorDet;
                padding: 12px 15px;
                cursor: pointer;
                line-height: 1.7em;
                font-size: 1.7em;
                width: 100%;
                height: 100%;
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
                border: solid 1px #ccc;
                margin: 5px; 
                text-align: center;
                justify-content: center;
                align-items: center;
                display: flex;
                cursor: pointer;
                line-height: 2em;
                font-size: 1.3em;
                font-weight: 600;
                height: 100%;
            }

            form[id*=give-form] #give-gateway-radio-list {
                display: grid;
                grid-gap: 10px;
                grid-template-columns: repeat(3,minmax(0,1fr));
            }

            .give-btn-level-custom{
                font-size: 14px !important;
                font-weight: 600 !important;
            }

            .give-total-wrap{
                display: flex !important;
                justify-content: center;
                align-items: center;
            }

            .give-currency-symbol{
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                font-size: 1.5em;
                /*border: none !important;*/
                border-top: none !important;
                border-bottom: none !important;
                border-left: none !important;
                border-right: 2px solid darkgrey !important;
                background-color: transparent !important;
            }

            .give-donation-amount{
                width: fit-content;
                max-width: 80%;
                justify-content: center;
                align-items: center;
                display: flex !important;
                box-shadow: inset 0 1px 4px rgb(0 0 0 / 22%);
                /*border: 1px solid #979797;*/
                border-radius: 5px!important;
                overflow: hidden;
                padding: 12px 16px;
                float: none!important;
                margin: 5px auto 15px!important;
                border-image: linear-gradient(to right, $colorDet, $color) 1;
                border-left: none;
                border-right: none;
                border-top: none;
                border-bottom: 3px solid;
            }

            #give-amount{
                display: flex;
                text-align: center;
                border: none !important;
                line-height: 1.7em !important;
                height: auto !important;
                font-size: 1.7em !important;
                min-width: 180px !important;
            }

            #give-donation-level-button-wrap{
                display: grid!important;
                grid-gap: 10px;
                grid-template-columns: repeat(3,minmax(0,1fr));
                margin: 16px 80px !important;
            }

            #give-donation-level-button-wrap:after, #give-donation-level-button-wrap:before {
                content: none !important;
            }

            form[id*=give-form] #give-gateway-radio-list:after, form[id*=give-form] #give-gateway-radio-list:before{
                content: none !important;
            }

            #give_checkout_user_info, #give-payment-mode-select {
                margin: $margin 0px !important;
            }

            legend{
                color: $titleColor !important;
                font-size: $titleSize !important;
            }

            #give-recurring-form .form-row .give-input-field-wrapper, #give-recurring-form .form-row input[type=email], #give-recurring-form .form-row input[type=password], #give-recurring-form .form-row input[type=tel], #give-recurring-form .form-row input[type=text], #give-recurring-form .form-row input[type=url], #give-recurring-form .form-row select, #give-recurring-form .form-row textarea, form.give-form .form-row .give-input-field-wrapper, form.give-form .form-row input[type=email], form.give-form .form-row input[type=password], form.give-form .form-row input[type=tel], form.give-form .form-row input[type=text], form.give-form .form-row input[type=url], form.give-form .form-row select, form.give-form .form-row textarea, form[id*=give-form] .form-row .give-input-field-wrapper, form[id*=give-form] .form-row input[type=email], form[id*=give-form] .form-row input[type=password], form[id*=give-form] .form-row input[type=tel], form[id*=give-form] .form-row input[type=text], form[id*=give-form] .form-row input[type=url], form[id*=give-form] .form-row select, form[id*=give-form] .form-row textarea{
                border: solid 2px #ccc;
                border-radius: 5px;
            }

            .give-input{
                font-size: 1.3em;
                box-shadow: inset 0 1px 4px rgb(0 0 0 / 22%);
                border: solid 2px #ccc;
                border-radius: 5px;
                /*border-image: linear-gradient(to right, #9a9a9a, $color) 1 !important;*/
                line-height: 1.3em;
            }

            #give-recurring-form .form-row .give-input-field-wrapper:focus, #give-recurring-form .form-row input[type=email]:focus, #give-recurring-form .form-row input[type=password]:focus, #give-recurring-form .form-row input[type=tel]:focus, #give-recurring-form .form-row input[type=text]:focus, #give-recurring-form .form-row input[type=url]:focus, #give-recurring-form .form-row select:focus, #give-recurring-form .form-row textarea:focus, form.give-form .form-row .give-input-field-wrapper:focus, form.give-form .form-row input[type=email]:focus, form.give-form .form-row input[type=password]:focus, form.give-form .form-row input[type=tel]:focus, form.give-form .form-row input[type=text]:focus, form.give-form .form-row input[type=url]:focus, form.give-form .form-row select:focus, form.give-form .form-row textarea:focus, form[id*=give-form] .form-row .give-input-field-wrapper:focus, form[id*=give-form] .form-row input[type=email]:focus, form[id*=give-form] .form-row input[type=password]:focus, form[id*=give-form] .form-row input[type=tel]:focus, form[id*=give-form] .form-row input[type=text]:focus, form[id*=give-form] .form-row input[type=url]:focus, form[id*=give-form] .form-row select:focus, form[id*=give-form] .form-row textarea:focus{
                border-image: linear-gradient(to right, #666, $color) 1;
            }

            #give-final-total-wrap{
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            form[id*=give-form] #give-final-total-wrap .give-donation-total-label{
                box-shadow: inset 0 1px 4px rgb(0 0 0 / 22%);
            }

            form[id*=give-form] #give-final-total-wrap .give-final-total-amount{
                box-shadow: inset 0 1px 4px rgb(0 0 0 / 22%);
            }

            @media screen and (max-width: 850px) { 
                #give-donation-level-button-wrap{
                    margin: 16px 20px !important;
                }
            }

            @media screen and (max-width: 500px) { 
                .give-donation-level-btn{
                    font-size: 1.5em;
                    border: none;
                }
                .give-donation-amount{
                    max-width: 100%;
                }
                #give-donation-level-button-wrap{
                    grid-gap: 8px;
                    grid-template-columns: repeat(2,minmax(0,1fr));
                    margin: 8px 0px !important;
                }
                form[id*=give-form] #give-gateway-radio-list {
                    display: grid;
                    grid-gap: 8px;
                    grid-template-columns: repeat(2,minmax(0,1fr));
                }
                form[id*=give-form] #give-gateway-radio-list>li{
                    font-size: 1em;
                }
                form[id*=give-form] #give-final-total-wrap .give-donation-total-label{
                    font-size: 13px;
                }

                form[id*=give-form] #give-final-total-wrap .give-final-total-amount{
                    font-size: 13px;
                }
            }


        </style>

        <script>
            // @TODO é necessário levar em consideração quando o formulário tem apenas 1 forma de pagamento
            document.addEventListener('DOMContentLoaded', function() {
                console.log('reconheceu o script de modificação do formulário');
                var formGive = document.getElementById('give-form-$id_prefix');
                var giveBtnReveal = document.getElementsByClassName('give-btn-reveal'); // verifica se o botão de revelar foi configurado pelo giveWP
                var listaPayments = document.getElementById('give-gateway-radio-list'); // Contém a lista com todos os objetos <li></li>
                var paymentFieldset = document.getElementById('give-payment-mode-select'); // contém os botões de seleção de métodos de pagamento
                var checkoutForm = document.getElementById('give_purchase_form_wrap'); // formulário de pagamento
                var donateBtn = document.getElementById('give-purchase-button'); // botão de finalizar compra
                var paymentBtns = document.getElementsByClassName('give-donation-level-btn'); // botões de valores
                var gatewayList = listaPayments.getElementsByTagName('li'); // lista com todos os obj da lista de gateways para elecionar
                var inputAmount = document.getElementById('give-amount');
                var checkoutFieldsetWrap = document.getElementById('give_purchase_form_wrap');
                var checkoutFieldset = document.getElementById('give_checkout_user_info');

                console.log('tamanho lista desordenada: ' + gatewayList.length);

                // função para mostrar os métodos de pagamento
                var paymentModeDisplay = function () {
                    paymentFieldset.style.display = 'block';
                    console.log('payment modes foram mostrados');
                };

                // função para mostrar o formulário de finalização de pagamento
                var checkoutFormDisplay = function (){
                    checkoutForm.style.display = 'block';
                    checkoutForm.id = 'give_purchase_form_wrap';
                    console.log('checkout form foi mostrada');
                };

                var userInfoFieldsScroll = function () {
                    console.log('rodou rolagem');
                    checkoutFieldsetWrap.scrollIntoView({behavior: 'smooth', block: 'nearest', inline: 'start'});
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
                        
                        gatewayList[c].addEventListener('click', function () {
                            console.log('li foi clicado');
                            var nodeChild = gatewayList[c].children;
                            nodeChild[0].click();
                            checkoutFormDisplay();
                            userInfoFieldsScroll();
                        }, false);

                    }
                }

            }, false);

        </script>

HTML;

        echo $form;
    }
}

add_action( 'give_donation_form_top', 'lkn_give_free_form_form', 10, 3 );
