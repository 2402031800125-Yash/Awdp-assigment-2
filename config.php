<?php
$host = "mysql8001.site4now.net";
$user = "acf17f_mydb";
$pass = "Yash@2006";
$dbname = "db_acf17f_mydb";

// Using mysqli since this is now a proper MySQL database
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>