<?php
	wp_nonce_field(basename(__FILE__), "meta-box-nonce");
	global $current_post_id;
	if(isset($_GET['post'])){
		$current_post_id = $_GET['post'];
		$nudge_sent_counter = (int)get_post_meta( $current_post_id, 'nudge_sent_counter', true);
	}
?>
<div>
	<div class="nudge-button-area">
		<div class="nudge-count">Sent : <span id="nudge_counter"><?php echo $nudge_sent_counter; ?></div>
		<div class="button-row">
			<button class=" custom-button custom-nudge-button codetrek-nudge-button" type="button" data-id="<?php echo $current_post_id; ?>">Send Nudge</button>
		</div>
	</div>	
</div>