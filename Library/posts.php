<?php

//include 'lib_auth.php';


function do_post($post_username, $post_body, $post_image_path){

    $post_query="INSERT INTO posts(username,image_path,body) VALUES ('$post_username','$post_image_path','$post_body');";

    $post_conn=get_db_connection();

    if(mysqli_query($post_conn,$post_query)){

        $post_id=mysqli_insert_id($post_conn);

        return $post_id;



    }
    else{


        return NULL;
    }



}


function get_all_posts(){

    $query_getposts="SELECT * FROM posts;";

    $getposts_conn=get_db_connection();

    $allposts=mysqli_query($getposts_conn,$query_getposts);

    if(mysqli_num_rows($allposts)>0){

        $posts=[];

        while($row=mysqli_fetch_assoc($allposts)){

            $posts[]=$row;



        }
        return $posts;


    }
    else{


        return [];
    }






}

?>