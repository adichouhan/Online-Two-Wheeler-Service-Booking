<?php

$server = "localhost";
$username="root";
$password="";
$db="tws";

// create connection

$conn = mysqli_connect($server,$username,$password,$db);

//check connection

if(!$conn){
    die("Connection Failed: ".mysqli_connect_error());
}



/*echo "CONNECTED SUCCESSFULLY";*/

?>