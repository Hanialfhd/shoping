<?php
session_start();

// التحقق من تسجيل دخول الموظف
if (!isset($_SESSION['emp_id'])) {
    header('Location: employee_login.php');
    exit;
}

include('coon.php');

// جلب جميع المنتجات وترتيبها حسب القسم
$res = mysqli_query($con, "SELECT * FROM pro ORDER BY category, name");

if (!$res) {
    die("حدث خطأ في جلب المنتجات: " . mysqli_error($con));
}

// تنظيم المنتجات في مصفوفة حسب الأقسام
$products_by_category = [];
while ($row = mysqli_fetch_assoc($res)) {
    $products_by_category[$row['category']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>صفحة المنتجات</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            margin: 20px;
            background-color: #f9f9f9;
        }
        nav.navbar {
            margin-bottom: 25px;
            text-align: center;
        }
        nav.navbar a {
            margin: 0 10px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        nav.navbar a:hover {
            background-color: #0056b3;
        }
        h2.category-title {
            background-color: #c8ad78;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            margin-top: 40px;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            font-weight: 700;
            font-size: 1.5rem;
        }
        .products-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: flex-start;
        }
        .product-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 220px;
            padding: 15px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.2s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }
        .product-card img {
            max-width: 100%;
            height: 140px;
            object-fit: contain;
            margin-bottom: 12px;
            border-radius: 6px;
        }
        .product-card h4 {
            margin: 10px 0 8px;
            font-size: 18px;
            color: #333;
            min-height: 44px; /* لمحاذاة العناوين */
        }
        .product-card p {
            margin: 6px 0 12px;
            font-size: 16px;
            color: #555;
            font-weight: 600;
        }
        .product-card a {
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 6px;
            color: white;
            font-weight: 700;
            margin: 0 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .product-card a.edit {
            background-color: #28a745;
        }
        .product-card a.edit:hover {
            background-color: #1e7e34;
        }
        .product-card a.delete {
            background-color: #dc3545;
        }
        .product-card a.delete:hover {
            background-color: #bd2130;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <a href="add_product.php">إضافة منتج</a>
    <a href="index.php">تسجيل خروج</a>
</nav>

<?php
// عرض المنتجات حسب الأقسام
foreach ($products_by_category as $category => $products) {
    echo "<h2 class='category-title'>" . htmlspecialchars($category) . "</h2>";
    echo "<div class='products-container'>";
    foreach ($products as $row) {
        echo "<div class='product-card'>";
        echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
        echo "<h4>" . htmlspecialchars($row['name']) . "</h4>";
        echo "<p>السعر: " . htmlspecialchars($row['price']) . " ر.س</p>";
        echo "<a href='update.php?id=" . $row['id'] . "' class='edit'>تعديل</a>";
        echo "<a href='delete.php?id=" . $row['id'] . "' class='delete' onclick='return confirm(\"هل أنت متأكد من الحذف؟\")'>حذف</a>";
        echo "</div>";
    }
    echo "</div>";
}
?>

</body>
</html>
