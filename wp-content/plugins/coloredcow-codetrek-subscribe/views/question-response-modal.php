<div id="responses_modal" class="modal">
	<?php
		global $current_post_id;
		if(isset($_GET['post'])){
			$current_post_id = $_GET['post'];
		}
		$session_id = get_post_meta($current_post_id, 'session_id', true);
		$session_category = get_the_terms( $session_id, 'codetrek_session_category');
	?>
	<div class="modal-content">
		<span class="close" onclick="close_modal()">Close</span>
		<div class="modal-content-section">
			<h3 class="form-question">Why write? Because it gives you the freedom of being you.</h3>
			<?php
				$interaction_form_ans_1 = get_post_meta($current_post_id, 'interaction_form_express_yourself');
				$answer = ! empty($interaction_form_ans_1)? $interaction_form_ans_1[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">How do you see your life till now, do you consider yourself a success or a failure? Share your story with some life instances.</h3>
			<?php
				$interaction_form_ans_2 = get_post_meta($current_post_id, 'interaction_form_life_story');
				$answer = ! empty($interaction_form_ans_2)? $interaction_form_ans_2[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Convincing people is tough. A lot of times our friends, family or other people around us don’t agree with the way we think. Relate a time from your life in which you had to convince people around you to sort a matter?</h3>
			<?php
				$interaction_form_ans_3 = get_post_meta($current_post_id, 'interaction_form_convince_story');
				$answer = ! empty($interaction_form_ans_3)? $interaction_form_ans_3[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Mountains. One of the most beautiful terrains to be in. People all over the world find different connect with hills but when it comes to work hills are usually not considered as a good option. Do you think it is possible to work in hills and develop software from there?</h3>
			<?php
				$interaction_form_ans_4 = get_post_meta($current_post_id, 'interaction_form_hills_possibility');
				$answer = ! empty($interaction_form_ans_4)? $interaction_form_ans_4[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>
			
			<?php 
				if (isset($session_category[0])) :
					if ('Design' == $session_category[0]->name) :
			?>
			<h3 class="form-question">Do you think it’s more important to remain quiet or be vocal? Why? Think about how these values add to communication skills.</h3>
			<?php
				$interaction_form_ans_5 = get_post_meta($current_post_id, 'interaction_form_vocal_or_quiet');
				$answer = ! empty($interaction_form_ans_5)? $interaction_form_ans_5[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Why is your motivation to learn designing applications? You can share some incident or experience that moved you to pursue design and your interest in this field.</h3>
			<?php
				$interaction_form_ans_6 = get_post_meta($current_post_id, 'interaction_form_design_motivation');
				$answer = ! empty($interaction_form_ans_6)? $interaction_form_ans_6[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Which design tools are you familiar with?</h3>
			<?php
				$interaction_form_ans_7 = get_post_meta($current_post_id, 'interaction_form_design_tools');
				$answer = ! empty($interaction_form_ans_7)? $interaction_form_ans_7[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Can you give examples of your favourite applications and what about it do you like. Example: from your experience of using it you may have liked its graphics or the way it works.</h3>
			<?php
				$interaction_form_ans_8 = get_post_meta($current_post_id, 'interaction_form_favourite_applications');
				$answer = ! empty($interaction_form_ans_8)? $interaction_form_ans_8[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<?php 
				elseif ('Engineering' == $session_category[0]->name) :
			?>

			<h3 class="form-question">Your interest in technology</h3>
			<?php
				$technical_form_ans_1 = get_post_meta($current_post_id, 'interaction_form_technology_interest');
				$answer = ! empty($technical_form_ans_1)? $technical_form_ans_1[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Your inclination towards Software</h3>
			<?php
				$technical_form_ans_2 = get_post_meta($current_post_id, 'interaction_form_software_inclination');
				$answer = ! empty($technical_form_ans_2)? $technical_form_ans_2[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Your desire to learn new technologies</h3>
			<?php
				$technical_form_ans_3 = get_post_meta($current_post_id, 'interaction_form_desire_new_technology');
				$answer = ! empty($technical_form_ans_3)? $technical_form_ans_3[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Your present skill level</h3>
			<?php
				$technical_form_ans_4 = get_post_meta($current_post_id, 'interaction_form_skill_level');
				$answer = ! empty($technical_form_ans_4)? $technical_form_ans_4[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">What programming languages you have learnt so far?</h3>
			<?php
				$technical_form_ans_5 = get_post_meta($current_post_id, 'interaction_form_programming_languages');
				$answer = ! empty($technical_form_ans_5)? $technical_form_ans_5[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Which text editors you are familiar with?</h3>
			<?php
				$technical_form_ans_6 = get_post_meta($current_post_id, 'interaction_form_text_editors');
				$answer = ! empty($technical_form_ans_6)? $technical_form_ans_6[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">What are scripting languages? Name few.</h3>
			<?php
				$technical_form_ans_7 = get_post_meta($current_post_id, 'interaction_form_scripting_languages');
				$answer = ! empty($technical_form_ans_7)? $technical_form_ans_7[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Which part of computer science or software development intrigues you the most?</h3>
			<?php
				$technical_form_ans_8 = get_post_meta($current_post_id, 'interaction_form_intrigues_most');
				$answer = ! empty($technical_form_ans_8)? $technical_form_ans_8[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">What do you understand by CMS?</h3>
			<?php
				$technical_form_ans_9 = get_post_meta($current_post_id, 'interaction_form_understanding_cms');
				$answer = ! empty($technical_form_ans_9)? $technical_form_ans_9[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Why do you think learning Data Structure and Algorithm is important?</h3>
			<?php
				$technical_form_ans_10 = get_post_meta($current_post_id, 'interaction_form_ds_algo_learning');
				$answer = ! empty($technical_form_ans_10)? $technical_form_ans_10[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Share the incident that got your interest in programming.</h3>
			<?php
				$technical_form_ans_11 = get_post_meta($current_post_id, 'interaction_form_interest_incident');
				$answer = ! empty($technical_form_ans_11)? $technical_form_ans_11[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">Name the frameworks you are familiar with.</h3>
			<?php
				$technical_form_ans_12 = get_post_meta($current_post_id, 'interaction_form_familiar_frameworks');
				$answer = ! empty($technical_form_ans_12)? $technical_form_ans_12[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<h3 class="form-question">What do you understand by version control? Mention examples.</h3>
			<?php
				$technical_form_ans_13 = get_post_meta($current_post_id, 'interaction_form_version_control');
				$answer = ! empty($technical_form_ans_13)? $technical_form_ans_13[0] : "No form submission yet.";
			?>
			<p class="form-answer"><?php echo $answer; ?> </p>

			<?php 
					endif;
				endif;
			?>

			<form id="qnr_review_form" action="">
				<input type="hidden" value="<?php echo $current_post_id; ?>" name="post_id">
				<input type="hidden" name="action" value="submit_qnr_review">
				<textarea name="qnr_review" id="qnr_review" cols="80" rows="5" placeholder="Add review note" required="required"><?php echo get_post_meta($current_post_id, 'qnr_review', true);?></textarea>
				<div class="form-group">
					<label for="rating">Rate answer</label>
					<input type="number" name="rating" max="10" value="<?php echo get_post_meta($current_post_id, 'rating', true) ?>">
				</div>
				<button id="qnr_review_button" class="review-button" type="button">Review</button>
			</form>
		</div>
	</div>
</div>
