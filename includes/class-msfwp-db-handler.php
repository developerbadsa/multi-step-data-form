<?php
class MSFWP_DB_Handler {
    private static $table_name;

    public static function init() {
        global $wpdb;
        self::$table_name = $wpdb->prefix . 'msfwp_form_entries';
    }

    public static function create_table() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE " . self::$table_name . " (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            ownership varchar(100) NOT NULL,
            date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );
    }

    public static function insert_entry( $data ) {
        global $wpdb;

        $wpdb->insert(
            self::$table_name,
            [
                'ownership' => $data['ownership'],
                'date'      => current_time( 'mysql' ),
            ]
        );
    }
}

MSFWP_DB_Handler::init();
