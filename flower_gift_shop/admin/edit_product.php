<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

require_once '../includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = null;
$error = '';
$success = '';

// 🔄 Lấy thông tin sản phẩm cũ
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $product = $result->fetch_assoc();
} else {
  die("❌ Không tìm thấy sản phẩm.");
}

// 📝 Xử lý khi submit form cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = (float)$_POST['price'];
  $category = $_POST['category'];
  $occasion = $_POST['occasion'] ?? null;
  $gift_type = $_POST['gift_type'] ?? null;

  $image_path = $product['image'];

  if (!empty($_FILES['image']['name'])) {
    $target_dir = "../product/flower/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      $image_path = "product/flower/" . $image_name;
    } else {
      $error = "❌ Upload ảnh thất bại.";
    }
  }

  if (!$error) {
    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, image=?, category=?, occasion=?, gift_type=? WHERE id=?");
    $stmt->bind_param("ssdssssi", $name, $description, $price, $image_path, $category, $occasion, $gift_type, $id);

    if ($stmt->execute()) {
      $success = "✅ Cập nhật sản phẩm thành công!";
      // load lại dữ liệu sau khi cập nhật
      $product['name'] = $name;
      $product['description'] = $description;
      $product['price'] = $price;
      $product['image'] = $image_path;
      $product['category'] = $category;
      $product['occasion'] = $occasion;
      $product['gift_type'] = $gift_type;
    } else {
      $error = "❌ Lỗi cập nhật: " . $conn->error;
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sửa sản phẩm</title>
  <script>
    function toggleTags(value) {
      document.getElementById('flower-tags').style.display = value === 'flower' ? 'block' : 'none';
      document.getElementById('gift-tags').style.display = value === 'gift' ? 'block' : 'none';
    }
    window.onload = function () {
      toggleTags('<?= $product['category'] ?>');
    }
  </script>
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

    <label>Giá (VNĐ):</label><br>
    <input type="number" name="price" value="<?= $product['price'] ?>" required><br><br>

    <label>Ảnh hiện tại:</label><br>
    <img src="../<?= $product['image'] ?>" width="120"><br><br>
    <label>Đổi ảnh mới (nếu muốn):</label><br>
    <input type="file" name="image" accept="image/*"><br><br>

    <label>Loại sản phẩm:</label><br>
    <select name="category" onchange="toggleTags(this.value)">
      <option value="flower" <?= $product['category'] === 'flower' ? 'selected' : '' ?>>Hoa</option>
      <option value="gift" <?= $product['category'] === 'gift' ? 'selected' : '' ?>>Quà</option>
    </select><br><br>

    <div id="flower-tags">
      <label>Dịp (occasion):</label><br>
      <select name="occasion">
        <option value="">-- Chọn dịp --</option>
        <option value="sinh_nhat" <?= $product['occasion'] === 'sinh_nhat' ? 'selected' : '' ?>>Sinh nhật</option>
        <option value="chuc_mung" <?= $product['occasion'] === 'chuc_mung' ? 'selected' : '' ?>>Chúc mừng</option>
        <option value="hoa_tang" <?= $product['occasion'] === 'hoa_tang' ? 'selected' : '' ?>>Hoa tang</option>
      </select><br><br>
    </div>

    <div id="gift-tags">
      <label>Loại quà (gift_type):</label><br>
      <select name="gift_type">
        <option value="">-- Chọn loại --</option>
        <option value="gau_bong" <?= $product['gift_type'] === 'gau_bong' ? 'selected' : '' ?>>Gấu bông</option>
        <option value="do_ngot" <?= $product['gift_type'] === 'do_ngot' ? 'selected' : '' ?>>Đồ ngọt</option>
        <option value="socola" <?= $product['gift_type'] === 'socola' ? 'selected' : '' ?>>Socola</option>
      </select><br><br>
    </div>

    <button type="submit">💾 Cập nhật</button>
  </form>

  <br><a href="manage_products.php">← Quay lại quản lý</a>
</body>
</html>
