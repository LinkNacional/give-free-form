<?php
/**
 * Plugin Name: Give - Free Form
 * Plugin URI:  https://www.linknacional.com.br/wordpress/givewp/
 * Description: Plugin de estilização de formulário de doação para GiveWP.
 * Version:     1.4.0
 * Author:      Link Nacional
 * Author URI:  https://www.linknacional.com.br
 * License:     GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: lkn-give-free-form
 */

require_once __DIR__ . '/plugin-updater/plugin-update-checker.php';

/**
 * Our Globals for easy Reference.
 * You'll want to make sure you replace "GIVE_ADDON_BOILERPLATE"
 * with your own prefix throughout this whole plugin.
 *
 * Functions are prefixed with "give_boilerplate" and should be replaced as well.
 *
 * The text domain is give-addon-boilerplate and should be replaced as well.
 */

// Exit if accessed directly. ABSPATH is attribute in wp-admin - plugin.php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Lkn_Give_Free_Form
 */
final class Lkn_Give_Free_Form {
    /**
     * Instance.
     *
     * @since
     * @access private
     * @var Lkn_Give_Free_Form
     */
    private static $instance;

    /**
     * Singleton pattern.
     *
     * @since
     * @access private
     */
    private function __construct() {
        self::$instance = $this;
    }

    /**
     * Get instance.
     *
     * @return Lkn_Give_Free_Form
     * @since
     * @access public
     *
     */
    public static function get_instance() {
        if (!isset(self::$instance) && !(self::$instance instanceof Lkn_Give_Free_Form)) {
            self::$instance = new Lkn_Give_Free_Form();
            self::$instance->setup();
        }

        return self::$instance;
    }

    /**
     * Setup
     *
     * @since
     * @access private
     */
    private function setup() {
        self::$instance->setup_constants();

        register_activation_hook(LKN_GIVE_FREE_FORM_FILE, [$this, 'install']);
        add_action('give_init', [$this, 'init'], 10, 1);
        add_action('plugins_loaded', [$this, 'check_environment'], 999);
    }

    /**
     * Setup constants
     *
     * Defines useful constants to use throughout the add-on.
     *
     * @since
     * @access private
     */
    private function setup_constants() {
        // Defines addon version number for easy reference.
        if (!defined('LKN_GIVE_FREE_FORM_VERSION')) {
            define('LKN_GIVE_FREE_FORM_VERSION', '1.0');
        }

        // Set it to latest.
        if (!defined('LKN_GIVE_FREE_FORM_MIN_GIVE_VERSION')) {
            define('LKN_GIVE_FREE_FORM_MIN_GIVE_VERSION', '2.3.0');
        }

        if (!defined('LKN_GIVE_FREE_FORM_FILE')) {
            define('LKN_GIVE_FREE_FORM_FILE', __FILE__);
        }

        if (!defined('LKN_GIVE_FREE_FORM_DIR')) {
            define('LKN_GIVE_FREE_FORM_DIR', plugin_dir_path(LKN_GIVE_FREE_FORM_FILE));
        }

        if (!defined('LKN_GIVE_FREE_FORM_URL')) {
            define('LKN_GIVE_FREE_FORM_URL', plugin_dir_url(LKN_GIVE_FREE_FORM_FILE));
        }

        if (!defined('LKN_GIVE_FREE_FORM_BASENAME')) {
            define('LKN_GIVE_FREE_FORM_BASENAME', plugin_basename(LKN_GIVE_FREE_FORM_FILE));
        }
    }

    /**
     * Plugin installation
     *
     * @since
     * @access public
     */
    public function install() {
        // Bailout.
        if (!self::$instance->check_environment()) {
            return;
        }
    }

    /**
     * Plugin installation
     *
     * @param Give $give
     *
     * @return void
     * @since
     * @access public
     *
     */
    public function init($give) {
        //echo "init";
        if (!self::$instance->check_environment()) {
            //se não esta logado entra daqui
            self::$instance->load_files();
            self::$instance->setup_hooks();
            self::$instance->load_license();

            return;
        }

        self::$instance->load_files();
        self::$instance->setup_hooks();
        self::$instance->load_license();
    }

    /**
     * Check plugin environment
     *
     * @return bool|null
     * @since
     * @access public
     *
     */
    public function check_environment() {
        // Não é admin inserir aqui
        if (!is_admin() || !current_user_can('activate_plugins')) {
            require_once LKN_GIVE_FREE_FORM_DIR . 'includes/actions.php';

            return null;
        }

        // Load plugin helper functions.
        if (!function_exists('deactivate_plugins') || !function_exists('is_plugin_active')) {
            require_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        // Load helper functions.
        require_once LKN_GIVE_FREE_FORM_DIR . 'includes/misc-functions.php';

        // Flag to check whether deactivate plugin or not.
        $is_deactivate_plugin = false;

        // Verify dependency cases.
        switch (true) {
            case doing_action('give_init'):
                if (
                    defined('GIVE_VERSION') &&
                    version_compare(GIVE_VERSION, LKN_GIVE_FREE_FORM_MIN_GIVE_VERSION, '<')
                ) {
                    /* Min. Give. plugin version. */

                    // Show admin notice.
                    add_action('admin_notices', '__give_lkn_FREE_FORM_dependency_notice');

                    $is_deactivate_plugin = true;
                }

                break;

            case doing_action('activate_' . LKN_GIVE_FREE_FORM_BASENAME):
            case doing_action('plugins_loaded') && !did_action('give_init'):
                /* Check to see if Give is activated, if it isn't deactivate and show a banner. */

                // Check for if give plugin activate or not.
                $is_give_active = defined('GIVE_PLUGIN_BASENAME') ? is_plugin_active(GIVE_PLUGIN_BASENAME) : false;

                if (!$is_give_active) {
                    add_action('admin_notices', '__give_lkn_FREE_FORM_inactive_notice');

                    $is_deactivate_plugin = true;
                }

                break;
        }

        // Don't let this plugin activate.
        if ($is_deactivate_plugin) {
            // Deactivate plugin.
            deactivate_plugins(LKN_GIVE_FREE_FORM_BASENAME);

            if (isset($_GET['activate'])) {
                unset($_GET['activate']);
            }

            return false;
        }

        return true;
    }

    /**
     * Load plugin files.
     *
     * @since
     * @access private
     */
    private function load_files() {
        require_once LKN_GIVE_FREE_FORM_DIR . 'includes/misc-functions.php';
        require_once LKN_GIVE_FREE_FORM_DIR . 'includes/actions.php';

        if (is_admin()) {
            require_once LKN_GIVE_FREE_FORM_DIR . 'includes/admin/form-settings.php';
        }
    }

    /**
     * Setup hooks
     *
     * @since
     * @access private
     */
    private function setup_hooks() {
        // Filters
    }

    /**
     * Load license
     *
     * @since
     * @access private
     */
    private function load_license() {
        new Give_License(
            LKN_GIVE_FREE_FORM_FILE,
            'Give Free Form',
            LKN_GIVE_FREE_FORM_VERSION,
            'WordImpress',
            'lkn_give_free_form_license_key'
        );
    }
}

/**
 * The main function responsible for returning the one true Lkn_Give_Free_Form instance
 * to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $recurring = Lkn_Give_Free_Form(); ?>
 *
 * @return Lkn_Give_Free_Form|bool
 * @since 1.0
 *
 */
function Lkn_Give_Free_Form() {
    return Lkn_Give_Free_Form::get_instance();
}

Lkn_Give_Free_Form();

/**
 * Instância do updateChecker, ela exige os seguintes parâmetros:
 *
 * url do JSON
 * caminho completo do arquivo principal do plugin
 * nome do diretório para instalação
 *
 * @return object
 */
function lkn_give_free_form_updater() {
    return new Lkn_Puc_Plugin_UpdateChecker(
        'https://api.linknacional.com.br/app/u/link_api_update.php?slug=give-free-form',
        __FILE__, //Full path to the main plugin file or functions.php.
        'give-free-form'
    );
}

lkn_give_free_form_updater();
