<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.linknacional.com.br
 * @since             2.0.0
 * @package           Lkn_Form_Customization_for_Give
 *
 * @wordpress-plugin
 * Plugin Name:       Donation Form Customization for GiveWP
 * Plugin URI:        https://www.linknacional.com.br/wordpress/givewp/give-free-form/
 * Description:       Form styling plugin for GiveWP.
 * Version:           2.0.0
 * Author:            Link Nacional
 * Author URI:        https://www.linknacional.com.br
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       lkn-give-free-form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Setup constants
 *
 * Defines useful constants to use throughout the plugin.
 *
 * @since 1.0.0
 */
// Defines plugin version number for easy reference.
if ( ! defined('LKN_DONATION_FORM_CUSTOMIZATION_VERSION')) {
    define('LKN_DONATION_FORM_CUSTOMIZATION_VERSION', '2.0.0');
}

// Set it to latest.
if ( ! defined('LKN_DONATION_FORM_CUSTOMIZATION_MIN_GIVE_VERSION')) {
    define('LKN_DONATION_FORM_CUSTOMIZATION_MIN_GIVE_VERSION', '2.3.0');
}

if ( ! defined('LKN_DONATION_FORM_CUSTOMIZATION_FILE')) {
    define('LKN_DONATION_FORM_CUSTOMIZATION_FILE', __FILE__);
}

if ( ! defined('LKN_DONATION_FORM_CUSTOMIZATION_DIR')) {
    define('LKN_DONATION_FORM_CUSTOMIZATION_DIR', plugin_dir_path(LKN_DONATION_FORM_CUSTOMIZATION_FILE));
}

if ( ! defined('LKN_DONATION_FORM_CUSTOMIZATION_URL')) {
    define('LKN_DONATION_FORM_CUSTOMIZATION_URL', plugin_dir_url(LKN_DONATION_FORM_CUSTOMIZATION_FILE));
}

if ( ! defined('LKN_DONATION_FORM_CUSTOMIZATION_BASENAME')) {
    define('LKN_DONATION_FORM_CUSTOMIZATION_BASENAME', plugin_basename(LKN_DONATION_FORM_CUSTOMIZATION_FILE));
}

if ( ! defined('LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN')) {
    define('LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN', 'lkn-give-free-form');
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lkn-give-free-form-activator.php
 */
function activate_lkn_give_free_form(): void {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-lkn-give-free-form-activator.php';
    Lkn_Form_Customization_for_Give_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lkn-give-free-form-deactivator.php
 */
function deactivate_lkn_give_free_form(): void {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-lkn-give-free-form-deactivator.php';
    Lkn_Form_Customization_for_Give_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lkn_give_free_form' );
register_deactivation_hook( __FILE__, 'deactivate_lkn_give_free_form' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lkn-give-free-form.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lkn_give_free_form(): void {
    $plugin = new Lkn_Form_Customization_for_Give();
    $plugin->run();
}
run_lkn_give_free_form();