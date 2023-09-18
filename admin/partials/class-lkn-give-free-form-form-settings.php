<?php
// Exit if access directly.
if ( ! defined('ABSPATH')) {
    exit;
}
/**
 * Example code to show how to add metabox tab to give form data settings.
 *
 * @package     Give
 * @copyright   Copyright (c) 2020, Impress.org
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
final class Lkn_Give_Free_Form_Settings {
    /**
     * Add form customization settings.
     *
     * @param mixed $settings
     * @return mixed $settings
     *
     */
    public static function lkn_give_free_form_setup_setting($settings) {
        $id = 'free_form-fields';

        // Custom metabox settings.
        $settings["{$id}_tab"] = array(
            'id' => "{$id}_tab",
            'title' => __('Estilização do Formulário', 'lkn-give-free-form'),
            'icon-html' => '<span class="dashicons dashicons-format-aside"></span>',
            'fields' => array(
                array(
                    'id' => "{$id}_lkn_form_style_disabled",
                    'name' => '',
                    'type' => 'disabled_for_non_legacy_templates_html',
                    'callback' => Lkn_Give_Free_Form_Settings::disabled_for_non_legacy_templates_html(),
                ),
                array(
                    'id' => "{$id}_lkn_form_style_status",
                    'name' => __('Habilitar', 'lkn-give-free-form'),
                    'type' => 'radio_inline',
                    'desc' => __('Habilita a estilização do formulário legado.', 'lkn-give-free-form'),
                    'options' => array(
                        'enabled' => __('Habilitado', 'lkn-give-free-form'),
                        'disabled' => __('Desabilitado', 'lkn-give-free-form'),
                    ),
                    'default' => 'disabled',
                ),
                array(
                    'id' => "{$id}_lkn_form_color",
                    'name' => __('Cor primária.', 'lkn-give-free-form'),
                    'desc' => __('A cor primária é usada em todo o modelo de formulário para vários elementos, incluindo botões, quebras de linha e elementos de foco. Defina uma cor que reflita sua marca ou imagem em destaque para obter os melhores resultados.', 'lkn-give-free-form'),
                    'type' => 'colorpicker',
                    'default' => '#2bc253',
                ),
                array(
                    'id' => "{$id}_lkn_details_color",
                    'name' => __('Cor secundária.', 'lkn-give-free-form'),
                    'desc' => __('A cor secundária é utilizadas em detalhes do site e destaque para as palavras.', 'lkn-give-free-form'),
                    'type' => 'colorpicker',
                    'default' => '#ffffff',
                ),
                array(
                    'id' => "{$id}_lkn_title_color",
                    'name' => __('Cor dos títulos.', 'lkn-give-free-form'),
                    'desc' => __('Define a cor da fonte das seções do formulário.', 'lkn-give-free-form'),
                    'type' => 'colorpicker',
                    'default' => '#666',
                ),
                array(
                    'id' => "{$id}_lkn_btn_border_color",
                    'name' => __('Cor das bordas dos botões.', 'lkn-give-free-form'),
                    'desc' => __('Define a cor das bordas para os botões de seleção de valor e de método de pagamento.', 'lkn-give-free-form'),
                    'type' => 'colorpicker',
                    'default' => '#ccc',
                ),
                array(
                    'id' => "{$id}_lkn_title_size",
                    'name' => __('Tamanho dos títulos.', 'lkn-give-free-form'),
                    'desc' => __('Define o tamanho da fonte das seções do formulário. Pode utilizar unidades de medida em px, em, rem ou vw.', 'lkn-give-free-form'),
                    'type' => 'text',
                    'default' => '16px',
                ),
                array(
                    'id' => "{$id}_lkn_section_margin",
                    'name' => __('Espaçamento entre as seções.', 'lkn-give-free-form'),
                    'desc' => __('A margem utilizada para separar as seções do formulário, apenas margem vertical. Pode utilizar unidades de medida em px, em, rem ou vw.', 'lkn-give-free-form'),
                    'type' => 'text',
                    'default' => '10px',
                ),
                array(
                    'id' => "{$id}_lkn_btn_border_size",
                    'name' => __('Tamanho das bordas dos botões.', 'lkn-give-free-form'),
                    'desc' => __('Define o tamanho das bordas dos botões de seleção de valor e de seleção de pagamento. Pode utilizar unidades de medida em px, em, rem ou vw.', 'lkn-give-free-form'),
                    'type' => 'text',
                    'default' => '2px',
                ),
                array(
                    'id' => "{$id}_lkn_btn_border_radius",
                    'name' => __('Curvatura das bordas.', 'lkn-give-free-form'),
                    'type' => 'text',
                    'desc' => __('Escolha a curvatura das bordas dos botões, quanto menor o valor mais quadrada será. Pode utilizar unidades de medida em px, em, rem ou vw.', 'lkn-give-free-form'),
                    'default' => '15px',
                ),
                array(
                    'id' => "{$id}_lkn_btn_paddingA",
                    'name' => __('Altura dos Botões.', 'lkn-give-free-form'),
                    'desc' => __('Escolha o altura das caixas dos botões. Pode utilizar unidades de medida em px, em, rem ou vw.', 'lkn-give-free-form'),
                    'type' => 'text',
                    'default' => '15px',
                ),
                array(
                    'id' => "{$id}_lkn_btn_paddingL",
                    'name' => __('Largura dos Botões.', 'lkn-give-free-form'),
                    'desc' => __('Escolha a largura das caixas dos botões. Pode utilizar unidades de medida em px, em, rem ou vw.', 'lkn-give-free-form'),
                    'type' => 'text',
                    'default' => '50px',
                ),
                array(
                    'id' => "{$id}_lkn_btn_text_size",
                    'name' => __('Tamanho da Fonte do Texto dos Botões.', 'lkn-give-free-form'),
                    'desc' => __('Escolha o tamanho da fonte do texto do conteúdo dos botões. Pode utilizar unidades de medida em px, em, rem ou vw.', 'lkn-give-free-form'),
                    'type' => 'text',
                    'default' => '1em',
                ),
                array(
                    'id' => "{$id}_stripe_input_lkn_css",
                    'name' => __('Campo para estilização avançada de campos do Stripe.', 'lkn-give-free-form'),
                    'desc' => __('Utilize CSS, sem classes, para customizar os campos do Stripe do seu jeito.', 'lkn-give-free-form'),
                    'type' => 'textarea',
                    'default' => '
font-size: 1.3em !important;
box-shadow: inset 0 1px 4px rgb(0 0 0 / 22%) !important;
border: solid 2px #ccc !important;
border-radius: 5px !important;
line-height: 1.3em !important;',
                ),
                array(
                    'id' => "{$id}_lkn_css",
                    'name' => __('Campo para estilização avançada.', 'lkn-give-free-form'),
                    'desc' => __('Utilize CSS para customizar o formulário do seu jeito.', 'lkn-give-free-form'),
                    'type' => 'textarea',
                    'default' => '',
                ),
            ),
        );

        return $settings;
    }

    // TODO melhorar um pouco essa função (Mostrar só em forms não-legado, arrumar html, etc).
    /**
     * Add a form admin notice
     *
     * @return string $html
     *
     */
    public static function disabled_for_non_legacy_templates_html() {
        // $current_form_id = give_get_current_form_id();

        // $form = give_get_form_object($current_form_id);

        // $form_type = $form->get_form_type();

        ob_start(); ?>
<p class="ffconfs-disabled">
    <?php _e(/* $form_type . */ 'O formulário customizado não é relevante para o formulário Multi-Step do giveWP. Caso você deseje utilizar o Free Form Plugin é necessário mudar o Template do formulário para opção "Legado".', 'lkn-give-free-form-notices'); ?>
</p>
<?php

        $html = ob_get_contents();

        return $html;
    }
}