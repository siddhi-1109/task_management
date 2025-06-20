<!-- sidebar.php -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
  .sidebar {
    width: 220px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #1E293B;
    color: #fff;
    padding: 20px 0;
  }

  .sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
  }

  .sidebar a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 20px;
    color: #fff;
    text-decoration: none;
    transition: background 0.2s;
    font-size: 16px;
  }

  .sidebar a:hover {
    background-color: #334155;
  }

  .material-icons {
    font-size: 20px;
  }
</style>

<div class="sidebar">
  <h2>Task Manager</h2>
  <a href="dashboard.php"><span class="material-icons">dashboard</span> Dashboard</a>
  <a href="add_task.php"><span class="material-icons">add_circle</span> Add Task</a>
  <a href="display.php"><span class="material-icons">list</span> My Tasks</a>
  <a href="complete_task.php"><span class="material-icons">check_circle</span> Completed</a>
  <a href="logout.php"><span class="material-icons">logout</span> Logout</a>
</div>
