<?php 
// Product Custom Post Type
function product_init() {
    // set up product labels
    $labels = array(
        'name' => 'Guests',
        'singular_name' => 'guest',
        'add_new' => 'Add New guest',
        'add_new_item' => 'Add New guest',
        'edit_item' => 'Edit guest',
        'new_item' => 'New guest',
        'all_items' => 'All guest',
        'view_item' => 'View guests',
        'search_items' => 'Search guests',
        'not_found' =>  'No guests Found',
        'not_found_in_trash' => 'No guests found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'guests',
    );
    
    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'product'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-users',
        'supports' => array(
            'title',
            'editor',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );
    register_post_type( 'product', $args );
    
    // register taxonomy
    register_taxonomy('product_category', 'product', array('hierarchical' => true, 'label' => 'Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'product-category' )));
}
add_action( 'init', 'product_init' );
?>