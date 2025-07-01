<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
include('coon.php');

// جلب جميع المنتجات وتصنيفها حسب القسم
$result = mysqli_query($con, "SELECT * FROM pro");
$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $cat = $row['category'];
    $products[$cat][] = $row;
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>  
<!-- <link rel="stylesheet" href="style.css"> -->
      <style>
                /* عام */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
          }
          
          body {
            background-color: #fafafa;
            direction: rtl;
            color: #333;
            min-height: 100vh;
          }
          
          /* شريط التنقل */
          .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 40px;
            background-color: #c8ad78;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 100;
          }
          
          .navbar .logo span {
            font-weight: 700;
            font-size: 28px;
            color: #fff;
            letter-spacing: 2px;
          }
          
          .navigation a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 600;
            font-size: 17px;
            padding: 8px 14px;
            border-radius: 6px;
            background-color: rgba(255, 255, 255, 0.15);
            transition: background-color 0.3s ease;
          }
          
          .navigation a:hover {
            background-color: rgba(255, 255, 255, 0.35);
          }
          
          /* الحاوية الرئيسية */
          .container {
            max-width: 1200px;
            margin: 40px auto 80px;
            padding: 0 20px;
          }
          
          /* العنوان الرئيسي */
          .sub-header {
            margin-bottom: 30px;
          }
          
          .sub-header .title {
            font-size: 28px;
            font-weight: 700;
            color: #222;
            margin-bottom: 6px;
            border-bottom: 3px solid #c8ad78;
            display: inline-block;
            padding-bottom: 6px;
          }
          
          .sub-header .title span {
            display: block;
            font-size: 17px;
            color: #555;
            font-weight: 500;
            margin-top: 4px;
          }
          
          /* رسالة عدم وجود منتجات */
          .message {
            text-align: center;
            font-size: 20px;
            padding: 50px 0;
            color: #999;
          }
          
          /* عنوان الأقسام */
          h3 {
            font-size: 22px;
            font-weight: 700;
            color: #c8ad78;
            margin: 30px 0 18px;
            border-bottom: 2px solid #c8ad78;
            padding-bottom: 4px;
          }
          
          /* حاوية المنتجات */
          .thumb-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
          }
          
          /* بطاقة المنتج */
          .thumb-unit {
            background-color: #fff;
            width: 220px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.07);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            cursor: pointer;
          }
          
          .thumb-unit:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
          }
          
          /* عنوان المنتج والسعر */
          .thumb-unit .heading {
            display: flex;
            justify-content: space-between;
            padding: 15px 18px 10px;
            font-weight: 600;
            color: #333;
            font-size: 16px;
          }
          
          /* صندوق الصورة */
          .thumb-unit .box {
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            height: 180px;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            margin: 0 12px;
          }
          
          /* أزرار الإضافة والتفاصيل */
          .thumb-unit .info {
            display: flex;
            justify-content: space-around;
            padding: 14px 0;
            background-color: #f7f7f7;
          }
          
          .thumb-unit .info a {
            text-decoration: none;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 700;
            color: white;
            transition: background-color 0.3s ease;
            user-select: none;
          }
          
          .thumb-unit .info a.add {
            background-color: #28a745;
          }
          
          .thumb-unit .info a.add:hover {
            background-color: #1e7e34;
          }
          
          .thumb-unit .info a.remove {
            background-color: #007bff;
          }
          
          .thumb-unit .info a.remove:hover {
            background-color: #0056b3;
          }
          
          /* استجابة الشاشة */
          @media (max-width: 768px) {
            .thumb-wrapper {
              justify-content: center;
            }
            .thumb-unit {
              width: 90%;
              max-width: 320px;
            }
            .navbar {
              flex-direction: column;
              gap: 10px;
              padding: 20px 15px;
            }
            .navigation a {
              margin-left: 0;
              margin-right: 10px;
            }
          }
          
      </style>
  <meta charset="UTF-8">
  <title>المتجر الإلكتروني</title>
</head>
<body>
  <header class="navbar">
    <div class="logo"><span>متجري</span></div>
    <div class="navigation">
      <a href="cart.php">عربتي</a>
      <a href="logout.php">خروج</a>
    </div>
  </header>

  <div class="container">
    <div class="sub-header">
      <div class="title">كل المنتجات <span>الاقسام المتاحة</span></div>
    </div>

    <?php if (empty($products)): ?>
      <p class="message">لا توجد منتجات حالياً.</p>
    <?php else: ?>
      <?php foreach ($products as $category => $items): ?>
        <h3 style="margin: 20px 0; color:#c8ad78"><?= htmlspecialchars($category) ?></h3>
        <div class="thumb-wrapper">
          <?php foreach ($items as $row): ?>
            <div class="thumb-unit">
              <div class="heading">
                <span><?= htmlspecialchars($row['name']) ?></span>
                <span><?= htmlspecialchars($row['price']) ?> ر.س</span>
              </div>
              <div class="box" style="background-image: url('images/<?= htmlspecialchars($row['image']) ?>');"></div>
              <div class="info">
                <a class="add" href="add_to_cart.php?id=<?= $row['id'] ?>">إضافة للعربة</a>
                <a class="remove" href="details.php?id=<?= $row['id'] ?>">تفاصيل</a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</body>
</html>
