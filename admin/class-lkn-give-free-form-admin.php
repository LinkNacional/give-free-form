<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.linknacional.com.br
 * @since      1.0.0
 *
 * @package    Lkn_Form_Customization_for_Give
 * @subpackage Lkn_Form_Customization_for_Give/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Lkn_Form_Customization_for_Give
 * @subpackage Lkn_Form_Customization_for_Give/admin
 * @author     Link Nacional
 */
final class Lkn_Form_Customization_for_Give_Admin {
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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

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
            'title' => esc_html__('Form Customization', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
            'icon-html' => '<span class="dashicons dashicons-format-aside"></span>',
            'fields' => array(
                array(
                    'id' => "{$id}_lkn_form_style_status",
                    'name' => esc_html__('Enable.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'radio_inline',
                    'desc' => esc_html__('Enable the legacy form customization.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'options' => array(
                        'enabled' => esc_html__('Enabled', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                        'disabled' => esc_html__('Disabled', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    ),
                    'default' => 'disabled',
                ),
                array(
                    'id' => "{$id}_lkn_form_color",
                    'name' => esc_html__('Primary color.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'desc' => esc_html__('The primary color is used throughout the form template for multiple elements, including buttons, line breaks and focus elements. Set a color that reflects your brand or featured image for the best results.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'colorpicker',
                    'default' => '#2bc253',
                ),
                array(
                    'id' => "{$id}_lkn_details_color",
                    'name' => esc_html__('Secondary color.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'desc' => esc_html__('The secondary color is used in website details and highlights for the words.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'colorpicker',
                    'default' => '#ffffff',
                ),
                array(
                    'id' => "{$id}_lkn_title_color",
                    'name' => esc_html__('Titles color.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'desc' => esc_html__('Sets the font color for form sections.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'colorpicker',
                    'default' => '#666',
                ),
                array(
                    'id' => "{$id}_lkn_btn_border_color",
                    'name' => esc_html__('Color of buttons border.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'desc' => esc_html__('Sets the border color for the amount selection and payment method buttons.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'colorpicker',
                    'default' => '#ccc',
                ),
                array(
                    'id' => "{$id}_lkn_title_size",
                    'name' => esc_html__('Titles size.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'desc' => esc_html__('Sets the font size for form sections. Can use units of measurement in px, em, rem or vw.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'text',
                    'default' => '16px',
                ),
                array(
                    'id' => "{$id}_lkn_section_margin",
                    'name' => esc_html__('Spacing between sections.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'desc' => esc_html__('The margin used to separate sections of the form (only vertical margin). Can use units of measurement in px, em, rem or vw.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'text',
                    'default' => '10px',
                ),
                array(
                    'id' => "{$id}_lkn_btn_border_size",
                    'name' => esc_html__('Size of buttons border.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'desc' => esc_html__('Sets the border size for the amount selection and payment method buttons. Can use units of measurement in px, em, rem or vw.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'text',
                    'default' => '2px',
                ),
                array(
                    'id' => "{$id}_lkn_btn_border_radius",
                    'name' => esc_html__('Curvature of buttons border.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'text',
                    'desc' => esc_html__('Choose the curvature of the buttons border, the lower the value, the more square it will be. Can use units of measurement in px, em, rem or vw.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'default' => '15px',
                ),
                array(
                    'id' => "{$id}_lkn_btn_paddingA",
                    'name' => esc_html__('Height of buttons.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'desc' => esc_html__('Choose the height of buttons box. Can use units of measurement in px, em, rem or vw.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'text',
                    'default' => '15px',
                ),
                array(
                    'id' => "{$id}_lkn_btn_paddingL",
                    'name' => esc_html__('Width of buttons.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'desc' => esc_html__('Choose the width of buttons box. Can use units of measurement in px, em, rem or vw.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'text',
                    'default' => '50px',
                ),
                array(
                    'id' => "{$id}_lkn_btn_text_size",
                    'name' => esc_html__('Text font size of buttons.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'desc' => esc_html__('Choose the text font size of buttons content. Can use units of measurement in px, em, rem or vw.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'text',
                    'default' => '1em',
                ),
                array(
                    'id' => "{$id}_stripe_input_lkn_css",
                    'name' => esc_html__('Field for advanced styling of Stripe fields.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'desc' => esc_html__('Use CSS, without classes, to customize Stripe fields the way you want.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
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
                    'name' => esc_html__('Field for advanced styling.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'desc' => esc_html__('Use CSS to customize the form the way you want.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
                    'type' => 'textarea',
                    'default' => '',
                ),
            ),
        );

        return $settings;
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts(): void {
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
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lkn-give-free-form-admin.js', array('jquery'), $this->version, false );

        $bannerStrings = array(
            'message' => esc_html__('The form customization is not relevant for Multi-step form of GiveWP. If you want to use the Donation Form Customization for GiveWP, you need to change the Form Template to the `Legacy` option.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
            'label' => esc_html__('Warning: ', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN)
        );

        wp_localize_script( $this->plugin_name, 'bannerStrings', $bannerStrings);
    }
}
