<?php
session_start();
require_once '../includes/db.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Tìm người dùng theo email
$result = $conn->query("SELECT * FROM users WHERE email = '$email'");
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        header("Location: ../index.php");
        exit;
    } else {
        echo "Sai mật khẩu! <a href='login.php'>Thử lại</a>";
    }
} else {
    echo "Email không tồn tại! <a href='login.php'>Thử lại</a>";
}
?>