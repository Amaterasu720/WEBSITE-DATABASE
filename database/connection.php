<?php

$host="localhost";
$dbname="test";
$username="root";
$password="";


$mysqli = new mysqli( $host,  $username,$password,  $dbname);

if($mysqli->connect_errno){
    die("CONNECTION ERROR" . $mysqli->connect_error );
}

return $mysqli;