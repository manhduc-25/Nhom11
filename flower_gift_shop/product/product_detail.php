<?php
require_once '../includes/db.php';

$back = $_SERVER['HTTP_REFERER'] ?? 'products.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Sản phẩm không tồn tại.";
    exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($product['name']) ?></title>
  <style>
    .detail {
      width: 600px;
      margin: 50px auto;
      border: 1px solid #ccc;
      padding: 20px;
      text-align: center;
    }
    .detail img {
      max-width: 100%;
      height: 400px;
      object-fit: cover;
    }
    .price {
      font-size: 20px;
      color: red;
      margin-top: 10px;
    }
    .back {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="detail">
    <h2><?= htmlspecialchars($product['name']) ?></h2>
    <img src="../<?= htmlspecialchars($product['image']) ?>" alt="Ảnh sản phẩm">
    <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
    <div class="price"><?= number_format($product['price']) ?> đ</div>

    <!-- 🔙 Nút quay lại -->
    <div class="back">
      <a href="<?= htmlspecialchars($back) ?>">← Quay lại trang trước</a>
    </div>
  </div>
</body>
</html>
