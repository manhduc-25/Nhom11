<?php
session_start();
require_once '../includes/db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    $sql = "SELECT * FROM admin_users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Sai tên đăng nhập hoặc mật khẩu";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
</head>
<body>
  <h2>Đăng nhập Admin</h2>
  <?php if ($error): ?>
    <p style="color:red"><?= $error ?></p>
  <?php endif; ?>
  <form method="POST">
    <label>Tên đăng nhập:</label><br>
    <input type="text" name="username"><br><br>
    <label>Mật khẩu:</label><br>
    <input type="password" name="password"><br><br>
    <button type="submit">Đăng nhập</button>
  </form>
</body>
</html>