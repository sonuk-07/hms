<?php
$hostname = "localhost";
$username = "root";
$password = "root";
$db_name = "hospital_db";

// Connect to the database
$dbconn = mysqli_connect($hostname, $username, $password, $db_name);

// Check connection
if (!$dbconn) {
    die("Database connection failed. " . mysqli_connect_error());
}

// // Set PHP timezone
// date_default_timezone_set('Asia/Kathmandu');

// // Set MySQL session timezone
// mysqli_query($dbconn, "SET time_zone = '+05:45'");
?>
