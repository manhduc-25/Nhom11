<!-- admin_header.php -->
<style>
  .admin-header {
    background: #333;
    padding: 12px 20px;
    display: flex;
    gap: auto;
    justify-content: space-between;
    align-items: center;
    font-family: Arial, sans-serif;
  }

  .admin-header a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    padding: 6px 10px;
    border-radius: 5px;
    transition: background-color 0.3s;
  }

  .admin-header a:hover {
    background-color: #555;
  }
</style>

<div class="admin-header">
  <a href="dashboard.php">Quản lý</a>
  <a href="manage_users.php">Người dùng</a>
  <a href="manage_products.php">Kho sản phẩm</a>
  <a href="logout.php">Đăng xuất</a>
</div>
