<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['middle_name'] = $user['middle_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['family_name'] = $user['family_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role_id'] == 1 ? 'admin' : 'user';
        $_SESSION['image'] = $user['image'];

        if ($_SESSION['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: welcome.php");
        }
    } else {
        echo "Invalid email or password";
    }
    $stmt->close();
    $conn->close();
}
?>
