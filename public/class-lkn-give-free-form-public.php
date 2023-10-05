<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.linknacional.com.br
 * @since      1.0.0
 *
 * @package    Lkn_Give_Free_Form
 * @subpackage Lkn_Give_Free_Form/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Lkn_Give_Free_Form
 * @subpackage Lkn_Give_Free_Form/public
 * @author     Link Nacional <email@email.com>
 */
final class Lkn_Give_Free_Form_Public {
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
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles(): void {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Lkn_Give_Free_Form_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Lkn_Give_Free_Form_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lkn-give-free-form-public.css', array(), $this->version, 'all' );
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
         * defined in Lkn_Give_Free_Form_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Lkn_Give_Free_Form_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lkn-give-free-form-public.js', array('jquery'), $this->version, false );
    }

    /**
     * Function that styles the form
     *
     * @param int $form_id - the form identificator
     *
     * @param array $args - list of additional arguments
     *
     * @return mixed
     */
    public function form_customization($form_id, $args) {
        $id_prefix = ! empty($args) ? $args : '';

        $status = get_post_meta($id_prefix, 'free_form-fields_lkn_form_style_status', true);
        $color = get_post_meta($id_prefix, 'free_form-fields_lkn_form_color', true);
        $colorDet = get_post_meta($id_prefix, 'free_form-fields_lkn_details_color', true);
        $titleColor = get_post_meta($id_prefix, 'free_form-fields_lkn_title_color', true);
        $titleSize = get_post_meta($id_prefix, 'free_form-fields_lkn_title_size', true);
        $margin = get_post_meta($id_prefix, 'free_form-fields_lkn_section_margin', true);
        $btnBorderColor = get_post_meta($id_prefix, 'free_form-fields_lkn_btn_border_color', true);
        $btnBorderSize = get_post_meta($id_prefix, 'free_form-fields_lkn_btn_border_size', true);
        $btnBorderRadius = get_post_meta($id_prefix, 'free_form-fields_lkn_btn_border_radius', true);
        $paddingA = get_post_meta($id_prefix, 'free_form-fields_lkn_btn_paddingA', true);
        $paddingL = get_post_meta($id_prefix, 'free_form-fields_lkn_btn_paddingL', true);
        $textSize = get_post_meta($id_prefix, 'free_form-fields_lkn_btn_text_size', true);
        $css = get_post_meta($id_prefix, 'free_form-fields_lkn_css', true);
        $stripeCss = get_post_meta($id_prefix, 'free_form-fields_stripe_input_lkn_css', true);

        if ('enabled' !== $status) {
            return false;
        } else {
            $form = <<<HTML
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

            echo $form;
        }
    }

    /**
     * Adiciona notice com mensagem que redireciona para página da link nacional no rodapé do formulário
     */
    public function lkn_give_free_form_footer_notice(): void {
        $html = <<<HTML
        <div class="lknNoticeWrapper">
            <span class="dashicons dashicons-lock" style="color=#989898;"></span>
            <a href="https://www.linknacional.com.br/plataforma-de-doacoes/" target="_blank" style="color: #666;text-decoration: none;"><span class="lknNoticeText"> Plataforma de doação segura</span></a>
        </div>
        <script>
           // Verifica se janela foi carregada
            window.addEventListener('DOMContentLoaded', function () {
                // Pega elemento específico de formulário com iframe
                let iframeLoader = parent.document.getElementsByClassName('iframe-loader')[0];
                // Pega elemento contendo a mensagem
                let lknNoticeWrapper = document.getElementsByClassName('lknNoticeWrapper')[0];

                // Verifica se formulário está dentro de um iframe
                if (iframeLoader) {
                    // Pega o footer já existente e altera a mensagem para a da link nacional
                    let secureNotice = document.getElementsByClassName('secure-notice')[0];
                    if (secureNotice) {
                        // Caso esteja dentro de um iframe esconde <div> contendo a mensagem
                        lknNoticeWrapper.setAttribute('style', 'display:none;');

                        secureNotice.innerHTML = '<i class="fas fa-lock"></i><a href="https://www.linknacional.com.br/plataforma-de-doacoes/" target="_blank" style="font-size: 10px;color: #666;text-decoration: none;">Plataforma de doação segura</a>';
                    } else {
                        lknNoticeText = document.getElementsByClassName('lknNoticeText')[0];
                        lknNoticeText.classList.add('lknIframeText');
                        lknNoticeWrapper.classList.add('lknIframeWrapper');
                    }
                }
            });
        </script>

        <style>
            .lknNoticeWrapper {
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                margin-top: 75px;
            }
            .lknNoticeText {
                font-size: 10px;
                color: #989898;
            }
            .lknIframeText {
                font-size: 13px;
            }
            .lknIframeWrapper {
                margin-top: 25px;
                margin-bottom: 25px;
            }
        </style>
HTML;
        echo $html;
    }
}
