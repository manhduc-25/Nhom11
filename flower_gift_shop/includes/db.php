<?php
// ⚙️ Thông tin cấu hình MySQL
$servername = "localhost";     // máy chủ MySQL (localhost khi dùng XAMPP)
$username   = "root";          // tài khoản mặc định XAMPP
$password   = "";              // mật khẩu mặc định là rỗng
$database   = "flower_shop";   // tên CSDL bạn đã tạo (nếu khác: flower_gift_shop)

// 🌐 Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// ❗ Kiểm tra lỗi kết nối
if ($conn->connect_error) {
    die("❌ Kết nối CSDL thất bại: " . $conn->connect_error);
}

// ✅ Thiết lập UTF-8 để hỗ trợ tiếng Việt
$conn->set_charset("utf8");
?>
