<?php
$host = "localhost"; // Adjust if necessary
$username = "root"; // Default for XAMPP
$password = ""; // Leave empty if no password
$database = "crud_app"; // Your database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
