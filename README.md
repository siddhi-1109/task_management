# 📝 Task Management System

A simple PHP-based Task Management System that allows users to register, log in, add tasks, mark them as complete, and manage their personal to-do list.

---

## 📌 Features

- User registration and login system  
- Add new tasks  
- View and manage tasks from a dashboard  
- Mark tasks as completed  
- Logout functionality  
- Responsive and styled UI using CSS

---

## 🛠️ Tech Stack

- **Frontend:** HTML, CSS  
- **Backend:** PHP  
- **Database:** MySQL

---

## 🚀 How to Run the Project

1. Copy the project to your `C:/xampp/htdocs/Task_management/` folder.
2. Create a MySQL database named `task_mangement`.
3. Import the SQL file if provided.
4. Update `DB_connection.php` with:

   ```php
   $conn = mysqli_connect("localhost", "root", "", "task_mangement");
