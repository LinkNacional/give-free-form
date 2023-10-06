<?php

// Exit, if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

/**
 * @see        https://www.linknacional.com/
 * @since      1.0.0
 * @author     Link Nacional
 */
final class Lkn_Form_Customization_for_Give_Helper {
    /**
     * Show plugin dependency notice.
     *
     * @since 1.0.0
     */
    final public static function lkn_give_free_form_verify_plugin_dependencies(): ?bool {
        // Not admin, insert here.
        if ( ! is_admin() || ! current_user_can('activate_plugins')) {
            require_once LKN_GIVE_FREE_FORM_DIR . 'public/class-lkn-give-free-form-public.php';

            return null;
        }

        // Load plugin helper functions.
        if ( ! function_exists('deactivate_plugins') || ! function_exists('is_plugin_active')) {
            require_once ABSPATH . '/wp-admin/includes/plugin.php';
        }
        
        // Flag to check whether deactivate plugin or not.
        $is_deactivate_plugin = null;

        // Verify minimum give plugin version.
        if (
            defined('GIVE_VERSION')
            && version_compare(GIVE_VERSION, LKN_GIVE_FREE_FORM_MIN_GIVE_VERSION, '<')
        ) {
            // Show admin notice.
            Lkn_Form_Customization_for_Give_Helper::lkn_give_free_form_dependency_alert();

            $is_deactivate_plugin = true;
        }
        
        // Check for if give plugin activate or not.
        $is_give_active = defined('GIVE_PLUGIN_BASENAME') ? is_plugin_active(GIVE_PLUGIN_BASENAME) : false;

        // Verify if give plugin is actived.
        if ( ! $is_give_active) {
            // Show admin notice.
            Lkn_Form_Customization_for_Give_Helper::lkn_give_free_form_inactive_alert();

            $is_deactivate_plugin = true;
        }

        // Deactivate plugin.
        if ($is_deactivate_plugin) {
            deactivate_plugins(LKN_GIVE_FREE_FORM_BASENAME);

            if (isset($_GET['activate'])) {
                unset($_GET['activate']);
            }

            return false;
        }

        return true;
    }

    /**
     * Notice for give dependecy.
     *
     * @since 1.0.0
     */
    final public static function lkn_give_free_form_dependency_notice(): void {
        // Admin notice.
        $message = sprintf(
            '<div class="notice notice-error"><p><strong>%1$s</strong> %2$s <a href="%3$s" target="_blank">%4$s</a>  %5$s %6$s+ %7$s</p></div>',
            __('Activation Error:', LKN_GIVE_FREE_FORM_TEXT_DOMAIN),
            __('You must have', LKN_GIVE_FREE_FORM_TEXT_DOMAIN),
            'https://givewp.com',
            __('Give', LKN_GIVE_FREE_FORM_TEXT_DOMAIN),
            __('version', LKN_GIVE_FREE_FORM_TEXT_DOMAIN),
            LKN_GIVE_FREE_FORM_MIN_GIVE_VERSION,
            __('for the Donation Form Customization for GiveWP to activate.', LKN_GIVE_FREE_FORM_TEXT_DOMAIN)
        );

        echo $message;
    }

    /**
     * Notice for No Core Activation.
     *
     * @since 1.0.0
     */
    final public static function lkn_give_free_form_inactive_notice(): void {
        // Admin notice.
        $message = sprintf(
            '<div class="notice notice-error"><p><strong>%1$s</strong> %2$s <a href="%3$s" target="_blank">%4$s</a> %5$s</p></div>',
            __('Activation Error:', LKN_GIVE_FREE_FORM_TEXT_DOMAIN),
            __('You must have', LKN_GIVE_FREE_FORM_TEXT_DOMAIN),
            'https://givewp.com',
            __('Give', LKN_GIVE_FREE_FORM_TEXT_DOMAIN),
            __('plugin installed and activated for the Donation Form Customization for GiveWP.', LKN_GIVE_FREE_FORM_TEXT_DOMAIN)
        );

        echo $message;
    }

    final public static function lkn_give_free_form_dependency_alert(): void {
        add_action('admin_notices', array('Lkn_Form_Customization_for_Give_Helper', 'lkn_give_free_form_dependency_notice'));
    }

    final public static function lkn_give_free_form_inactive_alert(): void {
        add_action('admin_notices', array('Lkn_Form_Customization_for_Give_Helper', 'lkn_give_free_form_inactive_notice'));
    }

    // TODO melhorar um pouco essa função (Mostrar só em forms não-legado, etc).
    /**
     * Add a form admin notice
     *
     * @return string $html
     *
     */
    public static function disabled_for_non_legacy_templates_html() {
        ob_start();

        $warning = esc_html__('O formulário customizado não é relevante para o formulário Multi-Step do giveWP. Caso você deseje utilizar o Free Form Plugin é necessário mudar o Template do formulário para opção "Legado".', LKN_GIVE_FREE_FORM_TEXT_DOMAIN);

        $formWarning = <<<HTML
        <p class="ffconfs-disabled">
            {$warning}
        </p>
HTML;

        echo $formWarning;

        echo ob_get_clean();
    }
}