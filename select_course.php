<?php
session_start();
require 'model/UserModel.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$model = new UserModel();
$courses = $model->getCourses();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_id'])) {
    $model->selectCourse($_SESSION['user_id'], $_POST['course_id']);
    $success = "Course selected successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Course</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Select Course</h2>
    <?php if (isset($success)): ?>
        <p style="color: green;"><?= $success ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <select name="course_id" required>
            <option value="">Select a course</option>
            <?php foreach ($courses as $course): ?>
                <option value="<?= $course['id'] ?>"><?= htmlspecialchars($course['course_name']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Select Course</button>
    </form>
</body>
</html>
