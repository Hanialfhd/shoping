<?php
// login_user.php
session_start();
include('coon.php');

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $res = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
    if ($row = mysqli_fetch_assoc($res)) {
        if (password_verify($_POST['password'], $row['password_hash'])) {
            $_SESSION['user_id'] = $row['id'];
            header('Location: shop.php');
            exit;
        } else {
            $error = 'كلمة المرور خاطئة';
        }
    } else {
        $error = 'اسم المستخدم غير موجود';
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول عميل</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .main {
            width: 320px;
            margin: 100px auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            text-align: center;
        }

        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 95%;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 15px;
        }

        p.error {
            color: red;
            font-weight: bold;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="main">
        <h2>تسجيل دخول</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="username" placeholder="اسم المستخدم" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <button name="login" type="submit">دخول</button>
        </form>
        <p>ليس لديك حساب؟ <a href="register.php">إنشاء حساب</a></p>
        <a href="index.php">الرجوع للرئيسية</a>
    </div>
</body>
</html>
