<?php
class UserModel {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=course_management", "root", "");
    }

    public function registerUser($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    public function loginUser($email, $password) {
        $stmt = $this->pdo->prepare("SELECT password, id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row && password_verify($password, $row['password']) ? $row['id'] : false;
    }

    public function getCourses() {
        $stmt = $this->pdo->prepare("SELECT id, course_name FROM courses");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectCourse($userId, $courseId) {
        $stmt = $this->pdo->prepare("INSERT INTO selected_courses (user_id, course_id) VALUES (?, ?)");
        return $stmt->execute([$userId, $courseId]);
    }

    public function changePassword($userId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        return $stmt->execute([$hashedPassword, $userId]);
    }
}
?>
