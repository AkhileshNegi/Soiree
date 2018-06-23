var current_review_index = 0;
var current_reviewed_index = 0;
var review_posts;
var reviewed_posts;
jQuery('#qnr_review_form').on('click', '#qnr_review_button', function(){
	var form = jQuery('#qnr_review_form');
		if (!form[0].checkValidity()) {
			form[0].reportValidity();
			return;
		}
	var data = jQuery('#qnr_review_form').serialize();
	jQuery.ajax({
		url: ajax_object.ajax_url,
		type: "POST",
		data: data,
		success: function(response) {
			alert('Your review is successfully submitted');
			jQuery("#responses_modal").hide();
		},
		error: function(err) {
			alert('Sorry, Some error occured.');
		}
	});
});

function open_modal() {
	jQuery('html,body').css("overflow", "hidden");
	jQuery("#responses_modal").show();
}

function close_modal() {
	jQuery('html,body').css("overflow", "");
	jQuery("#responses_modal").hide();
}

function open_review_section() {
	jQuery("#responses_modal").show();
	document.getElementById('qnr_review_form').scrollIntoView(true);
}

jQuery('.button-row').on('click', '.codetrek-nudge-button', function(){
	jQuery('.codetrek-nudge-button').prop('disabled', true);
	var data = {
		'post_id' : jQuery(this).data('id'),
		'action' : 'send_nudge_mail',
	};
	jQuery.ajax({
		url: ajax_object.ajax_url,
		type: "POST",
		data: data,
		success: function(response) {
			if(response.data.status == 'sent') {
				jQuery('#nudge_counter').html(response.data.updated_nudge_value);
				jQuery('.codetrek-nudge-button').prop('disabled', false);
			}
		},
		error: function(err) {
			alert('Sorry, Some error occured.');
		}
	});
});

function close_widget_modal() {
	jQuery('html,body').css("overflow", "");
	jQuery("#dashboard_responses_modal").hide();
	jQuery("#loader").show();
	jQuery("#widget_modal_content").hide();
}

jQuery('.codetrek-widget').on('click', '.widget-review-button', function(){
	var data = {
		action:'query_codetrek_posts',
		session_id: jQuery(this).data('session_id'),
	}
	jQuery('html,body').css("overflow", "hidden");
	jQuery("#dashboard_responses_modal").show();
	jQuery.ajax({
		url: ajax_object.ajax_url,
		type: "POST",
		data: data,
		success: function(response) {
			current_review_index = 0;
			review_posts = response.data.review_posts;
			if (review_posts == null){
				jQuery("#loader").hide();
				jQuery("#widget_modal_content").html("No Data to Display");
				jQuery("#widget_modal_content").show();
			} else {
				load_post_modal(review_posts[current_review_index], 'review');
			}
		},
		error: function(err) {
			alert('Sorry, Some error occured.');
		}
	});
});

function load_post_modal(post_id, type) {
	var data = {
		post_id:post_id,
		action:'widget_modal_single_post',
		type:type
	}
	jQuery.ajax({
		url: ajax_object.ajax_url,
		type: "POST",
		data: data,
		success: function(response) {
			jQuery("#loader").hide();
			jQuery("#widget_modal_content").html(response.data.display_content);
			jQuery("#widget_modal_content").show();
			document.getElementById('widget_modal_content').scrollIntoView(true);
		},
		error: function(err) {
			alert('Sorry, Some error occured.');
		}
	});
}

jQuery('.codetrek-widget').on('click', '.widget-reviewed-button', function(){
	var data = {
		action:'query_codetrek_posts',
		session_id: jQuery(this).data('session_id'),
	}
	jQuery('html,body').css("overflow", "hidden");
	jQuery("#dashboard_responses_modal").show();
	jQuery.ajax({
		url: ajax_object.ajax_url,
		type: "POST",
		data: data,
		success: function(response) {
			current_reviewed_index = 0;
			reviewed_posts = response.data.reviewed_posts;
			if (reviewed_posts == null){
				jQuery("#loader").hide();
				jQuery("#widget_modal_content").html("No Data to Display");
				jQuery("#widget_modal_content").show();
			} else {
				load_post_modal(reviewed_posts[current_reviewed_index], 'reviewed');
			}
		},
		error: function(err) {
			alert('Sorry, Some error occured.');
		}
	});
});

jQuery('.codetrek-widget').on('click', '#widget_qnr_review_button', function(){
	var form = jQuery('#widget_qnr_review_form');
		if (!form[0].checkValidity()) {
			form[0].reportValidity();
			return;
		}
	var data = jQuery('#widget_qnr_review_form').serialize();
	jQuery.ajax({
		url: ajax_object.ajax_url,
		type: "POST",
		data: data,
		success: function(response) {
			alert('Your review is successfully submitted');
		},
		error: function(err) {
			alert('Sorry, Some error occured.');
		}
	});
});

jQuery('.modal-content-section').on('click', '.next-link', function(){
	jQuery("#loader").show();
	var modal_type = jQuery(this).data("type");
	if( modal_type == 'reviewed' ) {
		current_reviewed_index++;
		if (current_reviewed_index == reviewed_posts.length ) {
			current_reviewed_index = 0;
		}
		load_post_modal(reviewed_posts[current_reviewed_index], 'reviewed');
	}
	else if( modal_type == 'review' ) {
		current_review_index++;
		if (current_review_index == review_posts.length) {
			current_review_index = 0;
		}
		load_post_modal(review_posts[current_review_index], 'review')
	}
});

jQuery('.modal-content-section').on('click', '.previous-link', function(){
	jQuery("#loader").show();
	var modal_type = jQuery(this).data("type");
	if( modal_type == 'reviewed' ) {
		current_reviewed_index--;
		if (current_reviewed_index < 0) {
			current_reviewed_index = reviewed_posts.length - 1;
		}
		load_post_modal(reviewed_posts[current_reviewed_index], 'reviewed');
	}
	else if( modal_type == 'review' ) {
		current_review_index--;
		if (current_review_index < 0) {
			current_review_index = review_posts.length - 1;
		}
		load_post_modal(review_posts[current_review_index], 'review')
	} 
});