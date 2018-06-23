<?php

/*
Plugin Name: Case Studies
Plugin URI: http://coloredcow.com
Description: Plugin to display case studies
Version: 1.0.0
Author: ColoredCow
Author URI: http://coloredcow.com
*/

define('CASESTUDIES_PATH', plugin_dir_url( __FILE__ ));

if(! function_exists('cc_register_case_studies')){
    function cc_register_case_studies() {
     
        $labels = array(
            'name' => _x( 'Case Studies', 'case studies' ),
            'singular_name' => _x( 'Case Study', 'case study' ),
            'add_new' => _x( 'Add New', 'Case Study' ),
            'add_new_item' => __( 'Add New Case Study' ),
            'edit_item' => __( 'Edit Case Study' ),
            'new_item' => __( 'New Case Study' ),
            'view_item' => __( 'View Case Study' ),
            'search_items' => __( 'Search Case Studies' ),
            'not_found' =>  __( 'No Case Studies found' ),
            'not_found_in_trash' => __( 'No Case Studies found in Trash' ),
        );
     
        $args = array(
            'labels' => $labels,
            'singular_label' => __('Case Study', 'case_study'),
            'public' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'case-studies'),
            'supports' => array('title', 'editor','thumbnail', 'comments'),
            'has_archive' => true,
        );
        register_post_type('case_studies', $args);
    }
    add_action( 'init', 'cc_register_case_studies');
}

if(!function_exists('cc_register_case_studies_category')){
    function cc_register_case_studies_category() {

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
            'rewrite' => array('slug' => 'case-studies-category'),
        );
        register_taxonomy( 'case_studies_category', array( 'case_studies' ), $args );
    }
    add_action( 'init', 'cc_register_case_studies_category' );
}