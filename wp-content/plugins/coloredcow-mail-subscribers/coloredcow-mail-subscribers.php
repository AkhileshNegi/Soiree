<?php

/*
Plugin Name: ColoredCow Mail subscribers
Plugin URI: https://coloredcow.com
Description: Custom Post for ColoredCow's Mail subscribers
Version: 1.0.0
Author: ColoredCow
Author URI: https://coloredcow.com
*/

define('MAIL_SUBSCRIBERS_PATH', plugin_dir_url( __FILE__ ));

if(! function_exists('cc_register_mail_subscribers')){
    function cc_register_mail_subscribers() {
     
        $labels = array(
            'name' => _x( 'Mail Subscribers', 'mail_subscribers' ),
            'singular_name' => _x( 'Mail Subscriber', 'mail_subscriber' ),
            'add_new' => _x( 'Add New', 'Mail Subscriber' ),
            'add_new_item' => __( 'Add New Mail Subscriber' ),
            'edit_item' => __( 'Edit Mail Subscriber' ),
            'new_item' => __( 'New Mail Subscriber' ),
            'view_item' => __( 'View Mail Subscriber' ),
            'search_items' => __( 'Search Mail Subscriber' ),
            'not_found' =>  __( 'No Mail Subscribers found' ),
            'not_found_in_trash' => __( 'No Mail Subscribers found in Trash' ),
        );
     
        $args = array(
            'labels' => $labels,
            'singular_label' => __('Mail Subscriber', 'mail_subscribers'),
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'mail-subscribers'),
            'supports' => array('title', 'editor', 'comments'),
            'has_archive' => false,
            'public' => false,
            'publicly_queryable' => true,
            'show_ui' => true,
            'exclude_from_search' => true,
            'show_in_nav_menus' => false,
        );
        register_post_type('mail_subscribers', $args);
    }
    add_action( 'init', 'cc_register_mail_subscribers');
}

if(!function_exists('cc_register_mail_subscribers_category')){
    function cc_register_mail_subscribers_category() {

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
            'rewrite' => array('slug' => 'mail-subscribers-category'),
        );
        register_taxonomy( 'mail_subscribers_category', array( 'mail_subscribers' ), $args );
    }
    add_action( 'init', 'cc_register_mail_subscribers_category' );
}