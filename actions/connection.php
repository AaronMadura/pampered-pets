<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "pampered_pets";

$con = mysqli_connect($host,$user,$pass,$dbname);

if(!$con){
    echo('not connected');
}

?>