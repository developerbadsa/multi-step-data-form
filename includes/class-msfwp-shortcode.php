<?php
class MSFWP_Shortcode {
    public static function init() {
        add_shortcode( 'multi_step_form', [ __CLASS__, 'render_form' ] );
    }

    public static function render_form() {
        ob_start();
        include MSFWP_PLUGIN_DIR . 'templates/front-end.php';
        return ob_get_clean();
    }
}
