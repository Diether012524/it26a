<?php
$servername = "localhost";
$username = "root";
$password = ""; // XAMPP default password is empty
$database = "signupforms"; // Change to your actual database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Optional success message for testing only (you can remove later)
echo "";
?>
