<?php
require_once '../includes/db.php';
include '../includes/navbar.php';

$giftTypes = ['' => '-- Tất cả --', 'gau_bong' => 'Gấu bông', 'do_ngot' => 'Đồ ngọt', 'socola' => 'Socola'];
$selected_type = $_GET['gift_type'] ?? '';
$search = $_GET['search'] ?? '';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>🎁 Quà tặng</title>
  <style>
    .product { border: 1px solid #ccc; width: 250px; margin: 10px; padding: 10px; float: left; text-align: center; }
    .product img { width: 100%; height: 200px; object-fit: cover; }
  </style>
</head>
<body>

<h2>🎁 Danh sách Quà tặng</h2>

<!-- 🔎 Bộ lọc loại quà -->
<form method="GET">
  <label>Loại quà:</label>
  <select name="gift_type">
    <?php foreach ($giftTypes as $key => $label): ?>
      <option value="<?= $key ?>" <?= $selected_type === $key ? 'selected' : '' ?>><?= $label ?></option>
    <?php endforeach; ?>
  </select>

  <label>Tìm kiếm:</label>
  <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Nhập tên quà">

  <button type="submit">Lọc</button>
</form>

<hr style="clear:both;">

<div class="products">
<?php
$where = "category = 'gift'";

if (!empty($selected_type)) {
  $type = $conn->real_escape_string($selected_type);
  $where .= " AND gift_type = '$type'";
}

if (!empty($search)) {
  $s = $conn->real_escape_string($search);
  $where .= " AND name LIKE '%$s%'";
}

$result = $conn->query("SELECT * FROM products WHERE $where ORDER BY created_at DESC");

if ($result->num_rows > 0):
  while ($row = $result->fetch_assoc()):
?>
  <div class="product">
    <img src="<?= htmlspecialchars($row['image']) ?>" alt="Ảnh quà">
    <h3><a href="product/product_detail.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></a></h3>
    <p><?= htmlspecialchars($row['description']) ?></p>
    <strong><?= number_format($row['price']) ?> đ</strong>
  </div>
<?php endwhile; else: ?>
  <p>Không tìm thấy quà tặng phù hợp.</p>
<?php endif; ?>
</div>

</body>
</html>
