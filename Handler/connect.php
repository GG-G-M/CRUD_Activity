<?php
$host = "localhost"; 
$username = "root";
$password = ""; 
$database = "crud_app"; 

$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {}
else {
    die("Error creating database: " . $conn->error);
}
$conn->select_db($database);

$table_sql = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    credit INT NOT NULL
)";
if ($conn->query($table_sql) === TRUE) {
} else {
    die("Error creating table: " . $conn->error);
}
?>
