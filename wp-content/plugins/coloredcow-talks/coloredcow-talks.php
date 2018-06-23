<?php
/**
 * Plugin Name: ColoredCow Talks
 * Plugin URI: https://coloredcow.com
 * Description: Plugin to display coloredcow talks
 * Version: 1.0.0
 * Author: ColoredCow
 * Author URI: https://coloredcow.com
 *
 * @package ColoredCow
 */

define( 'TALKS_PATH', plugin_dir_url( __FILE__ ) );

if ( ! function_exists( 'cc_register_talks' ) ) {
/**
 * Function to register coloredcow talks plugin
 */
	function cc_register_talks() {
		$labels = array(
			'name' => _x( 'Talks', 'talks' ),
			'singular_name' => _x( 'Talk', 'talk' ),
			'add_new' => _x( 'Add New', 'Talk' ),
			'add_new_item' => __( 'Add New Talk' ),
			'edit_item' => __( 'Edit Talk' ),
			'new_item' => __( 'New Talk' ),
			'view_item' => __( 'View Talk' ),
			'search_items' => __( 'Search Talks' ),
			'not_found' => __( 'No Talk found' ),
			'not_found_in_trash' => __( 'No Talk found in Trash' ),
		);
		$args = array(
			'labels' => $labels,
			'singular_label' => __( 'Talks', 'talks' ),
			'public' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'talks/%talks_category%', 'with_front' => false ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'author' ),
			'has_archive' => 'talks',
		);
		register_post_type( 'talks', $args );
	}
	add_action( 'init', 'cc_register_talks' );
}

if ( ! function_exists( 'cc_register_talks_category' ) ) {
/**
 * Function to create categories for coloredcow talks plugin
 */
	function cc_register_talks_category() {
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
			'rewrite' => array( 'slug' => 'talks', 'with_front' => false ),
		);
		register_taxonomy( 'talks_category', array( 'talks' ), $args );
	}
	add_action( 'init', 'cc_register_talks_category' );
}

