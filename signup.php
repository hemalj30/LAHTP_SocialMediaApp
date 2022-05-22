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
    <title>Signup</title>

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
    
  <img class="mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  
  <h1 class="h3 mb-3 font-weight-normal">Welcome ! Sign up ;) </h1>


<?php  
      
  if((isset($_GET['error']))&&(($_GET['error']==1)))
  {
  
  echo('<div class="alert alert-danger">Enter the credentials properly !!</div>');
  
  }
      
      
?>

<?php  
      
  if((isset($_GET['otp_error']))&&(($_GET['otp_error']==1)))
  {
  
  echo('<div class="alert alert-danger">Username incorrect !! Please signup again :) </div>');
  
  }
      
      
?>


 
  <label for="fullname" class="sr-only">Full Name</label>
  
  <input type="text" name="full_name" id="fullname" class="form-control" placeholder="Full Name" required autofocus value=<?php echo isset($_GET['error_fn']) ? $_GET['error_fn'] : " "; ?>>
  
  <label for="username" class="sr-only">Username</label>
  
  <input type="text" name="user_name" id="username" class="form-control" placeholder="Username" required autofocus>
  
  <label for="mobile" class="sr-only">Mobile Number</label>
  
  <input type="phone" name="mob_num" id="mobile" class="form-control" placeholder="Mobile"  required autofocus value=<?php echo isset($_GET['error_mob']) ? $_GET['error_mob'] : " "; ?>>
  
  <label for="inputPassword" class="sr-only">Password</label>
  
  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required autofocus>
  
  
  <input type="hidden" id="auth" name="type" value="signup">
  
  <!--<div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>-->
  
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
  
  <p class="mt-5 mb-3 text-muted">&copy; 2017-<?php echo date('Y'); ?></p>
  
</form>
</body>
</html>
