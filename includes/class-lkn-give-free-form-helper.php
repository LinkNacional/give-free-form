<?php

// Exit, if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

/**
 * @see        https://www.linknacional.com/
 * @since      1.0.0
 * @author     Link Nacional
 */
final class Lkn_Form_Customization_for_Give_Helper
{
    /**
     * Show plugin dependency notice.
     *
     * @since 1.0.0
     */
    final public static function lkn_give_free_form_verify_plugin_dependencies(): ?bool
    {
        // Not admin, insert here.
        if (! is_admin() || ! current_user_can('activate_plugins')) {
            require_once LKN_DONATION_FORM_CUSTOMIZATION_DIR . 'public/class-lkn-give-free-form-public.php';

            return null;
        }

        // Load plugin helper functions.
        if (! function_exists('deactivate_plugins') || ! function_exists('is_plugin_active')) {
            require_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        // Flag to check whether deactivate plugin or not.
        $is_deactivate_plugin = null;

        // Verify minimum give plugin version.
        if (
            defined('GIVE_VERSION')
            && version_compare(GIVE_VERSION, LKN_DONATION_FORM_CUSTOMIZATION_MIN_GIVE_VERSION, '<')
        ) {
            // Show admin notice.
            Lkn_Form_Customization_for_Give_Helper::lkn_give_free_form_dependency_alert();

            $is_deactivate_plugin = true;
        }

        // Check for if give plugin activate or not.
        $is_give_active = defined('GIVE_PLUGIN_BASENAME') ? is_plugin_active(GIVE_PLUGIN_BASENAME) : false;

        // Verify if give plugin is actived.
        if (! $is_give_active) {
            // Show admin notice.
            Lkn_Form_Customization_for_Give_Helper::lkn_give_free_form_inactive_alert();

            $is_deactivate_plugin = true;
        }

        // Deactivate plugin.
        if ($is_deactivate_plugin) {
            deactivate_plugins(LKN_DONATION_FORM_CUSTOMIZATION_BASENAME);

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
    final public static function lkn_give_free_form_dependency_notice(): void
    {
        // Admin notice.
        $message = sprintf(
            '<div class="notice notice-error"><p><strong>%1$s</strong> %2$s <a href="%3$s" target="_blank">%4$s</a>  %5$s %6$s+ %7$s</p></div>',
            esc_html__('Activation Error:', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
            esc_html__('You must have', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
            'https://givewp.com',
            esc_html__('Give', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
            esc_html__('version', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
            LKN_DONATION_FORM_CUSTOMIZATION_MIN_GIVE_VERSION,
            esc_html__('for the Donation Form Customization for GiveWP to activate.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN)
        );

        echo wp_kses_post($message);
    }

    /**
     * Notice for No Core Activation.
     *
     * @since 1.0.0
     */
    final public static function lkn_give_free_form_inactive_notice(): void
    {
        // Admin notice.
        $message = sprintf(
            '<div class="notice notice-error"><p><strong>%1$s</strong> %2$s <a href="%3$s" target="_blank">%4$s</a> %5$s</p></div>',
            esc_html__('Activation Error:', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
            esc_html__('You must have', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
            'https://givewp.com',
            esc_html__('Give', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN),
            esc_html__('plugin installed and activated for the Donation Form Customization for GiveWP.', LKN_DONATION_FORM_CUSTOMIZATION_TEXT_DOMAIN)
        );

        echo wp_kses_post($message);
    }

    final public static function lkn_give_free_form_dependency_alert(): void
    {
        add_action('admin_notices', array('Lkn_Form_Customization_for_Give_Helper', 'lkn_give_free_form_dependency_notice'));
    }

    final public static function lkn_give_free_form_inactive_alert(): void
    {
        add_action('admin_notices', array('Lkn_Form_Customization_for_Give_Helper', 'lkn_give_free_form_inactive_notice'));
    }

    final public static function lkn_give_free_form_translations(): array
    {
        return [
            'givewp-checkbox' => __('GiveWP Checkbox', 'lkn-give-free-form'),
            'checkbox-description' => __('A simple checkbox block for GiveWP forms.', 'lkn-give-free-form'),
            'field-settings' => __('Field Settings', 'lkn-give-free-form'),
            'label' => __('Label', 'lkn-give-free-form'),
            'required' => __('Required', 'lkn-give-free-form'),
            'checked-by-default' => __('Checked by Default', 'lkn-give-free-form'),
            'display-settings' => __('Display Settings', 'lkn-give-free-form'),
            'show-in-admin' => __('Show in Admin Panel', 'lkn-give-free-form'),
            'show-in-receipt' => __('Show in Receipt', 'lkn-give-free-form'),
            'input-fields' => __('Input Fields', 'lkn-give-free-form'),
            'custom' => __('Custom', 'lkn-give-free-form'),
            'layout' => __('Layout', 'lkn-give-free-form')
        ];
    }
}
