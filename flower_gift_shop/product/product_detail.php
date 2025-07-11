<?php
session_start();
require_once '../includes/db.php';

$product = null;

if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $product = $result->fetch_assoc();
}

if (!$product) {
  echo "<p style='color:red'>Sản phẩm không tồn tại.</p>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>
    <?= htmlspecialchars($product['name']) ?>
  </title>
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .detail-container {
      max-width: 1000px;
      margin: 50px auto;
      display: flex;
      gap: 40px;
      font-family: Arial, sans-serif;
    }

    .detail-container img {
      width: 400px;
      height: auto;
      border-radius: 10px;
      border: 1px solid #ccc;
    }

    .product-info h2 {
      font-size: 28px;
      margin-bottom: 10px;
    }

    .product-info p {
      font-size: 16px;
      margin-bottom: 10px;
    }

    .product-info .price {
      font-size: 22px;
      color: #A50164;
      font-weight: bold;
      margin: 15px 0;
    }

    .product-info form {
      margin-top: 20px;
    }

    .product-info input[type="number"] {
      width: 60px;
      padding: 5px;
      font-size: 16px;
      margin-right: 10px;
    }

    .product-info button {
      padding: 8px 20px;
      background-color: black;
      color: white;
      border: none;
      font-weight: bold;
      cursor: pointer;
      border-radius: 5px;
    }

    .product-info a {
      color: black;
      text-decoration: none;
      border-bottom: 5px;
    }
  </style>
</head>

<body>

  <?php include '../includes/navbar.php'; ?>

  <div class="detail-container">
    <img src="flower/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    <div class="product-info">
      <h2>
        <?= htmlspecialchars($product['name']) ?>
      </h2>
      <p>
        <?= nl2br(htmlspecialchars($product['description'])) ?>
      </p>
      <div class="price">
        <?= number_format($product['price'], 0, ',', '.') ?>₫
      </div>

      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <label>Số lượng:</label>
        <input type="number" name="quantity" value="1" min="1" required>
        <button type="submit">🛒 Thêm vào giỏ</button>
      </form>
      <p><br><a href="product_list.php">Quay lại danh sách sản phẩm</a></p>
    </div>
  </div>
  <!-- 🔙 Nút quay lại -->
  <?php include '../includes/footer.php'; ?>
</body>

</html>
