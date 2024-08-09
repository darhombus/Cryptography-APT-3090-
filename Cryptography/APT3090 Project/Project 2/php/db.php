
<?php
$servername = "sql101.infinityfree.com";
$username = "if0_37004071";  // Default XAMPP username
$password = "E7ZAjxTszlXYFTV";      // Default XAMPP password is empty
$dbname = "if0_37004071_finalprojectdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>