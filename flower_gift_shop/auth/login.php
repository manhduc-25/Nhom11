<?php
session_start();
require_once '../includes/db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST["email"]);
  $password = $_POST["password"];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user['username'];
      header("Location: ../index.php");
      exit;
    } else {
      $error = "Mật khẩu không đúng";
    }
  } else {
    $error = "Email không tồn tại";
  }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .login-form {
      max-width: 450px;
      margin: 60px auto;
      padding: 30px 35px;
      background-color: #EBEDE8;
      border-radius: 10px;
      box-shadow: -13px 20px 20px #81b19b;
      font-family: Arial, sans-serif;
    }

    .login-form h2 {
      text-align: center;
      margin-bottom: 25px;
      font-size: 28px;
      color: #81b19b;
    }

    .login-form label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
      color: #444;
    }

    .login-form input {
      width: 100%;
      padding: 12px;
      margin-top: 6px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      transition: border-color 0.3s;
    }

    .login-form input:focus {
      border-color: #A50164;
      outline: none;
    }

    .login-form button {
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

    .login-form button:hover {
      background-color: #333;
    }

    .login-form p {
      text-align: center;
      margin-top: 18px;
      font-size: 15px;
    }

    .login-form p a {
      color: #A50164;
      text-decoration: none;
      font-weight: 600;
    }

    .login-form p a:hover {
      text-decoration: underline;
    }

    .error,
    .success {
      text-align: center;
      margin-top: 10px;
      font-weight: bold;
      font-size: 15px;
    }

    .admin-login {
      text-decoration: none;
      display: inline-flex;
      justify-content: center;
      align-items: center;
      width: 24px;
      color: white;
      background-color: #81b19b;
      border-radius: 50%;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <?php include '../includes/navbar.php'; ?>

  <div class="login-form">
    <h2>Đăng nhập</h2>

    <?php if (isset($_GET['registered'])): ?>
      <div class="success">Đăng ký thành công! Hãy đăng nhập.</div>
    <?php endif; ?>

    <?php if ($error): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <label for="email">Email:</label>
      <input type="email" name="email" required>

      <label for="password">Mật khẩu:</label>
      <input type="password" name="password" required>

      <button type="submit">Đăng nhập</button>
    </form>

    <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>

    <a class="admin-login" href="../admin/login.php">A</a>
  </div>

  <?php include '../includes/footer.php'; ?>
</body>

</html>
