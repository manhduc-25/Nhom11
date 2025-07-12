<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

require_once '../includes/db.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Quản lý sản phẩm</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f7f7f7;
      margin: 0;
      padding: 0;
    }

    table {
      border-collapse: collapse;
      width: 80%;
      margin: 20px auto;
    }

    th,
    td {
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

    .add-product {
      text-decoration: none;
      color: #81b19b;
    }

    a {
      text-decoration: none;
    }
    .change {
      color: yellowgreen;
    }

    .delete {
      color: red;
    }
  </style>
</head>

<body>

  <?php include 'header.php'; ?>

  <h2><ion-icon name="cube-outline"></ion-icon> Danh sách sản phẩm</h2>
  <p><a class="add-product" href="add_product.php"><ion-icon name="add-circle-outline"></ion-icon> Thêm sản phẩm mới</a></p>

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
            <a class="change" href="edit_product.php?id=<?= $row['id'] ?>"><ion-icon name="pencil-outline"></ion-icon> Sửa</a>
            <a class="delete" href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xoá?')"><ion-icon name="trash-outline"></ion-icon> Xoá</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
