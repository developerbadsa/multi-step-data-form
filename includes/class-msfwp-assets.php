<?php
class MSFWP_Assets {
    public static function init() {
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_assets' ] );
    }

    public static function enqueue_assets() {
        if ( is_singular() && has_shortcode( get_post()->post_content, 'multi_step_form' ) ) {
            wp_enqueue_style( 'msfwp-style', MSFWP_PLUGIN_URL . 'assets/css/style.css', [], MSFWP_VERSION );
            wp_enqueue_script( 'msfwp-script', MSFWP_PLUGIN_URL . 'assets/js/script.js', [ 'jquery' ], MSFWP_VERSION, true );

            // Localize script for AJAX and dynamic behavior.
            wp_localize_script( 'msfwp-script', 'msFwp', [
                'ajax_url' => admin_url( 'admin-ajax.php' ),
            ] );
        }
    }
}
