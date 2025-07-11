<?php
require_once '../includes/db.php';
include '../includes/navbar.php';

$occasions = ['' => '-- Tất cả --', 'sinh_nhat' => 'Sinh nhật', 'tinh_yeu' => 'Tình yêu', 'cam_on' => 'Cảm ơn', 'lang_man' => 'Lãng mạn'];
$selected_occasion = $_GET['occasion'] ?? '';
$search = $_GET['search'] ?? '';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>🌸 Hoa tươi</title>
  <style>
    .product { border: 1px solid #ccc; width: 250px; margin: 10px; padding: 10px; float: left; text-align: center; }
    .product img { width: 100%; height: 200px; object-fit: cover; }
  </style>
</head>
<body>

<h2>🌸 Danh sách Hoa tươi</h2>

<!-- 🔎 Bộ lọc dịp tặng -->
<form method="GET">
  <label>Dịp tặng:</label>
  <select name="occasion">
    <?php foreach ($occasions as $key => $label): ?>
      <option value="<?= $key ?>" <?= $selected_occasion === $key ? 'selected' : '' ?>><?= $label ?></option>
    <?php endforeach; ?>
  </select>

  <label>Tìm kiếm:</label>
  <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Nhập tên sản phẩm">

  <button type="submit">Lọc</button>
</form>

<hr style="clear:both;">

<div class="products">
<?php
$where = "category = 'flower'";

if (!empty($selected_occasion)) {
  $escaped = $conn->real_escape_string($selected_occasion);
  $where .= " AND occasion = '$escaped'";
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
    <img src="../<?= htmlspecialchars($row['image']) ?>" alt="Ảnh sản phẩm">
    <h3><a href="product_detail.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></a></h3>
    <p><?= htmlspecialchars($row['description']) ?></p>
    <strong><?= number_format($row['price']) ?> đ</strong>
  </div>
<?php endwhile; else: ?>
  <p>Không tìm thấy sản phẩm phù hợp.</p>
<?php endif; ?>
</div>
</body>
</html>
