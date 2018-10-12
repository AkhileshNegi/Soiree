
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Soiree</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo get_bloginfo('template_directory'); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo get_bloginfo('template_directory'); ?>/blog.css" rel="stylesheet">
  <style>
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
          <a class="blog-nav-item active" href="">Home</a>
          <a class="blog-nav-item" href="registration">Registration</a>
         <a class="blog-nav-item" href="status">Status</a>
        </nav>
      </div>
    </div>
    <div class="container">
      <div class="blog-header">
        <h1 class="blog-title">Lake Fest</h1>
        <p class="lead blog-description">A yearly party organised by Locals.</p>
      </div>
      <div class="row">
        <div class="col-sm-8 blog-main">
          <div class="blog-post">
            <h2 class="blog-post-title">Last Party</h2>
            <p class="blog-post-meta">May 5, 2018 </p>
<div class="container">
  <img src="<?php echo get_bloginfo('template_directory'); ?>/img/pt2.jpg" class="img-responsive" alt="Cinque Terre" width="540" height="540"> 
</div>
</div><br/>
          <div class="blog-post">
            <h2 class="blog-post-title">Highlights</h2>
            <p class="blog-post-meta">May 5, 2018</p>
            <div class="gallery">
  <a target="_blank" href="Cheers!.jpg">
    <img src="<?php echo get_bloginfo('template_directory'); ?>/img/drnk.jpg" alt="Cheers!" width="300" height="200">
  </a>
  <div class="desc">Cheers</div>
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
  <div class="desc">Music</div>
</div>
          </div>
        </div>
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About Lake Fest </h4>
            <p>Lakefest is a fairly new festival, which began as a music and cider festival, yet in its second year has booked big UK bands propelling it to the status of a full blown music festival.Lakesfest grew out from when Croft Farm Waterpark hosted its music and cider festival on 9th April 2011[1] It was attended by just over 1,500 people consuming 8,500 pints of cider. Bands including The Stages of Dan, The Roving Crows and The Wurzels starred. Classic West Country games like Welly Wanging and skittles were available to play with a prizes up for grabs. The feedback was so positive that planning went immediately into "Lakefest".</p>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><i class="fa fa-github fa-lg"></i><a href="#"> GitHub</a></li>
              <li><i class="fa fa-twitter fa-lg"></i><a href="#"> Twitter</a></li>
              <li><i class="fa fa-facebook fa-lg"></i><a href="#">  Facebook</a></li>
            </ol>
          </div>
        </div>
      </div> </div>
    <footer class="blog-footer">
    </footer>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
