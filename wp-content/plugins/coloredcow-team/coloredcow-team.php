<?php

/*
Plugin Name: ColoredCow Team
Plugin URI: http://coloredcow.com
Description: Plugin to accomodate team members
Version: 1.0.0
Author: ColoredCow
Author URI: http://coloredcow.com
*/

define('TEAM_PATH', plugin_dir_url( __FILE__ ));

if(! function_exists('cc_register_team')){
    function cc_register_team() {
     
        $labels = array(
            'name' => _x( 'Team', 'team' ),
            'singular_name' => _x( 'Team Member', 'team member' ),
            'add_new' => _x( 'Add New', 'Team Member' ),
            'add_new_item' => __( 'Add New Team Member' ),
            'edit_item' => __( 'Edit Team Member' ),
            'new_item' => __( 'New Team Member' ),
            'view_item' => __( 'View Team Member' ),
            'search_items' => __( 'Search Team' ),
            'not_found' =>  __( 'No Team Member found' ),
            'not_found_in_trash' => __( 'No Team Member found in Trash' ),
        );
     
        $args = array(
            'labels' => $labels,
            'singular_label' => __('Team Member', 'team_member'),
            'public' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'team'),
            'supports' => array('title', 'editor','thumbnail'),
            'has_archive' => true,
        );
        register_post_type('team', $args);
    }
    add_action( 'init', 'cc_register_team');
}