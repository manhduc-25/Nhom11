<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<div class="navbar">
  <!-- 🔗 LOGO + SEARCH + LOGIN -->
  <div id="logo">
    <a href="/flower_gift_shop/index.php">
      <img src="/flower_gift_shop/images/logo.png" alt="Logo">
    </a>
    <div>
      <div class="search-box">
        <form action="/flower_gift_shop/search.php" method="GET">
          <input type="search" name="q" placeholder="Tìm kiếm">
          <button type="submit" class="search-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
              <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                <path d="M21 12a9 9 0 1 1-18 0a9 9 0 0 1 18 0" />
                <path d="M13.856 13.85a3.429 3.429 0 1 0-4.855-4.842a3.429 3.429 0 0 0 4.855 4.842m0 0L16 16" />
              </g>
            </svg>
          </button>
        </form>
      </div>

      <!-- LOGIN/USER -->
      <div class="login-container">
        <?php if (isset($_SESSION['user'])): ?>
          <span>Wellcome <?= htmlspecialchars($_SESSION['user']) ?></span>
          <a href="/flower_gift_shop/auth/logout.php"><button class="login">Đăng xuất</button></a>
        <?php else: ?>
          <div class="login-register-btn">
            <a href="/flower_gift_shop/auth/login.php" class="login-btn"><button class="login">Login</button></a>
            <a href="/flower_gift_shop/auth/register.php" class="register-btn"><button class="register">Register</button></a>
          </div>
        <?php endif; ?>

        <!-- Giỏ hàng -->
        <a href="/flower_gift_shop/cart.php" title="Giỏ hàng">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M16.5 21a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m-8 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3M3.71 5.4h15.214c1.378 0 2.373 1.27 1.995 2.548l-1.654 5.6C19.01 14.408 18.196 15 17.27 15H8.112c-.927 0-1.742-.593-1.996-1.452zm0 0L3 3" />
          </svg>
        </a>
      </div>
    </div>
  </div>

  <!-- 🔗 MENU -->
  <nav>
    <ul>
      <li><a href="/flower_gift_shop/index.php">Trang Chủ</a></li>
      <li><a href="/flower_gift_shop/product/products.php">Danh Sách</a></li>
      <li><a href="#">Sinh Nhật</a></li>
      <li><a href="#">Tiệc Cưới</a></li>
      <li><a href="/flower_gift_shop/product/gift.php">Quà tặng</a></li>
    </ul>
  </nav>
</div>
