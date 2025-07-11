<?php
session_start();
require_once '../includes/db.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["username"]);
  $email = trim($_POST["email"]);
  $password = $_POST["password"];
  $confirm = $_POST["confirm"];

  if ($password !== $confirm) {
    $error = "Mật khẩu xác nhận không khớp.";
  } else {
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $error = "Email đã được sử dụng.";
    } else {
      $hashed = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $name, $email, $hashed);

      if ($stmt->execute()) {
        header("Location: register.php?registered=1");
        exit;
      } else {
        $error = "Đăng ký thất bại: " . $stmt->error;
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Đăng ký</title>
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .register-container {
      max-width: 450px;
      margin: 60px auto;
      padding: 30px 35px;
      background-color: #EBEDE8;
      border-radius: 10px;
      box-shadow: 0 5px 20px #81b19b;
      font-family: Arial, sans-serif;
    }

    .register-container h2 {
      text-align: center;
      margin-bottom: 25px;
      font-size: 28px;
      color: #81b19b;
    }

    .register-container label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
      color: #444;
    }

    .register-container input {
      width: 100%;
      padding: 12px;
      margin-top: 6px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      transition: border-color 0.3s;
    }

    .register-container input:focus {
      border-color: #A50164;
      outline: none;
    }

    .register-container button {
      margin-top: 25px;
      width: 100%;
      padding: 12px;
      background-color: #81b19b;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      font-weight: bold;
      transition: background-color 0.3s;
      cursor: pointer;
    }

    .register-container button:hover {
      background-color: #333;
    }

    .register-container p {
      text-align: center;
      margin-top: 18px;
      font-size: 15px;
    }

    .register-container p a {
      color: #A50164;
      text-decoration: none;
      font-weight: 600;
    }

    .register-container p a:hover {
      text-decoration: underline;
    }

    .error,
    .success {
      text-align: center;
      margin-top: 10px;
      font-weight: bold;
      font-size: 15px;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <?php include '../includes/navbar.php'; ?>

  <div class="register-container">
    <h2>Đăng ký tài khoản</h2>

    <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>
    <?php if ($success): ?><div class="success"><?= $success ?></div><?php endif; ?>

    <form method="POST">
      <label for="name">Tên đăng nhập:</label>
      <input type="text" name="username" required>

      <label for="email">Email:</label>
      <input type="email" name="email" required>

      <label for="password">Mật khẩu:</label>
      <input type="password" name="password" required>

      <label for="confirm">Xác nhận mật khẩu:</label>
      <input type="password" name="confirm" required>

      <button type="submit">Đăng ký</button>
    </form>

    <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
  </div>

  <?php include '../includes/footer.php'; ?>
</body>

</html>
