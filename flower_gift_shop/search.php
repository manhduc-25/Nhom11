<?php
session_start();
require_once 'includes/db.php';
include 'includes/navbar.php';

$search = $_GET['search'] ?? '';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Kết quả tìm kiếm</title>
  <style>
    .product { border: 1px solid #ccc; width: 250px; margin: 10px; padding: 10px; float: left; text-align: center; }
    .product img { width: 100%; height: 200px; object-fit: cover; }
  </style>
</head>
<body>

<h2>🔍 Kết quả tìm kiếm cho: "<?= htmlspecialchars($search) ?>"</h2>

<div class="products">
<?php
if (!empty($search)) {
  $s = $conn->real_escape_string($search);
  $result = $conn->query("SELECT * FROM products WHERE name LIKE '%$s%' ORDER BY created_at DESC");

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="product">';
      echo '<img src="' . htmlspecialchars($row['image']) . '" alt="Ảnh sản phẩm">';
      echo '<h3><a href="product/product_detail.php?id=' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</a></h3>';
      echo '<p>' . htmlspecialchars($row['description']) . '</p>';
      echo '<strong>' . number_format($row['price']) . ' đ</strong>';
      echo '</div>';
    }
  } else {
    echo '<p>Không tìm thấy sản phẩm phù hợp.</p>';
  }
} else {
  echo '<p>Vui lòng nhập từ khoá tìm kiếm.</p>';
}
?>
</div>

</body>
</html>
