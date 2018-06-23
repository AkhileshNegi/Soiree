<?php
/**
 * Plugin Name: ColoredCow Research Work
 * Plugin URI: https://coloredcow.com
 * Description: Plugin to display research work
 * Version: 1.0.0
 * Author: ColoredCow
 * Author URI: https://coloredcow.com
 *
 * @package ColoredCow
 */

define( 'RESEARCHWORK_PATH', plugin_dir_url( __FILE__ ) );

if ( ! function_exists( 'cc_register_research_work' ) ) {
/**
 * Function to register research work plugin
 */
	function cc_register_research_work() {
		$labels = array(
			'name' => _x( 'Research Work', 'research work' ),
			'singular_name' => _x( 'Research Work', 'research work' ),
			'add_new' => _x( 'Add New', 'Research Work' ),
			'add_new_item' => __( 'Add New Research Work' ),
			'edit_item' => __( 'Edit Research Work' ),
			'new_item' => __( 'New Research Work' ),
			'view_item' => __( 'View Research Work' ),
			'search_items' => __( 'Search Research Works' ),
			'not_found' => __( 'No Research Work found' ),
			'not_found_in_trash' => __( 'No Research Work found in Trash' ),
		);
		$args = array(
			'labels' => $labels,
			'singular_label' => __( 'Research Work', 'research_work' ),
			'public' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'research' ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'author' ),
			'has_archive' => true,
		);
		register_post_type( 'research_work', $args );
	}
	add_action( 'init', 'cc_register_research_work' );
}

if ( ! function_exists( 'cc_register_research_work_category' ) ) {
/**
 * Function to create Caterogries for research work plugin
 */
	function cc_register_research_work_category() {
		$labels = array(
			'name' => _x( 'Categories', 'categories' ),
			'singular_name' => _x( 'Category', 'category' ),
			'add_new' => _x( 'Add New', 'Category' ),
			'add_new_item' => __( 'Add New Category' ),
			'edit_item' => __( 'Edit Category' ),
			'new_item' => __( 'New Category' ),
			'view_item' => __( 'View Category' ),
			'search_items' => __( 'Search Category' ),
			'not_found' => __( 'No Categories found' ),
			'not_found_in_trash' => __( 'No Categories found in Trash' ),
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'research-work-category' ),
		);
		register_taxonomy( 'research_work_category', array( 'research_work' ), $args );
	}
	add_action( 'init', 'cc_register_research_work_category' );
}

