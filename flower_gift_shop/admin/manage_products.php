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
  <title>Quản lý sản phẩm</title>
  <style>
    table { border-collapse: collapse; width: 100%; }
    th, td { padding: 10px; border: 1px solid #ccc; }
    form.search-form { margin-bottom: 20px; }
  </style>
</head>
<body>

<h2>📦 Quản lý Sản phẩm</h2>

<!-- 🔍 Thanh tìm kiếm -->
<form method="GET" class="search-form">
  <input type="text" name="search" placeholder="🔍 Tìm tên sản phẩm..." value="<?= htmlspecialchars($search) ?>">
  <button type="submit">Tìm</button>
</form>

<table>
  <tr>
    <th>Ảnh</th>
    <th>Tên</th>
    <th>Mô tả</th>
    <th>Giá</th>
    <th>Danh mục</th>
    <th>Hành động</th>
  </tr>

<?php
$where = '1';
if (!empty($search)) {
  $s = $conn->real_escape_string($search);
  $where .= " AND name LIKE '%$s%'";
}

$result = $conn->query("SELECT * FROM products WHERE $where ORDER BY created_at DESC");

if ($result->num_rows > 0):
  while ($row = $result->fetch_assoc()):
?>
  <tr>
    <td><img src="../<?= htmlspecialchars($row['image']) ?>" width="80"></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['description']) ?></td>
    <td><?= number_format($row['price']) ?> đ</td>
    <td><?= $row['category'] === 'flower' ? 'Hoa' : 'Quà' ?></td>
    <td>
      <a href="edit_product.php?id=<?= $row['id'] ?>">✏️ Sửa</a> |
      <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá?')">🗑️ Xoá</a>
    </td>
  </tr>
<?php
  endwhile;
else:
?>
  <tr><td colspan="6">Không tìm thấy sản phẩm.</td></tr>
<?php endif; ?>
</table>

</body>
</html>

  <br><a href="dashboard.php">← Quay lại Trang quản lý</a>
</body>
</html>
