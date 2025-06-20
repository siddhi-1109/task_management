<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_mangement";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch completed tasks
$sql = "SELECT id, title, description, due_date, priority FROM add_task WHERE LOWER(status) = 'completed'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Completed Tasks</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: #f1f5f9;
      margin: 0;
      padding: 0;
    }
    .main-content {
      margin-left: 220px;
      padding: 40px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px 16px;
      border: 1px solid #ccc;
      text-align: left;
    }
    th {
      background-color: #1976d2;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    h2 {
      color: #1976d2;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <?php require 'sidebar.php'; ?>
  <div class="main-content">
    <h2>Completed Tasks</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Due Date</th>
          <th>Priority</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['title']) ?></td>
              <td><?= htmlspecialchars($row['description']) ?></td>
              <td><?= $row['due_date'] ?></td>
              <td><?= $row['priority'] ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="5">No completed tasks found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
