<?php
class MSFWP_AJAX_Handler {
    public static function init() {
        // Register AJAX actions for logged-in and guest users.
        add_action( 'wp_ajax_save_form_data', [ __CLASS__, 'save_form_data' ] );
        add_action( 'wp_ajax_nopriv_save_form_data', [ __CLASS__, 'save_form_data' ] );
    }

    public static function save_form_data() {
        // Verify nonce for security.
        check_ajax_referer( 'save_form_nonce', 'security' );

        // Validate and sanitize input.
        $ownership = isset( $_POST['ownership'] ) ? sanitize_text_field( $_POST['ownership'] ) : '';

        // Save the data using the DB handler.
        if ( ! empty( $ownership ) ) {
            MSFWP_DB_Handler::insert_entry( [ 'ownership' => $ownership ] );
            wp_send_json_success( 'Form data saved successfully!' );
        } else {
            wp_send_json_error( 'Invalid form data.' );
        }
    }
}

MSFWP_AJAX_Handler::init();
