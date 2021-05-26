<?php
// Settings admin serves the purpose of adding or modifying the tabs existing in the configurations
// window in the wordpress plugin give

/**
 * Add setting to exiting section and tab
 * If you want to add setting to existing tab and existing section then find a required filter for setting and add your logic.
 * With current code we are adding a setting field to "General" section of "General" tab
 *
 * @param $settings
 *
 * @return array
 */
function lkn_give_free_form_add_setting_into_existing_tab( $settings ) {
    return $settings;
}

add_filter( 'give_get_settings_gateways', 'lkn_give_free_form_add_setting_into_existing_tab' );

/**
 * Add setting to new section 'free Settings' of 'General' Tab
 * @param $settings
 *
 * @return array
 */
function lkn_give_free_form_add_setting_into_new_section( $settings ) {
    switch ( give_get_current_setting_section() ) {
    case 'free_form':

        // script passado como EOT
        $script = <<<HTML
        <script>
        
        document.addEventListener("DOMContentLoaded", function(event) {
            // pega o campo de descrição e seta o tamanho máximo como 100 de acordo com o free_form
            // var description = document.getElementById('free_form_description_setting_field');
            // description.setAttribute('maxlength', '100');
        });
        
        </script>
HTML;
        echo $script;

    	$settings[] = [
    	    'type' => 'title',
    	    'id' => 'free_form',
    	];

        $settings[] = [
            'name' => __( 'Modo de Depuração', 'give' ),
            'id' => 'lkn_free_form_debug',
            'desc' => __( 'Habilitar ambiente para Debug.' ),
            'type' => 'radio',
            'default' => 'disabled',
            'options' => [
                'enabled' => __( 'Habilitar', 'give' ),
                'disabled' => __( 'Desabilitar', 'give' ),
            ],
        ];

        $settings[] = [
            'id' => 'free_form',
            'type' => 'sectionend',
        ];
        break;
        }// // End switch()

    return $settings;
}

add_filter( 'give_get_settings_general', 'lkn_give_free_form_add_setting_into_new_section' );

/**
 * Add new section to "General" setting tab
 *
 * @param $sections
 *
 * @return array
 */
function lkn_give_free_form_add_new_setting_section( $sections ) {
    $sections['free_form'] = __( 'Formulário Customizado' );
    return $sections;
}

add_filter( 'give_get_sections_general', 'lkn_give_free_form_add_new_setting_section' );
