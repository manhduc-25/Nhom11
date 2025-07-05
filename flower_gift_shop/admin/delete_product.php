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

// Lấy ảnh sản phẩm trước khi xoá (nếu muốn xoá luôn ảnh)
$stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $product = $result->fetch_assoc();

  // Xoá ảnh vật lý (nếu có)
  $image_path = '../' . $product['image'];
  if (file_exists($image_path)) {
    unlink($image_path);
  }

  // Xoá bản ghi khỏi CSDL
  $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
}

// Trở về trang quản lý
header("Location: manage_products.php");
exit;
?>
