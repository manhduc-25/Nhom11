<?php
session_start();
require_once '../includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user['name']; // Lưu tên hoặc $user['id']
      header("Location: ../index.php"); // 👉 Về trang chủ sau đăng nhập
      exit;
    } else {
      $error = "❌ Mật khẩu không đúng.";
    }
  } else {
    $error = "❌ Email không tồn tại.";
  }
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Đăng nhập</title></head>
<body>
  <h2>🔐 Đăng nhập</h2>
  <?php if ($error): ?><p style="color:red"><?= $error ?></p><?php endif; ?>

  <form method="POST">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Mật khẩu:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Đăng nhập</button>
  </form>

  <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
</body>
</html>
