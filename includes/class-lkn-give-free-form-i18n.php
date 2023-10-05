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
 * @package    Lkn_Give_Free_Form
 * @subpackage Lkn_Give_Free_Form/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Lkn_Give_Free_Form
 * @subpackage Lkn_Give_Free_Form/includes
 * @author     Link Nacional <email@email.com>
 */
final class Lkn_Give_Free_Form_i18n {
    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain(): void {
        load_plugin_textdomain(
            LKN_GIVE_FREE_FORM_TEXT_DOMAIN,
            false,
            dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
        );
    }
}
