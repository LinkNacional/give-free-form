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
        $this->id = 'custom_form-fields';
        $this->prefix = '_custom_form_';
        add_filter( 'give_metabox_form_data_settings', [$this, 'setup_setting'], 999 );
    }

    function setup_setting( $settings ) {
        $screen = get_current_screen();

        // Custom metabox settings.
        $settings["{$this->id}_tab"] = [
            'id' => "{$this->id}_tab",
            'title' => __( 'Estilização do Formulário', 'sss4givewp' ),
            'icon-html' => '<span class="dashicons dashicons-text-page"></span>',
            'fields' => [
                [
                    'id' => "{$this->id}_lkn_form_style_disabled",
                    'name' => '',
                    'type' => 'disabled_for_non_legacy_templates_html',
                    'callback' => [$this, 'disabled_for_non_legacy_templates_html'],
                ],
                [
                    'id' => "{$this->id}_lkn_form_style_status",
                    'name' => __( 'Habilitar', 'pfconfs-4-givewp' ),
                    'type' => 'radio_inline',
                    'desc' => __( 'Habilita a estilização do formulário legado.', 'pfconfs-4-givewp' ),
                    'options' => [
                        'enabled' => __('Habilitado', 'pfconfs-4-givewp'),
                        'disabled' => __('Desabilitado', 'pfconfs-4-givewp'),
                    ],
                    'default' => 'disabled',
                ],
                [
                    'id' => "{$this->id}_lkn_form_color",
                    'name' => __( 'Cor primária.', 'pfconfs-4-givewp' ),
                    'desc' => 'A cor primária é usada em todo o modelo de formulário para vários elementos, incluindo botões, quebras de linha e elementos de foco. Defina uma cor que reflita sua marca ou imagem em destaque para obter os melhores resultados.',
                    'type' => 'colorpicker',
                    'default' => '#2bc253',
                ],
            ],
        ];
        return $settings;
    }

    public function disabled_for_non_legacy_templates_html() {
        ob_start(); ?>
			<p class="pfconfs-disabled"><?php _e('Per Form Confirmations is not relevant for non-Legacy Form Templates. If you want to use Per Form Confirmations, then change your Form Template to the "Legacy" option.', 'pfconfs-4-givewp'); ?></p>
		<?php 

		$html = ob_get_contents();

        return $html;
    }
}
new Lkn_Free_Form_Settings();