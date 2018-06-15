<?php /* Template Name: status */ ?>
<!DOCTYPE html>
<html>
<head>
	<title>Status</title>
</head>
<body>
<h1>status checked</h1>
<?php
   $args = array(
   	  'post_type' => 'guest',
      'post_status' => 'publish',
      'meta_key' =>'guest_status',
      'meta_value' =>'accepted',
   );
   $guest_details = new WP_Query($args);
  //var_dump($guest_details);
  if($guest_details->have_posts()) : 
      while($guest_details->have_posts()) : 
         $guest_details->the_post();
?>

         <h1><?php the_title() ?></h1>
         <div class='post-content'><?php the_content() ?></div>      

<?php
      endwhile;
   else: 
?>

      Oops, there are no posts.

<?php
   endif;
?>
</body>
</html>