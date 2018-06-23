<?php

/*
Plugin Name: ColoredCow Colleges
Plugin URI: https://coloredcow.com
Description: Custom Post for tracking college communications in ColoredCow
Version: 1.0.0
Author: ColoredCow
Author URI: https://coloredcow.com
*/

define('COLOREDCOW_COLLEGE_PLUGIN_PATH', plugin_dir_url( __FILE__ ));

if( ! function_exists('cc_register_coloredcow_colleges')) {
    function cc_register_coloredcow_colleges() {

        $labels = array(
            'name' => _x( 'Colleges', 'colleges' ),
            'singular_name' => _x( 'college', 'College' ),
            'add_new' => _x( 'Add New', 'College' ),
            'add_new_item' => __( 'Add New College' ),
            'edit_item' => __( 'Edit College' ),
            'new_item' => __( 'New College' ),
            'view_item' => __( 'View College' ),
            'search_items' => __( 'Search Colleges' ),
            'not_found' =>  __( 'No College found' ),
            'not_found_in_trash' => __( 'No College found in Trash' ),
        );

        $args = array(
            'labels' => $labels,
            'singular_label' => __('College', 'college'),
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'college'),
            'supports' => array('title', 'editor'),
            'has_archive' => false,
            'public' => false,
            'publicly_queryable' => true,
            'show_ui' => true,
            'exclude_from_search' => true,
            'show_in_nav_menus' => false,
        );
        register_post_type('college', $args);
    }
    add_action( 'init', 'cc_register_coloredcow_colleges');
}
