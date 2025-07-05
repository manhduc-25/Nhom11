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
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Lấy thông tin sản phẩm cần sửa
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows !== 1) {
  die("Không tìm thấy sản phẩm!");
}
$product = $result->fetch_assoc();

$success = '';
$error = '';

// Xử lý khi submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = (float)$_POST['price'];

  // Xử lý ảnh nếu có upload mới
  if (!empty($_FILES['image']['name'])) {
    $target_dir = "../product/flower/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      $image_path = "product/flower/" . $image_name;
    } else {
      $error = "❌ Upload ảnh thất bại.";
    }
  } else {
    $image_path = $product['image']; // Giữ ảnh cũ nếu không chọn ảnh mới
  }

  // Cập nhật CSDL
  if (!$error) {
    $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssdsi", $name, $description, $price, $image_path, $id);
    if ($stmt->execute()) {
      $success = "✅ Cập nhật thành công!";
      // Cập nhật lại $product để hiển thị mới
      $product['name'] = $name;
      $product['description'] = $description;
      $product['price'] = $price;
      $product['image'] = $image_path;
    } else {
      $error = "❌ Lỗi CSDL: " . $conn->error;
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sửa sản phẩm</title>
</head>
<body>
  <h2>✏️ Sửa sản phẩm</h2>

  <?php if ($success): ?><p style="color:green"><?= $success ?></p><?php endif; ?>
  <?php if ($error): ?><p style="color:red"><?= $error ?></p><?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <label>Tên sản phẩm:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br><br>

    <label>Mô tả:</label><br>
    <textarea name="description" rows="4" required><?= htmlspecialchars($product['description']) ?></textarea><br><br>

    <label>Giá:</label><br>
    <input type="number" name="price" value="<?= $product['price'] ?>" required><br><br>

    <label>Ảnh hiện tại:</label><br>
    <img src="../<?= $product['image'] ?>" width="200"><br><br>

    <label>Chọn ảnh mới (nếu cần đổi):</label><br>
    <input type="file" name="image" accept="image/*"><br><br>

    <button type="submit">Lưu thay đổi</button>
  </form>

  <br><a href="manage_products.php">← Quay lại danh sách</a>
</body>
</html>
