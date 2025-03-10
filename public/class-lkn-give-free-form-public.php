<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.linknacional.com.br
 * @since      1.0.0
 *
 * @package    Lkn_Form_Customization_for_Give
 * @subpackage Lkn_Form_Customization_for_Give/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Lkn_Form_Customization_for_Give
 * @subpackage Lkn_Form_Customization_for_Give/public
 * @author     Link Nacional
 */
final class Lkn_Form_Customization_for_Give_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Function that styles the form
     *
     * @param int $form_id - the form identificator
     *
     * @param array $args - list of additional arguments
     *
     */
    public function form_customization($form_id, $args): void
    {
        require_once LKN_DONATION_FORM_CUSTOMIZATION_DIR . 'public/partials/class-lkn-give-free-form-customization.php';
    }

    /**
     * Adds the mensage notice that's redirect for Link Nacional page on form footer.
     */
    public function lkn_give_free_form_footer_notice(): void
    {
        $link = esc_html__('https://www.linknacional.com.br/plataforma-de-doacoes/', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN);
        $message = esc_html__('Secure donation platform', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN);

        $html = '<div class="lkn_notice_wrapper">
            <span class="dashicons dashicons-lock" style="color: #989898;"></span>
            <a href="' . esc_url($link) . '" target="_blank" style="color: #666; text-decoration: none;">
                <span class="lknNoticeText">' . esc_html($message) . '</span>
            </a>
        </div>';
        echo wp_kses_post($html);
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts(): void
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Lkn_Form_Customization_for_Give_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Lkn_Form_Customization_for_Give_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/lkn-give-free-form-public.js', array('jquery'), $this->version, false);
    }
}
