<?php

/*
Plugin Name: ColoredCow News
Plugin URI: http://coloredcow.com
Description: Custom Post for ColoredCow's news
Version: 1.0.0
Author: ColoredCow
Author URI: http://coloredcow.com
*/

define('NEWS_PATH', plugin_dir_url( __FILE__ ));

if(! function_exists('cc_register_news')){
    function cc_register_news() {
     
        $labels = array(
            'name' => _x( 'News', 'news' ),
            'singular_name' => _x( 'News', 'news' ),
            'add_new' => _x( 'Add New', 'News' ),
            'add_new_item' => __( 'Add New News' ),
            'edit_item' => __( 'Edit News' ),
            'new_item' => __( 'New News' ),
            'view_item' => __( 'View News' ),
            'search_items' => __( 'Search Team' ),
            'not_found' =>  __( 'No News found' ),
            'not_found_in_trash' => __( 'No News found in Trash' ),
        );
     
        $args = array(
            'labels' => $labels,
            'singular_label' => __('News', 'news'),
            'public' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'news'),
            'supports' => array('title', 'editor', 'comments'),
            'has_archive' => true,
        );
        register_post_type('news', $args);
    }
    add_action( 'init', 'cc_register_news');
}