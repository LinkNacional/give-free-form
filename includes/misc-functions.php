<?php
/**
 * Show plugin dependency notice
 *
 * @since
 */
function __give_lkn_free_form_dependency_notice() {
    // Admin notice.
    $message = sprintf(
		'<strong>%1$s</strong> %2$s <a href="%3$s" target="_blank">%4$s</a>  %5$s %6$s+ %7$s.',
		__( 'Activation Error:', 'lkn-give-free-form' ),
		__( 'You must have', 'lkn-give-free-form' ),
		'https://givewp.com',
		__( 'Give', 'lkn-give-free-form' ),
		__( 'version', 'lkn-give-free-form' ),
		GIVE_FREE_FORM_MIN_GIVE_VERSION,
		__( 'for the Give Free Form add-on to activate', 'lkn-give-free-form' )
	);

    Give()->notices->register_notice( [
        'id' => 'give-activation-error',
        'type' => 'error',
        'description' => $message,
        'show' => true,
    ] );
}

/**
 * Notice for No Core Activation
 *
 * @since
 */
function __give_lkn_free_form_inactive_notice() {
    // Admin notice.
    $message = sprintf(
		'<div class="notice notice-error"><p><strong>%1$s</strong> %2$s <a href="%3$s" target="_blank">%4$s</a> %5$s.</p></div>',
		__( 'Activation Error:', 'lkn-give-free-form' ),
		__( 'You must have', 'lkn-give-free-form' ),
		'https://givewp.com',
		__( 'Give', 'lkn-give-free-form' ),
		__( ' plugin installed and activated for the Give Free Form add-on to activate', 'lkn-give-free_form' )
	);

    echo $message;
}

/**
 * Show activation banner
 *
 * @since
 * @return void
*/
function __give_lkn_free_form_activation_gateway() {
    // Initialize activation welcome banner.
    if ( class_exists( 'Lkn_Give_Free_Form' ) ) {
        // Only runs on admin.
        $args = [
            'file' => GIVE_FREE_FORM_FILE,
            'name' => __( 'Formulário Customizado', 'lkn-give-free-form' ),
            'version' => GIVE_FREE_FORM_VERSION,
            'documentation_url' => 'https://givewp.com/documentation/add-ons/boilerplate/',
            'support_url' => 'https://givewp.com/support/',
            'testing' => false // Never leave true.
        ];

        new Lkn_Give_Free_Form( $args );
    }
}
