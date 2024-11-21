<?php
/**
 * Plugin Name: Multi-Step Form WP
 * Description: A WordPress plugin to create a multi-step form with dynamic design and functionality.
 * Version: 1.0.0
 * Author: Rahim Badsa
 * Text Domain: ms_fwp
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define constants.
define( 'MSFWP_VERSION', '1.0.0' );
define( 'MSFWP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MSFWP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include necessary files.
require_once MSFWP_PLUGIN_DIR . 'includes/class-msfwp-assets.php';
require_once MSFWP_PLUGIN_DIR . 'includes/class-msfwp-shortcode.php';

// Initialize assets and shortcode.
MSFWP_Assets::init();
MSFWP_Shortcode::init();



add_action( 'wp_ajax_save_answer', 'msfwp_save_answer' );
add_action( 'wp_ajax_nopriv_save_answer', 'msfwp_save_answer' );

function msfwp_save_answer() {
    if ( isset( $_POST['answer'] ) ) {
        $answer = sanitize_text_field( $_POST['answer'] );
        wp_send_json_success( "Answer saved: $answer" );
    } else {
        wp_send_json_error( 'No answer provided.' );
    }
}

