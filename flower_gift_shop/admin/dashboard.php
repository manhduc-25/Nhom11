<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .dashboard-content {
      padding: 20px;
    }

    h1 {
      color: #333;
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="dashboard-content">
    <h1>Hello, <?= htmlspecialchars($_SESSION['admin']) ?>!</h1>
    <p>Wellcome back boss. Sử dụng thanh điều hướng bên trên để thao tác!</p>
  </div>

</body>
</html>
