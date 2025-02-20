<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.linknacional.com.br
 * @since      1.0.0
 *
 * @package    Lkn_Form_Customization_for_Give
 * @subpackage Lkn_Form_Customization_for_Give/includes
 */

use Give\Framework\Blocks\BlockModel;
use Give\Framework\FieldsAPI\Checkbox;
use Give\Framework\FieldsAPI\Contracts\Node;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Lkn_Form_Customization_for_Give
 * @subpackage Lkn_Form_Customization_for_Give/includes
 * @author     Link Nacional
 */
final class Lkn_Form_Customization_for_Give
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Lkn_Form_Customization_for_Give_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        if (defined('LKN_DONATION_FORM_CUSTOMIZATION_VERSION')) {
            $this->version = LKN_DONATION_FORM_CUSTOMIZATION_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'lkn-give-free-form';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Lkn_Form_Customization_for_Give_Loader. Orchestrates the hooks of the plugin.
     * - Lkn_Form_Customization_for_Give_i18n. Defines internationalization functionality.
     * - Lkn_Form_Customization_for_Give_Admin. Defines all hooks for the admin area.
     * - Lkn_Form_Customization_for_Give_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies(): void
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(__DIR__) . 'includes/class-lkn-give-free-form-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(__DIR__) . 'includes/class-lkn-give-free-form-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(__DIR__) . 'admin/class-lkn-give-free-form-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(__DIR__) . 'public/class-lkn-give-free-form-public.php';

        /**
         * The class responsible for useful functions of plugin.
         */
        require_once plugin_dir_path(__DIR__) . 'includes/class-lkn-give-free-form-helper.php';

        /**
         * The class responsible for plugin updater checker of plugin.
         */
        include_once plugin_dir_path(__DIR__) . 'includes/plugin-updater/plugin-update-checker.php';

        $this->loader = new Lkn_Form_Customization_for_Give_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Lkn_Form_Customization_for_Give_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale(): void
    {
        $plugin_i18n = new Lkn_Form_Customization_for_Give_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    public function updater_init(): ?object
    {
        if (class_exists('Lkn_Puc_Plugin_UpdateChecker')) {
            return new Lkn_Puc_Plugin_UpdateChecker(
                'https://api.linknacional.com.br/v2/u/?slug=give-free-form',
                LKN_DONATION_FORM_CUSTOMIZATION_FILE,
                LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN
            );
        } else {
            return null;
        }
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks(): void
    {
        $plugin_admin = new Lkn_Form_Customization_for_Give_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

        $this->loader->add_action('init', $this, 'updater_init');
        $this->loader->add_filter('give_metabox_form_data_settings', $plugin_admin, 'lkn_give_free_form_setup_setting', 999);
        $this->loader->add_action('plugins_loaded', 'Lkn_Form_Customization_for_Give_Helper', 'lkn_give_free_form_verify_plugin_dependencies', 999);

        $this->loader->add_action('givewp_form_builder_enqueue_scripts', $this, 'lkn_enqueue_givewp_block_editor_assets', 999, 1);
        $this->loader->add_filter('givewp_donation_form_block_render', $this, 'lkn_render_field', 10, 4);
    }

    public function lkn_render_field(?Node $node, BlockModel $block, int $index)
    {
        switch ($block->name) {
            case 'givewp/lkn-form-checkbox':
                $metaKey = 'lkn-form-checkbox-' . substr($block->clientId, 0, 8);

                return Checkbox::make($metaKey, $block)
                    ->label($block->getAttribute('label'))
                    ->checked($block->getAttribute('isRequired') == 1 && $block->getAttribute('isCheckedByDefault') == 1 ? '1' : ($block->getAttribute('isCheckedByDefault') == 1 ? true : ''))
                    ->value($block->getAttribute('isRequired') == 1 && $block->getAttribute('isCheckedByDefault') == 1 ? '1' : ($block->getAttribute('isCheckedByDefault') == 1 ? true : ''))
                    ->helpText($block->getAttribute('description'))
                    ->showInAdmin($block->getAttribute('showInAdmin'))
                    ->showInReceipt($block->getAttribute('showInReceipt'))
                    ->rules($block->getAttribute('isRequired') ? 'required' : 'boolean');
        }

        return $node;
    }

    public function lkn_enqueue_givewp_block_editor_assets()
    {
        wp_enqueue_script(
            'lkn-give-free-classnames',
            plugin_dir_url(__FILE__) . '../admin/js/lkn-give-free-form-classnames.js',
            array(),
            LKN_DONATION_FORM_CUSTOMIZATION_MIN_GIVE_VERSION,
            true
        );

        wp_enqueue_script(
            'lkn-give-free-form-checkbox-field',
            plugin_dir_url(__FILE__) . '../admin/js/lkn-give-free-form-checkbox-field.js',
            ['wp-blocks', 'wp-element', 'wp-editor'],
            LKN_DONATION_FORM_CUSTOMIZATION_MIN_GIVE_VERSION,
            true
        );

        wp_localize_script(
            'lkn-give-free-form-checkbox-field',
            'lknGiveFreeFormTranslations',
            Lkn_Form_Customization_for_Give_Helper::lkn_give_free_form_translations()
        );

        wp_enqueue_style(
            'lkn-give-free-form',
            plugin_dir_url(__FILE__) . '../admin/css/lkn-give-free-form.css',
            LKN_DONATION_FORM_CUSTOMIZATION_MIN_GIVE_VERSION,
            'all'
        );

    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks(): void
    {
        $plugin_public = new Lkn_Form_Customization_for_Give_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

        $this->loader->add_action('give_donation_form_top', $plugin_public, 'form_customization', 10, 2); // Também realiza o enqueue_styles, caso contrário todos formulários seriam customizados ignorando a opção de "Habilitar".
        $this->loader->add_action('give_donation_form_bottom', $plugin_public, 'lkn_give_free_form_footer_notice', 10, 3);
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run(): void
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Lkn_Form_Customization_for_Give_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }
}
