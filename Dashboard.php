<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// DB Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_mangement";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize counters
$total_tasks = 0;
$pending = 0;
$in_progress = 0;
$completed = 0;

// Fetch task counts
$sql = "SELECT status, COUNT(*) as count FROM add_task GROUP BY status";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $status = strtolower($row['status']);
    $count = $row['count'];
    $total_tasks += $count;

    if ($status == 'pending') {
        $pending = $count;
    } elseif ($status == 'in progress') {
        $in_progress = $count;
    } elseif ($status == 'completed') {
        $completed = $count;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Task Management Dashboard</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .footer {
      background-color: #2c3e50;
      color: white;
      text-align: center;
      padding: 10px 0;
      position: relative;
      bottom: 0;
      width: 100%;
      font-family: 'Roboto', sans-serif;
    }
    :root {
      --primary-color: #1976d2;
      --text-primary: #212121;
      --text-secondary: #616161;
      --card-bg: rgba(255 255 255 / 0.6);
      --card-bg-hover: rgba(255 255 255 / 0.9);
      --card-shadow: 0 8px 32px rgba(25, 118, 210, 0.12);
      --font-family: 'Roboto', sans-serif;
    }
    *, *::before, *::after {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: var(--font-family);
      background: linear-gradient(135deg, #e3f2fd, #bbdefb);
      color: var(--text-primary);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .main-content {
      flex: 1;
      padding: 48px 16px;
    }
    .header {
      margin-bottom: 32px;
    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: var(--primary-color);
      padding: 16px;
      border-radius: 8px;
      color: white;
    }
    .navbar h1 {
      margin: 0;
      font-size: 1.5rem;
    }
    .navbar .logout-button {
      background-color: #e53935;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 8px 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .navbar .logout-button:hover {
      background-color: #c62828;
    }
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 32px;
      max-width: 960px;
      width: 100%;
      margin: 0 auto;
    }
    .card {
      background: var(--card-bg);
      border-radius: 24px;
      padding: 40px 32px;
      box-shadow: var(--card-shadow);
      backdrop-filter: blur(14px) saturate(180%);
      -webkit-backdrop-filter: blur(14px) saturate(180%);
      color: var(--text-primary);
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      transition: background-color 0.4s ease, transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.4s ease;
      cursor: default;
    }
    .card:focus-within,
    .card:hover {
      background: var(--card-bg-hover);
      box-shadow: 0 16px 48px rgba(25, 118, 210, 0.26);
      transform: translateY(-6px);
      outline: none;
    }
    .card h3 {
      font-weight: 700;
      font-size: 1.375rem;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      color: var(--primary-color);
      user-select: none;
    }
    .material-icons {
      font-size: 28px;
      color: var(--primary-color);
    }
    .card p {
      font-weight: 800;
      font-size: 3.5rem;
      margin: 0;
      color: var(--text-secondary);
      letter-spacing: 2px;
      user-select: text;
    }
    .chart-box {
      width: 400px;
      margin: 40px auto;
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    @media (max-width: 480px) {
      .cards {
        grid-template-columns: 1fr;
        gap: 24px;
        max-width: 100%;
      }
      .card {
        padding: 32px 24px;
      }
      .card p {
        font-size: 2.75rem;
      }
    }
  </style>
</head>
<body>
  <?php require "sidebar.php"; ?>
  <div class="main-content">
    <div class="navbar">
      <h1>TASK MANAGEMENT DASHBOARD</h1>
      <form action="logout.php" method="post">
        <button type="submit" class="logout-button">Logout</button>
      </form>
    </div>
    <div class="header">
      <div class="user">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></div>
    </div>

    <div class="cards" role="region" aria-label="Task summary cards">
      <div class="card" tabindex="0">
        <h3><span class="material-icons" aria-hidden="true">assignment</span> Total Tasks</h3>
        <p><?php echo $total_tasks; ?></p>
      </div>
      <div class="card" tabindex="0">
        <h3><span class="material-icons" aria-hidden="true">hourglass_empty</span> Pending</h3>
        <p><?php echo $pending; ?></p>
      </div>
      <div class="card" tabindex="0">
        <h3><span class="material-icons" aria-hidden="true">autorenew</span> In Progress</h3>
        <p><?php echo $in_progress; ?></p>
      </div>
      <div class="card" tabindex="0">
        <h3><span class="material-icons" aria-hidden="true">check_circle</span> Completed</h3>
        <p><?php echo $completed; ?></p>
      </div>
    </div>

    <!-- Doughnut Chart -->
    <div class="chart-box">
      <canvas id="statusChart"></canvas>
    </div>

    <script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'In Progress', 'Completed'],
            datasets: [{
                data: [<?= $pending ?>, <?= $in_progress ?>, <?= $completed ?>],
                backgroundColor: ['#f59e0b', '#3b82f6', '#10b981'],
                borderColor: ['#d97706', '#2563eb', '#059669'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Task Status Overview'
                }
            }
        }
    });
    </script>

    <div class="footer">
      &copy; <?php echo date("Y"); ?> Siddhi Humbarkar| All Rights Reserved.
    </div>
  </div>
</body>
</html>
