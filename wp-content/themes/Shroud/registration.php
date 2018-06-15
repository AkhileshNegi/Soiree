
<?php /* Template Name: registration */ ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo get_bloginfo('template_directory'); ?>/blog.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>


    <div class="blog-masthead">
            
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="../">Home</a>
          <a class="blog-nav-item" href="registration">Registration</a>
         <a class="blog-nav-item" href="status">Status</a>
        </nav>
      </div>
    </div>

<br>
<div class="container-fluid">
    <div class="row ">
      <div class="col-lg-3 text-left">
      </div>
      <div class="col-lg-6 text-left">
      
    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>"" method="POST">
                    <div class="form-group">
      <input type="hidden" name="action" value="save_form">

      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name"  placeholder="Enter Name ">

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email">
    </div>
    
    <div class="form-group">
      <label for="gender">Gender:</label><br>
      <input type="radio" name="gender" value="male" checked> Male&nbsp &nbsp &nbsp &nbsp
    
  <input type="radio" name="gender" value="female"> Female &nbsp &nbsp &nbsp &nbsp
    
  <input type="radio" name="gender" value="other"> Other  

      </div>
    <button type="submit" class="btn btn-success">Request Invitation</button>
 

      </div>
      <div class="col-lg-3 text-center">
      </div>
    </div>
 </div>
  </body>
</html>
