
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>OTP_Verification</title>

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
  
  <h1 class="h3 mb-3 font-weight-normal">OTP Verification </h1>


<?php  
      
  if((isset($_GET['verification_error']))&&(($_GET['verification_error']==1)))
  {
  
  echo('<div class="alert alert-danger">Enter the correct OTP !!</div>');
  
  }
      
      
?>


<?php  
      
  if((isset($_GET['activation_error']))&&(($_GET['activation_error']==1)))
  {
  
  echo('<div class="alert alert-danger">Authentication Failed :( Try later !!</div>');
  
  }
      
      
?>


 
 <label for="username" class="sr-only">Username</label>
 <input type="text" name="user_name_otp" id="username" class="form-control" placeholder="Username" required autofocus value="<?php echo isset($_GET['otp_username'])?$_GET['otp_username']:" "; ?>">

 
 
  <label for="otp" class="sr-only">OTP</label>
  <input type="text" name="user_otp" id="otp" class="form-control" placeholder="OTP" required autofocus>  
  
  <input type="hidden" id="auth" name="type" value="otp">
  
  <!--<div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>-->
  
  <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
  
  <p class="mt-5 mb-3 text-muted">&copy; 2017-<?php echo date('Y'); ?></p>
  
</form>
</body>
</html>
