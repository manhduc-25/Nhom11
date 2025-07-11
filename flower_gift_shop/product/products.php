<?php
require_once '../includes/db.php';
include '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        h2 {
            text-align: center;
            color: #81b19b;
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 30px;
            font-family: Arial, sans-serif;
        }

        .product-card {
            width: 220px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            background-color: #fff;
            transition: box-shadow 0.3s;
        }

        .product-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 5px;
        }

        .product-card h3 {
            font-size: 18px;
            margin: 10px 0 5px;
        }

        .product-card p {
            font-size: 14px;
            color: #555;
        }

        .product-card .price {
            font-weight: bold;
            color: #A50164;
            margin-top: 8px;
        }

        .product-card a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>

    <h2>Danh sách sản phẩm</h2>

    <div class="product-list">
        <?php
        $result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<a href="product_detail.php?id=' . $row['id'] . '">';
                echo '<img src="../flower/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                echo '<p class="price">' . number_format($row['price'], 0, ',', '.') . '₫</p>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo '<p>Không có sản phẩm nào để hiển thị.</p>';
        }
        ?>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>

</html>
