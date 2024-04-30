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
function todo_app_activate()
{
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
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

register_activation_hook(__FILE__, 'todo_app_activate');


/**
 * Enqueue scripts and styles.
 */
function to_do_app_enqueue_scripts(): void
{
    // Enqueue JavaScript file
    wp_enqueue_script('my-plugin-js', plugins_url('admin/js/app.js', __FILE__), array(), '1.0', true);

}

add_action('wp_enqueue_script', 'to_do_app_enqueue_scripts');

/**
 * Enqueue styles.
 */
function to_do_app_enqueue_styles(): void
{
    // Enqueue CSS file
    wp_enqueue_style('my-plugin-css', plugins_url('admin/css/output.css', __FILE__), array(), '1.0');
}

add_action('wp_enqueue_style', 'to_do_app_enqueue_styles');

/**
 * Function to display to-do items table.
 */
function display_todo_items_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'todo_items';
    $todo_items = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

    require_once plugin_dir_path(__FILE__) . 'admin/pages/index.php';
}

// Add a shortcode to display the to-do items table
//add_shortcode('todo_table', 'display_todo_items_table');

/**
 * Function to add a menu item in the dashboard.
 */
function todo_app_menu()
{
    add_menu_page(
        'To Do App',
        'To Do App',
        'manage_options',
        'todo_app_menu',
        'display_todo_items_table', // Callback function to display the table
        'dashicons-list-view', // Icon for the menu item
        30 // Position of the menu item
    );

    // Add a submenu under the "To Do App" menu
    add_submenu_page(
        'todo_app_menu',
        'Tasks',
        'Tasks',
        'manage_options',
        'todo_app_menu',
        'display_todo_items_table' // Callback function to display the table
    );

    add_submenu_page(
        'todo_app_menu', // Parent slug
        'Create Tasks', // Page title
        'Create Tasks', // Menu title
        'manage_options', // Capability
        'todo_create_task', // Menu slug
        'display_todo_items_table' // Callback function to display the table
    );
}

add_action('admin_menu', 'todo_app_menu');


