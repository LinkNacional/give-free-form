<?php

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
if (!defined('ABSPATH')) {
    exit;
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
function lkn_give_free_form_form($form_id, $args) {
    $id_prefix = !empty($args['id_prefix']) ? $args['id_prefix'] : '';

    $status = get_post_meta($form_id, 'free_form-fields_lkn_form_style_status', true);
    $color = get_post_meta($form_id, 'free_form-fields_lkn_form_color', true);
    $colorDet = get_post_meta($form_id, 'free_form-fields_lkn_details_color', true);
    $titleColor = get_post_meta($form_id, 'free_form-fields_lkn_title_color', true);
    $titleSize = get_post_meta($form_id, 'free_form-fields_lkn_title_size', true);
    $margin = get_post_meta($form_id, 'free_form-fields_lkn_section_margin', true);
    $btnBorderColor = get_post_meta($form_id, 'free_form-fields_lkn_btn_border_color', true);
    $btnBorderSize = get_post_meta($form_id, 'free_form-fields_lkn_btn_border_size', true);
    $btnBorderRadius = get_post_meta($form_id, 'free_form-fields_lkn_btn_border_radius', true);
    $paddingA = get_post_meta($form_id, 'free_form-fields_lkn_btn_paddingA', true);
    $paddingL = get_post_meta($form_id, 'free_form-fields_lkn_btn_paddingL', true);
    $textSize = get_post_meta($form_id, 'free_form-fields_lkn_btn_text_size', true);
    $css = get_post_meta($form_id, 'free_form-fields_lkn_css', true);
    $stripeCss = get_post_meta($form_id, 'free_form-fields_stripe_input_lkn_css', true);


    if ($status !== 'enabled') {
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
                border: $btnBorderSize solid $btnBorderColor;
                border-radius: $btnBorderRadius;
                color: $colorDet;
                padding: 12px 15px;
                cursor: pointer;
                line-height: 1.7em;
                font-size: $textSize;
                width: 100%;
                height: 100%;
            }

            .give-donation-level-btn:hover{
                background-color: $color;
                color: $colorDet;
                filter: brightness(120%);
            }

            .give-default-level:hover{
                background-color: $colorDet;
                color: $color;
                filter: brightness(120%);
            }

            .give-default-level{
                background-color: $colorDet;
                color: $color;
            }

            form[id*=give-form] #give-gateway-radio-list>li input[type=radio]{
                display: none;
            }

            .give-gateway-option-selected{
                background-color: $colorDet !important;
                color: $color !important;
            }

            form[id*=give-form] #give-gateway-radio-list>li{
                background-color: $color;
                color: $colorDet;
                border: solid $btnBorderSize $btnBorderColor;
                margin: 5px; 
                text-align: center;
                justify-content: center;
                align-items: center;
                display: flex;
                cursor: pointer;
                line-height: 2em;
                font-weight: 600;
                height: 100%;
                font-size: $textSize;
                border-radius: $btnBorderRadius;
            }

            form[id*=give-form] #give-gateway-radio-list {
                display: grid;
                grid-gap: 10px;
                grid-template-columns: repeat(3,minmax(0,1fr));
            }

            .give-btn-level-custom{
                font-size: $textSize;
                font-weight: 600;
            }

            .give-total-wrap{
                display: flex;
                justify-content: center;
                align-items: center;
            }

            form[id*=give-form] .give-donation-amount .give-currency-symbol{
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                font-size: 1.4em;
                background-color: transparent;
            }

            form[id*=give-form] .give-donation-amount .give-currency-symbol.give-currency-position-before{
                border-top: none;
                border-bottom: none;
                border-left: none;
                border-right: 2px solid darkgrey;
            }

            form[id*=give-form] .give-donation-amount .give-currency-symbol.give-currency-position-after{
                border-top: none;
                border-bottom: none;
                border-left: 2px solid darkgrey;
                border-right: none;
            }

            .give-donation-amount{
                width: fit-content;
                max-width: 80%;
                justify-content: center;
                align-items: center;
                display: flex;
                box-shadow: inset 0 1px 4px rgb(0 0 0 / 22%);
                border-radius: 5px;
                overflow: hidden;
                padding: 12px 16px;
                float: none;
                border-image: linear-gradient(to right, $colorDet, $color) 1;
                border-left: none;
                border-right: none;
                border-top: none;
                border-bottom: 3px solid;
            }

            form[id*=give-form] .give-donation-amount{
                margin: 5px auto 15px;
            }

            form[id*=give-form] .give-donation-amount #give-amount, form[id*=give-form] .give-donation-amount #give-amount-text{
                display: block;
                text-align: center;
                border: none;
                line-height: 1.7em;
                height: auto;
                font-size: 1.7em;
                min-width: 180px;
            }

            #give-donation-level-button-wrap{
                display: grid;
                grid-gap: 10px;
                grid-template-columns: repeat(3,minmax(0,1fr));
                margin: 16px 80px;
            }

            #give-donation-level-button-wrap:after, #give-donation-level-button-wrap:before {
                content: none;
            }

            form[id*=give-form] #give-gateway-radio-list:after, form[id*=give-form] #give-gateway-radio-list:before{
                content: none;
            }

            #give_checkout_user_info, #give-payment-mode-select {
                margin: $margin 0px;
            }

            #give-recurring-form h3.give-section-break, #give-recurring-form h4.give-section-break, #give-recurring-form legend, form.give-form h3.give-section-break, form.give-form h4.give-section-break, form.give-form legend, form[id*=give-form] h3.give-section-break, form[id*=give-form] h4.give-section-break, form[id*=give-form] legend{
                color: $titleColor;
                font-size: $titleSize;
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
                line-height: 1.3em;
            }

            .give-stripe-single-cc-field-wrap {
                $stripeCss
            }

            .form-row .give-stripe-cc-field {
                $stripeCss
            }

            #give-recurring-form .form-row .give-input-field-wrapper:focus, #give-recurring-form .form-row input[type=email]:focus, #give-recurring-form .form-row input[type=password]:focus, #give-recurring-form .form-row input[type=tel]:focus, #give-recurring-form .form-row input[type=text]:focus, #give-recurring-form .form-row input[type=url]:focus, #give-recurring-form .form-row select:focus, #give-recurring-form .form-row textarea:focus, form.give-form .form-row .give-input-field-wrapper:focus, form.give-form .form-row input[type=email]:focus, form.give-form .form-row input[type=password]:focus, form.give-form .form-row input[type=tel]:focus, form.give-form .form-row input[type=text]:focus, form.give-form .form-row input[type=url]:focus, form.give-form .form-row select:focus, form.give-form .form-row textarea:focus, form[id*=give-form] .form-row .give-input-field-wrapper:focus, form[id*=give-form] .form-row input[type=email]:focus, form[id*=give-form] .form-row input[type=password]:focus, form[id*=give-form] .form-row input[type=tel]:focus, form[id*=give-form] .form-row input[type=text]:focus, form[id*=give-form] .form-row input[type=url]:focus, form[id*=give-form] .form-row select:focus, form[id*=give-form] .form-row textarea:focus{
                border-image: linear-gradient(to right, #666, $color) 1;
            }

            .give-form .give-stripe-cc-field.focus, .give-form .give-stripe-cc-field:focus {
                border-image: linear-gradient(to right, #666, $color) 1 !important;
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

            .give-btn-reveal{
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                background-color: $color;
                color: $colorDet;
                padding: $paddingA $paddingL;
                font-size: $textSize;
                line-height: 1.4em;
                font-weight: 600;
                border-radius: $btnBorderRadius;
            }

            #give-purchase-button {
                border-radius: $btnBorderRadius;
                padding: $paddingA $paddingL;
                font-size: $textSize;
            }

            #give-purchase-button:hover {
                background: $color;
                filter: brightness(120%);
                border-radius: $btnBorderRadius;
            }

            [id*=give-form].give-display-modal .give-btn, [id*=give-form].give-display-reveal .give-btn{
                padding: $paddingA $paddingL;
                margin: 0px auto;
            }

            .give-btn-reveal:hover{
                background: $color;
                filter: brightness(120%);
            }

            [id*=give-form] .give-custom-amount-text{
                margin: 5px auto 15px;
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                font-size: 1.2em;
            }

            @media screen and (max-width: 850px) { 
                #give-donation-level-button-wrap{
                    margin: 16px 20px;
                }

                form[id*=give-form] #give-gateway-radio-list>li{
                    font-size: 1em;
                }
            }

            @media screen and (max-width: 500px) { 
                .give-donation-level-btn{
                    font-size: 1.4em;
                }

                .give-donation-amount{
                    max-width: 100%;
                }

                #give-donation-level-button-wrap{
                    grid-gap: 8px;
                    grid-template-columns: repeat(2,minmax(0,1fr));
                    margin: 8px 0px;
                }

                form[id*=give-form] #give-gateway-radio-list {
                    display: grid;
                    grid-gap: 8px;
                    grid-template-columns: repeat(2,minmax(0,1fr));
                }
                
                form[id*=give-form] #give-final-total-wrap .give-donation-total-label{
                    font-size: 13px;
                }

                form[id*=give-form] #give-final-total-wrap .give-final-total-amount{
                    font-size: 13px;
                }

                .give-btn-level-custom{
                    font-size: 14px;
                    font-weight: 600;
                }
            }

            .lkn-btn-gateway {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                background-color: $color;
                color: $colorDet;
                padding: $paddingA $paddingL;
                font-size: $textSize;
                line-height: 1.4em;
                font-weight: 600;
                border-radius: $btnBorderRadius;
            }

            .lkn-btn-gateway:hover{
                background-color: $color;
                color: $colorDet;
                filter: brightness(120%);
            }
            $css
            {}

        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

            var listaPagemento = document.getElementById('give-gateway-radio-list'); // Contém a lista com todos os objetos <li></li>
            var elemListaPagamento = listaPagemento.getElementsByTagName('li'); // lista com todos os obj da lista de gateways para elecionar
            var checkoutFieldsetWrap = document.getElementById('give_purchase_form_wrap'); // campos de finalização de compra checkout

            // função que da scroll ao clicar numa forma de pagamento
            var userInfoFieldsScroll = function () {
                checkoutFieldsetWrap.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
            };

            // Caso exista mais de 1 forma de pagamento insere eventos nos elementos html
            if (elemListaPagamento.length !== 1) {

                // insere eventos em todos os botões
                for (let c = 0; c < elemListaPagamento.length; c++) {

                    // Ao clicar na lista o input também reconhecerá o click e irá rolar para os campos do checkout
                    elemListaPagamento[c].addEventListener('click', function () {
                        var nodeChild = elemListaPagamento[c].children;
                        nodeChild[0].click();
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

add_action('give_donation_form_top', 'lkn_give_free_form_form', 10, 3);

/**
 * Adiciona notice com mensagem que redireciona para página da link nacional no rodapé do formulário
 */
function lkn_give_free_form_footer_notice() {
    $html = <<<HTML
        <div class="lknNoticeWrapper">
            <span class="dashicons dashicons-lock" style="color=#989898;"></span>
            <a href="https://www.linknacional.com.br/plataforma-de-doacoes/" target="_blank" style="color: #666;text-decoration: none;"><span class="lknNoticeText"> Plataforma de doação segura</span></a>
        </div>
        <script>
           // Verifica se janela foi carregada
            window.addEventListener('DOMContentLoaded', function () {
                // Pega elemento específico de formulário com iframe
                let iframeLoader = parent.document.getElementsByClassName('iframe-loader')[0];
                // Pega elemento contendo a mensagem
                let lknNoticeWrapper = document.getElementsByClassName('lknNoticeWrapper')[0];

                // Verifica se formulário está dentro de um iframe
                if (iframeLoader) {
                    // Pega o footer já existente e altera a mensagem para a da link nacional
                    let secureNotice = document.getElementsByClassName('secure-notice')[0];
                    if (secureNotice) {
                        // Caso esteja dentro de um iframe esconde <div> contendo a mensagem
                        lknNoticeWrapper.setAttribute('style', 'display:none;');

                        secureNotice.innerHTML = '<i class="fas fa-lock"></i><a href="https://www.linknacional.com.br/plataforma-de-doacoes/" target="_blank" style="font-size: 10px;color: #666;text-decoration: none;">Plataforma de doação segura</a>';
                    } else {
                        lknNoticeText = document.getElementsByClassName('lknNoticeText')[0];
                        lknNoticeText.classList.add('lknIframeText');
                        lknNoticeWrapper.classList.add('lknIframeWrapper');
                    }
                }
            });
        </script>

        <style>
            .lknNoticeWrapper {
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                margin-top: 75px;
            }
            .lknNoticeText {
                font-size: 10px;
                color: #989898;
            }
            .lknIframeText {
                font-size: 13px;
            }
            .lknIframeWrapper {
                margin-top: 25px;
                margin-bottom: 25px;
            }
        </style>
HTML;
    echo $html;
}

add_action('give_donation_form_bottom', 'lkn_give_free_form_footer_notice', 10, 3);
