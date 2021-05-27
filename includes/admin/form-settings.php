<?php
// Exit if access directly.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Example code to show how to add metabox tab to give form data settings.
 *
 * @package     Give
 * @copyright   Copyright (c) 2020, Impress.org
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class Lkn_Free_Form_Settings {
    /**
     * Give_Metabox_Setting_Fields constructor.
     */
    function __construct() {
        $this->id = 'free_form-fields';
        $this->prefix = '_free_form_';
        add_filter( 'give_metabox_form_data_settings', [$this, 'setup_setting'], 999 );
    }

    function setup_setting( $settings ) {
        $screen = get_current_screen();

        // Custom metabox settings.
        $settings["{$this->id}_tab"] = [
            'id' => "{$this->id}_tab",
            'title' => __( 'Estilização do Formulário', 'lkn-title-ff' ),
            'icon-html' => '<span class="dashicons dashicons-format-aside"></span>',
            'fields' => [
                [
                    'id' => "{$this->id}_lkn_form_style_disabled",
                    'name' => '',
                    'type' => 'disabled_for_non_legacy_templates_html',
                    'callback' => [$this, 'disabled_for_non_legacy_templates_html'],
                ],
                [
                    'id' => "{$this->id}_lkn_form_style_status",
                    'name' => __( 'Habilitar', 'lkn-pfconfs-status-e-givewp' ),
                    'type' => 'radio_inline',
                    'desc' => __( 'Habilita a estilização do formulário legado.', 'lkn-pfconfs-status-desc-givewp' ),
                    'options' => [
                        'enabled' => __('Habilitado', 'lkn-pfconfs-status-e-givewp'),
                        'disabled' => __('Desabilitado', 'lkn-pfconfs-status-e-givewp'),
                    ],
                    'default' => 'disabled',
                ],
                [
                    'id' => "{$this->id}_lkn_form_color",
                    'name' => __( 'Cor primária.', 'lkn-pfconfs-color-givewp' ),
                    'desc' => __('A cor primária é usada em todo o modelo de formulário para vários elementos, incluindo botões, quebras de linha e elementos de foco. Defina uma cor que reflita sua marca ou imagem em destaque para obter os melhores resultados.', 'lkn-pfconfs-color-desc-givewp'),
                    'type' => 'colorpicker',
                    'default' => '#2bc253',
                ],
                [
                    'id' => "{$this->id}_lkn_details_color",
                    'name' => __( 'Cor secundária.', 'lkn-pfconfs-color-givewp' ),
                    'desc' => __('A cor secundária é utilizadas em detalhes do site e destaque para as palavras.', 'lkn-pfconfs-color-desc-givewp'),
                    'type' => 'colorpicker',
                    'default' => '#ffffff',
                ],
            ],
        ];
        return $settings;
    }

    public function disabled_for_non_legacy_templates_html() {
        ob_start(); ?>
			<p class="ffconfs-disabled"><?php _e('O formulário customizado não é relevante para o formulário novo do giveWP. Caso você deseje utilizar o Free Form Plugin é necessário mudar o Template do formulário para opção "Legado".', 'ffconfs-notice-givewp'); ?></p>
		<?php 

		$html = ob_get_contents();

        return $html;
    }
}
new Lkn_Free_Form_Settings();