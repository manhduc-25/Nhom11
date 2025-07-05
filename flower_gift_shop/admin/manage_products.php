<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

require_once '../includes/db.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Quản lý sản phẩm</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }
    img {
      height: 80px;
    }
    .actions a {
      margin-right: 10px;
    }
  </style>
</head>
<body>

  <h2>📦 Danh sách sản phẩm</h2>
  <p><a href="add_product.php">➕ Thêm sản phẩm mới</a></p>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Ảnh</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Mô tả</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
      while ($row = $result->fetch_assoc()):
      ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><img src="../<?= $row['image'] ?>" alt="ảnh"></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= number_format($row['price']) ?> đ</td>
        <td><?= nl2br(htmlspecialchars($row['description'])) ?></td>
        <td class="actions">
          <a href="edit_product.php?id=<?= $row['id'] ?>">✏️ Sửa</a>
          <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xoá?')">🗑️ Xoá</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <br><a href="dashboard.php">← Quay lại Trang quản lý</a>
</body>
</html>
