<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
require_once '../includes/db.php';
?>

<?php include 'header.php'; ?> <!-- Đây là phần giao diện menu -->

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Lấy dữ liệu cũ
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

// Nếu cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = (float)$_POST['price'];

  // Nếu có ảnh mới
  if ($_FILES['image']['name']) {
    $target_dir = "../product/flower/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      $image_path = "product/flower/" . $image_name;
    } else {
      $error = "Upload ảnh mới thất bại.";
    }
  } else {
    $image_path = $product['image']; // Giữ lại ảnh cũ nếu không thay
  }

  if (!$error) {
    $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssdsi", $name, $description, $price, $image_path, $id);
    if ($stmt->execute()) {
      $success = "✅ Đã cập nhật sản phẩm.";
      $product['name'] = $name;
      $product['description'] = $description;
      $product['price'] = $price;
      $product['image'] = $image_path;
    } else {
      $error = "Lỗi khi cập nhật: " . $conn->error;
    }
  }
}
?>
