var current_review_index = 0;
var current_reviewed_index = 0;
var review_posts;
var reviewed_posts;

function close_internship_modal() {
	jQuery('html,body').css("overflow", "");
	jQuery("#internship_responses_modal, #internship_modal_content").hide();
	jQuery("#internship_loader").show();
}

jQuery('.internship-widget').on('click', '.internship-review-button', function(){
	var data = {
		action:'query_internship_posts',
	}
	jQuery('html,body').css("overflow", "hidden");
	jQuery("#internship_responses_modal").show();
	jQuery.ajax({
		url: ajax_object.ajax_url,
		type: "POST",
		data: data,
		success: function(response) {
			current_review_index = 0;
			review_posts = response.data.review_posts;
			if (review_posts == null){
				jQuery("#internship_loader").hide();
				jQuery("#internship_modal_content").html("No Data to Display").show();
			} else {
				load_internship_post_modal(review_posts[current_review_index], 'review');
			}
		},
		error: function(err) {
			alert('Sorry, Some error occured.');
		}
	});
});

function load_internship_post_modal(post_id, type) {
	var data = {
		post_id:post_id,
		action:'widget_modal_internship_post',
		type:type
	}
	jQuery.ajax({
		url: ajax_object.ajax_url,
		type: "POST",
		data: data,
		success: function(response) {
			jQuery("#internship_loader").hide();
			jQuery("#internship_modal_content").html(response.data.display_content).show();
			document.getElementById('internship_modal_content').scrollIntoView(true);
		},
		error: function(err) {
			alert('Sorry, Some error occured.');
		}
	});
}

jQuery('#internship_responses_modal').on('click', '#widget_internship_qnr_review_button', function(){
	var form = jQuery('#widget_internship_qnr_review_form');
		if (!form[0].checkValidity()) {
			form[0].reportValidity();
			return;
		}
	var data = jQuery('#widget_internship_qnr_review_form').serialize();
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

jQuery('.internship-widget').on('click', '.internship-reviewed-button', function(){
	var data = {
		action:'query_internship_posts',
	}
	jQuery('html,body').css("overflow", "hidden");
	jQuery("#internship_responses_modal").show();
	jQuery.ajax({
		url: ajax_object.ajax_url,
		type: "POST",
		data: data,
		success: function(response) {
			current_reviewed_index = 0;
			reviewed_posts = response.data.reviewed_posts;
			if (reviewed_posts == null){
				jQuery("#internship_loader").hide();
				jQuery("#internship_modal_content").html("No Data to Display").show();
			} else {
				load_internship_post_modal(reviewed_posts[current_reviewed_index], 'reviewed');
			}
		},
		error: function(err) {
			alert('Sorry, Some error occured.');
		}
	});
});

jQuery('#internship_responses_modal').on('click', '.internship-next-link', function(){
	jQuery("#internship_loader").show();
	var modal_type = jQuery(this).data("type");
	if( modal_type == 'reviewed' ) {
		current_reviewed_index++;
		if (current_reviewed_index == reviewed_posts.length ) {
			current_reviewed_index = 0;
		}
		load_internship_post_modal(reviewed_posts[current_reviewed_index], 'reviewed');
	}
	else if( modal_type == 'review' ) {
		current_review_index++;
		if (current_review_index == review_posts.length) {
			current_review_index = 0;
		}
		load_internship_post_modal(review_posts[current_review_index], 'review')
	}
});

jQuery('#internship_responses_modal').on('click', '.internship-previous-link', function(){
	jQuery("#internship_loader").show();
	var modal_type = jQuery(this).data("type");
	if( modal_type == 'reviewed' ) {
		current_reviewed_index--;
		if (current_reviewed_index < 0) {
			current_reviewed_index = reviewed_posts.length - 1;
		}
		load_internship_post_modal(reviewed_posts[current_reviewed_index], 'reviewed');
	}
	else if( modal_type == 'review' ) {
		current_review_index--;
		if (current_review_index < 0) {
			current_review_index = review_posts.length - 1;
		}
		load_internship_post_modal(review_posts[current_review_index], 'review')
	} 
});