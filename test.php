<?php

//include 'Library/posts.php';

//do_post("hello","hello","hello");


print_r($_FILES);

echo "<br>";

$path="abc.txt";

print_r(pathinfo($path));

echo "<br>";

/*echo gettype($path);

echo "<br>";

echo gettype(pathinfo($path));

echo "<br>";*/

echo basename($path);

echo "<br>";

echo basename($path,".txt");


?>