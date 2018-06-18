<?php/* Template Name: Thankyou */?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Status</title>
    <link href="<?php echo get_bloginfo('template_directory'); ?>/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo get_bloginfo('template_directory'); ?>/blog.css" rel="stylesheet">

  <style>
  .blue {
      color: green;
    }
  div.gallery {
      margin: 5px;
      border: 1px solid #ccc;
      float: left;
      width: 180px;
  }

  div.gallery:hover {
      border: 1px solid #777;
  }

  div.gallery img {
      width: 100%;
      height: auto;
  }

  div.desc {
  padding: 15px;
  text-align: center;
  }
  </style>
</head>

<body>


  <div class="blog-masthead">   
    <div class="container">
      <nav class="blog-nav">
      <a class="blog-nav-item " href="../">Home</a>
      <a class="blog-nav-item " href="registration">Registration</a>
      <a class="blog-nav-item" href="status">Status</a>
      </nav>
    </div>
  </div>

    <div class="container">
    <div class="blog-header">
    <h4 class="blog-title"><font face="Gloucester MT">Soiree</font></h4>
    <p class="lead blog-description"><h2><font face="Freestyle Script">A monthly party organised by ColoredCow.</font></h2></p>
    </div>
    <div class="row">
      <div class="col-sm-8 blog-main">
              <div class="blog-post">
                <h4 class="blog-title"><font face="Gloucester MT" color="green">  Thank you for the registration</font>
                </h4> 
           
               </div><br/>
        
                <div class="blog-post">
                    <h2 class="blog-title">Highlights</h2>
                    <p class="blog-post-meta">May 5, 2018</p>



                  <div class="gallery">
                <a target="_blank" href="Cheers!.jpg">
                <img src="<?php echo get_bloginfo('template_directory'); ?>/img/drnk.jpg" alt="Cheers!" width="300" height="200">
              </a>
                  <div class="desc">Cheers
                  </div>
            </div>

            <div class="gallery">
              <a target="_blank" href="dance.jpg">
            <img src="<?php echo get_bloginfo('template_directory'); ?>/img/dance.jpg" alt="Disco" width="300" height="200">
            </a>
              <div class="desc">Dance</div>
            </div>

            <div class="gallery">
              <a target="_blank" href="songs.jpg">
              <img src="<?php echo get_bloginfo('template_directory'); ?>/img/songs.jpg" alt="Melody" width=300" height="200">
              </a>
              <div class="desc">Music
              </div>
            </div>
        </div><!-- /.blog-post -->
    </div><!-- /.blog-main -->
          <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
              <div class="sidebar-module sidebar-module-inset">
                <h4>About Colored Cow</h4>
                <p>ColoredCow is a problem solving company; we solve business problems through technology. We center the solutions around our clients and the people their business affects. Our software products and services grow business when we make connection at the heart by making empathy the main element. We believe in providing long lasting solutions that we can share as success stories. A colored cow would always stand out from the crowd; we do justice to our name by reflecting the same in our thoughts and in the way we work.</p>
            </div>
          </div><!-- /.blog-sidebar -->
      </div><!-- /.row -->
  </div><!-- /.container -->
    <footer class="blog-footer">
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
  </script>
</body>
</html>