<?php

/**
 * Plugin Name: To Do App
 * Description: A simple to do app plugin.
 * Version: 1.0
 * Author: Md. Mottasin Lemon
 */

/**
 * Function to run on plugin activation.
 */
function todo_app_activate() {
    global $wpdb;

    // Define table name
    $table_name = $wpdb->prefix . 'todo_items';

    // SQL query to create table
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        task VARCHAR(255) NOT NULL,
        completed TINYINT(1) NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    // Execute the SQL query
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'todo_app_activate' );