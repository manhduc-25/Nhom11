<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Trang quản lý</title>
</head>
<body>
  <h2>Chào, <?= htmlspecialchars($_SESSION['admin']) ?></h2>
  <p>Chọn chức năng quản lý:</p>
  <ul>
    <li><a href="manage_products.php">📦 Quản lý sản phẩm</a></li>
    <li><a href="add_product.php">➕ Thêm sản phẩm mới</a></li>
    <li><a href="logout.php">🚪 Đăng xuất</a></li>
  </ul>
</body>
</html>
