<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login_user.php');
    exit;
}

include('coon.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("المنتج غير صالح.");
}

$id = intval($_GET['id']);

$res = mysqli_query($con, "SELECT * FROM pro WHERE id = $id");

if (mysqli_num_rows($res) == 0) {
    die("المنتج غير موجود.");
}

$p = mysqli_fetch_assoc($res);

$imagePath = "images/" . $p['image'];
if (!file_exists($imagePath) || empty($p['image'])) {
    $imagePath = "images/default.png"; // صورة افتراضية
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل المنتج</title>
    <style>
        /* عام */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fafafa;
            color: #333;
            direction: rtl;
        }

        /* شريط التنقل */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #c8ad78;
            padding: 16px 40px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar .logo a {
            text-decoration: none;
            color: white;
            font-weight: 700;
            font-size: 24px;
            letter-spacing: 2px;
        }
        .navigation a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 600;
            font-size: 16px;
            padding: 8px 14px;
            border-radius: 6px;
            background-color: rgba(255,255,255,0.15);
            transition: background-color 0.3s ease;
        }
        .navigation a:hover {
            background-color: rgba(255,255,255,0.35);
        }

        /* الحاوية الرئيسية */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.07);
        }

        .sub-header .title {
            font-size: 28px;
            font-weight: 700;
            color: #c8ad78;
            margin: 30px 0 20px;
            border-bottom: 3px solid #c8ad78;
            padding-bottom: 6px;
            text-align: center;
        }

        /* تفاصيل المنتج */
        .product-details {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            padding: 20px 10px 40px;
            justify-content: center;
        }

        .details-image {
            width: 300px;
            height: 300px;
            object-fit: contain;
            border-radius: 14px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            background-color: #f9f9f9;
        }

        .product-details h2 {
            width: 100%;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 18px;
            color: #4a4a4a;
            text-align: center;
        }

        .product-details p {
            font-size: 17px;
            line-height: 1.6;
            color: #555;
            margin: 8px 0;
            width: 100%;
            max-width: 550px;
            text-align: right;
            word-break: break-word;
        }

        .product-details strong {
            color: #333;
        }

        .add {
            display: inline-block;
            margin-top: 30px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 18px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(40,167,69,0.6);
            transition: background-color 0.3s ease;
            user-select: none;
        }

        .add:hover {
            background-color: #1e7e34;
            box-shadow: 0 6px 20px rgba(30,126,52,0.8);
        }

        /* استجابة الشاشات الصغيرة */
        @media (max-width: 768px) {
            .product-details {
                flex-direction: column;
                align-items: center;
                padding: 20px 10px 30px;
            }
            .details-image {
                width: 90%;
                height: auto;
            }
            .product-details h2,
            .product-details p {
                max-width: 100%;
                text-align: center;
            }
            .add {
                width: 90%;
                text-align: center;
                padding: 14px 0;
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="logo"><a href="shop.php">متجري</a></div>
        <div class="navigation">
            <a href="cart.php">عربتي</a>
            <a href="logout.php">خروج</a>
        </div>
    </header>

    <div class="container">
        <div class="sub-header">
            <div class="title">تفاصيل المنتج</div>
        </div>

        <div class="product-details">
            <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($p['name']) ?>" class="details-image">
            <h2><?= htmlspecialchars($p['name']) ?></h2>
            <p><strong>السعر:</strong> <?= htmlspecialchars($p['price']) ?> ر.س</p>
            <p><strong>الوصف:</strong><br><?= nl2br(htmlspecialchars($p['description'])) ?></p>
            <p><strong>القسم:</strong> <?= htmlspecialchars($p['category']) ?></p>
            <a href="add_to_cart.php?id=<?= $p['id'] ?>" class="add">🛒 أضف للعربة</a>
        </div>
    </div>
</body>
</html>
