<?php
require_once '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Danh sách sản phẩm</title>
  <style>
    .product {
      border: 1px solid #ccc;
      width: 250px;
      margin: 10px;
      padding: 10px;
      float: left;
      text-align: center;
    }
    .product img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <h2>Danh sách sản phẩm</h2>

  <?php
  $result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="product">';
      echo '<img src="../' . htmlspecialchars($row['image']) . '" alt="Ảnh sản phẩm">';
      echo '<h3><a href="product_detail.php?id=' . $row['id'] . '">' . $row['name'] . '</a></h3>';
      echo '<p>' . $row['description'] . '</p>';
      echo '<strong>' . number_format($row['price']) . ' đ</strong>';
      echo '</div>';
    }
  } else {
    echo 'Không có sản phẩm nào.';
  }
  ?>
</body>
</html>
