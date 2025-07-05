<?php
session_start();
require_once '../includes/db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Mã hoá mật khẩu
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Kiểm tra email trùng
$check = $conn->query("SELECT * FROM users WHERE email = '$email'");
if ($check->num_rows > 0) {
    echo "Email đã tồn tại! <a href='register.php'>Thử lại</a>";
    exit;
}

// Thêm người dùng
$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed')";
if ($conn->query($sql) === TRUE) {
    // Lấy lại thông tin user vừa đăng ký
    $user_id = $conn->insert_id;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $name;
    $_SESSION['role'] = 'user';

    // Chuyển hướng về trang chính
    header("Location: ../index.php");
    exit;
} else {
    echo "Lỗi: " . $conn->error;
}
?>