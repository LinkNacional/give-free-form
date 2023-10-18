<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.linknacional.com.br
 * @since      1.0.0
 *
 * @package    Lkn_Form_Customization_for_Give
 * @subpackage Lkn_Form_Customization_for_Give/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Lkn_Form_Customization_for_Give
 * @subpackage Lkn_Form_Customization_for_Give/includes
 * @author     Link Nacional
 */
final class Lkn_Form_Customization_for_Give_i18n {
    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain(): void {
        load_plugin_textdomain(
            LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN,
            false,
            dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
        );
    }
}
