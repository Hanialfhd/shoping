<?php
session_start();
include("coon.php");

// عند إرسال نموذج تسجيل الدخول
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_code = $_POST['emp_code'];
    $password = $_POST['password'];

    // جلب بيانات الموظف من قاعدة البيانات
    $stmt = mysqli_prepare($con, "SELECT * FROM employees WHERE emp_code = ?");
    mysqli_stmt_bind_param($stmt, "s", $emp_code);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($res)) {
        // مقارنة كلمة المرور (نصياً بدون تشفير)
        if ($password === $row['password']) {
            // إنشاء جلسة للموظف وتخزين الاسم
            $_SESSION['emp_id'] = $row['id'];
            $_SESSION['emp_name'] = $row['name'];

            // إعادة التوجيه إلى لوحة تحكم الموظف
            header("Location: emp_dashboard.php");
            exit;
        } else {
            $error = "❌ كلمة المرور غير صحيحة";
        }
    } else {
        $error = "❌ معرّف الموظف غير موجود";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول الموظف</title>
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
            font-size: 16px;
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

        p.error {
            color: red;
            font-weight: bold;
            margin-top: 15px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            display: block;
            margin-top: 15px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="main">
        <h2>تسجيل دخول الموظف</h2>

        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="emp_code" placeholder="معرّف الموظف" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <button type="submit">تسجيل الدخول</button>
        </form>

        <a href="index.php">⬅ الرجوع للرئيسية</a>
    </div>
</body>
</html>
