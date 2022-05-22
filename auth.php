<?php

include 'library/lib_auth.php';


if(isset($_POST['type']))
{
    
    if($_POST['type']=='signin')
    {
     
        
        $Username = $_POST['user_name'];
        $Pass = $_POST['password'];

        if(isset($_POST['remember'])&&($_POST['remember']==1)){

            $Remember='1';
        }
        else{

            $Remember='0';


        }
        //$Pass=get_hash_pass($Pass);

        $result=login($Username,$Pass,$Remember);

        if($result=='login_success'){

            header("Location: home.php");

        }
        else if($result=='serv_error'){


            header("Location: index.php?serv_message=1");
        
        }
        else if($result=='login_fail'){


            header("Location: index.php?fail_login_message=1");
        }
        

        
        
    }

    else if($_POST['type']=='signup')
    {
        
            $Fullname = $_POST['full_name'];
            $Username = $_POST['user_name'];
            $Mob = $_POST['mob_num'];
            $Pass = $_POST['password'];
           // $Pass=get_hash_pass($Pass);
        
        
            $result= signup($Fullname,$Username,$Mob,$Pass);
        
            if($result=='insert_successful')
            {
            
                header("Location: verify.php?otp_username=".urlencode($Username));
            }
            else if($result=='insert_unsuccessful')
            {
                header("Location: signup.php?error=1&error_fn=".urlencode($Fullname)."&error_mob=".urlencode($Mob));
            }
        
    }

    else if($_POST['type']=='otp')
    {
        
        $otp_user=$_POST['user_name_otp'];
        $otp_user_otp=$_POST['user_otp'];

        $id_activation=verify_signup($otp_user,$otp_user_otp);

        if($id_activation=='activated'){

            header("Location: index.php?signup_message=1");
        }

    }
}

?>