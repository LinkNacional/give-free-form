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
final class Lkn_Form_Customization_for_Give_Public {
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
    public function __construct( $plugin_name, $version ) {
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
    public function form_customization($form_id, $args): void {
        $id_prefix = ! empty($args) ? $args : '';

        $status = get_post_meta($form_id, 'free_form-fields_lkn_form_style_status', true);
        $color = get_post_meta($form_id, 'free_form-fields_lkn_form_color', true);
        $colorDet = get_post_meta($form_id, 'free_form-fields_lkn_details_color', true);
        $titleColor = get_post_meta($form_id, 'free_form-fields_lkn_title_color', true);
        $titleSize = get_post_meta($form_id, 'free_form-fields_lkn_title_size', true);
        $margin = get_post_meta($form_id, 'free_form-fields_lkn_section_margin', true);
        $btnBorderColor = get_post_meta($form_id, 'free_form-fields_lkn_btn_border_color', true);
        $btnBorderSize = get_post_meta($form_id, 'free_form-fields_lkn_btn_border_size', true);
        $btnBorderRadius = get_post_meta($form_id, 'free_form-fields_lkn_btn_border_radius', true);
        $paddingA = get_post_meta($form_id, 'free_form-fields_lkn_btn_paddingA', true);
        $paddingL = get_post_meta($form_id, 'free_form-fields_lkn_btn_paddingL', true);
        $textSize = get_post_meta($form_id, 'free_form-fields_lkn_btn_text_size', true);
        $css = get_post_meta($form_id, 'free_form-fields_lkn_css', true);
        $stripeCss = get_post_meta($form_id, 'free_form-fields_stripe_input_lkn_css', true);

        if ('enabled' !== $status) {
            echo '';
        } else {
            wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lkn-give-free-form-public.css', array(), $this->version, 'all' );

            $formCustomization = <<<HTML
        <style>
            #give-purchase-button{
                background-color: $color;
                color: $colorDet;
            }

            .give-donation-level-btn{
                background-color: $color;
                border: $btnBorderSize solid $btnBorderColor;
                border-radius: $btnBorderRadius;
                color: $colorDet;
                font-size: $textSize;
            }

            .give-donation-level-btn:hover{
                background-color: $color;
                color: $colorDet;
            }

            .give-default-level:hover{
                background-color: $colorDet;
                color: $color;
            }

            .give-default-level{
                background-color: $colorDet;
                color: $color;
            }

            .give-gateway-option-selected{
                background-color: $colorDet !important;
                color: $color !important;
            }

            form[id*=give-form] #give-gateway-radio-list>li{
                background-color: $color;
                color: $colorDet;
                border: solid $btnBorderSize $btnBorderColor;
                font-size: $textSize;
                border-radius: $btnBorderRadius;
            }

            .give-btn-level-custom{
                font-size: $textSize;
            }

            .give-donation-amount{
                border-image: linear-gradient(to right, $colorDet, $color) 1;
            }

            #give_checkout_user_info, #give-payment-mode-select {
                margin: $margin 0px;
            }

            #give-recurring-form h3.give-section-break, #give-recurring-form h4.give-section-break, #give-recurring-form legend, form.give-form h3.give-section-break, form.give-form h4.give-section-break, form.give-form legend, form[id*=give-form] h3.give-section-break, form[id*=give-form] h4.give-section-break, form[id*=give-form] legend{
                color: $titleColor;
                font-size: $titleSize;
            }

            .give-stripe-single-cc-field-wrap {
                $stripeCss
            }

            .form-row .give-stripe-cc-field {
                $stripeCss
            }

            #give-recurring-form .form-row .give-input-field-wrapper:focus, #give-recurring-form .form-row input[type=email]:focus, #give-recurring-form .form-row input[type=password]:focus, #give-recurring-form .form-row input[type=tel]:focus, #give-recurring-form .form-row input[type=text]:focus, #give-recurring-form .form-row input[type=url]:focus, #give-recurring-form .form-row select:focus, #give-recurring-form .form-row textarea:focus, form.give-form .form-row .give-input-field-wrapper:focus, form.give-form .form-row input[type=email]:focus, form.give-form .form-row input[type=password]:focus, form.give-form .form-row input[type=tel]:focus, form.give-form .form-row input[type=text]:focus, form.give-form .form-row input[type=url]:focus, form.give-form .form-row select:focus, form.give-form .form-row textarea:focus, form[id*=give-form] .form-row .give-input-field-wrapper:focus, form[id*=give-form] .form-row input[type=email]:focus, form[id*=give-form] .form-row input[type=password]:focus, form[id*=give-form] .form-row input[type=tel]:focus, form[id*=give-form] .form-row input[type=text]:focus, form[id*=give-form] .form-row input[type=url]:focus, form[id*=give-form] .form-row select:focus, form[id*=give-form] .form-row textarea:focus{
                border-image: linear-gradient(to right, #666, $color) 1;
            }

            .give-form .give-stripe-cc-field.focus, .give-form .give-stripe-cc-field:focus {
                border-image: linear-gradient(to right, #666, $color) 1 !important;
            }

            .give-btn-reveal{
                background-color: $color;
                color: $colorDet;
                padding: $paddingA $paddingL;
                font-size: $textSize;
                border-radius: $btnBorderRadius;
            }

            #give-purchase-button {
                border-radius: $btnBorderRadius;
                padding: $paddingA $paddingL;
                font-size: $textSize;
            }

            #give-purchase-button:hover {
                background: $color;
                border-radius: $btnBorderRadius;
            }

            [id*=give-form].give-display-modal .give-btn, [id*=give-form].give-display-reveal .give-btn{
                padding: $paddingA $paddingL;
            }

            .give-btn-reveal:hover{
                background: $color;
            }

            .lkn-btn-gateway {
                background-color: $color;
                color: $colorDet;
                padding: $paddingA $paddingL;
                font-size: $textSize;
                border-radius: $btnBorderRadius;
            }

            .lkn-btn-gateway:hover{
                background-color: $color;
                color: $colorDet;
            }

            $css
            {}
        </style>
HTML;
            echo $formCustomization;
        }
    }

    /**
     * Adds the mensage notice that's redirect for Link Nacional page on form footer.
     */
    public function lkn_give_free_form_footer_notice(): void {
        $link = esc_html__('https://www.linknacional.com.br/plataforma-de-doacoes/', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN);
        $message = esc_html__('Secure donation platform', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN);

        $html = <<<HTML
        <div class="lkn_notice_wrapper">
            <span class="dashicons dashicons-lock" style="color=#989898;"></span>
            <a href="{$link}" target="_blank" style="color: #666;text-decoration: none;"><span class="lknNoticeText"> {$message}</span></a>
        </div>
HTML;
        echo $html;
    }    

    /**
     * Register the JavaScript for the public-facing side of the site.
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
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lkn-give-free-form-public.js', array('jquery'), $this->version, false );
    }
}
