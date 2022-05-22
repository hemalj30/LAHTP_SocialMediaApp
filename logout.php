<?php

include 'Library/lib_auth.php';


$lg_user=$_COOKIE['username'];
$lg_usersession=$_COOKIE['user_session'];

if((isset($_COOKIE['username'])) && (isset($_COOKIE['user_session']))){

    logout($lg_user,$lg_usersession);
}


setcookie('username',' ',time()-60);
setcookie('user_session',' ',time()-60);
header("Location:index.php");


?>

