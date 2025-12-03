<?php
$mysqli = new mysqli("localhost","root","","gestions_des_coures");

if($mysqli -> connect_errno){
    echo "Failed to connect to MySQL : ". $mysqli->connect_error;
    exit();
}
?>