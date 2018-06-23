<?php

/*
Plugin Name: ColoredCow Codetrek session
Plugin URI: https://coloredcow.com
Description: Custom Post for ColoredCow's Codetrek session
Version: 1.0.0
Author: ColoredCow
Author URI: https://coloredcow.com
Text Domain: codetrek_session
*/

define('CODETREK_SESSION_PATH', plugin_dir_url( __FILE__ ));

if(! function_exists('cc_register_codetrek_session')){
    function cc_register_codetrek_session() {
     
        $labels = array(
            'name' => _x( 'Codetrek session', 'codetrek_session' ),
            'singular_name' => _x( 'codetrek session', 'Codetrek session' ),
            'add_new' => _x( 'Add New', 'Codetrek session' ),
            'add_new_item' => __( 'Add New Codetrek session' ),
            'edit_item' => __( 'Edit Codetrek session' ),
            'new_item' => __( 'New Codetrek session' ),
            'view_item' => __( 'View Codetrek session' ),
            'search_items' => __( 'Search Codetrek session' ),
            'not_found' =>  __( 'No Codetrek session found' ),
            'not_found_in_trash' => __( 'No Codetrek session found in Trash' ),
        );
     
        $args = array(
            'labels' => $labels,
            'singular_label' => __('Codetrek session', 'codetrek session'),
            'public' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'codetrek-session'),
            'supports' => array('title', 'editor', 'comments', 'thumbnail'),
            'has_archive' => false,
        );
        register_post_type('codetrek_session', $args);
    }
    add_action( 'init', 'cc_register_codetrek_session');
}

if(!function_exists('cc_register_codetrek_sessions_category')){
    function cc_register_codetrek_sessions_category() {

        $labels = array(
            'name' => _x( 'Categories', 'categories' ),
            'singular_name' => _x( 'Category', 'category' ),
            'add_new' => _x( 'Add New', 'Category' ),
            'add_new_item' => __( 'Add New Category' ),
            'edit_item' => __( 'Edit Category' ),
            'new_item' => __( 'New Category' ),
            'view_item' => __( 'View Category' ),
            'search_items' => __( 'Search Category' ),
            'not_found' =>  __( 'No Categories found' ),
            'not_found_in_trash' => __( 'No Categories found in Trash' ),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => true,
            'rewrite' => array('slug' => 'codetrek-session-category'),
        );
        register_taxonomy( 'codetrek_session_category', array( 'codetrek_session' ), $args );
    }
    add_action( 'init', 'cc_register_codetrek_sessions_category' );
}