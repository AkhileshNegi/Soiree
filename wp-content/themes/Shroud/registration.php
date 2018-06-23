<?php /* Template Name: registration */ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Registration</title>

        <link href="<?php echo get_bloginfo('template_directory'); ?>/css/bootstrap.min.css" rel="stylesheet">

        <link href="<?php echo get_bloginfo('template_directory'); ?>/blog.css" rel="stylesheet">
       <?php echo wp_head(); ?>
    </head>
  <body>
    <div class="blog-masthead">       
        <div class="container ">
          <nav class="blog-nav">
          <a class="blog-nav-item " href="../">Home</a>
          <a class="blog-nav-item active" href="registration">Registration</a>
          <a class="blog-nav-item " href="status">Status</a>
          </nav>
        </div>
    </div> <br>
    <div  class="container king">
      <div id= "box" class="row ">
          <div class="col-lg-6 text-left">
                    
                  <form action="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>"" method="POST" id="registration_form">

                  <div class="form-group">
                  <input type="hidden" name="action" value="save_form">
                  <label for="name">Name:</label>
                  <input type="text" class="form-control" name="name"  placeholder="Enter Name " required>
                  </div>

                  <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                  </div>

                  <div class="form-group">
                  <label for="gender">Gender:</label><br>
                  <input type="radio" name="gender" value="male" required> Male&nbsp &nbsp &nbsp &nbsp
                  <input type="radio" name="gender" value="female"> Female &nbsp &nbsp &nbsp &nbsp
                  <input type="radio" name="gender" value="other"> Other  
                  </div>

                  <button type="button" class="btn btn-success" id="soiree_request">Request</button>
                  
                 </div>
                  </form>
            
      </div></div></div></body>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      
          <?php wp_footer(); ?>
  </body>
</html>
