<?php

include 'Library/lib_auth.php';

if(isset($_COOKIE['username']) && isset($_COOKIE['user_session'])){

  if(verify_session($_COOKIE['username'],$_COOKIE['user_session'])){

    header("Location: home.php");

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
    <title>Signin Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

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
        
    </style>



    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

  </head>
  
  <body class="text-center">
   
  <form class="form-signin" method="POST" action="auth.php">
    
  <img class="mb-4" src="Logo/fs.jpg" alt="" width="72" height="72">
  
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>


<?php  
      
  if((isset($_GET['signup_message']))&&(($_GET['signup_message'])==1))
  {
  
  echo('<div class="alert alert-success">Signup success !! You can SignIn now :)</div>');
  
  }
?>


<?php  
      
  if((isset($_GET['fail_login_message']))&&(($_GET['fail_login_message'])==1))
  {
  
  echo('<div class="alert alert-danger">Wrong Credentials !!!</div>');
  
  }
?>


<?php  
      
  if((isset($_GET['serv_message']))&&(($_GET['serv_message'])==1))
  {
  
  echo('<div class="alert alert-danger">Server Error :( Try again later :) </div>');
  
  }

?>


  
  <label for="username" class="sr-only">Username</label>
  <input type="text" name="user_name" id="username" class="form-control" placeholder="Username" required autofocus>
  
    <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
  
  <input type="hidden" id="auth" name="type" value="signin">
  
  
  <input class="checkbox mb-3" type="checkbox" value="1" name="remember"> Remember me for 7 Days
  
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
  
  <a href="signup.php"><button class="btn btn-lg btn-info btn-block" type="button">Sign Up</button></a>
  
  <p class="mt-5 mb-3 text-muted">&copy; 2017-<?php echo date('Y'); ?></p>
  
</form>
</body>
</html>
