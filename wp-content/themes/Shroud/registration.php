
<?php /* Template Name: registration */ ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Invite Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/css/bootstrap.min.css">
  </head>
  <body>
  
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Soiree</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
    </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>
  
<br>
<div class="container-fluid">
    <div class="row ">
      <div class="col-lg-3 text-center">
      </div>
      <div class="col-lg-6 text-left">
      
    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>"" method="POST">
                    <div class="form-group">
      <input type="hidden" name="action" value="save_form">

      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name"  placeholder="Enter Name ">
    </div>
      <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control"  name="password" placeholder="Enter password">
    </div>
    
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email">
    </div>
    
    <div class="form-group">
      <label for="phone">Number:</label>
      <input type="number" class="form-control"  name="phone" placeholder="Enter phone number">
    </div>
    <div class="form-group">
      <label for="city">City:</label>
      <input type="text" class="form-control"  name="city" placeholder="Enter City">
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
