<?php
// DB Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_mangement";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch tasks
$sql = "SELECT * FROM add_task";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Task List</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f9;
      margin: 20px;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    table {
      width: 90%;
      margin: auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 12px 16px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #4F46E5;
      color: white;
      text-transform: uppercase;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #eef;
    }

    .completed {
      background-color: #d1fae5 !important;
    }

    .action-link {
      color: #2563EB;
      text-decoration: none;
      font-weight: bold;
    }
    .action-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<h2>Task List</h2>

<table>
  <tr>
    <th>Title</th>
    <th>Description</th>
    <th>Due Date</th>
    <th>Priority</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  <?php
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $status = $row['status'];
          $isCompleted = strtolower($status) === 'completed';
          echo "<tr class='" . ($isCompleted ? "completed" : "") . "'>
                  <td>" . htmlspecialchars($row['title']) . "</td>
                  <td>" . htmlspecialchars($row['description']) . "</td>
                  <td>" . $row['due_date'] . "</td>
                  <td>" . $row['priority'] . "</td>
                  <td>" . $status . "</td>
                  <td>";
          if (!$isCompleted) {
              echo "<a class='action-link' href='mark_complete.php?id={$row['id']}'>Mark as Completed</a>";
          } else {
              echo "<span style='color: green;'>✔ Done</span>";
          }
          echo "</td></tr>";
      }
  } else {
      echo "<tr><td colspan='6' style='text-align:center;'>No tasks found</td></tr>";
  }

  $conn->close();
  ?>
</table>

</body>
</html>
