<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Task</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f4f6f8;
      display: flex;
    }

    .sidebar {
      width: 200px;
      background-color: #2c3e50;
      color: white;
      height: 100vh;
      padding: 20px 15px;
      position: fixed;
      top: 0;
      left: 0;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 20px;
    }

    .sidebar a {
      display: block;
      padding: 10px;
      color: white;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s;
    }

    .sidebar a:hover {
      background-color: #34495e;
      padding-left: 15px;
    }

    .main-content {
      margin-left: 200px;
      padding: 30px 20px;
      width: calc(100% - 200px);
    }

    .form-container {
      max-width: 700px;
      margin: 30px auto;
      background: #ffffff;
      padding: 20px 25px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #2c3e50;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: 500;
      margin-bottom: 6px;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }

    .form-group textarea {
      resize: vertical;
    }

    .form-group button {
      background-color: navy;
      color: white;
      padding: 10px;
      border: none;
      width: 100%;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .form-group button:hover {
      background-color: #001f4d;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .main-content {
        margin-left: 0;
        width: 100%;
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <?php include "sidebar.php"; ?>

  <div class="main-content">
    <div class="form-container">
      <h2>Add New Task</h2>
      <form action="save_task.php" method="POST">
        <div class="form-group">
          <label for="title">Task Title</label>
          <input type="text" id="title" name="title" required />
        </div>

        <div class="form-group">
          <label for="description">Task Description</label>
          <textarea id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="form-group">
          <label for="due_date">Due Date</label>
          <input type="date" id="due_date" name="due_date" required />
        </div>

        <div class="form-group">
          <label for="priority">Priority</label>
          <select id="priority" name="priority" required>
            <option value="">-- Select Priority --</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
          </select>
        </div>

        <div class="form-group">
          <button type="submit" name="add_task">Add Task</button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
