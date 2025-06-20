<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_mangement";

// DB connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get task ID and update status
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "UPDATE add_task SET status='Completed' WHERE id=$id";
    $conn->query($sql);
}

// Redirect back to task list
header("Location: display.php"); // or your task list page
exit;
?>
