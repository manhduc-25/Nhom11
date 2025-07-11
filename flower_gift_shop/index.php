<?php
session_start();
require_once 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Trang chủ - Giao Hoa và Quà Tặng</title>
  <style>
    body { font-family: Arial, sans-serif; }
    .navbar {
      background-color: #f5f5f5;
      padding: 10px;
      margin-bottom: 20px;
    }
    .navbar a {
      margin-right: 15px;
      text-decoration: none;
      color: #333;
    }
    .products {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .product {
      border: 1px solid #ddd;
      padding: 10px;
      width: 200px;
      text-align: center;
    }
    .product img {
      max-width: 100%;
      height: 150px;
      object-fit: cover;
    }
  </style>
</head>
<body>

  <!-- 🔗 Thanh điều hướng -->
  <div class="navbar">
    <a href="index.php">🏠 Trang chủ</a>
    <a href="product/products.php">🌸 Sản phẩm</a>
    <a href="product/gift.php">🎁 Quà tặng</a>
    <a href="cart.php">🛒 Giỏ hàng</a>

    <?php if (isset($_SESSION['user'])): ?>
      <span>👋 Xin chào, <?= htmlspecialchars($_SESSION['user']) ?></span>
      <a href="auth/logout.php">🚪 Đăng xuất</a>
    <?php else: ?>
      <a href="auth/login.php">🔐 Đăng nhập</a>
      
    <?php endif; ?>
  </div>

  <h1>Chào mừng đến với Ứng dụng Giao Hoa và Quà Tặng!</h1>
  <p>Đặt hoa và quà tặng một cách nhanh chóng và dễ dàng 🌷🎁</p>

    <!-- 🔎 Thanh tìm kiếm -->
  <form method="GET" action="search.php">
    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." required>
    <button type="submit">Tìm</button>
  </form>
  <h2>🌟 Sản phẩm mới</h2>

  <div class="products">
    <?php
    $result = $conn->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 4");
    while ($row = $result->fetch_assoc()):
    ?>
      <div class="product">
        <img src="<?= $row['image'] ?>" alt="Ảnh sản phẩm">
        <h4><?= htmlspecialchars($row['name']) ?></h4>
        <p><strong><?= number_format($row['price']) ?> đ</strong></p>
        <a href="product/product_detail.php?id=<?= $row['id'] ?>">Xem chi tiết</a>
      </div>
    <?php endwhile; ?>
  </div>

</body>
</html>
