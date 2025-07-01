<?php
session_start();
if (!isset($_SESSION['emp_id'])) {
    header('Location: employee_login.php');
    exit;
}

include('coon.php');

if (isset($_POST['upload'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $desc = mysqli_real_escape_string($con, $_POST['description']);
    $cat = mysqli_real_escape_string($con, $_POST['category']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($img);

        if (move_uploaded_file($tmp, $target_file)) {
            $insert = "INSERT INTO pro (name, price, image, description, category) 
                       VALUES ('$name', '$price', '$img', '$desc', '$cat')";
            if (mysqli_query($con, $insert)) {
                $success = "✅ تم إضافة المنتج بنجاح.";
            } else {
                $error = "حدث خطأ أثناء إضافة المنتج: " . mysqli_error($con);
            }
        } else {
            $error = "حدث خطأ أثناء رفع الصورة.";
        }
    } else {
        $error = "يرجى اختيار صورة للمنتج.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة منتج جديد</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            direction: rtl;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #5a4d3a;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="file"], textarea, select {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="file"]:focus, textarea:focus, select:focus {
            border-color: #c8ad78;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            background-color: #c8ad78;
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #a88e50;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .success {
            color: #27ae60;
        }

        .error {
            color: #e74c3c;
        }

        a.back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #c8ad78;
            text-decoration: none;
        }

        a.back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>إضافة منتج جديد</h2>

    <?php if (isset($success)): ?>
        <p class="message success"><?= htmlspecialchars($success) ?></p>
    <?php elseif (isset($error)): ?>
        <p class="message error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="اسم المنتج" required>
        <input type="text" name="price" placeholder="السعر" required>
        <textarea name="description" placeholder="وصف المنتج" required></textarea>
        <select name="category" required>
            <option value="">اختر القسم</option>
            <option value="الكترونيات">الكترونيات</option>
            <option value="شاشات">شاشات</option>
            <option value="هواتف">هواتف</option>
            <option value="كمبيوتر">كمبيوتر</option>
            <option value="أواني منزلية">أواني منزلية</option>
            <option value="ملابس رجالية">ملابس رجالية</option>
            <option value="ملابس نسائية">ملابس نسائية</option>
            <option value="ملابس أطفال">ملابس أطفال</option>
            <option value="الصحة والجمال">الصحة والجمال</option>
            <option value="الألعاب والأطفال">الألعاب والأطفال</option>
        </select>
        <input type="file" name="image" required>
        <button type="submit" name="upload">رفع المنتج</button>
    </form>
    <a href="prod.php" class="back">⬅ العودة إلى إدارة المنتجات</a>
</div>

</body>
</html>
