<?php
	$session_args = array(
		'post_type' => 'codetrek_session',
		'posts_per_page' => -1,
	);
	$currentdate=date('Y-m-d');
	query_posts($session_args);
	if (have_posts()) :
		while (have_posts()) :
			the_post();
			$start_date = get_field('start_date');
			$session = array (
				'title'         =>  get_the_title(),
				'start_date'    =>  $start_date,
				'ID'			=>	get_the_ID(),
			);
			if ($start_date > $currentdate) :
				$upcoming_sessions[] = $session;
			endif;
		endwhile;
	endif;
?>
<div class="codetrek-widget">
	<p>Latest happenings at CodeTrek </p>
	<div class="codetrek-responses">
		<div class="all-responses">
			<p><b>All : <?php echo wp_count_posts('codetrek_data')->publish; ?></b></p>
			<div><a class="widget-review-button " href="#">Review answers</a>&nbsp;&nbsp;&nbsp;
			<a class="widget-reviewed-button " href="#">View reviewed answers</a></div>
		</div>
		<?php if (isset($upcoming_sessions)) : ?>
		<div class="session-responses">
			<?php foreach ($upcoming_sessions as $upcoming) : 
				$count_args = array (
					'post_type'	=> 'codetrek_data',
					'meta_key'	=> 'session_id',
					'meta_value'=> $upcoming['ID'],
				);
				$count_query = new WP_Query($count_args);
			?>
			<hr>
			<p><b><?php echo $upcoming['title'].' : '.$count_query->found_posts; ?></b></p>
			<div><a class="widget-review-button " href="#" data-session_id="<?php echo $upcoming['ID']; ?>">Review answers</a>&nbsp;&nbsp;&nbsp;
			<a class="widget-reviewed-button " href="#" data-session_id="<?php echo $upcoming['ID']; ?>">View reviewed answers</a></div>
		</div>
		<?php 
				endforeach;
			endif;
		?>
	</div>

	<?php 
		require('dashboard-response-modal.php');
	?>
</div>