<?php
session_start();
require 'DB_connection.php'; // Make sure this file sets up $conn

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_task'])) {
    $title       = $_POST['title'];
    $description = $_POST['description'];
    $due_date    = $_POST['due_date'];
    $priority    = $_POST['priority'];

    // Basic validation
    if (empty($title) || empty($description) || empty($due_date) || empty($priority)) {
        echo "<script>alert('Please fill in all fields.'); window.location.href='add_task.php';</script>";
        exit;
    }

    // Insert into database
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO add_task (user_id, title, description, due_date, priority) 
            VALUES ('$user_id', '$title', '$description', '$due_date', '$priority')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Task added successfully.'); window.location.href='Dashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='add_task.php';</script>";
    }

    $conn->close();
} else {
    header("Location: Dashboard.php");
    exit;
}
?>
