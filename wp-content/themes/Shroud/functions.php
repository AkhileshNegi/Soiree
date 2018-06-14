<?php


// add a custom post type named guest
add_action('init', 'register_guest_post_type');
function register_guest_post_type() {
    $labels = array(
        'name' => 'Guests',
        'singular_name' => 'Guest',
        'add_new' => 'Add New Guest',
        'add_new_item' => 'Add New guest',
        'edit_item' => 'Edit Guest',
        'new_item' => 'New Guest',
        'all_items' => 'All Guest',
        'view_item' => 'View Guests',
        'search_items' => 'Search guests',
        'not_found' =>  'No guests Found',
        'not_found_in_trash' => 'No guests found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Guests',
    );
    
    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'guest'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-users',
        'supports' => array(
            'title',
            'thumbnail',
        )
    );
    register_post_type( 'guest', $args );
}


add_action('admin_post_save_form', 'save_form');
add_action('admin_post_nopriv_save_form', 'save_form');
function save_form() {

$email = $_POST['email'];
$gender = $_POST['gender'];


$id = wp_insert_post([
    'post_title' => $_POST['name'],
    'post_type' => 'guest',
    'post_status' => 'publish',
]);

add_post_meta($id, 'guest_email', $email);
add_post_meta($id, 'guest_gender', $gender);
}


// adding custom meta box to show guest details
add_action('add_meta_boxes', 'my_theme_add_meta_box');
function my_theme_add_meta_box() {
    add_meta_box(
        'guest_details',
        'Guest details',
        'my_theme_add_guest_fields',
        'guest',
        'normal',
        'high'
    );
}


// functions to show that field in WordPress
function my_theme_add_guest_fields() {
    global $post;
    $email = get_post_meta($post->ID, 'guest_email', true);
    $gender = get_post_meta($post->ID, 'guest_gender', true);

    $values = get_post_custom( $post->ID );
    $selected = isset( $values['guest_gender'] ) ? esc_attr( $values['guest_gender'][0] ) : ”;
?>
<label>Email:</label><br>
<input type="text" name="email" value="<?php echo $email; ?>">

<br><br>
<label>Gender</label><br>
<select name="gender" >
    <option value="male" <?php selected( $selected, 'male' ); ?>>male</option>
    <option value="female" <?php selected( $selected, 'female' ); ?>>female</option>
    <option value="other" <?php selected( $selected, 'other' ); ?>>other</option>
</select>
<?php
}


function save_your_guest_details( $post_id ) {   
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    
    // check permissions
    if ( 'guest' === $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }  
    }

    $email = $_POST['email'];
    update_post_meta( $post_id, 'guest_email', $email );

    $gender = $_POST['gender'];
     update_post_meta( $post_id, 'guest_gender', $gender );
}
add_action( 'save_post', 'save_your_guest_details' );
