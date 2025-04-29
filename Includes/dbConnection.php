<?php
$hostname = "localhost";
$username = "root";
$password = "root";
$db_name = "hospital_db";
$dbconn = mysqli_connect($hostname,$username,$password,$db_name);
if(!$dbconn){
    die("Database connection failed.".mysqli_connect_error());
}
?>