<?php
/*
Plugin Name: Questions and Answers
Plugin URI: http://coloredcow.in
Description: A QnA Plugin
Version: 1.0.0
Author: Shubham Pandey
Author URI: http://shubhampandeydev.wordpress.com
*/
define('QNA_PATH', plugin_dir_url( __FILE__ ));

if(! function_exists('cc_register_qna')){
    function cc_register_qna() {
     
        $labels = array(
            'name' => _x( 'QnA', 'post type general name' ),
            'singular_name' => _x( 'QnA', 'post type singular name' ),
            'add_new' => _x( 'Add New', 'QnA' ),
            'add_new_item' => __( 'Add New QnA' ),
            'edit_item' => __( 'Edit QnA' ),
            'new_item' => __( 'New QnA' ),
            'view_item' => __( 'View QnA' ),
            'search_items' => __( 'Search QnAs' ),
            'not_found' =>  __( 'No QnAs found' ),
            'not_found_in_trash' => __( 'No QnAs found in Trash' ),
        );
     
        $args = array(
            'labels' => $labels,
            'singular_label' => __('QnA', 'qna'),
            'public' => true,
            'capability_type' => 'post',
            'supports' => array('title', 'editor', 'excerpt'),
            'has_archive' => 'qna',
        );
        register_post_type('qna', $args);
    }
}
add_action( 'init', 'cc_register_qna');
?>