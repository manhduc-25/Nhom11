<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
require_once '../includes/db.php';
?>

<?php include 'header.php'; ?>

<?php
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = (float)$_POST['price'];

  $target_dir = "../product/flower/";
  $image_name = basename($_FILES["image"]["name"]);
  $target_file = $target_dir . $image_name;

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $image_path = "product/flower/" . $image_name;

    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $description, $price, $image_path);

    if ($stmt->execute()) {
      $success = "✅ Thêm sản phẩm thành công!";
    } else {
      $error = "❌ Lỗi CSDL: " . $conn->error;
    }
  } else {
    $error = "❌ Upload ảnh thất bại.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Thêm sản phẩm</title>
</head>
<body>
  <h2>➕ Thêm sản phẩm mới</h2>

  <?php if ($success): ?><p style="color:green"><?= $success ?></p><?php endif; ?>
  <?php if ($error): ?><p style="color:red"><?= $error ?></p><?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <label>Tên sản phẩm:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Mô tả:</label><br>
    <textarea name="description" rows="4" required></textarea><br><br>

    <label>Giá (VNĐ):</label><br>
    <input type="number" name="price" required><br><br>

    <label>Ảnh sản phẩm:</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>

    <button type="submit">Lưu sản phẩm</button>
  </form>

  <br><a href="dashboard.php">← Về trang quản lý</a>
</body>
</html>
