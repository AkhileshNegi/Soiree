<?php
/*
Plugin Name: Career
Plugin URI: http://coloredcow.in
Description: A Career Plugin
Version: 1.0.0
Author: ColoredCow
Author URI: https://coloredcow.com
*/
define('CAREER_PATH', plugin_dir_url( __FILE__ ));
if(! function_exists('cc_register_career')){
	function cc_register_career() {

		$labels = array(
			'name' => _x( 'Career', 'post type general name' ),
			'singular_name' => _x( 'Career', 'post type singular name' ),
			'add_new' => _x( 'Add New', 'Career' ),
			'add_new_item' => __( 'Add New Career' ),
			'edit_item' => __( 'Edit Career' ),
			'new_item' => __( 'New Career' ),
			'view_item' => __( 'View Career' ),
			'search_items' => __( 'Search Careers' ),
			'not_found' =>  __( 'No Careers found' ),
			'not_found_in_trash' => __( 'No Careers found in Trash' ),
		);

		$args = array(
			'labels' => $labels,
			'singular_label' => __('Career', 'career'),
			'public' => true,
			'capability_type' => 'post',
			'supports' => array('title', 'editor' , 'thumbnail', 'excerpt'),
			'has_archive' => true
		);
		register_post_type('career', $args);
	}
	add_action( 'init', 'cc_register_career');
}

if(!function_exists('cc_save_career')){
	function cc_save_career( $post_id, $post_object ){
		if( !isset( $post_object->post_type ) || 'career' != $post_object->post_type )
			return;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return;
		if ( isset( $_POST['cc_video_url'] )  )
			update_post_meta( $post_id, 'cc_video_url', $_POST['cc_video_url'] );
	}
	add_action( 'save_post', 'cc_save_career', 10, 2 );
}

if(!function_exists('cc_add_video_url_metabox')){
	function cc_add_video_url_metabox() {
		add_meta_box( 'cc_meta_box_video', 'Video URL', 'cc_video_url_metabox', 'career' ,'side','high');
	}
}

if(!function_exists('cc_video_url_metabox')){
	function cc_video_url_metabox( $post ) {
		$values = get_post_custom( $post->ID );
		$video_url = isset( $values['cc_video_url'] ) ? esc_attr( $values['cc_video_url'][0] ) : 'http://';
		wp_nonce_field( 'cc_career_editor', 'metabox_nonce' );
		?>
		<p>
			<label for="video_url">Video URL:</label>
			<input type="url" name="cc_video_url" id="cc_video_url" value="<?php echo $video_url; ?>" />
		</p>
		<?php
	}
	add_action('add_meta_boxes','cc_add_video_url_metabox');
}

if(!function_exists('cc_embed_video')){
	function cc_embed_video($video){
		if( strpos($video, 'youtube.com') !== false ){
			$video_file = substr($video, strlen($video)-11);
			$video_link = "https://youtube.com/embed/".$video_file."?rel=0";
		} else if(strpos($video, 'facebook.com') !== false ){
			$video_link = "https://www.facebook.com/plugins/video.php?href=".$video."";
		} else{
			$video_link=$video;
		}
		return $video_link;
	}
}

if(!function_exists('cc_register_career_category')){
	function cc_register_career_category() {
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
			'rewrite' => array('slug' => 'career-category'),
		);
		register_taxonomy( 'career_category', array( 'career' ), $args );
	}
	add_action( 'init', 'cc_register_career_category' );
}

function career_admin_enqueue_scripts() {
	wp_enqueue_script( 'career-main', plugins_url('career-main.js', __FILE__ ), array( 'jquery'), '1.1.0', true);
	wp_enqueue_style('career_admin_style', plugins_url('career-style.css', __FILE__));
	wp_localize_script('career-main', 'ajax_object',
		array(
			'ajax_url' => admin_url('admin-ajax.php')
		)
	);
}
add_action( 'admin_enqueue_scripts', 'career_admin_enqueue_scripts' );



function add_internship_widget() {
	wp_add_dashboard_widget("career-widget", "Internship Applications", "display_internship_responses_widget");
}

function display_internship_responses_widget() {
	require_once (dirname(__FILE__).'/views/internship-widget.php');
}
add_action("wp_dashboard_setup", "add_internship_widget");

function submit_internship_qnr_review(){
	global $wpdb;
	$post_id = $_POST['post_id'];
	$review_by = $_POST['review_by'];
	$review = $_POST['internship_qnr_review'];
	$rating = $_POST['internship_rating'];
	$wpdb->update($wpdb->prefix.'internship_engineering_form', array('qnr_review'=>$review, 'rating'=>$rating, 'qnr_review_by'=>$review_by ), array('id' => $post_id));
	wp_send_json_success();
}
add_action( 'wp_ajax_submit_internship_qnr_review', 'submit_internship_qnr_review' );
add_action( 'wp_ajax_nopriv_submit_internship_qnr_review', 'submit_internship_qnr_review' );

function query_internship_posts() {
	global $wpdb;
	$results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}internship_engineering_form");
	foreach ($results as $result) {
		if (empty($result->qnr_review) && '0' == $result->rating) {
			$review_post_id[] = $result->id;
		} else {
			$reviewed_post_id[] = $result->id;
		}
	}
	wp_send_json_success(array('reviewed_posts' => $reviewed_post_id, 'review_posts' => $review_post_id));
}
add_action( 'wp_ajax_query_internship_posts', 'query_internship_posts' );
add_action( 'wp_ajax_nopriv_query_internship_posts', 'query_internship_posts' );

function widget_modal_internship_post() {
	$current_post_id = $_POST['post_id'];
	$modal_type = $_POST['type'];
	$modal_content = internship_modal_content_widget($current_post_id, $modal_type);
	wp_send_json_success(array('display_content' => $modal_content));
}
add_action( 'wp_ajax_widget_modal_internship_post', 'widget_modal_internship_post' );
add_action( 'wp_ajax_nopriv_widget_modal_internship_post', 'widget_modal_internship_post' );

function internship_modal_content_widget($current_post_id, $modal_type) {
	global $wpdb;
	$current_user = wp_get_current_user();
	$result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}internship_engineering_form WHERE id={$current_post_id}");
	$html .='<p class="name-heading">Name : <span>'.$result[0]->first_name.' '.$result[0]->middle_name.' '.$result[0]->last_name.'</span></p>';
	$html .='<div class="dashboard-form-question">Why write? Because it gives you the freedom of being you.</				div>';
	$interaction_form_ans_1 = $result[0]->express_yourself;
	$answer = ! empty($interaction_form_ans_1)? $interaction_form_ans_1 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';
	$html .='<div class="dashboard-form-question">How do you see your life till now, do you consider yourself a success or a failure? Share your story with some life instances.</div>';
	$interaction_form_ans_2 = $result[0]->life_story;
	$answer = ! empty($interaction_form_ans_2)? $interaction_form_ans_2 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';

	$html .='<div class="dashboard-form-question">Convincing people is tough. A lot of times our friends, family or other people around us don’t agree with the way we think. Relate a time from your life in which you had to convince people around you to sort a matter?</div>';
	$interaction_form_ans_3 = $result[0]->convince_story;
	$answer = ! empty($interaction_form_ans_3)? $interaction_form_ans_3 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';

	$html .='<div class="dashboard-form-question">Mountains. One of the most beautiful terrains to be in. People all over the world find different connect with hills but when it comes to work hills are usually not considered as a good option. Do you think it is possible to work in hills and develop software from there?</div>';
	$interaction_form_ans_4 = $result[0]->hills_possibility;
	$answer = ! empty($interaction_form_ans_4)? $interaction_form_ans_4 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';
	$html .='<div class="dashboard-form-question">Your interest in technology</div>';
	$technical_form_ans_1 = $result[0]->technology_interest;
	$answer = ! empty($technical_form_ans_1)? $technical_form_ans_1 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';

	$html .='<div class="dashboard-form-question">Your inclination towards Software</div>';
	$technical_form_ans_2 = $result[0]->software_inclination;
	$answer = ! empty($technical_form_ans_2)? $technical_form_ans_2 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';

	$html .='<div class="dashboard-form-question">Your desire to learn new technologies</div>';
	$technical_form_ans_3 = $result[0]->desire_new_technology;
	$answer = ! empty($technical_form_ans_3)? $technical_form_ans_3 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';

	$html .='<div class="dashboard-form-question">Your present skill level</div>';
	$technical_form_ans_4 = $result[0]->skill_level;
	$answer = ! empty($technical_form_ans_4)? $technical_form_ans_4 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';

	$html .='<div class="dashboard-form-question">What programming languages you have learnt so far?</div>';
	$technical_form_ans_5 = $result[0]->programming_languages;
	$answer = ! empty($technical_form_ans_5)? $technical_form_ans_5 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';

	$html .='<div class="dashboard-form-question">Which text editors you are familiar with?</div>';
	$technical_form_ans_6 = $result[0]->text_editors;
	$answer = ! empty($technical_form_ans_6)? $technical_form_ans_6 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';

	$html .='<div class="dashboard-form-question">What are scripting languages? Name few.</div>';
	$technical_form_ans_7 = $result[0]->scripting_languages;
	$answer = ! empty($technical_form_ans_7)? $technical_form_ans_7 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';

	$html .='<div class="dashboard-form-question">Which part of computer science or software development intrigues you the most?</div>';
	$technical_form_ans_8 = $result[0]->intrigues_most;
	$answer = ! empty($technical_form_ans_8)? $technical_form_ans_8 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';
	$html .='<div class="dashboard-form-question">What do you understand by CMS?</div>';
	$technical_form_ans_9 = $result[0]->understanding_cms;
	$answer = ! empty($technical_form_ans_9)? $technical_form_ans_9 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';

	$html .='<div class="dashboard-form-question">Why do you think learning Data Structure and Algorithm is important?</div>';
	$technical_form_ans_10 = $result[0]->ds_algo_learning;
	$answer = ! empty($technical_form_ans_10)? $technical_form_ans_10 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';

	$html .='<div class="dashboard-form-question">Share the incident that got your interest in programming.</div>';
	$technical_form_ans_11 = $result[0]->interest_incident;
	$answer = ! empty($technical_form_ans_11)? $technical_form_ans_11 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';

	$html .='<div class="dashboard-form-question">Name the frameworks you are familiar with.</div>';
	$technical_form_ans_12 = $result[0]->familiar_frameworks;
	$answer = ! empty($technical_form_ans_12)? $technical_form_ans_12 : "No form submission yet.";
	$html .='<p class="form-answer">'.$answer.'</p>';
	$html .='<div class="dashboard-form-question">What do you understand by version control? Mention examples.</div>';
	$technical_form_ans_13 = $result[0]->version_control;
	$answer = ! empty($technical_form_ans_13)? $technical_form_ans_13 : "No form submission yet.";
	
	$html .='<p class="form-answer">'.$answer.'</p>';
	$html .='<form id="widget_internship_qnr_review_form">';
	$html .='<input type="hidden" value="'.$current_post_id.'" name="post_id">';
	$html .='<input type="hidden" value="'.$current_user->user_login.'" name="review_by">';
	$html .='<input type="hidden" name="action" value="submit_internship_qnr_review">';
	$html .='<textarea name="internship_qnr_review" id="internship_qnr_review" cols="80" rows="5" placeholder="Add review note" required="required">'.$result[0]->qnr_review.'</textarea>';
	$html .='<div class="form-group">
				<label for="rating">Rate answer</label>';
	$html .='<input type="number" name="internship_rating" max="10" value="'.$result[0]->rating.'">
			</div>
				<button id="widget_internship_qnr_review_button" class="review-button" type="button">Review</button>
			</form>
			<div class="next-previous-links">';
	$html .='<a class="internship-previous-link" data-type='.$modal_type.' href="#previous">&laquo; Previous</a>&nbsp;||&nbsp;';
	$html .='<a class="internship-next-link" data-type='.$modal_type.' href="#next">Next &raquo;</a>
			</div>';
	return $html;
}