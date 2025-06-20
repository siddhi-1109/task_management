<?php
$host = 'localhost';        // MySQL server (usually localhost)
$user = 'root';             // MySQL username (default in XAMPP)
$password = '';             // MySQL password (leave blank if none)
$database = 'task_mangement'; // Your database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Connection successful
// echo "Connected successfully";
?>
