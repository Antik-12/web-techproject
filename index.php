<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to the Course Management System</h1>
    <nav>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="select_course.php">Select Course</a>
            <a href="change_password.php">Change Password</a>
            <a href="logout.php">Logout</a>
        <?php endif; ?>
    </nav>
</body>
</html>
