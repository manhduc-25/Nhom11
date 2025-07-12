<?php
session_start();
require_once '../includes/db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = trim($_POST["username"]);
  $password = $_POST["password"];

  $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();
    if (password_verify($password, $admin['password'])) {
      $_SESSION['admin'] = $admin['username'];
      header("Location: dashboard.php");
      exit;
    } else {
      $error = "Mật khẩu không đúng.";
    }
  } else {
    $error = "Tài khoản không tồn tại.";
  }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Đăng nhập Admin</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=line_start_arrow_notch" />
  <style>
    body {
      background-color: #f0f2f5;
      font-family: Arial;
    }

    .login-box {
      width: 400px;
      margin: 100px auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 20px #81b19b;
      font-family: Arial, sans-serif;
    }

    .login-box .header {
      display: inline-flex;
      justify-items: center;
      align-items: center;
      gap: 46px;
    }

    .material-symbols-outlined {
      color: #81b19b;
      font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
    }

  h2 {
  text-align: center;
  margin-bottom: 20px;
  }

  input {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
  }

  button {
  width: 100%;
  padding: 10px;
  background: #000;
  color: white;
  border: none;
  border-radius: 5px;
  font-weight: bold;
  }

  button:hover {
  background: #374942ff;
  box-shadow: 1px 1px 20px #81b19b;
  }

  .error {
  color: red;
  text-align: center;
  }
  </style>
</head>

<body>

  <div class="login-box">
    <div class="header">
      <a href="../auth/login.php"><span class="material-symbols-outlined">line_start_arrow_notch</span></a>
          <h2>Đăng nhập cho Admin</h2>
    </div>
    <?php if ($error): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="username" placeholder="Tên đăng nhập" required>
      <input type="password" name="password" placeholder="Mật khẩu" required>
      <button type="submit">Đăng nhập</button>
    </form>
  </div>

</body>

</html>
