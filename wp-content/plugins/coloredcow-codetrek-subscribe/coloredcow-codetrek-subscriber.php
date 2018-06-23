<?php
/**
 * Plugin Name: ColoredCow Codetrek data
 * Plugin URI: https://coloredcow.com
 * Description: Custom Post for ColoredCow's Codetrek data
 * Version: 1.0.0
 * Author: ColoredCow
 * Author URI: https://coloredcow.com
 * Text Domain: codetrek_data
 *
 * @package ColoredCow
 * @subpackage CodeTrek
 */

define( 'CODETREK_DATA_PATH', plugin_dir_url( __FILE__ ) );

function menu_pages() {
	add_menu_page( 'Codetrek Data', 'Codetrek Data', 'manage_options', 'codetrek_data','codetrek_data_admin_enqueue_scripts', 'dashicons-clipboard' );
}
add_action( 'admin_menu', 'menu_pages' );

function codetrek_data_admin_enqueue_scripts() {
	wp_enqueue_script( 'main', plugins_url( 'main.js', __FILE__ ), array( 'jquery' ), '1.1.0', true );
	wp_enqueue_style( 'codetrek_data_admin_style' , plugins_url( 'style.css', __FILE__ ) );
	wp_localize_script( 'main', 'ajax_object',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'codetrek_data_admin_enqueue_scripts' );

if ( ! function_exists( 'cc_register_codetrek_data' ) ) {
	function cc_register_codetrek_data() {
		$labels = array(
			'name' => _x( 'Codetrek data', 'codetrek_data' ),
			'singular_name' => _x( 'codetrek data', 'Codetrek data' ),
			'add_new' => _x( 'Add New', 'Codetrek data' ),
			'add_new_item' => __( 'Add New Codetrek data' ),
			'edit_item' => __( 'Edit Codetrek data' ),
			'new_item' => __( 'New Codetrek data' ),
			'view_item' => __( 'View Codetrek data' ),
			'search_items' => __( 'Search Codetrek data' ),
			'not_found' => __( 'No Codetrek data found' ),
			'not_found_in_trash' => __( 'No Codetrek data found in Trash' ),
		);

		$args = array(
			'labels' => $labels,
			'singular_label' => __( 'Codetrek data', 'codetrek data' ),
			'capability_type' => 'post',
			'rewrite' => array(
				'slug' => 'codetrek-data',
			),
			'supports' => array( 'title', 'editor', 'comments' ),
			'has_archive' => false,
			'public' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'exclude_from_search' => true,
			'show_in_nav_menus' => false,
		);
		register_post_type( 'codetrek_data', $args );
	}
	add_action( 'init', 'cc_register_codetrek_data' );

	function nudge_meta_box_markup() {
		require_once( dirname( __FILE__ ) . '/views/nudge-metabox.php' );
	}

	function nudge_meta_box() {
		add_meta_box( 'nudge-meta-box', 'Nudge Student', 'nudge_meta_box_markup', 'codetrek_data', 'side', 'low', null );
	}
	add_action( 'add_meta_boxes_codetrek_data', 'nudge_meta_box' );

	function selection_process_meta_box_markup() {
		wp_nonce_field( basename( __FILE__ ), 'meta-box-nonce' );
		require_once( dirname( __FILE__ ) . '/views/selection-metabox.php' );
	}

	function selection_process_meta_box() {
		add_meta_box( 'selection-process-meta-box', 'Selection Process', 'selection_process_meta_box_markup', 'codetrek_data', 'side', 'low', null );
	}
	add_action( 'add_meta_boxes_codetrek_data', 'selection_process_meta_box' );

	function require_response_modal() {
		require_once( dirname( __FILE__ ) . '/views/question-response-modal.php' );
	}
	add_action( 'admin_footer', 'require_response_modal' );
}

function submit_qnr_review() {
	$post_id = $_POST['post_id'];
	$review = $_POST['qnr_review'];
	$rating = $_POST['rating'];
	update_post_meta( $post_id, 'qnr_review' , $review );
	update_post_meta( $post_id, 'rating', $rating );
	wp_send_json_success();
}
add_action( 'wp_ajax_submit_qnr_review', 'submit_qnr_review' );
add_action( 'wp_ajax_nopriv_submit_qnr_review', 'submit_qnr_review' );

/**
 * Function to send nudge mail to the CodeTrek registrant
 *
 * @return void
 */
function send_nudge_mail() {

	$post_id = $_POST['post_id'];
	$nudge_sends = get_post_meta( $post_id, 'nudge_sent_counter', true );

	$encrypted_id = apply_filters( 'encrypt_post_id', $post_id );
	$interaction_form_url = get_permalink( get_page_by_path( 'codetrek/interaction-form/' ) ) . '?cc_sid=' . $encrypted_id;

	if ( ! class_exists( 'CCSES_Mail' ) ) {
		wp_send_json_error(array(
			'status' => 'not-sent',
			'updated_nudge_value' => $nudge_sends,
		));
	}

	$ccses = new CCSES_Mail;
	$ccses->set_subject( 'Complete your application to participate in CodeTrek' );

	$student_name = get_the_title( $post_id );
	$student_email = get_post_meta( $post_id, 'email', true );
	$ccses->set_recipients( array( CCSES_Mail::get_formatted_address( $student_name, $student_email ) ) );

	$ccses->set_sender( CCSES_Mail::get_formatted_address( 'CodeTrek Team', 'codetrek@coloredcow.com' ) );
	$ccses->set_mail_template( 'mail-templates/codetrek/nudge.php', [
		'intlink' => $interaction_form_url,
	]);
	$result = $ccses->send_mail();

	update_post_meta( $post_id, 'nudge_sent_counter', ++$nudge_sends );
	wp_send_json_success(array(
		'status' => 'sent',
		'updated_nudge_value' => $nudge_sends,
	));
}
add_action( 'wp_ajax_send_nudge_mail', 'send_nudge_mail' );
add_action( 'wp_ajax_nopriv_send_nudge_mail', 'send_nudge_mail' );

function add_dashboard_widget() {
	wp_add_dashboard_widget( 'codetrek-widget', 'CodeTrek Form Responses', 'display_responses_dashboard_widget' );
}

function display_responses_dashboard_widget() {
	require_once( dirname( __FILE__ ) . '/views/responses-dashboard-widget.php' );
}
add_action( 'wp_dashboard_setup', 'add_dashboard_widget' );

function query_codetrek_posts() {
	$session_id = $_POST['session_id'];
	if ( ! isset( $session_id ) ) {
		$reviewed_args = array(
			'post_type' => 'codetrek_data',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'qnr_review',
				),
			),
			'order' => 'ASC',
		);
	} else {
		$reviewed_args = array(
			'post_type' => 'codetrek_data',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'qnr_review',
				),
				array(
					'key' => 'session_id',
					'value' => $session_id,
				),
			),
			'order' => 'ASC',
		);
	}

	$reviewed_posts_query = get_posts( $reviewed_args );
	foreach ( $reviewed_posts_query as $reviewed_post ) {
		$reviewed_post_id[] = $reviewed_post->ID;
	}
	if ( ! isset( $session_id ) ) {
		$review_args = array(
			'post_type' => 'codetrek_data',
			'posts_per_page' => -1,
			'post__not_in' => $reviewed_post_id,
			'order' => 'ASC',
		);
	} else {
		$review_args = array(
			'post_type' => 'codetrek_data',
			'posts_per_page' => -1,
			'post__not_in' => $reviewed_post_id,
			'order' => 'ASC',
			'meta_key' => 'session_id',
			'meta_value' => $session_id,
		);
	}
	$review_posts_query = get_posts( $review_args );
	foreach ( $review_posts_query as $review_post ) {
		$review_post_id[] = $review_post->ID;
	}
	wp_send_json_success(array(
		'reviewed_posts' => $reviewed_post_id,
		'review_posts' => $review_post_id,
	));
}
add_action( 'wp_ajax_query_codetrek_posts', 'query_codetrek_posts' );
add_action( 'wp_ajax_nopriv_query_codetrek_posts', 'query_codetrek_posts' );

function widget_modal_single_post() {
	$current_post_id = $_POST['post_id'];
	$modal_type = $_POST['type'];
	$modal_content = modal_content_widget( $current_post_id, $modal_type );
	wp_send_json_success(array(
		'display_content' => $modal_content,
	));
}
add_action( 'wp_ajax_widget_modal_single_post', 'widget_modal_single_post' );
add_action( 'wp_ajax_nopriv_widget_modal_single_post', 'widget_modal_single_post' );

function modal_content_widget( $current_post_id, $modal_type ) {
	$session_id = get_post_meta( $current_post_id, 'session_id', true );
	$session_category = get_the_terms( $session_id, 'codetrek_session_category' );
	$html .= '<p class="name-heading">Name : <span>' . get_the_title( $current_post_id ) . '</span></p>';
	$html .= '<p class="session-heading">Session : <span>' . get_post_meta( $current_post_id, 'session', true ) . '</span></p>';
	$html .= '<div class="dashboard-form-question">Why write? Because it gives you the freedom of being you.</div>';
	$interaction_form_ans_1 = get_post_meta( $current_post_id, 'interaction_form_express_yourself' );
	$answer = ! empty( $interaction_form_ans_1 ) ? $interaction_form_ans_1[0] : 'No form submission yet.';
	$html .= '<p class="form-answer">' . $answer . '</p>';

	$html .= '<div class="dashboard-form-question">How do you see your life till now, do you consider yourself a success or a failure? Share your story with some life instances.</div>';
	$interaction_form_ans_2 = get_post_meta( $current_post_id, 'interaction_form_life_story' );
	$answer = ! empty( $interaction_form_ans_2 ) ? $interaction_form_ans_2[0] : 'No form submission yet.';
	$html .= '<p class="form-answer">' . $answer . '</p>';

	$html .= '<div class="dashboard-form-question">Convincing people is tough. A lot of times our friends, family or other people around us don’t agree with the way we think. Relate a time from your life in which you had to convince people around you to sort a matter?</div>';
	$interaction_form_ans_3 = get_post_meta( $current_post_id, 'interaction_form_convince_story' );
	$answer = ! empty( $interaction_form_ans_3 ) ? $interaction_form_ans_3[0] : 'No form submission yet.';
	$html .= '<p class="form-answer">' . $answer . '</p>';

	$html .= '<div class="dashboard-form-question">Mountains. One of the most beautiful terrains to be in. People all over the world find different connect with hills but when it comes to work hills are usually not considered as a good option. Do you think it is possible to work in hills and develop software from there?</div>';
	$interaction_form_ans_4 = get_post_meta( $current_post_id, 'interaction_form_hills_possibility' );
	$answer = ! empty( $interaction_form_ans_4 ) ? $interaction_form_ans_4[0] : 'No form submission yet.';
	$html .= '<p class="form-answer">' . $answer . '</p>';
	if ( isset( $session_category[0] ) ) {
		if ( 'Design' === $session_category[0]->name ) {
			$html .= '<h3 class="form-question">Do you think it’s more important to remain quiet or be vocal? Why? Think about how these values add to communication skills.</h3>';
			$interaction_form_ans_5 = get_post_meta( $current_post_id, 'interaction_form_vocal_or_quiet' );
			$answer = ! empty( $interaction_form_ans_5 ) ? $interaction_form_ans_5[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';
			$html .= '<h3 class="form-question">Why is your motivation to learn designing applications? You can share some incident or experience that moved you to pursue design and your interest in this field.</h3>';
			$interaction_form_ans_6 = get_post_meta( $current_post_id, 'interaction_form_design_motivation' );
			$answer = ! empty( $interaction_form_ans_6 ) ? $interaction_form_ans_6[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';
			$html .= '<h3 class="form-question">Which design tools are you familiar with?</h3>';
			$interaction_form_ans_7 = get_post_meta( $current_post_id, 'interaction_form_design_tools' );
			$answer = ! empty( $interaction_form_ans_7 ) ? $interaction_form_ans_7[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';
			$html .= '<h3 class="form-question">Can you give examples of your favourite applications and what about it do you like. Example: from your experience of using it you may have liked its graphics or the way it works.</h3>';
			$interaction_form_ans_8 = get_post_meta( $current_post_id, 'interaction_form_favourite_applications' );
			$answer = ! empty( $interaction_form_ans_8 ) ? $interaction_form_ans_8[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';
		} elseif ( 'Engineering' === $session_category[0]->name ) {
			$html .= '<div class="dashboard-form-question">Your interest in technology</div>';
			$technical_form_ans_1 = get_post_meta( $current_post_id, 'interaction_form_technology_interest' );
			$answer = ! empty( $technical_form_ans_1 ) ? $technical_form_ans_1[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';

			$html .= '<div class="dashboard-form-question">Your inclination towards Software</div>';
			$technical_form_ans_2 = get_post_meta( $current_post_id, 'interaction_form_software_inclination' );
			$answer = ! empty( $technical_form_ans_2 ) ? $technical_form_ans_2[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';

			$html .= '<div class="dashboard-form-question">Your desire to learn new technologies</div>';
			$technical_form_ans_3 = get_post_meta( $current_post_id, 'interaction_form_desire_new_technology' );
			$answer = ! empty( $technical_form_ans_3 ) ? $technical_form_ans_3[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';

			$html .= '<div class="dashboard-form-question">Your present skill level</div>';
			$technical_form_ans_4 = get_post_meta( $current_post_id, 'interaction_form_skill_level' );
			$answer = ! empty( $technical_form_ans_4 ) ? $technical_form_ans_4[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';

			$html .= '<div class="dashboard-form-question">What programming languages you have learnt so far?</div>';
			$technical_form_ans_5 = get_post_meta( $current_post_id, 'interaction_form_programming_languages' );
			$answer = ! empty( $technical_form_ans_5 ) ? $technical_form_ans_5[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';

			$html .= '<div class="dashboard-form-question">Which text editors you are familiar with?</div>';
			$technical_form_ans_6 = get_post_meta( $current_post_id, 'interaction_form_text_editors' );
			$answer = ! empty( $technical_form_ans_6 ) ? $technical_form_ans_6[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';

			$html .= '<div class="dashboard-form-question">What are scripting languages? Name few.</div>';
			$technical_form_ans_7 = get_post_meta( $current_post_id, 'interaction_form_scripting_languages' );
			$answer = ! empty( $technical_form_ans_7 ) ? $technical_form_ans_7[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';

			$html .= '<div class="dashboard-form-question">Which part of computer science or software development intrigues you the most?</div>';
			$technical_form_ans_8 = get_post_meta( $current_post_id, 'interaction_form_intrigues_most' );
			$answer = ! empty( $technical_form_ans_8 ) ? $technical_form_ans_8[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';
			$html .= '<div class="dashboard-form-question">What do you understand by CMS?</div>';
			$technical_form_ans_9 = get_post_meta( $current_post_id, 'interaction_form_understanding_cms' );
			$answer = ! empty( $technical_form_ans_9 ) ? $technical_form_ans_9[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';

			$html .= '<div class="dashboard-form-question">Why do you think learning Data Structure and Algorithm is important?</div>';
			$technical_form_ans_10 = get_post_meta( $current_post_id, 'interaction_form_ds_algo_learning' );
			$answer = ! empty( $technical_form_ans_10 ) ? $technical_form_ans_10[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';

			$html .= '<div class="dashboard-form-question">Share the incident that got your interest in programming.</div>';
			$technical_form_ans_11 = get_post_meta( $current_post_id, 'interaction_form_interest_incident' );
			$answer = ! empty( $technical_form_ans_11 ) ? $technical_form_ans_11[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';

			$html .= '<div class="dashboard-form-question">Name the frameworks you are familiar with.</div>';
			$technical_form_ans_12 = get_post_meta( $current_post_id, 'interaction_form_familiar_frameworks' );
			$answer = ! empty( $technical_form_ans_12 ) ? $technical_form_ans_12[0] : 'No form submission yet.';
			$html .= '<p class="form-answer">' . $answer . '</p>';
			$html .= '<div class="dashboard-form-question">What do you understand by version control? Mention examples.</div>';
			$technical_form_ans_13 = get_post_meta( $current_post_id, 'interaction_form_version_control' );
			$answer = ! empty( $technical_form_ans_13 ) ? $technical_form_ans_13[0] : 'No form submission yet.';

			$html .= '<p class="form-answer">' . $answer . '</p>';
		}
	}
	$html .= '<form id="widget_qnr_review_form">';
	$html .= '<input type="hidden" value="' . $current_post_id . '" name="post_id">';
	$html .= '<input type="hidden" name="action" value="submit_qnr_review">';
	$html .= '<textarea name="qnr_review" id="qnr_review" cols="80" rows="5" placeholder="Add review note" required="required"> ' . get_post_meta( $current_post_id, 'qnr_review', true ) . '</textarea>';
	$html .= '<div class="form-group">
				<label for="rating">Rate answer</label>';
	$html .= '<input type="number" name="rating" max="10" value="' . get_post_meta( $current_post_id, 'rating', true ) . '">
			</div>
				<button id="widget_qnr_review_button" class="review-button" type="button">Review</button>
			</form>
			<div class="next-previous-links">';
	$html .= '<a class="previous-link" data-type=' . $modal_type . ' href="#previous">&laquo; Previous</a>&nbsp;||&nbsp;';
	$html .= '<a class="next-link" data-type=' . $modal_type . ' href="#next">Next &raquo;</a>
			</div>';
	return $html;
}
