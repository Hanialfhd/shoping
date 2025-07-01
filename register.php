<?php
// register.php
session_start();
include('coon.php');

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    
    // التحقق من وجود اسم المستخدم مسبقًا
    $exists = mysqli_query($con, "SELECT id FROM users WHERE username='$username'");
    if (mysqli_num_rows($exists)) {
        $error = 'اسم المستخدم مستخدم بالفعل';
    } else {
        // تشفير كلمة المرور قبل التخزين
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($con, "INSERT INTO users (username, password_hash) VALUES ('$username', '$password')");
        header('Location: login_user.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
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
    <meta charset="UTF-8">
    <title>إنشاء حساب عميل</title>
</head>
<body>
    <div class="main">
        <h2>إنشاء حساب</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post">
            <input type="text" name="username" placeholder="اسم المستخدم" required><br><br>
            <input type="password" name="password" placeholder="كلمة المرور" required><br><br>
            <button name="register">سجِّل</button>
        </form>
        <p>لديك حساب؟ <a href="login_user.php">تسجيل دخول</a></p>
        <a href="index.php">الرجوع للرئيسية</a>
    </div>
</body>
</html>
