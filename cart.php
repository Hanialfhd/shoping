<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login_user.php');
    exit;
}

include('coon.php');

$user_id = $_SESSION['user_id'];

$res = mysqli_query($con, "
    SELECT c.id AS cart_id, p.*
    FROM cart c
    JOIN pro p ON c.product_id = p.id
    WHERE c.user_id = $user_id
");
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>عربتي</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo"><a href="shop.php">متجري</a></div>
        <div class="navigation">
            <a href="shop.php">العودة للمتجر</a>
            <a href="logout.php">خروج</a>
        </div>
    </header>

    <div class="container">
        <div class="sub-header">
            <div class="title">عربة التسوق</div>
        </div>

        <?php if (mysqli_num_rows($res) == 0): ?>
            <p class="message">🛒 العربة فارغة حالياً</p>
        <?php else: ?>
            <div class="thumb-wrapper">
                <?php while ($row = mysqli_fetch_assoc($res)): ?>
                    <div class="thumb-unit">
                        <div class="heading">
                            <span><?= htmlspecialchars($row['name']) ?></span>
                            <span><?= htmlspecialchars($row['price']) ?> ر.س</span>
                        </div>
                        <div class="box" style="background-image: url('images/<?= htmlspecialchars($row['image']) ?>');"></div>
                        <div class="info">
                            <a class="remove" href="remove_from_cart.php?id=<?= $row['cart_id'] ?>" onclick="return confirm('هل تريد إزالة المنتج؟')">إزالة</a>
                            <a class="add" href="details.php?id=<?= $row['id'] ?>">تفاصيل</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
