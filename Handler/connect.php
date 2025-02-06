<?php
$host = "localhost"; // Adjust if necessary
$username = "root"; // Default for XAMPP
$password = ""; // Leave empty if no password
$database = "crud_app"; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password);

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
    // Database created or already exists
    //echo "Database created successfully (or already exists).<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($database);

// Create the 'users' table if it doesn't exist
$table_sql = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    credit INT NOT NULL
)";
if ($conn->query($table_sql) === TRUE) {
    //echo "Table 'users' created successfully (or already exists).<br>";
} else {
    die("Error creating table: " . $conn->error);
}
?>
