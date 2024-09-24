<?php
session_start();
require 'model/UserModel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = new UserModel();
    $userId = $model->loginUser($_POST['email'], $_POST['password']);
    if ($userId) {
        $_SESSION['user_id'] = $userId;
        header("Location: index.php");
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
