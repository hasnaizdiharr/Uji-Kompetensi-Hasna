<?php 
$server = "localhost"; // or "127.0.0.1"
$user = "root";
$password = "";
$nama_database = "admin";

// Establish the database connection
$db = mysqli_connect($server, $user, $password, $nama_database);

// Check the connection
if (!$db) {
    die("Failed to connect to database: " . mysqli_connect_error());
} 
?>
 
