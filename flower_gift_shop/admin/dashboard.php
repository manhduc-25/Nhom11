<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../includes/db.php';
include 'header.php';

$search = $_GET['search'] ?? '';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Trang quản trị</title>
  <style>
    .product { border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
    .product img { width: 100px; height: 100px; object-fit: cover; float: left; margin-right: 15px; }
  </style>
</head>
<body>

<h2>👋 Xin chào, <?= htmlspecialchars($_SESSION['admin']) ?></h2>

<p><a href="add_product.php">➕ Thêm sản phẩm</a> | <a href="manage_products.php">📦 Quản lý sản phẩm</a> | <a href="logout.php">🚪 Đăng xuất</a></p>

<!-- 🔎 Thanh tìm kiếm -->
<form method="GET">
  <input type="text" name="search" placeholder="Tìm tên sản phẩm..." value="<?= htmlspecialchars($search) ?>">
  <button type="submit">Tìm</button>
</form>

<hr>

<h3>📋 Danh sách sản phẩm</h3>

<?php
$where = '1';
if (!empty($search)) {
    $s = $conn->real_escape_string($search);
    $where .= " AND name LIKE '%$s%'";
}

$result = $conn->query("SELECT * FROM products WHERE $where ORDER BY created_at DESC LIMIT 10");

if ($result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
?>
  <div class="product">
    <img src="../<?= htmlspecialchars($row['image']) ?>" alt="">
    <strong><?= htmlspecialchars($row['name']) ?></strong><br>
    <?= htmlspecialchars($row['description']) ?><br>
    <strong><?= number_format($row['price']) ?> đ</strong> | <?= $row['category'] === 'flower' ? 'Hoa' : 'Quà' ?><br>
    <a href="edit_product.php?id=<?= $row['id'] ?>">✏️ Sửa</a> |
    <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn chắc muốn xoá?')">🗑️ Xoá</a>
  </div>
<?php
    endwhile;
else:
    echo "<p>Không tìm thấy sản phẩm phù hợp.</p>";
endif;
?>

</body>
</html>
