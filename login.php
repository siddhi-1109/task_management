<?php
require "DB_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $password = $_POST['password'];

    if (empty($name) || empty($password)) {
        echo "<script>alert('Both fields are required.'); window.history.back();</script>";
        exit;
    }

    $query = "SELECT id, name, password FROM users WHERE name = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);  // DEBUG HELP
    }

    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $fetched_name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $fetched_name;

            echo "<script>alert('Login successful. Welcome, " . htmlspecialchars($fetched_name) . "!'); window.location.href='dashboard.php';</script>";
            exit;
        } else {
            echo "<script>alert('Invalid password.'); window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('No user found with this name.'); window.history.back();</script>";
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Task Manager</title>
  <link rel="stylesheet" href="login.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

  <div class="login-container">
    <form class="login-form" action="" method="POST">
      <h2>Task Manager Login</h2>

      <label for="name">Name</label>
      <input type="text" id="name" name="name" placeholder="Enter name" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter password" required>

      <button type="submit">Login</button>

      <p class="register-link">Don't have an account? <a href="register.php">Register</a></p>
    </form>
  </div>

</body>
</html>
