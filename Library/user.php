<?php

function get_fullname(){

    if(is_loggedin()){

        $name=$_COOKIE['username'];

        $fullname_query="SELECT * FROM users WHERE username='$name';";

        $fullname_conn=get_db_connection();

        $fullname_result=mysqli_query($fullname_conn,$fullname_query);
        
        if((mysqli_num_rows($fullname_result)==1)){

            $fullname=mysqli_fetch_assoc($fullname_result);

            return $fullname['username'];



        }
        else{


            return null;
        }

    }
}


?>