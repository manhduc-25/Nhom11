<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Đăng ký</title>
</head>
<body>
  <h2>Đăng ký</h2>
  <form action="register_process.php" method="POST">
    <input type="text" name="name" placeholder="Tên người dùng" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Mật khẩu" required><br>
    <button type="submit">Đăng ký</button>
  </form>
  <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
</body>
</html>