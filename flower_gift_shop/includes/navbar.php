<?php
session_start();
?>
<div style="background:#f5f5f5; padding:10px;">
  <a href="/flower_gift_shop/index.php">🏠 Trang chủ</a>
  <a href="/flower_gift_shop/product/products.php">🌸 Sản phẩm</a>
  <a href="/flower_gift_shop/cart.php">🛒 Giỏ hàng</a>

  <?php if (isset($_SESSION['user'])): ?>
    <span>👋 <?= htmlspecialchars($_SESSION['user']) ?></span>
    <a href="/flower_gift_shop/auth/logout.php">🚪 Đăng xuất</a>
  <?php else: ?>
    <a href="/flower_gift_shop/auth/login.php">🔐 Đăng nhập</a>
    <a href="/flower_gift_shop/auth/register.php">📝 Đăng ký</a>
  <?php endif; ?>
</div>