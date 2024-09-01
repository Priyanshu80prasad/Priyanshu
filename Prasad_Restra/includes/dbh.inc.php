<?php
$servername = "localhost";
$dbUsername = "root";
$dbPassword = ""; // Default XAMPP password
$dbName = "restaurant_reservation"; // Change this to your correct database name

// Create connection
$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
