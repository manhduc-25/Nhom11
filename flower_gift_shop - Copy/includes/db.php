<?php
$servername = "localhost";     // máy chủ MySQL
$username = "root";            // mặc định XAMPP là root
$password = "";                // mặc định không có mật khẩu
$database = "flower_shop";     // tên CSDL bạn đã tạo

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>