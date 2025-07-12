<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
require_once '../includes/db.php';

// Biến xác định trang hiện tại cho menu
$currentPage = basename($_SERVER['PHP_SELF']);

// Xử lý thêm sản phẩm
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

    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image)
                        VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $description, $price, $image_path);

    if ($stmt->execute()) {
      $success = "Thêm sản phẩm thành công!";
    } else {
      $error = "Lỗi CSDL: " . $conn->error;
    }
  } else {
    $error = "Upload ảnh thất bại.";
  }
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Thêm sản phẩm</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #fff;
    }

    form {
      max-width: 600px;
      margin: 30px auto;
      background: #f8f8f8;
      padding: 20px;
      border-radius: 10px;
      font-family: Arial, sans-serif;
    }

    form label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    form input,
    form textarea,
    form select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    form button {
      margin-top: 20px;
      padding: 10px;
      width: 100%;
      background-color: #333;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    form button:hover {
      background-color: #555;
    }

    .success {
      color: green;
      text-align: center;
    }

    .error {
      color: red;
      text-align: center;
    }
  </style>
  <script>
    function toggleTags(value) {
      document.getElementById('flower-tags').style.display = value === 'flower' ? 'block' : 'none';
      document.getElementById('gift-tags').style.display = value === 'gift' ? 'block' : 'none';
    }
  </script>
</head>

<body>
  <?php if ($success): ?><p class="success"><?= $success ?></p><?php endif; ?>
  <?php if ($error): ?><p class="error"><?= $error ?></p><?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <h2 style="text-align:center;">Thêm sản phẩm mới</h2>
    <label>Tên sản phẩm:</label>
    <input type="text" name="name" required>

    <label>Mô tả:</label>
    <textarea name="description" rows="4" required></textarea>

    <label>Giá (VNĐ):</label>
    <input type="number" name="price" required step="1000">

    <label>Ảnh sản phẩm:</label>
    <input type="file" name="image" accept="image/*" required>

    <label>Loại sản phẩm:</label>
    <select name="category" onchange="toggleTags(this.value)" required>
      <option value="flower">Hoa</option>
      <option value="gift">Quà</option>
    </select>

    <div id="flower-tags">
      <label>Dịp tặng:</label>
      <select name="occasion">
        <option value="">-- Chọn dịp --</option>
        <option value="sinh_nhat">Sinh nhật</option>
        <option value="chuc_mung">Chúc mừng</option>
        <option value="hoa_tang">Hoa tang lễ</option>
      </select>
    </div>

    <div id="gift-tags" style="display:none;">
      <label>Loại quà:</label>
      <select name="gift_type">
        <option value="">-- Chọn loại --</option>
        <option value="gau_bong">Gấu bông</option>
        <option value="do_ngot">Đồ ngọt</option>
        <option value="socola">Socola</option>
      </select>
    </div>

    <button type="submit">Lưu sản phẩm</button>
  </form>

</body>

</html>
