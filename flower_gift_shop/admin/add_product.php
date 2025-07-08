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
  $category = $_POST['category'];
  $occasion = $_POST['occasion'] ?? null;
  $gift_type = $_POST['gift_type'] ?? null;

  $target_dir = "../product/flower/";
  $image_name = basename($_FILES["image"]["name"]);
  $target_file = $target_dir . $image_name;

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $image_path = "product/flower/" . $image_name;

    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image, category, occasion, gift_type)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdssss", $name, $description, $price, $image_path, $category, $occasion, $gift_type);

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
  <script>
    function toggleTags(value) {
      document.getElementById('flower-tags').style.display = value === 'flower' ? 'block' : 'none';
      document.getElementById('gift-tags').style.display = value === 'gift' ? 'block' : 'none';
    }
  </script>
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

    <!-- Category -->
    <label>Loại sản phẩm:</label><br>
    <select name="category" onchange="toggleTags(this.value)" required>
      <option value="flower">Hoa</option>
      <option value="gift">Quà</option>
    </select><br><br>

    <!-- Tags for flower -->
    <div id="flower-tags">
      <label>🎉 Dịp tặng (nếu là hoa):</label><br>
      <select name="occasion">
        <option value="">-- Chọn dịp --</option>
        <option value="sinh_nhat">Sinh nhật</option>
        <option value="chuc_mung">Chúc mừng</option>
        <option value="hoa_tang">Hoa tang lễ</option>
      </select><br><br>
    </div>

    <!-- Tags for gift -->
    <div id="gift-tags" style="display:none;">
      <label>🎁 Loại quà (nếu là quà):</label><br>
      <select name="gift_type">
        <option value="">-- Chọn loại --</option>
        <option value="gau_bong">Gấu bông</option>
        <option value="do_ngot">Đồ ngọt</option>
        <option value="socola">Socola</option>
      </select><br><br>
    </div>

    <button type="submit">Lưu sản phẩm</button>
  </form>

  <br><a href="dashboard.php">← Về trang quản lý</a>
</body>
</html>

  <br><a href="dashboard.php">← Về trang quản lý</a>
</body>
</html>
