<?php

add_action('init', 'register_guest_post_type');
function register_guest_post_type() {
    $labels = array(
        'name' => 'Guests',
        'singular_name' => 'Guest',
        'add_new' => 'Add New Guest',
        'add_new_item' => 'Add New guest',
        'edit_item' => 'Edit Guest',
        'new_item' => 'New Guest',
        'all_items' => 'All Guest',
        'view_item' => 'View Guests',
        'search_items' => 'Search guests',
        'not_found' =>  'No guests Found',
        'not_found_in_trash' => 'No guests found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Guests',
    );
    
    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'guest'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-users',
        'supports' => array(
            'title',
            'thumbnail',
        )
    );
    register_post_type( 'guest', $args );
}

add_action('admin_post_save_form', 'save_form');
add_action('admin_post_nopriv_save_form', 'save_form');
function save_form()
{
global $wpdb;

$mail = $_POST['email'];
$gender = $_POST['gender'];


wp_insert_post([
    'post_title' => $_POST['name'],
    'post_type' => 'guest',
    'post_status' => 'publish',
]);

}
