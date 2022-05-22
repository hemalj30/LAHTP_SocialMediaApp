<?php

$DB_Conn=NULL;
$DB_Servername = "localhost";
$DB_Username = "devil";
$DB_Password = "hemalchg";
$DB_name = "lahtp";
$SALT="jdhjxabjgaxdjjdidk";

function get_db_connection()
{   
    
    global $DB_Conn;
    global $DB_Servername;
    global $DB_Username;
    global $DB_Password;
    global $DB_name;

    if($DB_Conn)
    {
        
        return $DB_Conn;
    }
    else
    {
        
        $DB_Conn = mysqli_connect($DB_Servername, $DB_Username, $DB_Password, $DB_name);
        
        if(!$DB_Conn)
        {
            //echo mysqli_connect_error();
            die("Connection failed ".mysqli_connect_error());
            
            
        }
        else
        {
            return $DB_Conn;
        }
    }
    
        
    
    
}




function login($login_username,$login_password,$login_remember)
{
    
    $query="SELECT * FROM users WHERE username = '$login_username' AND password='$login_password';";
    
    
    $connection = get_db_connection();
    
    $result = mysqli_query($connection,$query);
    
    $num = mysqli_num_rows($result);
    
    if($num==1)
    {
        global $SALT;

        $session_final=strrev($login_password.$SALT);

        if($login_remember=='1'){

            $query="INSERT INTO ssession(user,user_session,remember,is_valid) VALUES ('$login_username','$session_final','1','1');";
        }
        else{

            $query="INSERT INTO ssession(user,user_session,remember,is_valid) VALUES ('$login_username','$session_final','0','1');";



        }
        $session_result=mysqli_query($connection,$query);

        if($session_result){

            if($login_remember=='1'){

                setcookie('username',$login_username,(time()+(7*24*60*60)));
                setcookie('user_session',$session_final,(time()+(7*24*60*60)));

            }
            else{


                setcookie('username',$login_username);
                setcookie('user_session',$session_final);
            }
            return 'login_success';
        }
        else{

            return 'serv_error';
        }
    }
    else{

        return 'login_fail';
    }
}




function signup($fullname,$sg_username,$mobile,$sg_password)
{
    
    //$final_password=get_hash_pass($password);
    $connection=get_db_connection();
    
    $otp=rand(100000,999999);
    
    $query="INSERT INTO users(username,password,fullname,mobile,is_admin,otp) VALUES ('$sg_username','$sg_password','$fullname','$mobile','0','$otp');";
    
    $result= mysqli_query($connection,$query);
    
    if($result)
    {
        
        return 'insert_successful';
        
        
    }
    else
    {
        
        return 'insert_unsuccessful';
        
        
    }
    
    
    
    
}



function verify_signup($verify_otp_username,$verify_otp)
{

    $verify_connection=get_db_connection();

    $verify_query="SELECT * FROM users WHERE username ='$verify_otp_username';";

    $row=mysqli_query($verify_connection,$verify_query);
    //mysqli_close($verify_connection);

    if(mysqli_num_rows($row)==1)
    {

        $arr=mysqli_fetch_assoc($row);

        if($verify_otp==$arr['otp']){


            //Signup success
            $activation=activate_user($arr['id']);
            if($activation){

                return 'activated';
            }
            else{

                header("Location: verify.php?activation_error=1&otp_username=".urlencode($verify_otp_username));
            }




        }
        else{

            header("Location: verify.php?verification_error=1&otp_username=".urlencode($verify_otp_username));


        }


    }
    else
    {

        header("Location: signup.php?otp_error=1");



    }


}


/*function get_hash_pass($hash_pass){

    global $SALT;


    return md5($hash_pass).$SALT;
}*/


function activate_user($id)
{
    $query="UPDATE users SET is_verified = '1' WHERE (id = '$id') ;";
    $connection = get_db_connection();
    
    $result=mysqli_query($connection,$query);
    
    if($result==1)
    {
        
        
        return 'activated';
        
    }
    
    
    
}



function verify_session($verify_session_username,$verify_session_token){

    $verify_session_query="SELECT * FROM ssession WHERE user='$verify_session_username' AND user_session='$verify_session_token';";
    $verify_session_connection=get_db_connection();

    $verify_session_result = mysqli_query($verify_session_connection,$verify_session_query);
    
    $session_num = mysqli_num_rows($verify_session_result);

    if($session_num==1){

        $row=mysqli_fetch_assoc($verify_session_result);

        if($row['is_valid']==1){

            $session_time=strtotime($row['created_on']);

            if($row['remember']==1){

                if(time()<$session_time+(7*24*60*60)){

                    return true;


                }
                else{

                    return false;
                }


            }
            else{

                if(time()<$session_time+(1*24*60*60)){

                    return true;

                }
                else{


                    return false;
                }


            }


        }


    }
}

function logout($logout_username,$logout_session){

    $logout_query="DELETE FROM ssession WHERE user='$logout_username';";

    $logout_connection=get_db_connection();

    $result= mysqli_query($logout_connection,$logout_query);

    return 1;




}


function is_loggedin(){



    if((isset($_COOKIE['username']))&&(isset($_COOKIE['user_session']))){


        if(!(verify_session($_COOKIE['username'],$_COOKIE['user_session']))){

            return false;



        }
        else{

            return true;
        }



    }
    else{


        return false;
    }

}





?>

