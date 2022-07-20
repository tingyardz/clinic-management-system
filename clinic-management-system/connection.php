<?php

$serverName = "localhost";
$username = "root";
$password = "";

try{
    $connect = mysqli_connect($serverName,$username,$password);
}
catch(Exception $e){
    echo "Message Error: ".$e->getMessage();
}

?>