<?php

include 'Library/lib_auth.php';
include 'Library/user.php';
include 'Library/posts.php';


if((!(isset($_COOKIE['username']))&&(!(isset($_COOKIE['user_session']))))){

  header("Location: index.php");

}

if(isset($_COOKIE['username']) && isset($_COOKIE['user_session'])){

  if(!verify_session($_COOKIE['username'],$_COOKIE['user_session'])){

    header("Location: index.php");

  }

}


if(isset($_GET['post'])){
  if((isset($_FILES['post_image']))&&(isset($_POST['post_body']))&&(($_POST['post_body']!==''))){

    $directory_path="Images/";

    $file=pathinfo($_FILES['post_image']['name']);
    $file_type=$file['extension'];

    $file_path=$directory_path.($_FILES['post_image']['name']);

    if((strtolower($file_type)=="png") || (strtolower($file_type)=="jpeg") || (strtolower($file_type)=="jpg")){

      if(file_exists($file_path)){


        header("Location:home.php?exists");






      }
      else{

        if(move_uploaded_file($_FILES['post_image']['tmp_name'] , $file_path)){

          do_post($_COOKIE['username'],$_POST['post_body'],$file_path);


        }

      }






    }
    else{


      header("Location:home.php?type");




    }
    


  }
  else{


    header("Location: home.php?empty");
  }



}


?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Album example · Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      a.nav-link{

        color:white;
      }

      a.nav-link:hover{

        color:red;


      }



    </style>
    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
  </head>
  <body>
    <header>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>Album</strong>
      </a>
      
      <ul class="nav justify-content-end">
         <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Welcome <?php echo get_fullname();?></a>
         </li>
        <li class="nav-item">
         <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
      
    </div>
  </div>
</header>


<main role="main">

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">

        <form method="POST" action="home.php?post" enctype="multipart/form-data">

          <div class="mb-3">

          <?php
          
              if((isset($_GET['empty'])))
              {       
  
                 echo('<div class="alert alert-danger">Enter the text too !!</div>');
  
              }
      
             if((isset($_GET['exists'])))
              {       
      
                 echo('<div class="alert alert-danger">File already exists !!</div>');
      
              }

            if((isset($_GET['type'])))
              {       
      
                 echo('<div class="alert alert-danger">Only Images are allowed !!</div>');
      
              }


          ?>

            <p class="form-control"> What's on your mind ?</p>

            <textarea class="form-control" id="body" rows="3" name="post_body" required>
            
            </textarea>
          
          </div>

          <div class="mb-3">

            <input class="form-control" type="file" id="form" name="post_image" required>
          
          </div>

          <div class="mb-3">

            <input class="btn btn-primary" type="submit" value="post" style="width:100%;">
          
          </div>

        </form>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">

      <?php

      $postings=get_all_posts();

      foreach($postings as $singlepost){

        echo '<div class="col-md-4">';
        echo '<div class="card mb-4 shadow-sm">';

            echo '<img class="bd-placeholder-img card-img-top" src="'.$singlepost['image_path'].'" alt="Image not available" width="100%" height="225">';
            
            echo '<div class="card-body">';
              echo '<p class="card-text">'.$singlepost['body'].'</p>';
              echo '<div class="d-flex justify-content-between align-items-center">';
                echo '<div class="btn-group">';
                  echo '<button type="button" class="btn btn-sm btn-outline-secondary">View</button>';
                  echo '<button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>';
                echo '</div>';
                //echo '<small class="text-muted">9 mins</small>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      }

      ?>  


      </div>
    </div>
  </div>

</main>

<footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="#">Back to top</a>
    </p>
    <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
    <p>New to Bootstrap? <a href="https://getbootstrap.com/">Visit the homepage</a> or read our <a href="../getting-started/introduction/">getting started guide</a>.</p>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script></body>
</html>
